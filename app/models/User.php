<?php
namespace App\Models;

use Core\Database;
use PDO;

class User {
   protected $id;
   protected $cnie;
   protected $nom;
   protected $prenom;
   protected $email;
   protected $motdepasse;
   protected $status;
   protected $role;
   protected $datecreation;
   protected $db;

   public function __construct($id = null, $cnie = null, $nom = null, $prenom = null, $email = null, $motdepasse = null, $status = null, $role = null, $datecreation = null) {
      $this->db = Database::getInstance()->getConnection();
      $this->id = $id;
      $this->cnie = $cnie;
      $this->nom = $nom;
      $this->prenom = $prenom;
      $this->email = $email;
      $this->motdepasse = $motdepasse;
      $this->status = $status;
      $this->role = $role;
      $this->datecreation = $datecreation;
   }

   // Get a user by email
   public static function getByEmail($email) {
      $db = Database::getInstance()->getConnection();
      $query = "SELECT * FROM utilisateurs WHERE email = :email";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
   }

   // Register a new user
   public static function register($cnie, $nom, $prenom, $email, $motdepasse, $status, $role, $datecreation) {
      $db = Database::getInstance()->getConnection();
  
      $query = "INSERT INTO utilisateurs (cnie, nom, prenom, email, motdepasse, status, role, datecreation) 
                VALUES (:cnie, :nom, :prenom, :email, :motdepasse, :status, :role, :datecreation)";
      $stmt = $db->prepare($query);
  
      $stmt->bindParam(':cnie', $cnie, PDO::PARAM_STR);
      $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
      $stmt->bindParam(':status', $status, PDO::PARAM_STR);
      $stmt->bindParam(':role', $role, PDO::PARAM_STR);
      $stmt->bindParam(':datecreation', $datecreation, PDO::PARAM_STR);
  
      return $stmt->execute();
  }

   // Get a user by ID
   public static function getByID($id) {
      $db = Database::getInstance()->getConnection();
      $query = "SELECT * FROM utilisateurs WHERE ID = :id";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
   }

   public static function getAllbyRole($role)
   {
       $connexion = Database::getInstance()->getConnection();
       $query = "SELECT id, nom, prenom, email, telephone, role 
                 FROM utilisateurs 
                 WHERE role = :role
                 ORDER BY id DESC ";
       $stmt = $connexion->prepare($query);
       $stmt->bindValue(':role', $role);
       $stmt->execute();
       $results= $stmt->fetchAll(\PDO::FETCH_ASSOC);
       return $results;
   }

   // Update user details
   public function updateUser() {
      $query = "UPDATE utilisateurs 
                  SET cnie = :cnie, 
                     nom = :nom, 
                     prenom = :prenom, 
                     email = :email, 
                     motdepasse = :motdepasse, 
                     status = :status, 
                     role = :role, 
                     datecreation = :datecreation 
                  WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
      $stmt->bindParam(':cnie', $this->cnie, PDO::PARAM_STR);
      $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
      $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
      $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
      $stmt->bindParam(':motdepasse', $this->motdepasse, PDO::PARAM_STR);
      $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
      $stmt->bindParam(':role', $this->role, PDO::PARAM_STR);
      $stmt->bindParam(':datecreation', $this->datecreation, PDO::PARAM_STR);
      return $stmt->execute();
   }

   // Delete a user account
   public function deleteAccount($id) {
      $query = "DELETE FROM utilisateurs WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
   }

   // Activate a user account
   public function activateAccount($cnie, $id) {
      $query = "UPDATE utilisateurs SET status = 'active' WHERE cnie = :cnie AND id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':cnie', $cnie, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
   }

   // Getters
   public function getId() {
      return $this->id;
   }
   public function getNom() {
      return $this->nom;
   }
   public function getCnie() {
      return $this->cnie;
   }
   public function getPrenom() {
      return $this->prenom;
   }
   public function getEmail() {
      return $this->email;
   }
   public function getMotDePasse() {
      return $this->motdepasse;
   }
   public function getStatus() {
      return $this->status;
   }
   public function getRole() {
      return $this->role;
   }
   public function getDateCreation() {
      return $this->datecreation;
   }

   // Setters
   public function setNom($nom) {
      $this->nom = $nom;
   }
   public function setPrenom($prenom) {
      $this->prenom = $prenom;
   }
   public function setEmail($email) {
      $this->email = $email;
   }
   public function setCnie($cnie) {
      $this->cnie = $cnie;
   }
   public function setMotDePasse($motdepasse) {
      $this->motdepasse = $motdepasse;
   }
   public function setStatus($status) {
      $this->status = $status;
   }
   public function setRole($role) {
      $this->role = $role;
   }
   public function setDateCreation($datecreation) {
      $this->datecreation = $datecreation;
   }

   public static function countAll() {
      $connexion = Database::getInstance()->getConnection();
      $sql = "SELECT COUNT(*) as numbertotal FROM utilisateurs";
      $stmt = $connexion->query($sql);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result['numbertotal'] ?? 0;
   }
   
   public static function countByRole($role) {
      $connexion = Database::getInstance()->getConnection();
      $sql = "SELECT COUNT(*) as numbertotalrole FROM utilisateurs WHERE role = :role";
      $stmt = $connexion->prepare($sql);
      $stmt->bindValue(':role', $role);
      $stmt->execute();
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result['numbertotalrole'] ?? 0;
   }

   public static function getAll() {
      $connexion = Database::getInstance()->getConnection();
      $query = "SELECT id, nom, prenom, email, telephone, role ,etat
                 FROM utilisateurs 
                 ORDER BY id DESC ";
      $stmt = $connexion->query($query);
      $results= $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $results;
   }
   public static function getProfile($id) {
      $connexion = Database::getInstance()->getConnection();
      $query = "SELECT id, nom, prenom, email, telephone, role ,etat
                 FROM utilisateurs 
                 WHERE id = :id";
      $stmt = $connexion->prepare($query);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result;
      
   }
}