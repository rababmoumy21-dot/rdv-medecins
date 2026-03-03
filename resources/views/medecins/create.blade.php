@extends('layouts.admin')

@section('title', 'Ajouter médecin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">➕ Ajouter un médecin</h3>
    </div>

    <form action="{{ route('medecins.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CIN</label>
                        <input type="text" name="cin" class="form-control" required>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Spécialité</label>
                <select name="specialite_id" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" class="form-control" required>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Retour</a>
            <button class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

@endsection
