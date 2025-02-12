<?php
namespace App\Models;

use App\Models\User;
use App\Models\ColisFactory;
use App\Models\ItineraireFactory;

class Conducteur  extends  User {
    private $ItineraireFactory;
    private $ColisFactory;
    public function __construct($data = null){
        parent::__construct();
        $this->ItineraireFactory = new ItineraireFactory();
        $this->ColisFactory = new ColisFactory();
        if ($data) {
           $this->id = $data["id"];
           $this->cnie = $data["cnie"];
           $this->nom = $data["nom"];
           $this->prenom = $data["prenom"];
           $this->email = $data["email"];
           $this->motdepasse =$data["motdepasse"];
           $this->status = $data["status"];
           $this->role = $data["role"];
           $this->datecreation =$data["datecreation"];
        }
        
    }
    public function getColis($id){
     $colis =  $this->ColisFactory->getColis($id);
    }
    public function addAnnonce($data) {
    $dataofvehicule;
    $this->Vehicule->add($dataofvehicule);
    $this->ColisFactory->addColis($dataofColis);
    
  }
  
  public function deleteAnnonce($id) {
    //   $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
 
  }

  public function AcceptRequest($id_colis){
    // accept request dyl expediteur bach idkhl colis dylo
    checkVolumeOfColis($idItineraire,$volume_of_new_colis);
    // accept
  }
  public function RefuseRequest($id_colis){
    // refuse request dyl expediteur bach idkhl colis dylo
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
  public function reachThePoint($id_Itineraire,$ville){

   $Itineraire =  $this->ItineraireFactory->getItineraire($id_Itineraire);
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
   public function showVehiculeInfos($id){
    // search the vehicule 
    $data = $this->vehicule->getByItineraire($id);
    $vehicule = new Vehicule();
   }
   public function getItinerairebyCondicteur(){
    $id = $this->getId();
    echo $id;
   }
   public function createItiniraireDetails(Itineraire $Itineraire){
    // $this->ItineraireFactory-> createItiniraireDetails(Itineraire $Itineraire);
   }



}