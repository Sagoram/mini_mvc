<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Client
{
    private $id;
    private $email;
    private $nom;
    private $prenom;
    private $mdp;
    private $adresse;

    // =====================
    // Getters / Setters
    // =====================

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; return $this; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; return $this; }

    public function getMdp() { return $this->mdp; }
    public function setMdp($mdp) { $this->mdp = password_hash($mdp, PASSWORD_DEFAULT); return $this; }

    public function getAdresse() { return $this->adresse; }
    public function setAdresse($adresse) { $this->adresse = $adresse; return $this; }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les clients
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM Clients ORDER BY id_clients DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un client par son ID
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Clients WHERE id_clients = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un client par son email
     */
    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Clients WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau client (inscription)
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "INSERT INTO Clients (email, nom, prenom, mdp, adresse) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$this->email, $this->nom, $this->prenom, $this->mdp, $this->adresse]);
    }

    /**
     * Met à jour un client
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare(
            "UPDATE Clients SET email = ?, nom = ?, prenom = ?, adresse = ? WHERE id_clients = ?"
        );
        return $stmt->execute([$this->email, $this->nom, $this->prenom, $this->adresse, $this->id]);
    }

    /**
     * Vérifie le mot de passe
     */
    public function verifyPassword($password)
    {
        return password_verify($password, $this->mdp);
    }

    /**
     * Supprime un client
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM Clients WHERE id_clients = ?");
        return $stmt->execute([$id]);
    }
}
