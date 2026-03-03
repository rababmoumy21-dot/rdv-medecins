@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>🔁 Transfert des patients de Dr. {{ $medecin->nom }} {{ $medecin->prenom }}</h2>

    {{-- Message erreur --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('medecins.reassign.submit', $medecin->id) }}">
        @csrf

        <div class="mb-3">
            <div class="mb-3">

                @if($autresMedecins->count() > 0)

                    <label>Choisir le médecin remplaçant</label>

                    <select name="nouveau_medecin_id" class="form-select" required>

                        @foreach($autresMedecins as $m)

                            <option value="{{ $m->id }}">
                                Dr. {{ $m->nom }} {{ $m->prenom }}
                            </option>

                        @endforeach

                    </select>

                @else

                    <div class="alert alert-warning">
                        Aucun médecin de la même spécialité n'a de créneau disponible.
                    </div>

                @endif

            </div>
        </div>

        <button type="submit"
                class="btn btn-danger"
                @if($autresMedecins->count() == 0) disabled @endif>
            Confirmer transfert et suppression
        </button>
    </form>
</div>
@endsection
