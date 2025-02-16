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
    
      $id_expediteur = $_SESSION['user']->id;
      $user =   $this->Expediteur->getProfileInfos($id_expediteur);
      
      require_once 'C:\laragon\www\Sari3\app\views\expediteur\Home_Annonces.php';
    }
    public function detailsannonceexp($id){
      $Itineraire = $this->Expediteur->getItinerairebyID($id);
      
      $Details= $this->Expediteur->createItiniraireDetails( $Itineraire);
             
      require_once 'C:\laragon\www\Sari3\app\views\expediteur\Details_Annonces.php';
    }

    public function mescolis(){

      require_once 'C:\laragon\www\Sari3\app\views\expediteur\Mes_Colis.php';
    }

    public function prflexpediteur(){

      require_once 'C:\laragon\www\Sari3\app\views\expediteur\Profile_Expediteur.php';
    }


    public function showItiniraire($idItineraire){
        
    }
    public function showItinirairedetails($idItineraire){
        $this->Expediteur->deleteColis( $Itineraire);
    }


    public function makeRequest() {
   
    $this->Expediteur->MakeRequest($_POST);
    // var_dump($_POST);

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

