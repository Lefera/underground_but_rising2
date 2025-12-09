<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Merci pour votre message</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 15px; color: #333;">

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="cid:logo.jpg" alt="Underground But Rising" style="width: 130px;">
    </div>

    <p>Bonjour {{ $data->name}},</p>

    <p>
        Nous avons bien reçu votre message et nous vous en remercions.
        Notre équipe reviendra vers vous dans les plus brefs délais.
    </p>

    @if(!empty($data->subject))
        <p><strong>Sujet de votre message :</strong> {{ $data->subject }}</p>
    @endif

    <br>

    <p>Cordialement,<br>
    <strong>Équipe Underground But Rising</strong></p>

    <br>
    <hr>

    <p style="font-size: 12px; opacity: .7;">
        Ceci est un message automatique, merci de ne pas y répondre directement.
    </p>

</body>
</html>
