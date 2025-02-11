<?php
require_once __DIR__ . '/../models/User.php';



class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
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
            
            if ($this->userModel->register($$Prenom, $Nom, $Email, $Mot_de_passe, $Telephone, $Photo, $Role)) {
                header("Location: index.php?action=login_form");
                exit();
            } else {
                echo "Registration failed!";
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
    }

    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Email      = $_POST['Email'] ?? '';
            $Mot_de_passe   = $_POST['Mot_de_passe'] ?? '';

            $user = $this->userModel->login($email, $password);

            if ($user) {
                // Check if a session is already started to avoid duplicate session_start() calls.
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $user;

                switch ($user['role']) {
                    case 'admin':
                        header("Location: index.php?action=admin_dashboard");
                        break;
                    case 'Conducteur':
                        header("Location: index.php?action=doctor_dashboard");
                        break;
                    case 'Expediteur':
                        header("Location: index.php?action=patient_dashboard");
                        break;
                    default:
                        header("Location: index.php");
                        break;
                }
                exit();
            } else {
                echo "Invalid login credentials!";
            }
        } else {
            include __DIR__ . '/../views/login.php';
        }
    }
}
