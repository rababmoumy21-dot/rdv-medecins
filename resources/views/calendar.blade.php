 @extends('layouts.admin')

@section('title', 'Calendrier')

@section('content')

<!-- Titre de la page -->
<h3 class="d-flex justify-content-between align-items-center mb-4">🗓️ Calendrier des rendez-vous</h3>

<div class="card">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Détails du Rendez-vous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Patient :</strong> <span id="modalPatient"></span></p>
                <p><strong>Médecin :</strong> <span id="modalMedecin"></span></p>
                <p><strong>Date :</strong> <span id="modalDate"></span></p>
                <p><strong>Heure :</strong> <span id="modalHeure"></span></p>
                <p><strong>Statut :</strong> <span id="modalStatut"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        events: '/calendar/events',

        eventClick: function(info) {

            var event = info.event;

            document.getElementById('modalTitle').innerText = event.title;
            document.getElementById('modalPatient').innerText = event.extendedProps.patient;
            document.getElementById('modalMedecin').innerText = event.extendedProps.medecin;
            document.getElementById('modalDate').innerText = event.extendedProps.date;
            document.getElementById('modalHeure').innerText = event.extendedProps.heure;
            document.getElementById('modalStatut').innerText = event.extendedProps.statut;

            var modal = new bootstrap.Modal(document.getElementById('eventModal'));
            modal.show();
        }
    });

    calendar.render();
});
</script>

@endsection
