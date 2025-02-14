<?php
namespace App\Models;

use PDO;
use Core\Model;
use Core\Database;
class Itineraire  {
    private $id;
    private $conducteur_id;
    private $vehicule_id;
    private $date_depart;
    private $date_arriver;
    private $statut;
    private $db;

    public function __construct($id = null, $conducteur_id = null, $vehicule_id = null, $date_depart = null, $date_arriver = null, $statut = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->id = $id;
        $this->conducteur_id = $conducteur_id;
        $this->vehicule_id = $vehicule_id;
        $this->date_depart = $date_depart;
        $this->date_arriver = $date_arriver;
        $this->statut = $statut;
    }

    // Get all itineraries by driver ID
    public static function getAllByConducteur($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM itineraire WHERE conducteur_id = :conducteur_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':conducteur_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all itineraries by sender ID (expediteur)
    public static function getAllByExpediteur($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT i.* FROM itineraire i
                  JOIN colis c ON i.id = c.itineraire_id
                  WHERE c.expediteur_id = :expediteur_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':expediteur_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific itinerary by ID
    public static function get($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM itineraire WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete an itinerary by ID
    public  function delete($id) {
        $query = "DELETE FROM itineraire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public static function create($id,$TimingData) {
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO public.itineraire(
	 conducteur_id, vehicule_id, date_depart, date_arriver)
	VALUES (:conducteur_id, :vehicule_id, :date_depart, :date_arriver) RETURNING  id;";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':conducteur_id', $_SESSION["user"]['id']);
        $stmt->bindParam(':vehicule_id', $id);
        $stmt->bindParam(':date_depart', $TimingData['date_depart']);
        $stmt->bindParam(':date_arriver', $TimingData['date_arriver']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getId() {
        return $this->id;
     }
     public function getConducteurID(){
        return $this->conducteur_id;
    }

    public function getVehiculeID(){
        return $this->vehicule_id;
    }

    public function getDateDepart(){
        return $this->date_depart;
    }

    public function getDateArriver(){
        return $this->date_arriver;
    }

    public function getStatut(){
        return $this->statut;
    }

   


    // setters

    public function setVehiculeID($vehicule_id){
        $this->vehicule_id = $vehicule_id;
    }

    public function setDateDepart($date_depart){
        $this->date_depart = $date_depart;
    }

    public function setDateArriver($date_arriver){
        $this->date_arriver = $date_arriver;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }
}