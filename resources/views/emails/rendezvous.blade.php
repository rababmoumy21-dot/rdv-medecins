<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Confirmation de rendez-vous</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f4f6f9; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px; border:1px solid #ddd;">

    <h2 style="color:#198754;">Confirmation de votre rendez-vous médical</h2>

    <p>
        Bonjour <strong>{{ $rendezvous->patient->nom }} {{ $rendezvous->patient->prenom }}</strong>,
    </p>

    <p>
        Votre rendez-vous avec le Dr.
        <strong>{{ $rendezvous->creneau->medecin->nom }} {{ $rendezvous->creneau->medecin->prenom }}</strong>
        a été confirmé avec succès.
    </p>

    <p>Voici les détails de votre rendez-vous :</p>

    <ul>
        <li>
            <strong>Date :</strong>
            {{ \Carbon\Carbon::parse($rendezvous->creneau->date)->format('d/m/Y') }}
        </li>

        <li>
            <strong>Heure :</strong>
            {{ $rendezvous->creneau->heure_debut }}
        </li>

        <li>
            <strong>Médecin :</strong>
            Dr. {{ $rendezvous->creneau->medecin->nom }}
            {{ $rendezvous->creneau->medecin->prenom }}
        </li>
    </ul>

    <p style="color:#198754;">
        Merci de vous présenter 10 minutes avant l'heure prévue.
    </p>

    <p>
        En cas d'empêchement, merci de contacter le cabinet pour annuler ou reporter votre rendez-vous.
    </p>

    <br>

    <p>
        Cordialement,<br>
        <strong>Cabinet Médical</strong><br>
        Service de gestion des rendez-vous
    </p>

</div>

</body>
</html>