<?php
require_once 'Database.php';

class Target {

    public function getTrackingInfo() {
        $conn = Database::getInstance();
        
        $sql = "SELECT ID, Orders, Ville, Statut FROM details_itineraire ORDER BY Orders";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data: " . $e->getMessage();
            return [];
        }
    }

    public function updateStatut($id) {

        $conn = Database::getInstance();
        
        // Retourner l'Ordre de la ville
        $sql = "SELECT Orders FROM details_itineraire WHERE ID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            echo "Invalid city ID.";
            return;
        }
    
        $currentOrder = $result['orders'];
    
        // Verification d'Ordre de la ville
        if ($currentOrder == 1) {
            $updateSql = "UPDATE details_itineraire SET Statut = 'True' WHERE ID = :id";
            $stmt = $conn->prepare($updateSql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return;
        }
    
        // Retourner l'Ordre de la ville precedente
        $sql = "SELECT Statut FROM details_itineraire WHERE Orders = :previousOrder";
        $stmt = $conn->prepare($sql);
        $previousOrder = $currentOrder - 1;
        $stmt->bindParam(':previousOrder', $previousOrder, PDO::PARAM_INT);
        $stmt->execute();
        $prevCity = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verification d'Ordre de la ville precedente
        if ($prevCity['statut'] === 'True') {
            $updateSql = "UPDATE details_itineraire SET Statut = 'True' WHERE ID = :id";
            $stmt = $conn->prepare($updateSql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            echo "Verifie l'etat des villes precedentes!!";
        }
        
        
    }
}
?>
