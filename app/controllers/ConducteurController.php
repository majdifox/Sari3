<?php
 namespace App\Controllers;

 use App\Models\Conducteur;

class ConducteurController{
    public $conducteur;
    public function __construct(){
        $this->conducteur = new Conducteur ;
    }

      public function showItinirairesbyConducteur(){
          $this->conducteur->getItinerairebyCondicteur();
      }
      public function showItiniraire(){
            
      }
      public function dashboard(){
            echo 'getItinerairebyCondicteur';
            $this->conducteur->getItinerairebyCondicteur($id_condecteur);
      }
      public function showItinirairedetails($idItineraire){
            $this->conducteur->createItiniraireDetails( $Itineraire);
      }
      
      
      public function addAnnonce() {
            //  @oussamaamou
        // mn b3d  call this function $this->conducteur->addAnnonce($data);
    
      }
      
      public function deleteAnnonce($id) {
            //  just call $this->conducteur->deleteAnnonce($id);
            
      }
      
      public function AcceptRequest($id_colis){
            //  just call $this->conducteur->AcceptRequest($id_colis);
      }
      public function RefuseRequest($id_colis){
            //  just call $this->conducteur->RefuseRequest($id_colis);
      }
      public function checkVolumeOfColis($idItineraire,$volume_of_new_colis){
            //  just call $this->conducteur-> checkVolumeOfColis($idItineraire,$volume_of_new_colis);
            
      }
      public function startRiding($idItineraire){
            //  just call $this->conducteur-> startRiding($idItineraire);
            
      }
      public function finishRiding($idItineraire){
            //  just call $this->conducteur-> finishRiding($idItineraire);
            
      }
      public function reachThePoint($id_Itineraire,$ville){
            //  just call $this->conducteur-> reachThePoint($id_Itineraire,$ville);
            
      }
      
      public function showVehiculeInfos($id){
        
      }
}

