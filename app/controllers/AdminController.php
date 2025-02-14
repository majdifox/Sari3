<?php
 namespace App\Controllers;


use Core\View;
use App\Models\Admin;
use App\Models\UserFactory; 
use App\Models\Itineraire; // added this line
use App\Models\AnnonceModel; // added this line
use App\Models\VehiculeModel; // added this line


class AdminController 
{
    private $admin;
    public function __construct()
    {
       
        $this->admin = new Admin();
    }

    public function dashboard()
    {   
        // Assuming you have the necessary parameters available
        $conducteur_id = 1; // Example value, replace with actual logic
        $vehicule_id = 1; // Example value, replace with actual logic
        $date_depart = '2025-01-01'; // Example value, replace with actual logic
        $date_arriver = '2025-01-02'; // Example value, replace with actual logic
        $statut = 'active'; // Example value, replace with actual logic
        $stats = $this->getDashboardStats();
        // $total_users = $this->admin->CountUtilisateurs();
        $itineraires = $this->admin->ListItineraires($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut);
        require_once 'C:\laragon\www\Sari3\app\views\Admin\Dashboard_Administrateur.php';
        // return json_encode($itineraires);
    }
    public function getDashboardStats() {
        $stats = [];
        
        // Statistiques des utilisateurs
        $userFactory = new \App\Models\UserFactory();
        $stats['users'] = [
            'total' => $userFactory->CountAll(),         // Maintenant retourne directement le nombre
            'conducteurs' => $userFactory->CountByRole('Conducteur'),  // Retourne directement le nombre
            'expediteurs' => $userFactory->CountByRole('Expediteur'), // Retourne directement le nombre
            'admins' => $userFactory->CountByRole('Admin')            // Retourne directement le nombre
        ];
        
        // Statistiques des itinéraires
        $itineraireFactory = new \App\Models\ItineraireFactory();
        $stats['itineraires'] = [
            'total' => $itineraireFactory->CountAll() ?? 0,
            'actifs' => $itineraireFactory->CountByStatus('En préparation') ?? 0,
            'termines' => $itineraireFactory->CountByStatus('En transit') ?? 0
        ];
        
        // Statistiques des colis
        $colisFactory = new \App\Models\ColisFactory();
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
        return json_encode($conducteurs);
    }
    public function ListItineraires($conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut)
    {
        $itineraires = Itineraire::getAllbyConducteur($this->admin->getId(), $conducteur_id, $vehicule_id, $date_depart, $date_arriver, $statut);
        return json_encode($itineraires);
    }
    public function ListExpediteurs()
    {
        $userFactory = new UserFactory();
        $expediteurs = $userFactory->getAllExpediteurs();
        return json_encode($expediteurs);
    }
    public function ListUsers()
    {
        $userFactory = new UserFactory();
        $users = $userFactory->getAllUsers(); 
        return json_encode($users);
    }

    public function deleteUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->delete($id_user);
        return json_encode(['status' => 'success']);
    }

    public function ValidateUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->validate($id_user); 
        return json_encode(['status' => 'success']);
    }

    public function SuspendUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->suspend($id_user); 
        return json_encode(['status' => 'success']);
    }

    public function BanUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->ban($id_user); 
        return json_encode(['status' => 'success']);
    }

    public function UnbanUser($id_user)
    {
        $userFactory = new UserFactory();
        $userFactory->unban($id_user); 
        return json_encode(['status' => 'success']);
    }

    public function ListAnnouncements()
    {
        $annonceModel = new AnnonceModel(); 
        $annonces = $annonceModel->getAll(); 
        return json_encode($annonces);
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
    

    
}