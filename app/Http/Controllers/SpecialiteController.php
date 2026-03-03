<?php

namespace App\Http\Controllers;
use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    public function index(Request $request)
    {
        //  Tableau : filtrer et trier par nom
        $query = Specialite::with('medecins');

        if ($request->nom) {
            $query->where('nom', $request->nom);
        }

        $specialites = $query->orderBy('nom', 'asc')->get(); // tri pour le tableau

        //  Liste déroulante triée par nom
        $specialitesRecherche = Specialite::orderBy('nom', 'asc')->get();

        return view('specialites.index', compact('specialites', 'specialitesRecherche'));

    }

    public function create()
    {
        return view('specialites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        Specialite::create($request->all());

        return redirect()->route('specialites.index')
                         ->with('success', 'Spécialité ajoutée avec succès');
    }

    public function edit($id)
    {
        $specialite = Specialite::findOrFail($id);
        return view('specialites.edit', compact('specialite'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        $specialite = Specialite::findOrFail($id);
        $specialite->update($request->all());

        return redirect()->route('specialites.index')
                         ->with('success', 'Spécialité modifiée avec succès');
    }

    public function destroy($id)
    {
        $specialite = Specialite::findOrFail($id);
        $specialite->delete();

        return redirect()->route('specialites.index')
                         ->with('success', 'Spécialité supprimée');
    }
}
