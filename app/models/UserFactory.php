<?php
namespace App\Models;

use PDO;
use Exception;
use App\Models\User;

class UserFactory {
    private $db;

    public static function createUser($role, $userData = null) {
       
        switch ($role) {
            case 'Expediteur':
                return new Expediteur(null, $userData);
            case 'Conducteur':
                return new Conducteur($userData->id,null,$userData->nom,$userData->prenom,$userData->email,$role,null);
            case 'Admin':
                return new Admin(null, $userData);
            default:
                throw new \Exception("Invalid user role");
        }
    }
    public function getUser($id) {
       $userData =  User::getByID($id);
        if ($userData) {
            $role = $userData->role; 
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
    public function register($data) {
       
        User::create($data);
        
    }
    public function getAllConducteurs() {
        $role = 'Conducteur';
        $user=User::getAllbyRole($role);
        return $user;
    }
    public function getAllExpediteurs() {
        $role = 'Expediteur';
        $user=User::getAllbyRole($role);
        return $user;
    }
    public function getAllAdmins() {
        $role = 'Admin';
        $user=User::getAllbyRole($role);
        return $user;
    }

    public function CountAll() {
        $user =   User::CountAll();
           return  $user;
        }
    public function CountByRole($role) {
            $user =   User::CountByRole($role);
               return  $user;
    }
}

