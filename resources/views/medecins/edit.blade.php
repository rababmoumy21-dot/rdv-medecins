@extends('layouts.admin')

@section('title', 'Modifier médecin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">✏️ Modifier médecin</h3>
    </div>

    <form action="{{ route('medecins.update', $medecin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CIN</label>
                        <input type="text" name="cin" value="{{ $medecin->cin }}" class="form-control" required>
                    </div>
                </div>

                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" value="{{ $medecin->nom }}" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="{{ $medecin->prenom }}" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Spécialité</label>
                <select name="specialite_id" class="form-control" required>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}"
                            {{ $medecin->specialite_id == $specialite->id ? 'selected' : '' }}>
                            {{ $specialite->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $medecin->email }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ $medecin->telephone }}" class="form-control">
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Retour</a>
            <button class="btn btn-warning">Mettre à jour</button>
        </div>
    </form>
</div>

@endsection
