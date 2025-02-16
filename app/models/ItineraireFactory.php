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
            // var_dump($dataCity);
          $data =   Itineraire::create($dataVehicle["id"],$TimingData);
          $i = 0;
            foreach ($dataCity as $city ) {
                
                ItineraireDetails::create($data["id"],$city,$i);
                $i++;
            }
            
        }
        public function createItiniraireDetails(Itineraire $Itineraire) {
         
            
            $list = ItineraireDetails::getDetailsOfItiniraire($Itineraire->getId());
      
            
            if ($list) {
                $i= 0;
                $objects=[];
                // hna kancriyiw objects 
            foreach ($list as $ItineraireDetails) {
                
                $objects[$i] = new ItineraireDetails($ItineraireDetails->id,$ItineraireDetails->itineraire_id,$ItineraireDetails->orders,$ItineraireDetails->ville,$ItineraireDetails->statut) ;
                $i++;
            } 
            return $objects;
            }
        }
        public function getItineraire($id){
            // n9lbo 3la iniraire f database 
            $Itineraire = Itineraire::get($id);
            // echo '<pre>';
            // var_dump($Itineraire);
            // echo '</pre>';
            if($Itineraire){
                
                return new Itineraire($Itineraire["id"],$Itineraire["conducteur_id"],$Itineraire["vehicule_id"],$Itineraire["date_depart"],$Itineraire["date_arriver"],$Itineraire["statut"]);
            }else{
                false;
            }
        }
        public function getItinerairebyExpediteur($id_expediteur){
            // n9lbo 3la iniraire f database  + details
            // b3d $result = fetchObject('itineraire');
        }
        public function getItinerairebyCondicteur($id_condecteur){
            // n9lbo 3la iniraire f database  + details
           $data = Itineraire::getAllByConducteur($id_condecteur);
           $objects = [];
           $i = 0;
           foreach ($data as $it) {
            $objects[$i] = $this->getItineraire($it['id']);
            $i++;
            
        }
        return $objects;
            // b3d $result = fetchObject('itineraire');
        }
        public function updateStatut($ville){
            // var_dump($ville->getId());
            $ville->updateStatut();
        }
            // b3d $result = fetchObject('itineraire');
        
        
        
    }

