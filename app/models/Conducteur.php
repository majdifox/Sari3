<?php
namespace App\Models;
use App\Models\User;

use App\Models\UserFactory;
use App\Models\ColisFactory;
use App\Models\VehiculeFactory;
use App\Models\ItineraireFactory;
session_start();
class Conducteur  extends  User {
    private $ItineraireFactory;
    private $ColisFactory;
    private $UserFactory;

    public function __construct($id = null ,$cnie = null,$nom = null  ,$prenom = null,$email = null,$role = null,$datecreation = null){
        parent::__construct();
        
        $this->id =  $id;
        $this->cnie =  $cnie;
        $this->nom =  $nom;
        $this->prenom =  $prenom;
        $this->email =  $email;
        $this->role =  $role;
        $this->datecreation =  $datecreation;
        $this->ItineraireFactory = new ItineraireFactory;
        $this->ColisFactory = new ColisFactory;
        $this->UserFactory = new UserFactory;
       
    }
    public function getColis($id){
     $colis =  $this->ColisFactory->getColis($id);
    }
    public function UpdataProfile($data){
     $user =  $this->UserFactory->getUser($data['id']);
     if ($user) {
      
      $user->setNom($data["nom"]);
      $user->setPrenom($data["prenom"]);
      $user->setTelephone($data["telephone"]);
      $user->setEmail($data["email"]);
      $user->setMotDePasse($data["password"]);
      $user->UpdateUser();
     }
    }
    public function addAnnonce($dataCity,$dataVehicle,$TimingData) {
      $this->ItineraireFactory->addItineraire($dataCity,$dataVehicle,$TimingData);
    }
    public function getColisParVilleEtItineraire($Itineraire,$ville) {
     return $this->ColisFactory->getColisParVilleEtItineraire($Itineraire,$ville);
    }
  
  public function deleteAnnonce($id) {
    $this->ItineraireFactory->deleteItineraire($id);
  }

  public function AcceptRequest($id_colis){
    // accept request dyl expediteur bach idkhl colis dylo
    $this->checkVolumeOfColis($idItineraire,$volume_of_new_colis);
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
  public function reachThePoint($ville){

  //  $Itineraire =  $this->ItineraireFactory->getItineraire($id_Itineraire);
   
  //  $details =  $this->ItineraireFactory->createItineraireDetails($Itineraire);
  //  foreach ($details as $detail) {
  //   $ItineraireVille =$detail->getVille();
  //   $order = $detail->getOrder();
  //   $this->ItineraireFactory->checkThePreviousPoint($order,$detail);
  //   if($ItineraireVille = $ville ){
  //       $details->setStatut('true');
  //     }
      $this->ItineraireFactory->updateStatut($ville);
  echo "here is the conducteur";
   
  
}
   public function showVehiculeInfos($id){
    // search the vehicule 
    $data = $this->vehicule->getByItineraire($id);
    $vehicule = new Vehicule();
   }
   public function getItinerairebyCondicteur($id_condecteur){
    return  $data =  $this->ItineraireFactory->getItinerairebyCondicteur($id_condecteur);

    
   }
   public function getItinerairebyID($id){
     return $Itineraire =  $this->ItineraireFactory->getItineraire($id);
    
   }
   public function createItiniraireDetails(Itineraire $Itineraire){
    echo 'is work';
   return $details =  $this->ItineraireFactory->createItiniraireDetails($Itineraire);
   
  }
   public function getProfileInfos($id_condecteur){
    return  $user =  $this->UserFactory->getUser($id_condecteur);
  }



}