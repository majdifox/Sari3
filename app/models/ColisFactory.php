<?php
require_once 'expoditeur.php';
require_once 'conducteur.php';
require_once 'Admin.php';

class ColisFactory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function createColis($userData) {
       return new Colis($id,$expediteur_id,$itineare_id,$destination,$volume,$poids,$date_depart,$date_arriver,$status,$etat);
    }
    public function getColis($id) {
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $role = $userData["role"]; 
            return $this->createUser($role, $userData);
        }
        return null;
    }
    
    public function getColisByExpediteur($id) {
        $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->bindParam(':expediteur_id',$id);
        $stmt->exectute();
        $Colis = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = [];
        $i = 0;
        foreach ($Colis as $coli) {
         $list[$i] = $this->createColis($colis);
         $i++;
        } 
        return $list;
    }
    public function getColisByVillesANDExpediteur($ville,$id) {
        $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->bindParam(':expediteur_id',$id);
        $stmt->exectute();
        $Colis = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = [];
        $i = 0;
        foreach ($Colis as $coli) {
         $list[$i] = $this->createColis($colis);
         $i++;
        } 
        return $list;
    }
}

