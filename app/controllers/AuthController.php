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
        echo $password;
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
            $userData = [
                'prenom' => $_POST['prenom'] ?? '',
                'nom' => $_POST['nom'] ?? '',
                'email' => $_POST["email"] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'motdepasse' => password_hash($_POST['mot_de_passe'] ?? '', PASSWORD_DEFAULT),
                // or whatever default status you want
                'role' => $_POST['role']
            ];
            echo '<pre>';
            var_dump($userData);
            echo '<pre>';
            // Register the user
            if (User::register(
                $userData
                
            )) {
                
                // Get the registered user's data
                var_dump($userData["email"]);
                $user = User::getByEmail($userData['email']);
                echo 'dd';
                if ($user) {
                    // Send registration email
                    // $this->emailNotification->sendRegistrationNotification([
                    //     'id' => $user->id,
                    //     'prenom' => $user->prenom,
                    //     'nom' => $user->nom,
                    //     'email' => $user->email,
                    //     'role' => $user->role
                    // ]);
                }
                
                // header("Location: /index.php/login");
                exit();
            } else {
                // Handle registration failure
                echo "Registration failed!";
            }
        } else {
            require_once(__DIR__.'/../views/auth/inscription.php');
        }
    }
   
}