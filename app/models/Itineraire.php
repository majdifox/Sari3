<?php
namespace App\Models;

use PDO;
use Core\Model;
use Core\Database;

class Itineraire  {
    private $id;
    private $conducteur_id;
    private $vehicule_id;
    private $date_depart;
    private $date_arriver;
    private $statut;
    
    private $db;
    protected $table = 'itineraire'; // Assuming the doctors table is named 'medcins'
     
    public function __construct($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut, $id = null) {
        $this->db = Database::getInstance()->getConnection();
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
        $connexion = Database::getInstance()->getConnection();
        $query = "SELECT i.*, 
                        u.nom as conducteur_nom, 
                        u.prenom as conducteur_prenom
                FROM itineraire i
                JOIN utilisateurs u ON i.conducteur_id = u.id
                ORDER BY i.date_depart DESC 
                LIMIT 5";
                
        $stmt = $connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function CountAll() {
        $connexion = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) as NumberTotal FROM  itineraire";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['NumberTotal'] ?? 0;
    }
    public static function CountByStatus($status) {
        $connexion = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) as NumberTotalit FROM itineraire where statut=:status ";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete an itinerary by ID
    // public  function delete($id) {
    //     $query = "DELETE FROM itineraire WHERE id = :id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     return $stmt->execute();
    // }
    // public static function create($data) {
        
    //     $db = Database::getInstance()->getConnection();
    //     $query = "INSERT INTO public.itineraire(
	//  conducteur_id, vehicule_id, date_depart, date_arriver, statut)
	// VALUES (:conducteur_id, :vehicule_id, :date_depart, :date_arriver, :statut) returning id;";
    //     $stmt = $db->prepare($query);
    //     $stmt->bindParam(':conducteur_id', $id, PDO::PARAM_INT);
    //     $stmt->bindParam(':vehicule_id', $id, PDO::PARAM_INT);
    //     $stmt->bindParam(':date_depart', $id, PDO::PARAM_INT);
    //     $stmt->bindParam(':date_arriver', $id, PDO::PARAM_INT);
    //     $stmt->bindParam(':statut', $id, PDO::PARAM_INT);
    //     return $stmt->execute();
    // }
}