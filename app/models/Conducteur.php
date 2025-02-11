<?php
namespace App\Models;

use Core\Model;

class Conducteur  extends  User {
    private $ItineraireFactory;
    public function __construct($ItineraireFactory){
        parent::__construct();
        $this->ItineraireFactory = new ItineraireFactory();
    }
    public function addAnnonce($data) {
    //   $sql = "SELECT * FROM users WHERE id = :id";
    
  }

  public function deleteAnnonce($id) {
    //   $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
 
  }

  public function AcceptRequest($id_colis){
    // accept request dyl expediteur bach idkhl colis dylo
    checkVolumeOfColis($idItineraire,$volume_of_new_colis);
  }
  public function checkVolumeOfColis($idItineraire,$volume_of_new_colis){
    // check Volume of colis li ghaytzad 3la dyl lkhrin b volume dyl vehicule
    // b idItineraire ghadi nl9aw id dyl vehicule mn b3d ghadi ncreyiw object dyl vehicule fiha les infos kamlin 
    return true;
  }
  public function startRiding($idItineraire){
    // hna ghanbdlo status dyl Itineraire
    
  }
  public function finishRiding($idItineraire){
    // hna ghanbdlo status dyl Itineraire
    
  }
  public function reachThePoint($Itineraire,$ville){

   $Itineraire =  $this->ItineraireFactory->getItineraire($id);
   $details =  createItineraireDetails($Itineraire);
   foreach ($details as $detail) {
    $ItineraireVille =$detail->getVille();
    $order = $detail->getOrder();
    $this->ItineraireFactory->checkThePreviousPoint($order,$detail);
    if($ItineraireVille = $ville ){
        $details->setStatut('true');
    }
    
   }


  }
 
}