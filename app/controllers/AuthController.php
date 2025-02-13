<?php
namespace App\Controllers;

use App\Models\User;
session_start();
class AuthController  {
    

    
    

    public function login ()
    {
        // echo 'hello';
    if($_SERVER['REQUEST_METHOD']==='POST'){
        echo '$POST';
        $email = $_POST['email'] ;
        $password = $_POST['password'] ;
       $user =  User::GetuserbyEmail($email);
       if ($user) {
        $_SESSION['user'] = $user;
        
        $role = $user->role;
        header("Location: http://sari3.test/index.php/".$role);
    }else {
        echo 'password incorrect';
       }
    }else {
        require_once('C:\laragon\www\Sari3\app\views\auth\login.php');
    }

    }

    public function logout (){
        session_start();
        session_destroy();
        header('Location: login');

    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Common fields
            $Prenom = $_POST['Prenom'] ?? '';
            $Nom  = $_POST['Nom'] ?? '';
            $Email      = $_POST['Email'] ?? '';
            $Mot_de_passe   = $_POST['Mot_de_passe'] ?? '';
            $Telephone      = $_POST['Telephone'] ?? '';
            $Photo      = $_POST['Photo'] ?? '';
            $Role       = $_POST['Role'] ?? '';
            
            if ($this->userModel->register($Prenom, $Nom, $Email, $Mot_de_passe, $Telephone, $Photo, $Role)) {
                header("Location: index.php?action=login_form");
                exit();
            } else {
                echo "Registration failed!";
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
    }
   
}