<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Changement de statut</title>
</head>
<body>
    <h1>Bonjour {{ $dossier->user->name }},</h1>

    <p>Nous vous informons que le statut de votre dossier a été modifié.</p>


    <p><strong>Nouveau statut :</strong> {{ $dossier->statut }}</p>
    @if ($dossier->statut === 'refuser')
    <p>Motif de refuse: {{ $dossier->motif_refus }}</p>

    @endif

    <p>Merci de consulter votre espace personnel pour plus de détails.</p>

    <p>Cordialement,<br>L'équipe RH</p>
</body>
</html>
