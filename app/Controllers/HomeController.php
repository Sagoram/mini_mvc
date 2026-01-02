<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;

// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Affiche la page d'accueil avec les derniers produits
    public function index(): void
    {
        $products = \Mini\Models\Product::getAll();
        $this->render('home/index', [
            'title' => 'Accueil',
            'products' => $products,
        ]);
    }

    public function users(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/users', params: [
            // Définit le titre transmis à la vue
            'users' => $users = User::getAll(),
        ]);
    }
}