@extends('layouts.admin')

@section('title', 'Ajouter spécialité')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">🩺 Nouvelle spécialité</h3>
    </div>

    <form method="POST" action="{{ route('specialites.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('specialites.index') }}" class="btn btn-secondary">Retour</a>
            <button class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

@endsection
