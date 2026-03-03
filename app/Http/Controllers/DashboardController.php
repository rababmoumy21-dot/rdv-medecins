<?php

namespace App\Http\Controllers;
use App\Models\Specialite;
use App\Models\Medecin;
use App\Models\Creneau;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Models\Patient;

class DashboardController extends Controller
{
   public function index()
    {
        return view('dashboard', [
            'specialites' => Specialite::count(),
            'medecins' => Medecin::count(),
            'creneaux' => Creneau::count(),
            'patients'    => Patient::count(),
            'rendezvous' => RendezVous::count(),
        ]);
    }
}
