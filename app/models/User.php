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
    public  function read($email) {
      echo '<br> ';
      var_dump(Database::getInstance());
      echo '<br> ';
     
      $sql = "SELECT * FROM utilisateurs WHERE email = :email";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      return $stmt->fetch(\PDO::FETCH_OBJ);
  }
    public static function create($data) {
      // $sql = "INSERT into  users ";
      // $stmt = $this->db->prepare($sql);
      // $stmt->bindParam(':username', $username);
      // $stmt->execute();
      // $userData = $stmt->fetch(PDO::FETCH_ASSOC);
  }
    public  function get($id) {
      // $sql = "SELECT * FROM users WHERE id = :id";
      // $stmt = $this->db->prepare($sql);
      // $stmt->bindParam(':id', $id);
      // $stmt->execute();
      // return $stmt->fetch(PDO::FETCH_OBJ);
  }
    public static  function getAllbyRole($role) {
      // $sql = "SELECT * FROM users WHERE id = :id";
      // $stmt = $this->db->prepare($sql);
      // $stmt->bindParam(':id', $id);
      // $stmt->execute();
      // return $stmt->fetch(PDO::FETCH_OBJ);
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

  public function register($data) {
   // Hash the password
   $hashedPassword = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);

   $sql = "INSERT INTO utilisateurs (cni, nom, prenom, photo, telephone, email, mot_de_passe, role, etat) 
           VALUES (:cni, :nom, :prenom, :photo, :telephone, :email, :mot_de_passe, :role, :etat)";

   try {
       $stmt = $this->db->prepare($sql);
       
       return $stmt->execute([
           ':cni' => $data['cni'],
           ':nom' => $data['nom'],
           ':prenom' => $data['prenom'],
           ':photo' => $data['photo'],
           ':telephone' => $data['telephone'],
           ':email' => $data['email'],
           ':mot_de_passe' => $hashedPassword,
           ':role' => $data['role'],
           ':etat' => $data['etat']
       ]);
   } catch (\PDOException $e) {
       // Log error and return false
       error_log($e->getMessage());
       return false;
   }
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