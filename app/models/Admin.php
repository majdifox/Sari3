<?php
namespace App\Models;

use App\Models\User;
use Core\Controller;
use App\Models\UserFactory;
use App\Models\ColisFactory;
use App\Models\VehiculeFactory;
use App\Models\ItineraireFactory;
class Admin extends User {
    private $UserFactory;
    public function __construct( ) {
        $this->UserFactory = new UserFactory;
        $this->ColisFactory = new ColisFactory;
        $this->ItineraireFactory = new ItineraireFactory;
        $this->VehiculeFactory = new VehiculeFactory;
        
    }
    
    public function getSpecificData() {
        
    }

    public function validateItineraires($ItinerairesId) {
        
    }
    public function refuseItineraires($ItinerairesId) {
        
    }
    

    public function ListConducteurs()
    {
        
    }
    public function selectItineraires()
    {
        
    }
    public function ListItineraires()
    {
        echo 'ListItineraires method';
    }
    public function ListExpediteurs()
    {
        
    }
    

    public function deleteUser($id_user)
    {
        
    }

    public function refuseAnnonce($id_annonce)
    {
 
    }
    public function deleteVehicule($id_Vehicule)
    {
 
    }
}

