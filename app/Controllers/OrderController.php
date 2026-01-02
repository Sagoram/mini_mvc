<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Order;
use Mini\Models\Product;

class OrderController extends Controller
{
    /**
     * Affiche une commande
     */
    public function show(array $params = []): void
    {
        $orderId = (int)($params['id'] ?? 0);
        $order = Order::findById($orderId);

        if (!$order) {
            http_response_code(404);
            echo '404 - Commande non trouvée';
            return;
        }

        // Récupère les articles de la commande
        $pdo = \Mini\Core\Database::getPDO();
        $stmt = $pdo->prepare(
            "SELECT id_produit, quantite FROM Inclure WHERE id_commande = ?"
        );
        $stmt->execute([$orderId]);
        $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $orderItems = [];
        $total = 0;
        foreach ($items as $item) {
            $product = Product::findById($item['id_produit']);
            if ($product) {
                $subtotal = $product['prix'] * $item['quantite'];
                $orderItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantite'],
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        $this->render('order/show', [
            'order' => $order,
            'orderItems' => $orderItems,
            'total' => $total
        ]);
    }

    /**
     * Affiche l'historique des commandes du client
     */
    public function history(array $params = []): void
    {
        if (!isset($_SESSION['client_id'])) {
            header('Location: /auth/login');
            return;
        }

        $orders = Order::findByClient($_SESSION['client_id']);

        $this->render('order/history', ['orders' => $orders]);
    }
}
