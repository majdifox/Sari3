<?php
namespace App\Models;

use PDO;
use Core\Model;

use Core\Database;

class ItineraireDetails      {
    private $id;
    private $iteneraire_id;
    private $orders;
    private $ville;
    private $status;
    private $db;

    public function __construct($itineraire_id = null, $orders = null, $ville = null, $statut = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->iteneraire_id = $itineraire_id;
        $this->orders = $orders;
        $this->ville = $ville;
        $this->status = $statut;
    }

    // Get all itinerary details by conductor ID
    public function getAllbyConducteur($id) {
        $query = "SELECT di.* FROM details_itineraire di
                  JOIN itineraire i ON di.itineraire_id = i.id
                  WHERE i.conducteur_id = :conducteur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':conducteur_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($id,$ville,$order) {
        echo $id;
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO public.details_itineraire(
	 itineraire_id, orders, ville)
	VALUES ( :itineraire_id, :orders, :ville);";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':itineraire_id', $id);
        $stmt->bindParam(':orders', $order);
        $stmt->bindParam(':ville', $ville);
        return $stmt->execute();
    }
    // Get details of a specific itinerary
    public static function getDetailsOfItiniraire($itineraire_id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM details_itineraire WHERE itineraire_id = :itineraire_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update status to 'En Transit'
    public function enTransit() {
        $this->setStatus('En Transit');
        $query = "UPDATE details_itineraire SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update status to 'Arrive'
    public function Arrive() {
        $this->setStatus('Arrive');
        $query = "UPDATE details_itineraire SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get itinerary details by ID
    public function getByID($id) {
        $query = "SELECT * FROM details_itineraire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete itinerary details by ID
    public function delete($id) {
        $query = "DELETE FROM details_itineraire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Set status
    public function setStatus($status) {
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function getItineraireId() {
        return $this->iteneraire_id;
    }
    public function getOrders() {
        return $this->orders;
    }
    public function getVille() {
        return $this->ville;
    }
    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setItineraireId($itineraire_id) {
        $this->iteneraire_id = $itineraire_id;
    }
    public function setOrders($orders) {
        $this->orders = $orders;
    }
    public function setVille($ville) {
        $this->ville = $ville;
    }
}