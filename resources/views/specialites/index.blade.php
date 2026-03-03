@extends('layouts.admin')

@section('title', 'Spécialités')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🩺 Liste des spécialités</h2>
        <a href="{{ route('specialites.create') }}" class="btn btn-primary">
            + Ajouter spécialité
        </a>
    </div>
{{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
        <label for="searchSpecialite" class="form-label mb-0"
            style="font-size: 1.2rem; font-weight: 500;">
            🔎 Rechercher une spécialité :
        </label>

        <select id="searchSpecialite" class="form-control" style="flex: 1;">
            <option value="">-- Toutes les spécialités --</option>

            @foreach($specialitesRecherche as $s)
                <option value="{{ $s->nom }}"
                    {{ request('nom') == $s->nom ? 'selected' : '' }}>
                    {{ $s->nom }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark"> 
                <tr>
                    
                    <th>Spécialités</th>
                    <th>Médecins</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($specialites as $specialite)
                <tr>
                    
                    <td>{{ $specialite->nom }}</td>
                    <td>
                        @if($specialite->medecins->count() > 0)
                            <ul>
                                @foreach($specialite->medecins as $medecin)
                                    <li>Dr. {{ $medecin->nom }} {{ $medecin->prenom }}</li>
                                @endforeach
                            </ul>
                        @else
                            Aucun médecin
                        @endif
                </td>
                    <td style="display: flex; justify-content: center; gap: 10px;">
                                            {{-- Modifier --}}
                        <a href="{{ route('specialites.edit', $specialite) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                                            {{-- Ajouter RDV --}}
                        <a href="{{ route('rendezvous.create', ['specialite_id' => $specialite->id]) }}" 
                        class="btn btn-sm btn-success">
                            <i class="fas fa-calendar-plus"></i> Ajouter RDV
                        </a>
                                            {{-- Supprimer --}}
                        <form action="{{ route('specialites.destroy', $specialite) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('searchSpecialite').addEventListener('change', function() {
    const nom = this.value;
    let url = "{{ route('specialites.index') }}";

    if (nom) {
        url += "?nom=" + encodeURIComponent(nom);
    }

    window.location.href = url;
});
</script>

@endsection
