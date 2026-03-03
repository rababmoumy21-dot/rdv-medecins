@extends('layouts.admin')

@section('title', 'Médecins')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👨‍⚕️ Liste des médecins</h2>
        <a href="{{ route('medecins.create') }}" class="btn btn-primary">
            
           + Ajouter médecin
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


<div class="card mb-3">
    <div class="card-body">
        <div class="row g-2 align-items-end">

            {{-- Recherche par nom --}}
            <div class="col-md-4">
                <label for="searchNom" class="form-label mb-1">Nom :</label>
                <input type="text"
                       id="searchNom"
                       name="nom"
                       class="form-control"
                       placeholder="🔎 Rechercher par nom..."
                       value="{{ request('nom') }}">
            </div>

            {{-- Recherche par spécialité --}}
            <div class="col-md-4">
                <label for="searchSpecialite" class="form-label mb-1">Spécialité :</label>
                <select id="searchSpecialite" name="specialite_id" class="form-control">
                    <option value="">-- Toutes les spécialités --</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}"
                            {{ request('specialite_id') == $specialite->id ? 'selected' : '' }}>
                            {{ $specialite->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bouton réinitialiser --}}
            <div class="col-md-4 d-flex align-items-start mt-4 mt-md-0">
                <form action="{{ route('medecins.index') }}" method="GET" class="w-100">
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-sync-alt"></i> Réinitialiser
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>



    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medecins as $medecin)
                <tr>
                    <td>{{ $medecin->cin }}</td>
                    <td>{{ $medecin->nom }}</td>
                    <td>{{ $medecin->prenom }}</td>
                    <td>{{ $medecin->specialite->nom ?? '-' }}</td>
                    <td>{{ $medecin->email }}</td>
                    <td>{{ $medecin->telephone }}</td>
                    <td>
                        <div style="display: flex; gap: 5px; align-items: center;">
                            <!-- Bouton Modifier -->
                            <a href="{{ route('medecins.edit', $medecin) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('medecins.destroy', $medecin->id) }}" method="POST"
                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce médecin ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>


let timeout = null;

// recherche quand on tape le nom
document.getElementById('searchNom').addEventListener('input', function() {

    clearTimeout(timeout);

    timeout = setTimeout(function() {
        filter();
    }, 1000); // délai en ms 
});

// recherche quand on change la spécialité
document.getElementById('searchSpecialite').addEventListener('change', function() {
    filter();
});


function filter()
{
    let nom = document.getElementById('searchNom').value;
    let specialite = document.getElementById('searchSpecialite').value;

    let url = "{{ route('medecins.index') }}" + "?nom=" + nom + "&specialite_id=" + specialite;

    window.location.href = url;
}

</script>


@endsection
