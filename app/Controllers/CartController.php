<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;

class CartController extends Controller
{
    /**
     * Affiche le panier
     */
    public function view(array $params = []): void
    {
        $cart = $_SESSION['cart'] ?? [];
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

        $this->render('cart/view', ['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Ajoute un produit au panier
     */
    public function add(array $params = []): void
    {
        $product_id = (int)($params['id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 1);

        if ($product_id <= 0 || $quantity <= 0) {
            header('Location: /');
            return;
        }

        $product = Product::findById($product_id);
        if (!$product) {
            header('Location: /');
            return;
        }

        // Initialise le panier s'il n'existe pas
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Cherche si le produit est déjà dans le panier
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // Ajoute le produit s'il n'existe pas
        if (!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'quantity' => $quantity
            ];
        }

        header('Location: /cart');
    }

    /**
     * Supprime un produit du panier
     */
    public function remove(array $params = []): void
    {
        $product_id = (int)($params['id'] ?? 0);

        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_filter(
                $_SESSION['cart'],
                fn($item) => $item['product_id'] !== $product_id
            );
            // Réindexe le tableau
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        header('Location: /cart');
    }

    /**
     * Vide le panier
     */
    public function clear(array $params = []): void
    {
        $_SESSION['cart'] = [];
        header('Location: /cart');
    }
}
