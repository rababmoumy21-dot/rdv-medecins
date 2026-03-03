@extends('layouts.admin')

@section('title', 'Créneaux')

@section('content')

<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🕒 Créneaux disponibles</h2>
        <a href="{{ route('creneaux.create') }}" class="btn btn-primary">
            + Ajouter créneau
        </a>
    </div>
    
{{-- Message succès --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

  
<div class="card shadow-sm mb-4 ">
    <div class="mb-2 d-flex align-items-center" style="gap: 10px; flex-wrap:wrap;">
        <div class="mb-2">
            <label class="form-label" style="font-size: 1.3rem; font-weight: bold;">
                🔎 Rechercher un créneau
            </label>
        </div>
        {{-- Zones de recherche  --}}
        <div class="d-flex align-items-center" style="gap: 15px; flex-wrap: wrap;">

            {{-- Spécialité --}}
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Spécialité :</label>
                <select id="searchSpecialite" class="form-control">

                    <option value="">-- Toutes les spécialités --</option>

                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}"
                            {{ request('specialite_id') == $specialite->id ? 'selected' : '' }}>
                            {{ $specialite->nom }}
                        </option>
                    @endforeach

                </select>
            </div>

           
            {{-- Médecin --}}
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Médecin :</label>
                <select id="searchMedecin" class="form-control">
                    <option value="">-- Tous les médecins --</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}"
                            data-specialite="{{ $medecin->specialite_id }}"
                            {{ request('medecin_id') == $medecin->id ? 'selected' : '' }}>
                            {{ $medecin->nom }} {{ $medecin->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Statut --}}
            <div class="col-md-4 col-lg-3">
                <label class="form-label">Statut :</label>
                <select id="searchStatut" class="form-control">

                    <option value="">-- Tous les statuts --</option>

                    <option value="disponible"
                        {{ request('statut') == 'disponible' ? 'selected' : '' }}>
                        Disponible
                    </option>

                    <option value="reserve"
                        {{ request('statut') == 'reserve' ? 'selected' : '' }}>
                        Réservé
                    </option>

                </select>
            </div>
            

        </div>
    {{-- Bouton réinitialiser --}}
        <div class="mt-4 text-center">
            <form action="{{ route('creneaux.index') }}" method="GET" class="w-100">
                <button type="submit" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-sync-alt"></i> Réinitialiser
                </button>
            </form>
        </div>
    </div>
</div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Médecin</th>
                    <th>Date</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Statut</th>
                    <th>Actions</th>    
                </tr>
            </thead>
            <tbody>
                @foreach($creneaux as $creneau)
                <tr>
                    <td>{{ $creneau->medecin->nom  }} {{  $creneau->medecin->prenom }}</td>
                    <td>{{ $creneau->date }}</td>
                    <td>{{ $creneau->heure_debut }}</td>
                    <td>{{ $creneau->heure_fin }}</td>
                    <td>
                        @if($creneau->disponible)
                            <span class="badge badge-success">Disponible</span>
                        @else
                            <span class="badge badge-danger">Réservé</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('creneaux.destroy', $creneau->id) }}" method="POST"
                            onsubmit="return confirmDelete({{ $creneau->disponible ? 'true' : 'false' }})">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
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
function confirmDelete(disponible)
{
    if (disponible)
    {
        // Créneau disponible → supprimer directement
        return confirm("Supprimer ce créneau ?");
    }
    else
    {
        // Créneau réservé → avertissement spécial
        return confirm("⚠️ Ce créneau contient un rendez-vous.\n\nVoulez-vous vraiment supprimer et notifier le patient ?");
    }
}
</script>

<script>
// Filtrer la liste des médecins selon la spécialité
document.getElementById('searchSpecialite').addEventListener('change', function() {
    const specialiteId = this.value;
    const medecinSelect = document.getElementById('searchMedecin');

    for (let i = 0; i < medecinSelect.options.length; i++) {
        const option = medecinSelect.options[i];
        const optionSpecialite = option.getAttribute('data-specialite');

        if (!specialiteId || optionSpecialite === specialiteId) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }

    // Réinitialiser la sélection du médecin
    medecinSelect.value = '';
});

// Fonction pour filtrer les créneaux (redirection)
function filterCreneaux() {
    const specialite = document.getElementById('searchSpecialite').value;
    const medecinId = document.getElementById('searchMedecin').value;
    const statut = document.getElementById('searchStatut').value;

    let url = "{{ route('creneaux.index') }}";
    const params = [];
    if (specialite) params.push("specialite_id=" + specialite);
    if (medecinId) params.push("medecin_id=" + encodeURIComponent(medecinId));
    if (statut) params.push("statut=" + encodeURIComponent(statut));

    if (params.length > 0) url += "?" + params.join("&");

    window.location.href = url;
}

// Redirection uniquement quand on change le médecin ou le statut
document.getElementById('searchMedecin').addEventListener('change', filterCreneaux);
document.getElementById('searchStatut').addEventListener('change', filterCreneaux);
</script>
@endsection
