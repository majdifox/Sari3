<?php
 namespace App\Controllers;

 use App\Models\Expediteur;

class ExpediteurController{
    public $Expediteur;
    public function __construct(){
        $this->Expediteur = new Expediteur;
    }

   
    public function showItinirairesbyExpediteur($id){

    }
    public function dashboard(){
      echo 'hola amigos';
    }
    public function showItiniraire($idItineraire){
        
    }
    public function showItinirairedetails($idItineraire){
        $this->Expediteur->deleteColis( $Itineraire);
    }


    public function addAnnonce() {
    //  check if all data $_POST are good 
        // mn b3d  call this function $this->Expediteur->addAnnonce($data);
    
  }

  public function deleteAnnonce($id) {
    //  just call $this->Expediteur->deleteAnnonce($id);
 
  }

  public function AcceptRequest($id_colis){
    //  just call $this->Expediteur->AcceptRequest($id_colis);
  }
  public function RefuseRequest($id_colis){
    //  just call $this->Expediteur->RefuseRequest($id_colis);
  }
  public function checkVolumeOfColis($idItineraire,$volume_of_new_colis){
        //  just call $this->Expediteur-> checkVolumeOfColis($idItineraire,$volume_of_new_colis);

  }
  public function startRiding($idItineraire){
        //  just call $this->Expediteur-> startRiding($idItineraire);
    
  }
  public function finishRiding($idItineraire){
        //  just call $this->Expediteur-> finishRiding($idItineraire);
    
  }
  public function reachThePoint($id_Itineraire,$ville){
        //  just call $this->Expediteur-> reachThePoint($id_Itineraire,$ville);

  }
 
}

