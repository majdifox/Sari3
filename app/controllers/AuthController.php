<?php
namespace App\Controllers;

use App\Models\User;
session_start();
class AuthController  {
    

    
    

    public function login ()
    {
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

   
}