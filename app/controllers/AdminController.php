<?php
namespace App\Controllers;

use Core\View;
use App\Models\Admin;


class AdminController 
{
    private $admin;
    public function __construct()
    {
       
        $this->admin = new Admin();
    }

    public function dashboard()
    {
        $this->admin->ListItineraires();
        echo '<br>dashboard';
        
    }

    public function ListConducteurs()
    {
        
    }
    public function ListItineraires()
    {
        
    }
    public function ListExpediteurs()
    {
        
    }
    

    public function deleteUser($id_user)
    {
        
    }

    public function deleteAnnonce($id_annonce)
    {
 
    }
    public function deleteVehicule($id_Vehicule)
    {
 
    }
    

    
}