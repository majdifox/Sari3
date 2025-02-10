<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Medecin;

class MedecinControllers extends Controller
{
    public function index()
    {
        $medecins = Medecin::all();
        $this->view('medecins/index', ['medecins' => $medecins]);
    }
}

?>