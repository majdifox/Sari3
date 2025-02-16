<?php
namespace App\Models;

use PDO;
use Core\Model;


use Core\Database;

class Colis {
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
    private $origin;
    private $nom;
    private $db;

    public function __construct($id = null, $expediteur_id = null, $itineraire_id = null, $destination = null, $volume = null, $poids = null, $date_depart = null, $date_arriver = null, $statut = null, $etat = null, $nom = null ,$origin = null) {
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
        $this->origin = $origin;
        $this->nom = $nom;
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
        
        $id = $this->getId();
        $expediteur_id = $this->getExpediteurId(); 
        $itineraire_id = $this->getItineraireId();
        $destination = $this->getDestination();
        $volume = $this->getVolume();
        $poids = $this->getPoids();
        $date_depart = $this->getDateDepart();
        $date_arriver = $this->getDateArriver();
        $statut = $this->getStatus();
        $origin = $this->getOrigin();
        $nom = $this->getNom();
       
        $query = "INSERT INTO colis (expediteur_id, itineraire_id, destination, volume, poids, origin,nom) 
                  VALUES (:expediteur_id, :itineraire_id, :destination, :volume, :poids, :origin,:nom)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':expediteur_id', $expediteur_id, PDO::PARAM_INT);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
        $stmt->bindParam(':volume', $volume, PDO::PARAM_INT);
        $stmt->bindParam(':poids', $poids, PDO::PARAM_INT);
        $stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update() {
        $id = $this->getId();
        $expediteur_id = $this->getExpediteurId(); 
        $itineraire_id = $this->getItineraireId();
        $destination = $this->getDestination();
        $volume = $this->getVolume();
        $poids = $this->getPoids();
        $date_depart = $this->getDateDepart();
        $date_arriver = $this->getDateArriver();
        $statut = $this->getStatus();
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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':expediteur_id', $expediteur_id, PDO::PARAM_INT);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
        $stmt->bindParam(':volume', $volume, PDO::PARAM_STR);
        $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
        $stmt->bindParam(':date_depart', $date_depart, PDO::PARAM_STR);
        $stmt->bindParam(':date_arriver', $date_arriver, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);
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

////////////////////////////



public static function getColisParVilleEtItineraire($itineraire_id,$ville) {
    
    $db = Database::getInstance()->getConnection();

    $sql = "SELECT DISTINCT(c.*)
            FROM colis c
            JOIN itineraire i ON c.Itineraire_id = i.ID
            JOIN details_itineraire d ON i.ID = d.Itineraire_id
            WHERE  d.Itineraire_id= :id AND c.Destination = :ville AND c.Statut = 'En préparation' OR c.Statut = 'En transit'
    ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
        $stmt->bindParam(':id', $itineraire_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}


public function colisLivrer(){
    $ColisID = $this->getId();
    
    $stmt = $this->db->prepare("UPDATE colis SET Statut = 'Livré' WHERE ID = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute([$ColisID]);
    
}


public function colisNonLivrer(){
    $ColisID = $this->getId();

    $stmt = $this->db->prepare("UPDATE colis SET Statut = 'Non livré' WHERE ID = ? ");
    $stmt->execute([$ColisID]);
    
}










//////////////////////////////
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
        return  $this->id;
    }
    public function getExpediteurId(){
        return  $this->expediteur_id;
    }
    public function getItineraireId(){
        return  $this->itineraire_id;
    }
    public function getOrigin(){
        return  $this->origin;
    }
    public function getNom(){
        return  $this->nom;
    }
}