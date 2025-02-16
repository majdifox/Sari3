<?php
namespace App\Models;
use App\Models\User;

use App\Models\UserFactory;
use App\Models\ColisFactory;
use App\Models\VehiculeFactory;
use App\Models\ItineraireFactory;

class Expediteur extends  User {
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
  public function getItinerairebyID($id){
    return $Itineraire =  $this->ItineraireFactory->getItineraire($id);
   
  }
  public function createItiniraireDetails(Itineraire $Itineraire){
    return $details =  $this->ItineraireFactory->createItiniraireDetails($Itineraire);
    
   }
    public function MakeRequest($data) {
    $this->ColisFactory->addColis($data);
  }

  public function getProfileInfos($id_expediteur){
    return  $user =  $this->UserFactory->getUser($id_expediteur);
  }

  public function deleteColis($idColis) {
    //  search itineraire by idColis and check if status still en preparation and delete it from the table colis
    $colis = $this->colisFactory->getColis($idColis);
  }
  public function showIniteraire() {
    //  search itineraire by Exp 
    $Itineraire = $this->ItineraireFactory->getItinerairebyExpediteur($this->getId());
  }

  
 
}