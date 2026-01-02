<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;
use Mini\Models\Order;
use Mini\Models\Client;

class CheckoutController extends Controller
{
    /**
     * Affiche le formulaire de validation du panier
     */
    public function view(array $params = []): void
    {
        if (!isset($_SESSION['client_id'])) {
            header('Location: /auth/login');
            return;
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header('Location: /cart');
            return;
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = Product::findById($item['product_id']);
            if ($product) {
                $subtotal = $product['prix'] * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        $this->render('checkout/view', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    /**
     * Crée la commande
     */
    public function process(array $params = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /checkout');
            return;
        }

        if (!isset($_SESSION['client_id'])) {
            header('Location: /auth/login');
            return;
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header('Location: /cart');
            return;
        }

        // Calcule le total
        $total = 0;
        foreach ($cart as $item) {
            $product = Product::findById($item['product_id']);
            if ($product) {
                $total += $product['prix'] * $item['quantity'];
            }
        }

        // Crée la commande
        $order = new Order();
        $order->setIdClient($_SESSION['client_id']);
        $order->setMontantTotal($total);
        $order->setStatut('en_attente');

        if ($order->save()) {
            // Récupère l'ID de la commande
            $pdo = \Mini\Core\Database::getPDO();
            $orderId = $pdo->lastInsertId();

            // Lie les produits à la commande
            foreach ($cart as $item) {
                $stmt = $pdo->prepare(
                    "INSERT INTO Inclure (id_produit, id_commande, quantite) VALUES (?, ?, ?)"
                );
                $stmt->execute([$item['product_id'], $orderId, $item['quantity']]);
            }

            // Lie le client à la commande
            $stmt = $pdo->prepare(
                "INSERT INTO passer (id_client, id_commande) VALUES (?, ?)"
            );
            $stmt->execute([$_SESSION['client_id'], $orderId]);

            // Vide le panier
            unset($_SESSION['cart']);

            header('Location: /order/' . $orderId);
        } else {
            $_SESSION['checkout_error'] = 'Erreur lors de la création de la commande.';
            header('Location: /checkout');
        }
    }
}
