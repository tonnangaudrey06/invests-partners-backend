<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>{{ $data['titre'] }}</title>
</head>

<body>
    {!! $data['mail'] !!}
    <p style="font-size: 1rem; color: #c44636; text-align: center">
        <strong>
            <a href="https://invest--partners.com/newsletter?email={{ urlencode($data['email']) }}">Se désabonner de la newsletter</a>
        </strong>
    </p>
</body>

</html>
