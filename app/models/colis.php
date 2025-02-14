<?php
namespace App\Models;
use Core\Database;
use Core\Model;

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
    private $table = 'colis';
    public function __construct($id,$expediteur_id,$itineraire,$destination,$volume,$poids,$date_depart,$date_arriver,$statut,$etat){
        
    }
    
    public function getAll() {
        // $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
        //         FROM {$this->table} c
        //         JOIN utilisateurs u ON c.expediteur_id = u.id
        //         ORDER BY c.date_depart DESC";
        // return $this->query($sql);
    }
    public static function get($id){
        // return specifique colis
    }
    public function getByItineraire($id) {
        // $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
        //         FROM {$this->table} c
        //         JOIN utilisateurs u ON c.expediteur_id = u.id
        //         WHERE c.id IN (
        //             SELECT colis_id FROM details_itineraire WHERE itineraire_id = ?
        //         )
        //         ORDER BY c.date_depart DESC";
        // return $this->query($sql, [$id]);
    }
    public function getByExpediteur($id) {
        // $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
        //         FROM {$this->table} c
        //         JOIN utilisateurs u ON c.expediteur_id = u.id
        //         WHERE c.id IN (
        //             SELECT colis_id FROM details_itineraire WHERE itineraire_id = ?
        //         )
        //         ORDER BY c.date_depart DESC";
        // return $this->query($sql, [$id]);
    }

    public function accept() {
        // $sql = "UPDATE {$this->table} SET statut = 'Livré' WHERE id = ?";
        // return $this->execute($sql, [$id]);
        $etat = 'Accepté';
        $this->setEtat($etat) ;
        $this->update();

    }
    public function refuse() {
        // $sql = "UPDATE {$this->table} SET statut = 'Livré' WHERE id = ?";
        // return $this->execute($sql, [$id]);
        $etat = 'Refus"';
        $this->setEtat($etat) ;
        $this->update();
    }

    public function create() {
        // $columns = implode(', ', array_keys($data));
        // $values = implode(', ', array_fill(0, count($data), '?'));
        
        // $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        // return $this->execute($sql, array_values($data));
    }
    public function update() {
        // $columns = implode(', ', array_keys($data));
        // $values = implode(', ', array_fill(0, count($data), '?'));
        
        // $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        // return $this->execute($sql, array_values($data));
    }

    public function delete(){

    }
    public function read(){

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



    /// getters  ans  setters

    public function setEtat($etat){
        $this->etat = $etat;
    }
    public function setStatus($statut){
        $this->status = $statut;
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
        return $this->etat = $etat;
    }
    public function getStatus(){
       return  $this->status = $statut;
    }
    public function getDateArriver(){
       return  $this->date_arriver = $date_arriver;
    }
    public function getDateDepart(){
       return  $this->date_depart = $date_depart;
    }
    public function getPoids(){
       return  $this->poids = $poids;
    }
    public function getVolume(){
       return  $this->volume = $volume;
    }
    public function getDestination(){
       return  $this->destination = $destination;
    }
    public function getId(){
       return  $this->destination = $destination;
    }
    public function getExpediteurId(){
       return  $this->destination = $destination;
    }
    public function getItineraireId(){
       return  $this->destination = $destination;
    }
    
    
    
    
   
}