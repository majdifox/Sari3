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
        }else{
         echo 'not found';
        }
    }
    
    public function getVehiculeByExpediteur($id) {
        
    }
    public function getVehiculeByVillesANDExpediteur($ville,$id) {
        
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

