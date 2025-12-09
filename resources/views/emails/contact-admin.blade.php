<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message - Formulaire de contact</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 15px; color: #333;">

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="cid:logo.jpg" alt="Underground But Rising" style="width:130px;">
    </div>

    <h2 style="background:#000; color:#fff; padding:10px;">
        Nouveau message reçu depuis le site Underground But Rising
    </h2>

    <p><strong>Nom :</strong> {{ $data->name }}</p>
    <p><strong>Email :</strong> {{ $data->email }}</p>

    @if(!empty($data->subject))
        <p><strong>Sujet :</strong> {{ $data->subject }}</p>
    @endif

    <p><strong>Message :</strong></p>
    <p>{!! nl2br(e($data->message)) !!}</p>

    <br><hr>

    <p style="font-size: 12px; opacity: .7;">
        Message reçu automatiquement via le formulaire de contact de votre site.
    </p>

</body>
</html>
