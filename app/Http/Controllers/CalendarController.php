<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
class CalendarController extends Controller
{
     public function index()
    {
        return view('calendar');
    }

    public function events()
    {
        $rendezvous = \App\Models\RendezVous::with('patient', 'creneau.medecin')->get();

    $events = [];

    foreach ($rendezvous as $rendezvous) {
        $events[] = [
            'title' => 'Dr. ' . $rendezvous->creneau->medecin->nom .' '. $rendezvous->creneau->medecin->prenom,
            'start' => $rendezvous->creneau->date . 'T' . $rendezvous->creneau->heure_debut,
            'color' => $rendezvous->statut == 'confirme' ? 'green' : 'red',

            // 👇 informations supplémentaires
            'extendedProps' => [
                'patient' => $rendezvous->patient->nom .' '. $rendezvous->patient->prenom ,
                'medecin' => $rendezvous->creneau->medecin->nom . ' '.$rendezvous->creneau->medecin->prenom,
                'date' => $rendezvous->creneau->date,
                'heure' => $rendezvous->creneau->heure_debut,
                'statut' => $rendezvous->statut,
            ]
        ];
    }

    return response()->json($events);
    }
}
