<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Bonjour {{ $user->name }}</h1>
<p>Voici votre code de vérification : <strong>{{ $user->verification_code }}</strong></p>
<p>Veuillez le saisir pour accéder à votre compte.</p>
<p>Merci de votre confiance.</p>
<p>Cordialement,</p>
    <p>Si vous n'avez pas demandé cette vérification, veuillez ignorer ce message.</p>
</body>
</html>
