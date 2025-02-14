<?php
namespace App\Models;
use App\Models\Itineraire;
use App\Models\ItineraireDetails;

    class ItineraireFactory {

       public function deleteItineraire($id)
       {
        $Itineraire =  $this->get($id);
        if($Itineraire){
            $Itineraire->delete();
        }
       }

       
        public function addItineraire($dataCity,$dataVehicle,$TimingData){
            // echo '<pre>';
            // var_dump($dataCity);
            // echo '</pre>';
            // echo '<pre>';
            // var_dump($dataVehicle);
            // echo '</pre>';
            // echo '<pre>';
            // var_dump($TimingData);
            // echo '</pre>';
          $id =   Itineraire::create($dataVehicle["id"],$TimingData);
            $i =0 ; 
            echo $id["id"];
            foreach ($dataCity as $ville ) {
                echo $ville;
                ItineraireDetails::create($id["id"],$ville,$i);
                $i++;
            }
        }
        public function createItiniraireDetails(Itineraire $Itineraire) {
            // ona  le id de Itineraire dans ghadi n9lb 3la details lkhrin dylo
            $list = ItineraireDetails::getDetailsOfItiniraire($Itineraire->getId());
            if ($list) {
                $i= 0;
                $objects=[];
                // hna kancriyiw objects 
            foreach ($list as $ItineraireDetails) {
                $objects[$i] = new ItineraireDetails($ItineraireDetails->id,$ItineraireDetails->iteneraire_id,$ItineraireDetails->orders,$ItineraireDetails->ville,$ItineraireDetails->statut) ;
                $i++;
                return $objects;
            } 
            }
        }
        //////////////////////////////////////////////////
        public function CountAll(){
            $itit= Itineraire::CountAll();
            return $itit;
        }
        public function CountByStatus($status){
            $itit= Itineraire::CountByStatus($status);
            return $itit;
        }
        public function getItineraire(){
            // n9lbo 3la iniraire f database 
            $Itineraire = Itineraire::getAllItineraires();
            return $Itineraire;
            
        }
        //////////////////////////////////////////////////////
        public function getItinerairebyExpediteur($id_expediteur){
            // n9lbo 3la iniraire f database  + details
            // b3d $result = fetchObject('itineraire');
        }
        public function getItinerairebyCondicteur($id_condecteur){
            // n9lbo 3la iniraire f database  + details
            // b3d $result = fetchObject('itineraire');
        }
        
        
    }

