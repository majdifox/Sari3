<?php
namespace App\Models;

use Core\Database;
use PDO;

class User {
   private $id;
   private $cnie;
   private $nom;
   private $prenom;
   private $email;
   private $motdepasse;
   private $status;
   private $role;
   private $datecreation;
   private $db;

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
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   // Register a new user
   public function register() {
      $query = "INSERT INTO utilisateurs (cnie, nom, prenom, email, motdepasse, status, role, datecreation) 
                  VALUES (:cnie, :nom, :prenom, :email, :motdepasse, :status, :role, :datecreation)";
      $stmt = $this->db->prepare($query);
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

   // Get a user by ID
   public static function getByID($id) {
      $db = Database::getInstance()->getConnection();
      $query = "SELECT * FROM utilisateurs WHERE id = :id";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   // Get all users by role
   public function getAllByRole($role) {
      $query = "SELECT * FROM utilisateurs WHERE role = :role";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':role', $role, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}