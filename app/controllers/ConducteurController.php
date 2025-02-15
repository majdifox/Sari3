<?php
 namespace App\Controllers;

 use App\Models\Conducteur;
session_start();
class ConducteurController{
    public $conducteur;
    public function __construct(){
        $this->conducteur = new Conducteur ;
    }

      public function showItinirairesbyConducteur(){
            $id_condecteur = $_SESSION["user"]['id'];
            $data = $this->conducteur->getItinerairebyCondicteur($id_condecteur);
         require_once('C:\laragon\www\Sari3\app\views\conducteur\Mes_Annonces.php');
      }
      public function annoncedetails($id){
             $Itineraire = $this->conducteur->getItinerairebyID($id);
             $Details= $this->conducteur->createItiniraireDetails( $Itineraire);
             echo '<pre>';
             var_dump($Details);
             echo '</pre>';
            require_once('C:\laragon\www\Sari3\app\views\conducteur\Annonce_details.php');
      }
      public function addIteneraire(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                  // Decode JSON to get vehicle as an object
                  $vehicleData = json_decode($_POST['vehicleData'], true);  // Decode JSON string to an array
                  $selectedCities = $_POST['cities'] ?? [];
              
                  echo '<h2>Vehicle Data:</h2>';
                  echo '<pre>';
                  print_r($vehicleData); // This should now be an array (or object if casted)
                  echo '</pre>';
              
                  echo '<h2>Selected Cities:</h2>';
                  echo '<pre>';
                  print_r($selectedCities);
                  $this->conducteur->addAnnonce($selectedCities,$vehicleData,$_POST);
                  echo '</pre>';
              }
            var_dump($_POST);
      }
      public function dashboard(){
            // echo 'getItinerairebyCondicteur';
            session_start();
            echo '<pre>';
            var_dump($_SESSION['user']);
            echo '</pre>';
            $id_condecteur = $_SESSION['user']['id'];
            $user =   $this->conducteur->getProfileInfos($id_condecteur);
           
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Profile_Conducteur.php';
      }
      public function details(){
            
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Details_Annonces.php';
      }
      
      public function mesannonces() {
            $id_condecteur = $_SESSION['user']['id'];
            $data = $this->conducteur->getItinerairebyCondicteur($id_condecteur);
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Mes_Annonces.php';
    
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

