<?php
 namespace App\Controllers;

 use App\Models\Conducteur;

class ConducteurController{
    public $conducteur;
    public function __construct(){
        $this->conducteur = new Conducteur ;
    }

      public function showItinirairesbyConducteur(){
         
      }
      public function showItiniraire(){
            
      }
      public function dashboard(){
            // echo 'getItinerairebyCondicteur';
            session_start();
            echo '<pre>';
            // var_dump($_SESSION['user']->id);
            echo '</pre>';
            $id_condecteur = $_SESSION['user']->id;
            $user =   $this->conducteur->getProfileInfos($id_condecteur);
           
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Profile_Conducteur.php';
      }
      public function details(){
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            $paths = explode('/',$uri,3);
            $Itineraire_id = end($paths);
            echo $Itineraire_id;
            $this->conducteur->createItiniraireDetails( $Itineraire_id);
            require_once '../views/conducteur/Details_Annonces.php';
      }
      
      public function mesannonces() {
            
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Mes_Annonces.php';
    
      }

      public function detailsannonce() {
            
            require_once 'C:\laragon\www\Sari3\app\views\conducteur\Details_Annonces.php';
    
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

