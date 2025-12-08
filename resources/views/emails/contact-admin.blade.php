<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message - Formulaire de contact</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 15px; color: #333;">

    <h2>Nouveau message reçu depuis le site Underground But Rising</h2>

    <p><strong>Nom :</strong> {{ $message['name'] }}</p>
    <p><strong>Email :</strong> {{ $message['email'] }}</p>

    @if(!empty($message['subject']))
        <p><strong>Sujet :</strong> {{ $message['subject'] }}</p>
    @endif

    <br>

    <p><strong>Message :</strong></p>
    <p>{!! nl2br(e($message['message'])) !!}</p>

    <br><hr>

    <p style="font-size: 12px; opacity: .7;">
        Message reçu automatiquement via le formulaire de contact de votre site.
    </p>

</body>
</html>
