<?php
require_once 'expoditeur.php';
require_once 'conducteur.php';
require_once 'Admin.php';
require_once 'colis.php';

class ColisFactory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function createColis($ColisData) {
       return new Colis($ColisData['id']=null,$expediteur_id,$ColisData['itineare_id'],$ColisData['destination'],$ColisData['volume'],$ColisData['poids'],$ColisData['date_depart'],$ColisData['date_arriver'],$ColisData['status'],$ColisData['etat']);
    }
    public function getColis($id) {
        $ColisData =   Colis::get($id);
        if ($colis) {
         return  $this->createColis($ColisData['id'],$expediteur_id,$ColisData['itineare_id'],$ColisData['destination'],$ColisData['volume'],$ColisData['poids'],$ColisData['date_depart'],$ColisData['date_arriver'],$ColisData['status'],$ColisData['etat']);
         # code...
        }else{
         echo 'not found';
        }
    }
    public function AcceptColis($id){
       $colis = $this->getColis($id);
       $colis->accept();
    }
    public function RefuseColis($id){
       $colis = $this->getColis($id);
       $colis->refuse();
    }
    public function getColisByExpediteur($id) {
        $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->bindParam(':expediteur_id',$id);
        $stmt->exectute();
        $Colis = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = [];
        $i = 0;
        foreach ($Colis as $coli) {
         $list[$i] = $this->createColis($colis);
         $i++;
        } 
        return $list;
    }
    public function getColisByVillesANDExpediteur($ville,$id) {
        $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->bindParam(':expediteur_id',$id);
        $stmt->exectute();
        $Colis = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = [];
        $i = 0;
        foreach ($Colis as $coli) {
         $list[$i] = $this->createColis($colis);
         $i++;
        } 
        return $list;
    }
    public function addColis($ColisData){
      $colis =   $this->createColis($ColisData);
      $colis->create();

    }
}

