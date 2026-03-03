<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Medecin;
use App\Models\Creneau;
use App\Models\Specialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\RendezVousAnnuleMail;

class CreneauController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $query = Creneau::with('medecin');

    // Filtrer les créneaux si un médecin est sélectionné
    if ($request->medecin_id) {
        $query->where('medecin_id', $request->medecin_id);
    }

    // Filtre par spécialité
    if ($request->specialite_id) {
        $query->whereHas('medecin', function($q) use ($request) {
            $q->where('specialite_id', $request->specialite_id);
        });
    }

    // Filtrer par statut
    if ($request->statut) {
        if ($request->statut === 'disponible') {
            $query->where('disponible', true);
        } elseif ($request->statut === 'reserve') {
            $query->where('disponible', false);
        }
    }

    //  Trier les créneaux par ordre alphabétique du nom du médecin
    $creneaux = $query->join('medecins', 'creneaux.medecin_id', '=', 'medecins.id')
                      ->orderBy('medecins.nom', 'asc')
                      ->select('creneaux.*') // pour éviter les colonnes en double
                      ->get();

    // Liste spécialités
    $specialites = Specialite::orderBy('nom', 'asc')->get();

    // Récupérer tous les médecins triés par nom uniquement pour la liste déroulante
    $medecins = Medecin::orderBy('nom', 'asc')->get();

    return view('creneaux.index', compact('creneaux', 'medecins', 'specialites'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer tous les médecins triés par nom (ascendant)
        $medecins = Medecin::orderBy('nom', 'asc')->get();
        return view('creneaux.create', compact('medecins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);

        Creneau::create([
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'disponible' => true
        ]);

        return redirect()->route('creneaux.index')
            ->with('success', 'Créneau ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
   public function destroy($id)
    {
        // Récupérer le créneau avec son rendez-vous et le patient
    $creneau = Creneau::with('rendezVous.patient')->findOrFail($id);

    // Vérifier si le créneau est réservé
    if (!$creneau->disponible && $creneau->rendezVous) {

        $rendezvous = $creneau->rendezVous;

        // Vérifier que le patient existe et a un email
        if ($rendezvous->patient && $rendezvous->patient->email) {
            try {
                // Envoyer le mail au patient
                Mail::to($rendezvous->patient->email)
                    ->send(new RendezVousAnnuleMail($rendezvous));
            } catch (\Exception $e) {
                // Si ça plante, on ignore l’erreur mais on peut la loguer
                Log::error('Erreur en envoyant le mail : ' . $e->getMessage());
            }
        }

        // Supprimer le rendez-vous
        $rendezvous->delete();
    }

    // Supprimer le créneau
    $creneau->delete();

    return redirect()->route('creneaux.index')
                     ->with('success', 'Créneau supprimé avec succès.');
    }

}
