<?php
require_once 'expoditeur.php';
require_once 'conducteur.php';
require_once 'Admin.php';

class ItineraireFactory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
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
    public function getDetails($id){
        /// details
        return $list;
    }
    public function villeChecked(Itineraire $Itineraire, $ville){
        // logic
    }
}

