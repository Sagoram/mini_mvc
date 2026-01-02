<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Product
{
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $id_cat;

    // =====================
    // Getters / Setters
    // =====================

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; return $this; }

    public function getPrix() { return $this->prix; }
    public function setPrix($prix) { $this->prix = $prix; return $this; }

    public function getStock() { return $this->stock; }
    public function setStock($stock) { $this->stock = $stock; return $this; }

    public function getIdCat() { return $this->id_cat; }
    public function setIdCat($id_cat) { $this->id_cat = $id_cat; return $this; }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les produits
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM Produits ORDER BY id_produit DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un produit par son ID
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Produits WHERE id_produit = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les produits d'une catégorie
     */
    public static function findByCategory($id_cat)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Produits WHERE id_cat = ? ORDER BY id_produit DESC");
        $stmt->execute([$id_cat]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau produit
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "INSERT INTO Produits (nom, description, prix, stock, id_cat) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$this->nom, $this->description, $this->prix, $this->stock, $this->id_cat]);
    }

    /**
     * Met à jour un produit
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "UPDATE Produits SET nom = ?, description = ?, prix = ?, stock = ?, id_cat = ? WHERE id_produit = ?"
        );
        return $stmt->execute([$this->nom, $this->description, $this->prix, $this->stock, $this->id_cat, $this->id]);
    }

    /**
     * Supprime un produit
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM Produits WHERE id_produit = ?");
        return $stmt->execute([$id]);
    }
}
