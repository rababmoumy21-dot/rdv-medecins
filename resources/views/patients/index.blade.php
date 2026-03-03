@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👥 Liste des Patients</h2>

        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            + Ajouter Patient
        </a>
    </div>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            {{-- Recherche par nom --}}
            <div class="col-md-4 mb-2">
                <input type="text"
                       id="searchNom"
                       class="form-control"
                       placeholder="🔎 Rechercher par nom..."
                       value="{{ request('nom') }}">
            </div>

            {{-- Recherche par CIN --}}
            <div class="col-md-4 mb-2">
                <input type="text"
                       id="searchCin"
                       class="form-control"
                       placeholder="🔎 Rechercher par CIN..."
                       value="{{ request('cin') }}">
            </div>
                 {{-- Bouton réinitialiser --}}
            <form action="{{ route('patients.index') }}" method="GET">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt"></i> Réinitialiser
                    </button>
            </form>
        </div>
    </div>
</div>

    <div class="card shadow-sm w-100">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            
                            <th>CIN</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            
                            <td>{{ $patient->cin }}</td>
                            <td>{{ $patient->nom }}</td>
                            <td>{{ $patient->prenom }}</td>
                            <td>{{ $patient->date_naissance }}</td>
                            <td>{{ $patient->adresse }}</td>
                            <td>{{ $patient->telephone }}</td>
                            <td>{{ $patient->email }}</td>
                            
                            

                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('patients.edit', $patient->id) }}"
                                    class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('patients.destroy', $patient->id) }}"
                                        method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Supprimer ce patient ?')">
                                                <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aucun patient enregistré
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
                <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $patients->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
<script>
let timeout = null;

// Recherche quand on tape le nom
document.getElementById('searchNom').addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        filter();
    }, 1000);
});

// Recherche quand on tape le CIN
document.getElementById('searchCin').addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        filter();
    }, 1000);
});

function filter()
{
    let nom = document.getElementById('searchNom').value;
    let cin = document.getElementById('searchCin').value;

    let url = "{{ route('patients.index') }}" + "?nom=" + nom + "&cin=" + cin;

    window.location.href = url;
}

</script>

@endsection
