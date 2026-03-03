@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Ajouter un patient</h2>

    <form method="POST" action="{{ route('patients.store') }}">
        @csrf

        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" name="cin" id="cin" class="form-control" 
                value="{{ old('cin', $patient->cin ?? '') }}" required>
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button class="btn btn-success mt-3">
            Enregistrer
        </button>
    </form>
</div>
@endsection
