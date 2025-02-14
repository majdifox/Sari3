<?php
namespace App\Models;
use Core\Database;
use Core\Model;
use PDO;

class Colis implements Model {
    private $id;
    private $expediteur_id;
    private $itineraire_id;
    private $destination;
    private $volume;
    private $poids;
    private $date_depart;
    private $date_arriver;
    private $statut;
    private $etat;
    private $db;

    public function __construct($id = null, $expediteur_id = null, $itineraire_id = null, $destination = null, $volume = null, $poids = null, $date_depart = null, $date_arriver = null, $statut = null, $etat = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->id = $id;
        $this->expediteur_id = $expediteur_id;
        $this->itineraire_id = $itineraire_id;
        $this->destination = $destination;
        $this->volume = $volume;
        $this->poids = $poids;
        $this->date_depart = $date_depart;
        $this->date_arriver = $date_arriver;
        $this->statut = $statut;
        $this->etat = $etat;
    }

    public function getAll() {
        $query = "SELECT * FROM colis";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM colis WHERE ID = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByItineraire($itineraire_id) {
        $query = "SELECT * FROM colis WHERE itineraire_id = :itineraire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByExpediteur($expediteur_id) {
        $query = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':expediteur_id', $expediteur_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function accept() {
        $query = "UPDATE colis SET statut = 'En transit' WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function refuse() {
        $query = "UPDATE colis SET statut = 'Refusé' WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function create() {
        $query = "INSERT INTO colis (expediteur_id, itineraire_id, destination, volume, poids, date_depart, date_arriver, statut, etat) 
                  VALUES (:expediteur_id, :itineraire_id, :destination, :volume, :poids, :date_depart, :date_arriver, :statut, :etat)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':expediteur_id', $this->expediteur_id, PDO::PARAM_INT);
        $stmt->bindParam(':itineraire_id', $this->itineraire_id, PDO::PARAM_INT);
        $stmt->bindParam(':destination', $this->destination, PDO::PARAM_STR);
        $stmt->bindParam(':volume', $this->volume, PDO::PARAM_STR);
        $stmt->bindParam(':poids', $this->poids, PDO::PARAM_STR);
        $stmt->bindParam(':date_depart', $this->date_depart, PDO::PARAM_STR);
        $stmt->bindParam(':date_arriver', $this->date_arriver, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR);
        $stmt->bindParam(':etat', $this->etat, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE colis 
                  SET expediteur_id = :expediteur_id, 
                      itineraire_id = :itineraire_id, 
                      destination = :destination, 
                      volume = :volume, 
                      poids = :poids, 
                      date_depart = :date_depart, 
                      date_arriver = :date_arriver, 
                      statut = :statut, 
                      etat = :etat 
                  WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':expediteur_id', $this->expediteur_id, PDO::PARAM_INT);
        $stmt->bindParam(':itineraire_id', $this->itineraire_id, PDO::PARAM_INT);
        $stmt->bindParam(':destination', $this->destination, PDO::PARAM_STR);
        $stmt->bindParam(':volume', $this->volume, PDO::PARAM_STR);
        $stmt->bindParam(':poids', $this->poids, PDO::PARAM_STR);
        $stmt->bindParam(':date_depart', $this->date_depart, PDO::PARAM_STR);
        $stmt->bindParam(':date_arriver', $this->date_arriver, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR);
        $stmt->bindParam(':etat', $this->etat, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Get Colis by Ville (City) and Expediteur (Sender) ID
    public function getColisByVillesANDExpediteur($ville, $id) {
        $query = "SELECT * FROM colis 
                    WHERE destination = :ville AND expediteur_id = :expediteur_id";
        $stmt = (new Colis())->db->prepare($query);
        $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
        $stmt->bindParam(':expediteur_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public static function CountAll() {
        $connexion = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) as numbertotal FROM colis ";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['numbertotal'];
    }
    public static function CountByStatus($status) {
        $connexion = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) as numbertotalcolis FROM colis where statut=:statut  ";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':statut', $status);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['numbertotalcolis'];
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }
    public function setStatus($statut){
        $this->statut = $statut;
    }
    public function setDateArriver($date_arriver){
        $this->date_arriver = $date_arriver;
    }
    public function setPoids($poids){
        $this->poids = $poids;
    }
    public function setVolume($volume){
        $this->volume = $volume;
    }
    public function setDestination($destination){
        $this->destination = $destination;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function getStatus(){
        return  $this->statut;
    }
    public function getDateArriver(){
        return  $this->date_arriver;
    }
    public function getDateDepart(){
        return  $this->date_depart;
    }
    public function getPoids(){
        return  $this->poids;
    }
    public function getVolume(){
        return  $this->volume;
    }
    public function getDestination(){
        return  $this->destination;
    }
    public function getId(){
        return  $this->destination;
    }
    public function getExpediteurId(){
        return  $this->destination;
    }
    public function getItineraireId(){
        return  $this->destination;
    }
    
    // les 5 dernier colis
    public static function getRecentColis()
{
    $connexion = Database::getInstance()->getConnection();
    
    // Join with utilisateurs table to get expediteur information
    $query = "SELECT c.*, 
                     u.prenom as expediteur_prenom, 
                     u.nom as expediteur_nom
              FROM colis c
              JOIN utilisateurs u ON c.expediteur_id = u.id
              ORDER BY c.date_depart DESC 
              LIMIT 5";
              
    $stmt = $connexion->prepare($query);
    $stmt->execute();
    $recent_colis = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $recent_colis;
}


    
   
}