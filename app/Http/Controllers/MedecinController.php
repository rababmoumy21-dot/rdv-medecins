<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;

use App\Models\RendezVous;
use App\Models\Creneau;
use Illuminate\Support\Facades\DB;

use App\Mail\TransferRendezVousMail;
use Illuminate\Support\Facades\Mail;

class MedecinController extends Controller
{
public function index(Request $request)
{
    // Requête des médecins avec spécialité
    $query = Medecin::with('specialite');

    // Filtrer par nom si fourni
    if ($request->nom) {
        $query->where('nom', 'like', '%' . $request->nom . '%');
    }

    // Filtrer par spécialité si sélectionnée
    if ($request->specialite_id) {
        $query->where('specialite_id', $request->specialite_id);
    }

    // Tri des médecins par nom
    $medecins = $query->orderBy('nom', 'asc')->get();

    // Récupérer toutes les spécialités pour la liste déroulante, triées par nom
    $specialites = Specialite::orderBy('nom', 'asc')->get();

    return view('medecins.index', compact('medecins', 'specialites'));
}

    public function create()
    {
        $specialites = Specialite::all();
        return view('medecins.create', compact('specialites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'specialite_id' => 'required|exists:specialites,id',
        ]);

        Medecin::create($request->all());

        return redirect()
            ->route('medecins.index')
            ->with('success', 'Médecin ajouté avec succès');
    }

    public function edit(Medecin $medecin)
    {
        $specialites = Specialite::all();
        return view('medecins.edit', compact('medecin', 'specialites'));
    }

    public function update(Request $request, Medecin $medecin)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'specialite_id' => 'required',
        ]);

        $medecin->update($request->all());

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin modifié');
    }

    
   public function destroy(Medecin $medecin)
{       
            // Nombre de rendez-vous du médecin
    $nombreRdv = RendezVous::whereHas('creneau', function ($query) use ($medecin) {
        $query->where('medecin_id', $medecin->id);
    })->count();


    // Cas 0 rendez-vous → suppression normale
    if ($nombreRdv == 0) {

        $medecin->delete();

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin supprimé avec succès.');
    }


    // Cas > 1 rendez-vous → interdit
    if ($nombreRdv > 1) {

        return redirect()->route('medecins.index')
            ->with('error', 'Impossible de supprimer ce médecin car il a plus d\'un rendez-vous.');
    }


    // Cas 1 rendez-vous → vérifier médecins disponibles
    $autresMedecinsDisponibles = Medecin::where('specialite_id', $medecin->specialite_id)
        ->where('id', '!=', $medecin->id)
        ->whereHas('creneaux', function ($query) {
            $query->where('disponible', 1);
        })
        ->count();


    // rediriger vers reassign avec info disponibilité
    if ($autresMedecinsDisponibles == 0) {

        return redirect()
            ->route('medecins.reassign.form', $medecin->id);
    }

    return redirect()->route('medecins.reassign.form', $medecin->id);
}

    public function showReassignForm(Medecin $medecin)
{
    
    $autresMedecins = Medecin::where('specialite_id', $medecin->specialite_id)
        ->where('id', '!=', $medecin->id)
        ->whereHas('creneaux', function ($query) {
            $query->where('disponible', 1);
        })
        ->get();

    return view('medecins.reassign', compact('medecin', 'autresMedecins'));
}


public function reassignAndDelete(Request $request, Medecin $medecin)
{
   $request->validate([
        'nouveau_medecin_id' => 'required|exists:medecins,id',
    ]);

    $nouveauMedecinId = $request->nouveau_medecin_id;
    $nouveauMedecin = Medecin::findOrFail($nouveauMedecinId);

    // récupérer les rendez-vous via les créneaux
    $rendezvousList = \App\Models\RendezVous::whereHas('creneau', function ($query) use ($medecin) {
        $query->where('medecin_id', $medecin->id);
    })
    ->with(['patient', 'creneau'])
    ->get();

    // si aucun rendez-vous → suppression directe
    if ($rendezvousList->isEmpty()) {

        // supprimer ses créneaux
        Creneau::where('medecin_id', $medecin->id)->delete();

        $medecin->delete();

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin supprimé (aucun rendez-vous).');
    }

    // transférer chaque rendez-vous
    foreach ($rendezvousList as $rendezvous) {

        $ancienCreneau = $rendezvous->creneau;

        // chercher créneau disponible du nouveau médecin même date
        $nouveauCreneau = Creneau::where('medecin_id', $nouveauMedecinId)
            ->where('disponible', true)
            ->where('date', $ancienCreneau->date)
            ->first();

        if (!$nouveauCreneau) {

            return back()->with('error',
                'Erreur : aucun créneau disponible pour le patient au même jour '
                . $rendezvous->patient->nom . ' ' . $rendezvous->patient->prenom
            );
        }

        // libérer ancien créneau
        $ancienCreneau->disponible = true;
        $ancienCreneau->save();

        // affecter nouveau créneau
        $rendezvous->creneau_id = $nouveauCreneau->id;
        $rendezvous->save();

        // marquer nouveau créneau réservé
        $nouveauCreneau->disponible = false;
        $nouveauCreneau->save();

        // envoyer email au patient
        if ($rendezvous->patient && $rendezvous->patient->email) {

            Mail::to($rendezvous->patient->email)
                ->send(new \App\Mail\TransferRendezVousMail(
                    $rendezvous,
                    $medecin,
                    $nouveauMedecin
                ));
        }
    }

    // supprimer tous les créneaux du médecin
    Creneau::where('medecin_id', $medecin->id)->delete();

    // supprimer médecin
    $medecin->delete();

    return redirect()->route('medecins.index')
        ->with('success', 'Médecin supprimé et rendez-vous transférés avec succès.');
}
}