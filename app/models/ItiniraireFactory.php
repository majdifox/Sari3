<?php
require_once 'expoditeur.php';
require_once 'conducteur.php';
require_once 'Admin.php';

class ItineraireFactory {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
       
    }


    public function createItiniraireDetails(Itineraire $Itineraire) {
        // ona  le id de Itineraire dans ghadi n9lb 3la details lkhrin dylo
        $list = getDetails($Itineraire->getId());
        if ($list) {
            $i= 0;
            $I=[];
           foreach ($list as $ItineraireDetails) {
            $I[$i] = new ItineraireDetails($ItineraireDetails->getId(),$ItineraireDetails->getItineraire_id(),$ItineraireDetails->getOrders(),$ItineraireDetails->getVille()) ;
            $i++;
            return $I;
           } 
        }
    }
    public function getItineraire($id){
        // n9lbo 3la iniraire f database 

       return new Itineraire($id,$conducteur_id,$vehicule_id,$date_depart,$date_arriver,$statut);
    }
    public function getItinerairebyExpediteur($id_expediteur){
        // n9lbo 3la iniraire f database  + details
        // b3d $result = fetchObject('itineraire');
    }
    
}

