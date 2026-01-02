<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Client;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function register(array $params = []): void
    {
        $this->render('auth/register', ['error' => $_SESSION['auth_error'] ?? null]);
        unset($_SESSION['auth_error']);
    }

    /**
     * Traite l'inscription
     */
    public function registerPost(array $params = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/register');
            return;
        }

        $email = $_POST['email'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $mdp = $_POST['mdp'] ?? '';
        $mdp_confirm = $_POST['mdp_confirm'] ?? '';
        $adresse = $_POST['adresse'] ?? '';

        // Validation basique
        if (empty($email) || empty($nom) || empty($prenom) || empty($mdp) || empty($adresse)) {
            $_SESSION['auth_error'] = 'Tous les champs sont requis.';
            header('Location: /auth/register');
            return;
        }

        if ($mdp !== $mdp_confirm) {
            $_SESSION['auth_error'] = 'Les mots de passe ne correspondent pas.';
            header('Location: /auth/register');
            return;
        }

        if (Client::findByEmail($email)) {
            $_SESSION['auth_error'] = 'Cet email est déjà utilisé.';
            header('Location: /auth/register');
            return;
        }

        $client = new Client();
        $client->setEmail($email);
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setMdp($mdp);
        $client->setAdresse($adresse);

        if ($client->save()) {
            $_SESSION['auth_success'] = 'Inscription réussie. Veuillez vous connecter.';
            header('Location: /auth/login');
        } else {
            $_SESSION['auth_error'] = 'Erreur lors de l\'inscription.';
            header('Location: /auth/register');
        }
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function login(array $params = []): void
    {
        $this->render('auth/login', ['error' => $_SESSION['auth_error'] ?? null, 'success' => $_SESSION['auth_success'] ?? null]);
        unset($_SESSION['auth_error']);
        unset($_SESSION['auth_success']);
    }

    /**
     * Traite la connexion
     */
    public function loginPost(array $params = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/login');
            return;
        }

        $email = $_POST['email'] ?? '';
        $mdp = $_POST['mdp'] ?? '';

        if (empty($email) || empty($mdp)) {
            $_SESSION['auth_error'] = 'Email et mot de passe requis.';
            header('Location: /auth/login');
            return;
        }

        $client = Client::findByEmail($email);
        if (!$client || $mdp !== $client['mdp']) {
            $_SESSION['auth_error'] = 'Email ou mot de passe incorrect.';
            header('Location: /auth/login');
            return;
        }

        // Connexion réussie
        $_SESSION['client_id'] = $client['id_clients'];
        $_SESSION['client_email'] = $client['email'];
        $_SESSION['client_nom'] = $client['nom'];
        $_SESSION['client_prenom'] = $client['prenom'];

        header('Location: /');
    }

    /**
     * Déconnexion
     */
    public function logout(array $params = []): void
    {
        session_destroy();
        header('Location: /');
    }
}
