<?php
namespace App\Controllers;

use App\Models\User;

class AuthController  {
    

    
    

    public function login ()
    {
        $email = "mohamed@gmail.com";
        $User = new User;
       $result =  $User->read($email);
       var_dump($result);

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