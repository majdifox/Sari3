<?php
namespace App\Models;

use Core\Model;

class ineatiere extends Model {
    private $id;
    private $cnie;
    private $nom;
    private $prenom;
    private $email;
    private $motdepasse;
    private $stats;
    private $role;
    private $datecreation;
    protected $table = 'medcins'; // Assuming the doctors table is named 'medcins'
     
    public function __construct($nom,$prenom){
    
    }
    public function getAll($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function get($id,$data) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function delete($id,$data) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    
   
}