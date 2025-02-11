<?php
namespace App\Models;

use Core\Model;

class User  extends Model {
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
    public function getAllConducteurs() {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function getAllExpoditeurs() {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function get($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'and m.utilisateur_id= :id ";
        // $stmt = $this->db->prepare($query);
        // $stmt->bindParam(':id',$id);
        // $stmt->execute();
        // return $stmt->fetch();
    }

    public function update($data) {
        // $query = "INSERT INTO " . $this->table . " (name, specialty) VALUES (:name, :specialty)";
        // $stmt = $this->db->prepare($query);
        // return $stmt->execute($data);
    }
    public function delete($data) {
        // $query = "INSERT INTO " . $this->table . " (name, specialty) VALUES (:name, :specialty)";
        // $stmt = $this->db->prepare($query);
        // return $stmt->execute($data);
    }
}