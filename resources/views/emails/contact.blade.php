<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Demande de renseignements</title>
</head>

<body>
    <p>{{ $data['message'] }}</p>
    <p>
        Cordialement,<br /><br />
        <strong>{{ $data['nom_complet'] }}</strong>
    </p>
    @include('partials.signature')
</body>

</html>