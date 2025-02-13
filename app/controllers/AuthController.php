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

   
}