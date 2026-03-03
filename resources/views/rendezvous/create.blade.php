@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">📝 Réserver un rendez-vous</h2>

    <form method="POST" action="{{ route('rendezvous.store') }}" class="card p-4 shadow">
        @csrf
        <!-- Sélection du patient -->
        <div class="mb-3">
            <label class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">
                        {{ $patient->nom }} {{ $patient->prenom }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Sélection du créneau disponible -->
        <div class="mb-3">
            <select name="creneau_id" class="form-select" required>
                @foreach($creneaux->where('disponible', 1) as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->medecin->nom }} {{ $c->medecin->prenom }} — {{ $c->date }} ({{ $c->heure_debut }})
                    </option>
                @endforeach
            </select>

            
        </div>

        <button class="btn btn-success">
            Confirmer la réservation
        </button>
    </form>
</div>
@endsection
