<?php
namespace App\Models;

use PDO;

use Core\Database;

class User {
    protected $id;
    protected $cnie;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $motdepasse;
    protected $status;
    protected $role;
    protected $telephone;
    protected $photo;
    protected $datecreation;
    protected $db;

    public function __construct($id = null, $cnie = null, $nom = null, $prenom = null, $email = null, $motdepasse = null, $status = null, $role = null, $telephone = null, $photo = null, $datecreation = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->id = $id;
        $this->cnie = $cnie;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->photo = $photo;
        $this->motdepasse = $motdepasse;
        $this->status = $status;
        $this->role = $role;
        $this->datecreation = $datecreation;
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

    // Update user data
    public function updateUser() {
        $query = "UPDATE utilisateurs 
                  SET nom = :nom, 
                      prenom = :prenom, 
                      email = :email, 
                      motdepasse = :motdepasse, 
                      telephone = :telephone, 
                      photo = :photo 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':motdepasse', $this->motdepasse, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $this->photo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getCnie() { return $this->cnie; }
    public function getTelephone() { return $this->telephone; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getMotDePasse() { return $this->motdepasse; }
    public function getStatus() { return $this->status; }
    public function getRole() { return $this->role; }
    public function getDateCreation() { return $this->datecreation; }

    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setPhoto($photo) { $this->photo = $photo; }
    public function setTelephone($telephone) { $this->telephone = $telephone; }
    public function setCnie($cnie) { $this->cnie = $cnie; }
    public function setMotDePasse($motdepasse) { $this->motdepasse = $motdepasse; }
    public function setStatus($status) { $this->status = $status; }
    public function setRole($role) { $this->role = $role; }
    public function setDateCreation($datecreation) { $this->datecreation = $datecreation; }

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
   public static function register( $nom, $prenom, $email, $motdepasse, $role) {
      $db = Database::getInstance()->getConnection();
  
      $query = "INSERT INTO utilisateurs ( nom, prenom, email, mot_de_passe,  role) 
                VALUES ( :nom, :prenom, :email, :motdepasse, :role)";
      $stmt = $db->prepare($query);
  
      $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
      $stmt->bindParam(':role', $role, PDO::PARAM_STR);
  
      return $stmt->execute();
   }

   // Get all users by role
   public static function getAllByRole($role) {
      $db = Database::getInstance()->getConnection();

      $query = "SELECT * FROM utilisateurs WHERE Role = :role";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':role', $role, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   // Delete a user account
   public function deleteAccount($id) {
      $query = "DELETE FROM utilisateurs WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
   }

   // Activate a user account
  

   // Activate a user account
   public function activateAccount($cnie, $id) {
      $query = "UPDATE utilisateurs SET status = 'active' WHERE cnie = :cnie AND id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':cnie', $cnie, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
   }
   

   public static function countAll () {
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
   public static function validateUser($id_user) {
      $connexion = Database::getInstance()->getConnection();
      $query = "UPDATE utilisateurs SET etat = 'Normal' WHERE id = :id_user";
      $stmt = $connexion->prepare($query);
      $stmt->bindValue(':id_user', $id_user);
      return $stmt->execute();
   }
   public static function suspend($id) {
      $connexion = Database::getInstance()->getConnection();
      $query = "UPDATE utilisateurs SET etat = 'Banne' WHERE id = :id";
      $stmt = $connexion->prepare($query);
      $stmt->bindValue(':id', $id);
      return $stmt->execute();
      
   }

}