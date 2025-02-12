<?php
namespace App\Controllers;


class AuthController  {
    

    public function dashboard()
    {
        $userModel = new User();
        $colisModel = new Colis();

        $data = [
            'total_users' => $userModel->countAll(),
            'total_colis' => $colisModel->countAll(),
            'user_stats' => $userModel->getUserStats(),
            'colis_stats' => $colisModel->getColisStats(),
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
            'colis_stats' => $colisModel->getColisStats(),
            'conducteurs_count' => $userModel->countByRole('Conducteur'),
            'expediteurs_count' => $userModel->countByRole('Expediteur')
        ];

        View::render('admin/statistiques', $data);
    }
}