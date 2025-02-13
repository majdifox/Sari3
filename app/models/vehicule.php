<?php
namespace App\Models;

use Core\Model;

class Vehicule  {
    private $id;
    private $matricule;
    private $model;
    private $volume;
    
    private $table = 'vehicule';
    public function __construct($id=null,$matricule,$model,$volume){
            $this->id = $id;
            $this->matricule = $matricule;
            $this->model = $model;
            $this->volume = $volume;
        
    }
    
    public static function getAll() {
        // $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
        //         FROM {$this->table} c
        //         JOIN utilisateurs u ON c.expediteur_id = u.id
        //         ORDER BY c.date_depart DESC";
        // return $this->query($sql);
    }
    public static function get($id){
        // return specifique vehicule
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