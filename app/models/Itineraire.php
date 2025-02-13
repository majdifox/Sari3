<?php
namespace App\Models;

use Core\Model;

class Itineraire implements Model {
    private $id;
    private $conducteur_id;
    private $vehicule_id;
    private $date_depart;
    private $date_arriver;
    private $statut;
    
    protected static $db;
    protected $table = 'itineraire'; // Assuming the doctors table is named 'medcins'
     
    public function __construct($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut, $id = null) {
        self::$db = Database::getConnection(); // Assuming a Database class exists for connection
        $this->conducteur_id = $conducteur_id;
        $this->vehicule_id = $vehicule_id;
        $this->date_depart = $date_depart;
        $this->date_arriver = $date_arriver;
        $this->statut = $statut;
        $this->id = $id;
    }
    public static function getAllbyConducteur($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public static function getAllbyExpediteur($id) {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public static function getAllItineraires() {
        $instance = new self(null, null, null, null, null);
        $query = "SELECT * FROM " . $instance->table;
        $stmt = self::$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function create() {
        
    }
    public function update() {
        
    }
    public function read() {
        
    }
    public function get() {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    public function delete() {
        // $query = "SELECT * FROM public.utilisateurs u  left join public.medecins m  on    u.id  = m.utilisateur_id WHERE role LIKE 'medecin'";
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }
    
   
}