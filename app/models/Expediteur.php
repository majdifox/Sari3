<?php
namespace App\Models;

use Core\Model;

class Expeduteur extends  User {
    private $ItineraireFactory;
    public function __construct($ItineraireFactory){
        parent::__construct();
        $this->ItineraireFactory = new ItineraireFactory();
        $this->colisFactory = new ColisFactory();

    }
    public function MakeRequest($data) {
    // data fiha id dyl itineraire o data dyl colis dyl expediteur
    // ghadi n3mro db table dyl Colis
    
  }

  public function deleteColis($idColis) {
    //  search itineraire by idColis and check if status still en preparation and delete it from the table colis
    $colis = $this->colisFactory->getColis($id);
  }
  public function showIniterairebyExp($Expediteur) {
    //  search itineraire by idColis and check if status still en preparation and delete it from the table colis
  }

  
 
}