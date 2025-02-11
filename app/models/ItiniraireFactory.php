<?php
require_once 'expoditeur.php';
require_once 'conducteur.php';
require_once 'Admin.php';

class ItineraireFactory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function createItiniraireDetails(Itineraire $Itineraire) {
        // ona  le id de Itineraire dans ghadi n9lb 3la details lkhrin dylo
        $list = getDetails($Itineraire->getId());
        if ($list) {
            $i= 0;
            $I=[];
           foreach ($list as $ItineraireDetails) {
            $I[$i] = new ItineraireDetails($ItineraireDetails->getId(),$ItineraireDetails->getItineraire_id(),$ItineraireDetails->getOrders(),$ItineraireDetails->getVille()) ;
            $i++;
            return $I;
           } 
        }
    }
    public function getDetails($id){
        /// details
        return $list;
    }
    public function get($id) {
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
    public function authenticate($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && password_verify($password, $userData['password'])) {
            return $this->createUser($userData["role"], $userData);
        }
        return null;
    }
    public function getAllTeachers() {
        $sql = "SELECT * FROM users WHERE role = 'teacher'";
        $stmt = $this->db->query($sql);
        $teachers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $list = [];
        $i = 0;
        foreach ($teachers as $teacher) {
         $list[$i] = $this->createUser($teacher->role,$teacher);
         $i++;
        } 
        return $list;
    }
}

