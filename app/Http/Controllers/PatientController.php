<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
{
    $query = Patient::query();

    if ($request->nom) {
        $query->where('nom', 'like', '%' . $request->nom . '%');
    }

    if ($request->cin) {
        $query->where('cin', 'like', '%' . $request->cin . '%');
    }

    $patients = $query->orderBy('nom', 'asc')->paginate(20);

    return view('patients.index', compact('patients'));
}

    public function create()
{
    return view('patients.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'cin' => 'required|string|max:20|unique:patients,cin,' . ($patient->id ?? 'NULL'),
        'email' => 'nullable|email|unique:patients,email',
        'telephone' => 'required|string|max:20',
        'date_naissance' => 'required|date',
    ]);

    Patient::create($request->all());

    return redirect()
        ->route('patients.index')
        ->with('success', 'Patient ajouté avec succès');
}
public function update(Request $request, Patient $patient)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'cin' => 'required|string|max:20|unique:patients,cin,' . ($patient->id ?? 'NULL'),
        'email' => 'nullable|email|unique:patients,email,' . $patient->id,
        'telephone' => 'required|string|max:20',
        'date_naissance' => 'required|date',
    ]);

    $patient->update($request->all());

    return redirect()
        ->route('patients.index')
        ->with('success', 'Patient modifié avec succès');
}

public function edit(Patient $patient)
{
    return view('patients.edit', compact('patient'));
}

public function destroy(Patient $patient)
{
    $patient->delete();

    return redirect()
        ->route('patients.index')
        ->with('success', 'Patient supprimé avec succès');
}

}
