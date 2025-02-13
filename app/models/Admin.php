<?php
namespace App\Models;
use App\Models\User;

use App\Models\UserFactory;
use App\Models\ColisFactory;
use App\Models\VehiculeFactory;
use App\Models\ItineraireFactory;
use App\Models\AnnonceModel; // Assuming this model exists
use App\Models\VehiculeModel; // Assuming this model exists
use App\Models\Itineraire; // Assuming this model exists

class Admin extends User {
    private $UserFactory;
    public function __construct( ) {
        $this->UserFactory = new UserFactory;
        $this->ColisFactory = new ColisFactory;
        $this->ItineraireFactory = new ItineraireFactory;
        $this->VehiculeFactory = new VehiculeFactory;
        
    }
    
    public function getSpecificData($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut) {
        $itineraireModel = new Itineraire($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut);
        return $itineraireModel->getAllItineraires(); // Assuming this method exists
    }

    public function validateItineraires($ItinerairesId, $conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut)
    {
        $itineraireModel = new Itineraire($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut); 
        $itineraireModel->validate($ItinerairesId); 
    }
    public function refuseItineraires($ItinerairesId, $conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut)
    {
        $itineraireModel = new Itineraire($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut); 
        $itineraireModel->refuse($ItinerairesId);
    }
    

    public function ListConducteurs()
    {
        $userFactory = new UserFactory();
        return $userFactory->getAllConducteurs(); 
    }
    public function selectItineraires($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut) {
        $itineraireModel = new Itineraire($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut);
        return $itineraireModel->getItinerairesForDate($date_depart);
    }
    public function ListItineraires($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut) {
        $itineraireModel = new Itineraire($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut);
        return $itineraireModel->getAllItineraires(); // Assuming this method exists
    }
    public function ListExpediteurs()
    {
        $userFactory = new UserFactory();
        return $userFactory->getAllExpediteurs(); // Assuming this method exists
    }
    

    public function deleteUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->delete($id_user); // Assuming this method exists
    }

    public function refuseAnnonce($id_annonce)
    {
        $annonceModel = new AnnonceModel(); // Assuming this model exists
        $annonceModel->refuse($id_annonce); // Assuming this method exists
    }

    public function deleteVehicule($id_Vehicule)
    {
        $vehiculeModel = new VehiculeModel(); // Assuming this model exists
        $vehiculeModel->delete($id_Vehicule); // Assuming this method exists
    }
}
