@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifier Patient</h2>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" name="cin" id="cin" class="form-control" 
                value="{{ old('cin', $patient->cin ?? '') }}" required>
        </div>
        <div class="form-group mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control"
                   value="{{ $patient->nom }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control"
                   value="{{ $patient->prenom }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $patient->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control"
                   value="{{ $patient->telephone }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control"
                   value="{{ $patient->date_naissance }}" required>
        </div>
        <div class="form-group mb-3">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control"
                   value="{{ $patient->adresse }}" required>
        </div>
        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
