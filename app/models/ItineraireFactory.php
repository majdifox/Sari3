<?php
namespace App\Models;


    class ItineraireFactory {
        private $db;

       public function deleteItineraire($id)
       {
        $Itineraire =  $this->getItineraire($id);
        if($Itineraire){
            $Itineraire->delete();
        }
       }

        public function createVehiculebyItiniraire(Itineraire $Itineraire)
        {
            
        }
        
        public function createItiniraireDetails(Itineraire $Itineraire) {
            // ona  le id de Itineraire dans ghadi n9lb 3la details lkhrin dylo
            $list = getAllbyItiniraire($Itineraire->getId());
            if ($list) {
                $i= 0;
                $objects=[];
            foreach ($list as $ItineraireDetails) {
                $objects[$i] = new ItineraireDetails($ItineraireDetails->getId(),$ItineraireDetails->getItineraire_id(),$ItineraireDetails->getOrders(),$ItineraireDetails->getVille()) ;
                $i++;
                return $objects;
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
        public function getItinerairebyCondicteur($id_condecteur){
            // n9lbo 3la iniraire f database  + details
            // b3d $result = fetchObject('itineraire');
        }
        
        
    }

