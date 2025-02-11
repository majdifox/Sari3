<?php


class conducteurController{
    public $conducteur;
    public function __construct(){
        $this->conducteur = new conducteur;
    }

    public function showVehiculeInfos($id){

    }
    public function showItinirairesbyConducteur($id){

    }
    public function showItiniraire($idItineraire){
        
    }
    public function showItinirairedetails($idItineraire){
        $this->conducteur->createItiniraireDetails( $Itineraire);
    }


    public function addAnnonce() {
    //  check if all data $_POST are good 
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
 
}

