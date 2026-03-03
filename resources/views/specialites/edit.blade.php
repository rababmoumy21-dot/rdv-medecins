@extends('layouts.admin')

@section('title', 'Modifier spécialité')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier spécialité</h3>
    </div>

    <form method="POST" action="{{ route('specialites.update', $specialite) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="{{ $specialite->nom }}" class="form-control" required>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('specialites.index') }}" class="btn btn-secondary">Retour</a>
            <button class="btn btn-warning">Mettre à jour</button>
        </div>
    </form>
</div>

@endsection
