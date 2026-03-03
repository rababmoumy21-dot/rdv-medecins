<?php

namespace App\Http\Controllers;
use App\Mail\RendezVousMail;
use Illuminate\Support\Facades\Mail;
use App\Models\RendezVous;
use App\Models\Creneau;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
public function index(Request $request)
{
    $query = RendezVous::with(['patient', 'creneau.medecin']);

    // Recherche par nom du patient
    if ($request->filled('nom_patient')) {
        $query->whereHas('patient', function($q) use ($request) {
            $q->where('nom', 'like', '%' . $request->nom_patient . '%');
        });
    }

    // Recherche par CIN du patient
    if ($request->filled('cin_patient')) {
        $query->whereHas('patient', function($q) use ($request) {
            $q->where('cin', 'like', '%' . $request->cin_patient . '%');
        });
    }

    // Recherche par nom du médecin
    if ($request->filled('nom_medecin')) {
        $query->whereHas('creneau', function($q) use ($request) {
            $q->whereHas('medecin', function($q2) use ($request) {
                $q2->where('nom', 'like', '%' . $request->nom_medecin . '%');
            });
        });
    }

    $rendezvous = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();

    return view('rendezvous.index', compact('rendezvous'));
}
    public function create(Request $request)
    {   
        $patients = Patient::orderBy('nom', 'asc')
                       ->get();
       # $medecins = Medecin::all();
        $creneaux = Creneau::with('medecin')
                ->where('disponible', 1)
                ->join('medecins', 'creneaux.medecin_id', '=', 'medecins.id')
                ->orderBy('medecins.nom', 'asc')
                ->orderBy('creneaux.date', 'asc')
                ->orderBy('creneaux.heure_debut', 'asc')
                ->select('creneaux.*')
                ->get();

        return view('rendezvous.create', compact(
            'patients',
            #'medecins',
            'creneaux'
        ));
    }

    public function store(Request $request)
    {   //Validation des données
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'creneau_id' => 'required|exists:creneaux,id',
        ]);

        // Vérifier que le créneau n'a pas de rendez-vous confirmé
        $existe = RendezVous::where('creneau_id', $request->creneau_id)
                            ->where('statut', 'confirme')
                            ->first();

        if ($existe) {
            return back()->with('error', 'Ce créneau est déjà réservé.');
        }

        //Vérifier que le créneau est encore disponible
        $creneau = Creneau::find($request->creneau_id);
       

        //Créer le rendez-vous
        $rendezvous = RendezVous::create([
            'patient_id' => $request->patient_id,
            'creneau_id' => $request->creneau_id,
            'statut' => 'confirme',
        ]);

        //Marquer le créneau comme indisponible
        $creneau->update(['disponible' => 0]);

        // Charger les relations pour les emails
        $rendezvous->load('patient', 'creneau.medecin');

        // ----------------- Envoi des emails ------------------

        // Email patient
        if ($rendezvous->patient->email) {
            Mail::to($rendezvous->patient->email)
                ->send(new RendezVousMail($rendezvous));
        }
      

        // ------------------------------------------------------
        return redirect()->route('rendezvous.index')
                         ->with('success', 'Rendez-vous créé avec succès.');
    
    }

    public function destroy(RendezVous $rendezvous)
    {
    // Si déjà annulé
    if ($rendezvous->statut === 'annule') {
        return back()->with('error', 'Ce rendez-vous est déjà annulé.');
    }

    // Mettre le statut à annulé
    $rendezvous->update([
        'statut' => 'annule'
    ]);

    // Rendre le créneau disponible
    if ($rendezvous->creneau) {
        $rendezvous->creneau->update([
            'disponible' => 1
        ]);
    }

    // Charger les relations pour le mail
    $rendezvous->load('patient', 'creneau.medecin');

    // Envoyer email au patient
    if ($rendezvous->patient && $rendezvous->patient->email) {
        Mail::to($rendezvous->patient->email)
            ->send(new \App\Mail\RendezVousAnnuleMail($rendezvous));
    }

    return redirect()->route('rendezvous.index')
        ->with('success', 'Rendez-vous annulé avec succès.');
    } 
}