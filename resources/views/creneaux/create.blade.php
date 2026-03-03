@extends('layouts.admin')

@section('title', 'Ajouter créneau')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nouveau créneau</h3>
    </div>

    <form method="POST" action="{{ route('creneaux.store') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">

            <div class="form-group">
                <label>Médecin</label>
                <select name="medecin_id" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}">
                            {{ $medecin->nom }} {{ $medecin->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Heure début</label>
                    <input type="time" name="heure_debut" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Heure fin</label>
                    <input type="time" name="heure_fin" class="form-control" required>
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <a href="{{ route('creneaux.index') }}" class="btn btn-secondary">Retour</a>
            <button class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

@endsection
