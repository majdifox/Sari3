<?php
namespace App\Models;

use Core\Model;

class Colis extends Model {
    private $id;
    private $expediteur_id;
    private $itineare_id;
    private $destination;
    private $volume;
    private $poids;
    private $date_depart;
    private $date_arriver;
    private $status;
    private $etat;
    private $table = 'colis';
    public function __construct($id,$expediteur_id,$itineare_id,$destination,$volume,$poids,$date_depart,$date_arriver,$status,$etat){
        
    }
    
    public function getAll() {
        $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
                FROM {$this->table} c
                JOIN utilisateurs u ON c.expediteur_id = u.id
                ORDER BY c.date_depart DESC";
        return $this->query($sql);
    }

    public function getByItineraire($id) {
        $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
                FROM {$this->table} c
                JOIN utilisateurs u ON c.expediteur_id = u.id
                WHERE c.id IN (
                    SELECT colis_id FROM details_itineraire WHERE itineraire_id = ?
                )
                ORDER BY c.date_depart DESC";
        return $this->query($sql, [$id]);
    }

    public function valide($id) {
        $sql = "UPDATE {$this->table} SET statut = 'Livré' WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function add($data) {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this->execute($sql, array_values($data));
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $result = $this->query($sql);
        return $result[0]['count'];
    }

    public function getColisStats() {
        $sql = "SELECT 
                    statut,
                    COUNT(*) as total,
                    AVG(volume) as volume_moyen,
                    AVG(poids) as poids_moyen
                FROM {$this->table}
                GROUP BY statut";
        return $this->query($sql);
    }

    public function getRecentColis($limit = 10) {
        $sql = "SELECT c.*, u.nom as expediteur_nom, u.prenom as expediteur_prenom 
                FROM {$this->table} c
                JOIN utilisateurs u ON c.expediteur_id = u.id
                ORDER BY c.date_depart DESC
                LIMIT ?";
        return $this->query($sql, [$limit]);
    }

    public function updateStatus($id, $statut) {
        $sql = "UPDATE {$this->table} SET statut = ? WHERE id = ?";
        return $this->execute($sql, [$statut, $id]);
    }
}