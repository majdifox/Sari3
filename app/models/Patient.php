<?php
namespace App\Models;

use Core\Database;

class Patient{

    public static function all()
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT ID, Nom, Prenom, Email, Telephone FROM utilisateurs WHERE Role = 'Patient'");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function prendreRendezVous($patient_id, $medecin_id, $date_reservation){

        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO rendezvous(Patient_id, Medecin_id, Date_reservation) VALUES (:patient_id, :medecin_id, :date_reservation)");

        $stmt->bindParam(':patient_id', $patient_id, \PDO::PARAM_INT);
        $stmt->bindParam(':medecin_id', $medecin_id, \PDO::PARAM_INT);
        $stmt->bindParam(':date_reservation', $date_reservation, \PDO::PARAM_STR);

        return $stmt->execute();

    }
}
?>