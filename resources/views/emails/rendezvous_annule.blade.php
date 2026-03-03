<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Annulation de rendez-vous</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f4f6f9; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px; border:1px solid #ddd;">

    <h2 style="color:#dc3545;">Annulation de votre rendez-vous médical</h2>

    <p>
        Bonjour <strong>{{ $rendezvous->patient->nom }} {{ $rendezvous->patient->prenom }}</strong>,
    </p>

    <p>
        Nous vous informons que votre rendez-vous avec le Dr.
        <strong>{{ $rendezvous->creneau->medecin->nom }} {{ $rendezvous->creneau->medecin->prenom }}</strong>,
        prévu le :
    </p>

    <ul>
        <li><strong>Date :</strong> {{ $rendezvous->creneau->date }}</li>
        <li><strong>Heure :</strong> {{ $rendezvous->creneau->heure_debut }}</li>
    </ul>

    <p style="color:#dc3545;">
        a été annulé en raison de l'indisponibilité du médecin ou d'une modification du planning.
    </p>

    <p>
        Nous vous invitons à contacter le cabinet afin de programmer un nouveau rendez-vous à votre convenance.
    </p>

    <br>

    <p>
        Nous vous remercions pour votre compréhension.
    </p>

    <p>
        Cordialement,<br>
        <strong>Cabinet Médical</strong><br>
        Service de gestion des rendez-vous
    </p>

</div>

</body>
</html>