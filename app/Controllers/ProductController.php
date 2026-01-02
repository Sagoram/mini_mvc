<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;
use Mini\Models\Category;

class ProductController extends Controller
{
    /**
     * Liste tous les produits ou filtre par catégorie
     */
    public function index(array $params = []): void
    {
        $products = Product::getAll();
        $categories = Category::getAll();
        $currentCategory = null;

        $this->render('product/index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $currentCategory
        ]);
    }

    /**
     * Affiche le détail d'un produit
     */
    public function show(array $params = []): void
    {
        $productId = (int)($params['id'] ?? 0);
        $product = Product::findById($productId);

        if (!$product) {
            http_response_code(404);
            echo '404 - Produit non trouvé';
            return;
        }

        $this->render('product/show', ['product' => $product]);
    }

    /**
     * Filtre les produits par catégorie
     */
    public function byCategory(array $params = []): void
    {
        $categoryId = (int)($params['id'] ?? 0);
        $category = Category::findById($categoryId);

        if (!$category) {
            http_response_code(404);
            echo '404 - Catégorie non trouvée';
            return;
        }

        $products = Product::findByCategory($categoryId);
        $categories = Category::getAll();

        $this->render('product/index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }
}
