# Installation de la base de données
1. Importer le fichier docs/database/schema.sql dans phpMyAdmin ou via la ligne de commande MySQL.
2. Vérifier que la base s'appelle ecommerce_mvc (voir app/config.ini).

# Lancer le projet
1. Placer le dossier mini_mvc dans le dossier htdocs de XAMPP.
2. Démarrer Apache et MySQL via le panneau XAMPP.
3. Lancer `php -S localhost:8000` dans le dossier public.

# Identifiants de test
alice@example.com / mdp1
bob@example.com / mdp2
carol@example.com / mdp3
david@example.com / mdp4
eve@example.com / mdp5

# Problèmes principals rencontrés

## 1. Erreur d'authentification MySQL
L'utilisateur `root` n'était pas accessible en ligne de commande due au plugin `caching_sha2_password`.

## 2. Erreurs de colonnes SQL
Le schéma utilise des noms de colonnes prefixés (`id_produit`, `id_cat`, `id_clients`) mais les modèles PHP référençaient juste `id`.

## 3. Serveur PHP intégré vs Apache
Le serveur Apache avec le `.htaccess` ne fonctionnait pas correctement pour les routes..

## 4. Authentification sans hachage de mot de passe
Les données de test avaient des mots de passe en texte brut mais le code utilisait `password_verify()

## 5. Routage des commandes 
La route `/order/history` était interprétée comme `/order/{id}` avec `history` comme ID.
