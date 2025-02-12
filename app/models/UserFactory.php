<?php
namespace App\Models;

use Exception;
use PDO;
use App\Models\User;

class UserFactory {
    private $db;

    public static function createUser($role, $userData = null) {
        switch ($role) {
            case 'Expediteur':
                return new Expediteur(null, $userData);
            case 'Conducteur':
                return new Conducteur(null, $userData);
            case 'Admin':
                return new Admin(null, $userData);
            default:
                throw new Exception("Invalid user role");
        }
    }
    public function getUser($id) {
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
}

