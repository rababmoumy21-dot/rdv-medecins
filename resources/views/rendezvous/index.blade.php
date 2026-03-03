@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📅 Liste des rendez-vous</h2>
        <a href="{{ route('rendezvous.create') }}" class="btn btn-primary">
            + Nouveau rendez-vous
        </a>
    </div>

    {{-- Messages succès / erreur --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Recherche --}}
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">

                <div class="col-md-3">
                    <input type="text"
                           id="searchNomPatient"
                           class="form-control"
                           placeholder="🔎 Nom du patient"
                           value="{{ request('nom_patient') }}">
                </div>

                <div class="col-md-3">
                    <input type="text"
                           id="searchCinPatient"
                           class="form-control"
                           placeholder="🔎 CIN du patient"
                           value="{{ request('cin_patient') }}">
                </div>

                <div class="col-md-3">
                    <input type="text"
                           id="searchNomMedecin"
                           class="form-control"
                           placeholder="🔎 Nom du médecin"
                           value="{{ request('nom_medecin') }}">
                </div>
                <form action="{{ route('rendezvous.index') }}" method="GET">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt"></i> Réinitialiser
                    </button>
                </form>
            </div>
        </div>
    </div>

            {{-- Tableau --}}
    <div class="card shadow-sm w-100">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Patient</th>
                            <th>Médecin</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezvous as $rdv)
                            <tr>
                                <td>{{ $rdv->patient?->nom }} {{ $rdv->patient?->prenom ?? '' }}</td>
                                <td>{{ $rdv->creneau?->medecin?->nom }} {{ $rdv->creneau?->medecin?->prenom ?? '' }}</td>
                                <td>{{ $rdv->creneau?->date ?? '—' }}</td>
                                <td>{{ $rdv->creneau?->heure_debut ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-{{ $rdv->statut === 'confirme' ? 'success' : ($rdv->statut === 'annule' ? 'secondary' : 'danger') }}">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                                <td>
                                    @if($rdv->statut === 'confirme')
                                        <form method="POST" action="{{ route('rendezvous.destroy', $rdv->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Annuler le rendez-vous ?')">
                                                Annuler
                                            </button>
                                        </form>
                                    @else
                                        {{-- Pas de bouton si annulé ou autre statut --}}
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Aucun rendez-vous
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $rendezvous->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>

{{-- JS pour la recherche live et le bouton Réinitialiser --}}
<script>
let timeout = null;

// Écoute sur tous les champs
document.querySelectorAll('#searchNomPatient, #searchCinPatient, #searchNomMedecin')
    .forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(filter, 600);
        });
    });

// Fonction pour filtrer la table
function filter()
{
    let nom_patient = document.getElementById('searchNomPatient').value;
    let cin_patient = document.getElementById('searchCinPatient').value;
    let nom_medecin = document.getElementById('searchNomMedecin').value;

    let url = "{{ route('rendezvous.index') }}" 
        + "?nom_patient=" + encodeURIComponent(nom_patient) 
        + "&cin_patient=" + encodeURIComponent(cin_patient) 
        + "&nom_medecin=" + encodeURIComponent(nom_medecin);

    window.location.href = url;
}


</script>
@endsection