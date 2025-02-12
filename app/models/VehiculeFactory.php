<?php
namespace App\Models;


class VehiculeFactory {
    


    public function createVehicule($VehiculeData) {
       return new Vehicule($VehiculeData['id']=null,$expediteur_id,$VehiculeData['itineare_id'],$VehiculeData['destination'],$VehiculeData['volume'],$VehiculeData['poids'],$VehiculeData['date_depart'],$VehiculeData['date_arriver'],$VehiculeData['status'],$VehiculeData['etat']);
    }
    public function getVehicule($id) {
        $VehiculeData =   Vehicule::get($id);
        if ($Vehicule) {
         return  $this->createVehicule($VehiculeData['id'],$expediteur_id,$VehiculeData['itineare_id'],$VehiculeData['destination'],$VehiculeData['volume'],$VehiculeData['poids'],$VehiculeData['date_depart'],$VehiculeData['date_arriver'],$VehiculeData['status'],$VehiculeData['etat']);
         # code...
        }else{
         echo 'not found';
        }
    }
    
    public function getVehiculeByExpediteur($id) {
        // $sql = "SELECT * FROM Vehicule WHERE expediteur_id = :expediteur_id";
        // $stmt = $this->db->prepare($sql);
        // $stmt = $this->db->bindParam(':expediteur_id',$id);
        // $stmt->exectute();
        // $Vehicule = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $list = [];
        // $i = 0;
        // foreach ($Vehicule as $coli) {
        //  $list[$i] = $this->createVehicule($Vehicule);
        //  $i++;
        // } 
        // return $list;
    }
    public function getVehiculeByVillesANDExpediteur($ville,$id) {
        // $sql = "SELECT * FROM Vehicule WHERE expediteur_id = :expediteur_id";
        // $stmt = $this->db->prepare($sql);
        // $stmt = $this->db->bindParam(':expediteur_id',$id);
        // $stmt->exectute();
        // $Vehicule = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $list = [];
        // $i = 0;
        // foreach ($Vehicule as $coli) {
        //  $list[$i] = $this->createVehicule($Vehicule);
        //  $i++;
        // } 
        // return $list;
    }
    public function addVehicule($VehiculeData){
      $Vehicule =   $this->createVehicule($VehiculeData);
      $Vehicule->create();

    }
    public function UpdateVehicule($VehiculeData){
      $Vehicule =   $this->createVehicule($VehiculeData);
      $Vehicule->create();

    }
}

