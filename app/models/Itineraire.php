<?php
namespace App\Models;

use Core\Model;

class Itineraire extends Model {
    private $id;
    private $conducteur_id;
    private $vehicule_id;
    private $date_depart;
    private $date_arriver;
    private $statut;
    
    protected $table = 'itineraire'; // Assuming the doctors table is named 'medcins'
     
    public function __construct($id,$conducteur_id,$vehicule_id,$date_depart,$date_arriver,$statut){
        
    }
    public function getAllbyConducteur($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function get($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function delete($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    
   
}