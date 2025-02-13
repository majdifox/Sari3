<?php
namespace App\Models;

use Core\Model;

class ItineraireDetails extends Model {
    private $id;
    private $iteneraire_id;
    private $orders;
    private $ville;
    private $statut;
    
    protected $table = 'details_itineraire'; // Assuming the doctors table is named 'medcins'
     
    public function __construct($itineraire_id,$orders,$ville,$statut){
        
    }
    public function getAllbyConducteur($id)
    {
        
    }
    public static  function getDetailsOfItiniraire($itineraire_id) {
        
    }
    public function enTransit(){
        $this->setStatus('En Transit');

    }
    public function Arrive(){
        $this->setStatus('Arrive');
    }
    public function get($id) {
       
    }
    public function delete($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }

    public function setStatus($status) {
        $this->status = $status;
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }

    
   
}