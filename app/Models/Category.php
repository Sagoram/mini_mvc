<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Category
{
    private $id;
    private $nom;

    // =====================
    // Getters / Setters
    // =====================

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère toutes les catégories
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM Categories ORDER BY id_cat ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une catégorie par son ID
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Categories WHERE id_cat = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle catégorie
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO Categories (nom) VALUES (?)");
        return $stmt->execute([$this->nom]);
    }

    /**
     * Met à jour une catégorie
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE Categories SET nom = ? WHERE id_cat = ?");
        return $stmt->execute([$this->nom, $this->id]);
    }

    /**
     * Supprime une catégorie
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM Categories WHERE id_cat = ?");
        return $stmt->execute([$id]);
    }
}
