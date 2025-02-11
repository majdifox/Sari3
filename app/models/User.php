<?php
namespace App\Models;

require_once __DIR__ . '/../../core/Database.php';

use Core\Model;

class User  implements  UserInterface {
    private $id;
    private $cnie;
    private $nom;
    private $prenom;
    private $email;
    private $motdepasse;
    private $status;
    private $role;
    private $datecreation;
    protected $table = 'utilisateur';
     
    public function __construct($db, $userData = null) {
      $this->db = $db;
      if ($userData) {
          $this->id = $userData['id'];
          $this->username = $userData['username'];
          $this->email = $userData['email'];
      }
  }
    public function read($id) {
      $sql = "SELECT * FROM users WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function update($id, $data) {
      $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':username', $data['username']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
  }

  public function delete($id) {
      $sql = "DELETE FROM users WHERE id_user = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
  }
  public function activate($cnie,$id) {
      $sql = "UPDATE public.users SET cnie = :cnie where id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':cnie', $cnie);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
  }

  public function register($Prenom, $Nom, $Email, $Mot_de_passe, $Telephone, $Photo, $Role) {
   $hashedPassword = password_hash($Mot_de_passe, PASSWORD_BCRYPT);

   $sql = "INSERT INTO utilisateurs (Prenom, Nom, Email, Mot_de_passe, Telephone, Photo, Role, Etat)
           VALUES (:Prenom, :Nom, :Email, :Mot_de_passe, :Telephone, :Photo, :Role, 'active')";

   $this->db->query($sql);
   $this->db->bind(':Prenom', $Prenom);
   $this->db->bind(':Nom', $Nom);
   $this->db->bind(':Email', $Email);
   $this->db->bind(':Mot_de_passe', $hashedPassword);
   $this->db->bind(':Telephone', $Telephone);
   $this->db->bind(':Photo', $Photo, PDO::PARAM_LOB);
   $this->db->bind(':Role', $Role);

   return $this->db->execute();
}



public function login($email, $password) {
   $this->db->query("SELECT * FROM utilisateurs WHERE Email = :Email");
   $this->db->bind(':Email', $email);
   $user = $this->db->fetch();

   if ($user && password_verify($password, $user['Mot_de_passe'])) {
       return $user;
   }
   return false;
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