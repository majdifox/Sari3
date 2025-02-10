<?php
namespace App\Controllers;

use App\Models\Medecin;
use Core\Controller;
use App\Models\Patient;

class PatientControllers extends Controller
{
    public function index()
    {
        $this->view('patients/index');
    }

    public function reservations()
    {
        $this->view('patients/rendezvous');
    }

    public function consultations()
    {
        $this->view('patients/consultations');
    }

    public function listeconsultations()
    {
        $medecins = Medecin::all();
        $this->view('patients/rendezvous', ['medecins' => $medecins]);
    }

    public function reservezConsultation(){

        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $patient_id = 4;
            $medecin_id = $_POST['medecin_id'];
            $date_reservation = $_POST['date_reservation'];

            $patientModel = new Patient();
            $success = $patientModel->prendreRendezVous($patient_id, $medecin_id, $date_reservation);
            // if ($success) {
            //     $_SESSION['success'] = "Rendez-vous pris avec succès.";
            //     header("Location: /patients/dashboard");
            // } else {
            //     $_SESSION['error'] = "Erreur lors de la prise de rendez-vous.";
            //     header("Location: /patients/rendezvous");
            // }
            exit;
        }
        
    }
}
?>