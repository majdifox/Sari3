<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\EmailNotification;

session_start();
class AuthController  {
    

    public function __construct() {
        $this->emailNotification = new EmailNotification();
    }
    

    public function login ()
    {
        // echo 'hello';
    if($_SERVER['REQUEST_METHOD']==='POST'){
        echo '$POST';
        $email = $_POST['email'] ;
        $password = $_POST['password'] ;
        $user =  User::getByEmail($email);
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
            $userData = [
                'prenom' => $_POST['Prenom'] ?? '',
                'nom' => $_POST['Nom'] ?? '',
                'email' => $_POST['Email'] ?? '',
                'motdepasse' => password_hash($_POST['Mot_de_passe'] ?? '', PASSWORD_DEFAULT),
                'status' => 'pending', // or whatever default status you want
                'role' => $_POST['Role'] ?? '',
                'datecreation' => date('Y-m-d H:i:s')
            ];

            // Register the user
            if (User::register(
                null, // CNIE (if needed)
                $userData['nom'],
                $userData['prenom'],
                $userData['email'],
                $userData['motdepasse'],
                $userData['status'],
                $userData['role'],
                $userData['datecreation']
            )) {
                // Get the registered user's data
                $user = User::getByEmail($userData['email']);
                if ($user) {
                    // Send registration email
                    $this->emailNotification->sendRegistrationNotification([
                        'id' => $user->id,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'role' => $user->role
                    ]);
                }
                
                header("Location: /login");
                exit();
            } else {
                // Handle registration failure
                echo "Registration failed!";
            }
        } else {
            require_once(__DIR__ . '/../views/auth/register.php');
        }
    }
   
}