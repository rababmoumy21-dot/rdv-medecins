<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Transfert de rendez-vous</title>
</head>
<body style="font-family: Arial; background:#f4f6f9; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px; border:1px solid #ddd;">

    <h2 style="color:#dc3545;">Transfert de votre rendez-vous médical</h2>

    <p>
        Bonjour <strong>{{ $rendezvous->patient->nom }} {{ $rendezvous->patient->prenom }}</strong>,
    </p>

    <p>
        Nous vous informons que le Dr.
        <strong>{{ $ancienMedecin->nom }} {{ $ancienMedecin->prenom }}</strong>
        a quitté le cabinet médical.
    </p>

    <p>
        Votre rendez-vous a été transféré vers le Dr.
        <strong>{{ $nouveauMedecin->nom }} {{ $nouveauMedecin->prenom }}</strong>.
    </p>

    <p>Détails du rendez-vous :</p>

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
            <strong>Nouveau médecin :</strong>
            Dr. {{ $nouveauMedecin->nom }} {{ $nouveauMedecin->prenom }}
        </li>
    </ul>

    <p style="color:#dc3545;">
        Si vous souhaitez annuler ou modifier ce rendez-vous, merci de contacter le cabinet médical.
    </p>

    <br>

    <p>
        Cordialement,<br>
        <strong>Cabinet Médical</strong>
        Service de gestion des rendez-vous
    </p>

</div>

</body>
</html>