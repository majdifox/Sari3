<?php
 namespace App\Controllers;


use Core\View;
use App\Models\Admin;
use App\Models\Vehicule; 
use App\Models\Itineraire; // added this line
use App\Models\UserFactory; // added this line
use App\Models\AnnonceModel; // added this line

use App\Models\ColisFactory;
use App\Models\VehiculeFactory;
use App\Models\ItineraireFactory;
class AdminController 
{
    private $admin;
    public function __construct()
    {
       
        $this->admin = new Admin();
    }

    public function dashboard()
    {   
        
        $stats = $this->getDashboardStats();
        $recent_colis=$this->getRecentColis();
        $conducteurs = $this->ListConducteurs();
        $itineraires = $this->ListItineraires();

        $total_users = $this->admin->CountUtilisateurs();
        
        require_once 'C:\laragon\www\Sari3\app\views\Admin\Dashboard_Administrateur.php';
        // return json_encode($itineraires);
    }
    public function gestion_utilisateur()
    {
        $users = $this->ListUsers();
        
        require_once 'C:\laragon\www\Sari3\app\views\Admin\Gestion_Utilisateur.php';
    }
    public function gestion_annonce()
    {
        $itineraires = $this->ListAnnonces();
        
        require_once 'C:\laragon\www\Sari3\app\views\Admin\Gestion_Annonces.php';
    }
    
    public function gestion_profile()
    {
       
        require_once 'C:\laragon\www\Sari3\app\views\Admin\Profile_Administrateur.php';
    }
    public function getDashboardStats() {
        $stats = [];
        
        // Statistiques des utilisateurs
        $userFactory = new UserFactory();
        $stats['users'] = [
            'total' => $userFactory->CountAll(),    
            'conducteurs' => $userFactory->CountByRole('Conducteur'),
            'expediteurs' => $userFactory->CountByRole('Expediteur'), 
            'admins' => $userFactory->CountByRole('Admin')      
        ];
        
        // Statistiques des itinéraires
        $itineraireFactory = new ItineraireFactory();
        $stats['itineraires'] = [
            'total' => $itineraireFactory->CountAll() ?? 0,
            'actifs' => $itineraireFactory->CountByStatus('En préparation') ?? 0,
            'termines' => $itineraireFactory->CountByStatus('En transit') ?? 0
        ];
        
        // Statistiques des colis
        $colisFactory = new ColisFactory();
        $stats['colis'] = [
            'total' => $colisFactory->CountAll() ?? 0,
            'en_attente' => $colisFactory->CountByStatus('En préparation') ?? 0,
            'en_cours' => $colisFactory->CountByStatus('En transit') ?? 0,
            'livres' => $colisFactory->CountByStatus('Livré') ?? 0
        ];
        // var_dump($stats);
        return $stats;
    }

    public function ListConducteurs()
    {
        $userFactory = new UserFactory();
        $conducteurs = $userFactory->getAllConducteurs();
        return $conducteurs;
    }
    public function ListItineraires()
    {
        $itineraireFactory = new ItineraireFactory();
        $itineraires = $itineraireFactory->getItineraire();
        return $itineraires;
    }
    public function ListExpediteurs()
    {
        $userFactory = new UserFactory();
        $expediteurs = $userFactory->getAllExpediteurs();
        return $expediteurs;
    }
    public function getProfile()
    {
        $userFactory = new \App\Models\UserFactory();
        $user = $userFactory->getProfile(3);

        return $user;
    }
    public function ListUsers()
    {
        $userFactory = new UserFactory();
        $users = $userFactory->getAllUsers(); 
        return $users;
    }
    public function ListAnnonces()
    {
        $annonceFactory = new \App\Models\ItineraireFactory();
        $annonces = $annonceFactory->getAnnonce(); 
        return $annonces;
    }

    public function deleteUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->delete($id_user);;
    }

    public function ValidateUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->validate($id_user); 
    }

   

    public function BanUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->ban($id_user); 
    }


    public function CreateAnnouncement($data)
    {
        $annonceModel = new AnnonceModel(); 
        $annonceModel->create($data); 
        return json_encode(['status' => 'success']);
    }

    public function DeleteAnnouncement($id_annonce)
    {
        $annonceModel = new AnnonceModel(); 
        $annonceModel->delete($id_annonce); 
        return json_encode(['status' => 'success']);
    }

    public function deleteAnnonce($id_annonce)
    {
        $annonceModel = new AnnonceModel();
        $annonceModel->delete($id_annonce);
        return json_encode(['status' => 'success']);
    }
    public function deleteVehicule($id_Vehicule)
    {
        $vehiculeModel = new VehiculeModel();
        $vehiculeModel->delete($id_Vehicule);
        return json_encode(['status' => 'success']);
    }
    
    public function getRecentColis()
{
    $colisFactory = new ColisFactory();
    $recent_colis = $colisFactory->RecentColis(); 
    return $recent_colis;
}
    public function getId()
{
    return $this->admin->getId();
}   

    
}