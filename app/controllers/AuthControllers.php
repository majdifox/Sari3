<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Utilisateur;

class AuthControllers extends Controller
{
    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function inscriptionForm()
    {
        $this->view('auth/inscription');
    }

    public function inscription()
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];

        Utilisateur::create($nom, $prenom, $telephone, $email, $password, $role);
        header('Location: log');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = Utilisateur::findByEmail($email);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            
            session_start();

            $_SESSION['id'] = $user['id'];

            $role = $user['role'];
            
            if($role === 'Patient'){
                header("Location: patients");
                exit();
            }
            if($role === 'Medecin'){
                header("Location: medecins");
                exit();
            }
        } else {
            $this->view('auth/login', ['error' => 'Invalid credentials.']);
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: log');
    }
}
?>