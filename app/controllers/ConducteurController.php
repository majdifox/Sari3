<?php
 namespace App\Controllers;

 use App\Models\Conducteur;
class ConducteurController{
    public $conducteur;
    public function __construct(){
        $this->conducteur = new Conducteur ;
    }

      public function showItinirairesbyConducteur(){
            $id_condecteur = $_SESSION["user"]->id;
            $data = $this->conducteur->getItinerairebyCondicteur($id_condecteur);
         require_once('C:\laragon\www\Sari3\app\views\conducteur\Mes_Annonces.php');
      }
      public function annoncedetails($id){
             $Itineraire = $this->conducteur->getItinerairebyID($id);
             $Details= $this->conducteur->createItiniraireDetails( $Itineraire);
             echo $_SERVER["REQUEST_METHOD"];
             if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                  echo '<pre>';
                  var_dump($_POST);
                  echo '</pre>';
                 $colis =  $this->conducteur->getColisParVilleEtItineraire($Itineraire->getId(),$_POST["ville"]) ;
                
             }
            require_once('C:\laragon\www\Sari3\app\views\conducteur\Annonce_details.php');
      }
      public function addIteneraire(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                  // Decode JSON to get vehicle as an object
                  $vehicleData = json_decode($_POST['vehicleData'], true);  // Decode JSON string to an array
                  $selectedCities = $_POST['cities'] ?? [];
              
                 
                  $this->conducteur->addAnnonce($selectedCities,$vehicleData,$_POST);
              }
            var_dump($_POST);
      }
      public function dashboard(){
            // echo 'getItinerairebyCondicteur';
            session_start();
          
            $id_condecteur = $_SESSION['user']->id;
            $user =   $this->conducteur->getProfileInfos($id_condecteur);
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                 var_dump($_POST);
                        $this->conducteur->UpdataProfile($_POST);
            }
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Profile_Conducteur.php';
      }
      public function details(){
            
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Details_Annonces.php';
      }
      
      public function mesannonces() {
            $id_condecteur = $_SESSION['user']->id;
            $data = $this->conducteur->getItinerairebyCondicteur($id_condecteur);
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Mes_Annonces.php';
    
      }
      public function updateDetailsItenraireStatus($id,$idDetails) {
            $Itineraire = $this->conducteur->getItinerairebyID($id);
            echo $idDetails.'<br>';
            
            echo $idDetails;
            echo '<br>';
            $Details = $this->conducteur->createItiniraireDetails($Itineraire);
        
            foreach ($Details as $ville) {
                  

                  if($ville->getId() == $idDetails){
                        echo $ville->getVille();
                        echo $id;
                        $colis = 
                   $this->conducteur->reachThePoint($ville);
                  }
      }
      require_once('C:\laragon\www\Sari3\app\views\conducteur\Annonce_details.php');
            
    
      }


      public function affichageColis($id,$idDetails){

            $this->conducteur->getColisParVilleEtItineraire($Itineraire,$ville);
      }

      
      
      public function addAnnonce() {
            //  @oussamaamou


           $this->conducteur->addAnnonce($data);
    
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

