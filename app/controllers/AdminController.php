<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\User;
use App\Models\Colis;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Vérifier si l'utilisateur est connecté et est un administrateur
        if (!isset($_SESSION['user'])) {
            redirect('/login');
        }
    }

    public function dashboard()
    {
        $userModel = new User();
        $colisModel = new Colis();

        $data = [
            'total_users' => $userModel->countAll(),
            'total_colis' => $colisModel->countAll(),
            'conducteurs_count' => $userModel->countByRole('Conducteur'),
            'expediteurs_count' => $userModel->countByRole('Expediteur'),
            'recent_colis' => $colisModel->getRecentColis(5)
        ];

        View::render('admin/dashboard', $data);
    }

    public function users()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        View::render('admin/users', ['users' => $users]);
    }

    public function toggleUserStatus()
    {
        if (!isset($_POST['user_id'])) {
            json_response(['success' => false, 'message' => 'ID utilisateur requis']);
        }

        $userModel = new User();
        $success = $userModel->toggleStatus($_POST['user_id']);
        json_response(['success' => $success]);
    }

    public function colis()
    {
        $colisModel = new Colis();
        $colis = $colisModel->getAll();
        View::render('admin/colis', ['colis' => $colis]);
    }

    public function updateColisStatus()
    {
        if (!isset($_POST['colis_id']) || !isset($_POST['statut'])) {
            json_response(['success' => false, 'message' => 'Paramètres manquants']);
        }

        $colisModel = new Colis();
        $success = $colisModel->updateStatus($_POST['colis_id'], $_POST['statut']);
        json_response(['success' => $success]);
    }

    public function statistiques()
    {
        $userModel = new User();
        $colisModel = new Colis();

        $data = [
            'user_stats' => $userModel->getUserStats(),
            'conducteurs_count' => $userModel->countByRole('Conducteur'),
            'expediteurs_count' => $userModel->countByRole('Expediteur'),
            'colis_by_status' => [
                'en_preparation' => $colisModel->countByStatus('En préparation'),
                'en_transit' => $colisModel->countByStatus('En transit'),
                'livre' => $colisModel->countByStatus('Livré'),
                'non_livre' => $colisModel->countByStatus('Non livré')
            ],
            'colis_by_state' => [
                'accepte' => $colisModel->countByState('Accepté'),
                'en_attente' => $colisModel->countByState('En attente'),
                'refuse' => $colisModel->countByState('Refusé')
            ]
        ];

        View::render('admin/statistiques', $data);
    }
}