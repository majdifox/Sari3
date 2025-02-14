<?php
namespace App\Models;

use Core\Database;

class User   {
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
    protected $table = 'utilisateur'; // Assuming the doctors table is named 'medcins'
   
    public function __construct( $userData = null) {
      $this->db = Database::getInstance()->getConnection();
      if ($userData) {
          $this->id = $userData['id'];
          $this->username = $userData['username'];
          $this->email = $userData['email'];
      }
  }
    public static function GetuserbyEmail($email) {
      $connexion = Database::getInstance()->getConnection();
     
      $sql = "SELECT * FROM utilisateurs WHERE email = :email";
      $stmt = $connexion->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  public function update($data) {
      $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':username', $data['username']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
  }
  //////////////////////////////////////////////////////////////////////////
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

/////////////////////////////////////////////////////////////////////
  public function delete() {
      $sql = "DELETE FROM users WHERE id_user = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id', $this->getId());
      return $stmt->execute();
  }
  public function activate($cnie,$id) {
      $sql = "UPDATE public.users SET cnie = :cnie where id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':cnie', $cnie);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
  }
   public function getId(){
    return  $this->id;
   }
   public function getNom(){
    return  $this->nom;
   }
   public function getCnie(){
    return  $this->cnie;
   }
   public function getPrenom(){
    return  $this->prenom;
   }
   public function getEmail(){
    return  $this->email;
   }
   public function getMoteDePasse(){
    return  $this->motdepasse;
   }
   public function getStatus(){
    return  $this->status;
   }
   public function getRole(){
    return  $this->role;
   }
   public function getDateCreation(){
    return  $this->role;
   }
   
   public function setNom($nom){
      $this->nom = $nom;
   }
   public function setPrenom($prenom){
      $this->prenom = $prenom;
   }
   public function setEmail($email){
      $this->email = $email;
   }
   public function setCnie($cnie){
      $this->cnie = $cnie;
   }
   public function setMoteDePasse($motdepasse){
      $this->motdepasse = $motdepasse;
   }
   public function setStatus($status){
      $this->status = $status;
   }
   public function setRole($role){
      $this->role = $role;
   }
   public function setDateCreation($role){
      $this->role = $role;
   }
}