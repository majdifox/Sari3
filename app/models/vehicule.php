<?php
namespace App\Models;

use Core\Model;

class Vehicule extends Model {
    private $id;
    private $matricule;
    private $model;
    private $volume;
    
    private $table = 'vehicule';
    public function __construct($id,$expediteur_id,$itineraire,$destination,$volume,$poids,$date_depart,$date_arriver,$statut,$etat){
        
    }
    
    public static function getAll() {
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

    }


    public function add($data) {
        // $columns = implode(', ', array_keys($data));
        // $values = implode(', ', array_fill(0, count($data), '?'));

    }





    /// getters  ans  setters

    public function setMatricule($matricule){
        $this->matricule = $matricule;
    }
    public function setModel($model){
        $this->model = $model;
    }
    public function setVolume($volume){
        $this->volume = $volume;
    }
    
    public function getMatricule(){
        return $this->matricule = $matricule;
    }
    public function getModel(){
       return  $this->model = $model;
    }
    
    public function getVolume(){
       return  $this->volume = $volume;
    }
    
    public function getId(){
       return  $this->destination = $destination;
    }
    
    
    
    
    
   
}