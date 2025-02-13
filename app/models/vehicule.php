<?php
namespace App\Models;

use Core\Database;
use PDO;

class Vehicule {
    private $id;
    private $matricule;
    private $model;
    private $volume;
    private $db;

    public function __construct($id = null, $matricule = null, $model = null, $volume = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->id = $id;
        $this->matricule = $matricule;
        $this->model = $model;
        $this->volume = $volume;
    }

    // Get all vehicles
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM vehicule";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a vehicle by ID
    public static function getByID($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM vehicule WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get vehicles by itinerary ID
    public function getByItineraire($itineraire_id) {
        $query = "SELECT v.* FROM vehicule v 
                  JOIN itineraire i ON v.id = i.vehicule_id 
                  WHERE i.id = :itineraire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new vehicle
    public function add($data) {
        $query = "INSERT INTO vehicule (matricule, model, volume) 
                  VALUES (:matricule, :model, :volume)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':matricule', $data['matricule'], PDO::PARAM_STR);
        $stmt->bindParam(':model', $data['model'], PDO::PARAM_STR);
        $stmt->bindParam(':volume', $data['volume'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Update a vehicle
    public function update() {
        $query = "UPDATE vehicule 
                  SET matricule = :matricule, 
                      model = :model, 
                      volume = :volume 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':model', $this->model, PDO::PARAM_STR);
        $stmt->bindParam(':volume', $this->volume, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Delete a vehicle
    public function delete() {
        $query = "DELETE FROM vehicule WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Getters
    public function getMatricule() {
        return $this->matricule;
    }
    public function getModel() {
        return $this->model;
    }
    public function getVolume() {
        return $this->volume;
    }
    public function getId() {
        return $this->id;
    }

    // Setters
    public function setMatricule($matricule) {
        $this->matricule = $matricule;
    }
    public function setModel($model) {
        $this->model = $model;
    }
    public function setVolume($volume) {
        $this->volume = $volume;
    }
}