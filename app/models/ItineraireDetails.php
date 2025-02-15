<?php
namespace App\Models;

use PDO;
use Core\Model;

use Core\Database;

class ItineraireDetails {
    private $id;
    private $iteneraire_id;
    private $orders;
    private $ville;
    private $status;
    private $date_arriver;
    private $db;

    public function __construct($id,$itineraire_id = null, $orders = null, $ville = null, $statut = null) {
        $this->db = Database::getInstance()->getConnection();

        $this->id = $id;
        $this->iteneraire_id = $itineraire_id;
        $this->orders = $orders;
        $this->ville = $ville;
        $this->status = $statut;
    }

    public static function create($id,$ville,$order) {
        echo $id;
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO public.details_itineraire(
	 itineraire_id, orders, ville)
	VALUES ( :itineraire_id, :orders, :ville);";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':itineraire_id', $id);
        $stmt->bindParam(':orders', $order);
        $stmt->bindParam(':ville', $ville);
        return $stmt->execute();
    }
    
    public function getAllbyConducteur($id) {
        $query = "SELECT di.* FROM details_itineraire di
                  JOIN itineraire i ON di.itineraire_id = i.id
                  WHERE i.conducteur_id = :conducteur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':conducteur_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get details of a specific itinerary
    public static function getDetailsOfItiniraire($itineraire_id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM details_itineraire WHERE itineraire_id = :itineraire_id ORDER BY Orders";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':itineraire_id', $itineraire_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Update status to 'En Transit'
    public function enTransit() {
        $this->setStatus('En Transit');
        $query = "UPDATE details_itineraire SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update status to 'Arrive'
    public function Arrive() {
        $this->setStatus('Arrive');
        $query = "UPDATE details_itineraire SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get itinerary details by ID
    public function getByID($id) {
        $query = "SELECT * FROM details_itineraire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete itinerary details by ID
    public function delete($id) {
        $query = "DELETE FROM details_itineraire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    ///////////////////////



    // public function getTrackingInfo() {
    //     $conn = Database::getInstance();
        
    //     $sql = "SELECT ID, Orders, Ville, Statut FROM details_itineraire 
    //     JOIN itineraire ON itineraire.ID = details_itineraire
    //     ORDER BY Orders";
        
    //     try {
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute();
            
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         echo "Error fetching data: " . $e->getMessage();
    //         return [];
    //     }
    // }
    public function getDetails_itineraireOrders(){
        echo $this->getId();
        $id  = $this->getId();
        $sql = "SELECT Orders FROM details_itineraire WHERE ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return  $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function setStatusItinerarire(){
        echo 'updated';
        $updateSql = "UPDATE details_itineraire SET Statut = 'True' WHERE ID = :id";
        $stmt = $this->db->prepare($updateSql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function updateStatut() {
        
      $result =  $this->getDetails_itineraireOrders();
      
    
        if (!$result) {
            echo "Invalid city ID.";
            echo $this->getId();
            return;
        }
    
        $currentOrder = $result['orders'];
        echo "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH<br>";
        echo $currentOrder;
        // Verification d'Ordre de la ville
        if ($currentOrder == 0) {
            echo 'noiice';
           $this->setStatusItinerarire();
            return;
        }
        $iteneraire_id = $this->getItineraireId();
        // Retourner l'Ordre de la ville precedente
        $sql = "SELECT Statut FROM details_itineraire WHERE Orders = :previousOrder and itineraire_id = :itineraire_id ";
        $stmt = $this->db->prepare($sql);
        $previousOrder = $currentOrder - 1;
        $stmt->bindParam(':previousOrder', $previousOrder, PDO::PARAM_INT);
        $stmt->bindParam(':itineraire_id', $iteneraire_id, PDO::PARAM_INT);
        $stmt->execute();
        $prevCity = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<br>';
        var_dump($prevCity);
        // Verification d'Ordre de la ville precedente
        $id = $this->getId();
        echo '<br>';
        echo $id;
        if ($prevCity['statut'] === 'True') {
            $updateSql = "UPDATE details_itineraire SET Statut = 'True' WHERE ID = :id";
            $stmt = $this->db->prepare($updateSql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            echo "Verifie l'etat des villes precedentes!!";
        }
        
        
    }

    

    








    ///////////////////////////////////
    // Set status
    public function setStatus($status) {
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function getItineraireId() {
        return $this->iteneraire_id;
    }
    public function getOrders() {
        return $this->orders;
    }
    public function getVille() {
        return $this->ville;
    }
    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setItineraireId($itineraire_id) {
        $this->iteneraire_id = $itineraire_id;
    }
    public function setOrders($orders) {
        $this->orders = $orders;
    }
    public function setVille($ville) {
        $this->ville = $ville;
    }
}