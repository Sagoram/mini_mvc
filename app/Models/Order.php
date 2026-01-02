<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Order
{
    private $id;
    private $id_client;
    private $montant_total;
    private $statut;

    // =====================
    // Getters / Setters
    // =====================

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getIdClient() { return $this->id_client; }
    public function setIdClient($id_client) { $this->id_client = $id_client; return $this; }

    public function getMontantTotal() { return $this->montant_total; }
    public function setMontantTotal($montant_total) { $this->montant_total = $montant_total; return $this; }

    public function getStatut() { return $this->statut; }
    public function setStatut($statut) { $this->statut = $statut; return $this; }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère toutes les commandes
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM Commandes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une commande par son ID
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Commandes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les commandes d'un client
     */
    public static function findByClient($id_client)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Commandes WHERE id IN (SELECT id_commande FROM passer WHERE id_client = ?) ORDER BY id DESC");
        $stmt->execute([$id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle commande
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "INSERT INTO Commandes (montant_total, statut) VALUES (?, ?)"
        );
        return $stmt->execute([$this->montant_total, $this->statut]);
    }

    /**
     * Met à jour une commande
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "UPDATE Commandes SET montant_total = ?, statut = ? WHERE id = ?"
        );
        return $stmt->execute([$this->montant_total, $this->statut, $this->id]);
    }

    /**
     * Supprime une commande
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM Commandes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
