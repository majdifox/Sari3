<?php
namespace App\Models;

use PDO;

class ColisFactory {

    public function createColis($colisData) {
        echo '<pre>';
        var_dump($colisData);
        echo '</pre>';
        return new Colis(
            $colisData['id'] ?? null,
            $colisData['expediteur_id'],
            $colisData['itineraire_id'],
            $colisData['destination'],
            $colisData['volume'],
            $colisData['poids'],
            $colisData['date_depart']??null,
            $colisData['date_arriver']?? null,
            $colisData['statut']??null,
            $colisData['etat']??null,
            $colisData['nom'],
            $colisData['origin']
        );
    }

    public function getColis($id) {
        $colisData = Colis::get($id);
        if ($colisData) {
            return $this->createColis($colisData);
        } else {
            throw new \Exception("Colis not found with ID: $id");
        }
    }

    // Accept a Colis (update status to 'En transit')
    public function acceptColis($id) {
        $colis = $this->getColis($id);
        $colis->accept();
    }

    // Refuse a Colis (update status to 'Refusé')
    public function refuseColis($id) {
        $colis = $this->getColis($id);
        $colis->refuse();
    }

    // Get all Colis by Expediteur (Sender) ID
    public function getColisByExpediteur($id) {
        $colis = new Colis();
        return $colis->getByExpediteur($id);
    }

    // Add a new Colis
    public function addColis($colisData) {
        $colis = $this->createColis($colisData);
        $colis->create();
    }
}
