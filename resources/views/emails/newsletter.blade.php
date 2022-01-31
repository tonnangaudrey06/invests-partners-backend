<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>{{ $data['titre'] }}</title>
</head>

<body>
    {!! $data['mail'] !!}
    <p style="font-size: .7rem;">
        <strong>
            <a style="font-size: .7rem; color: #cacaca; text-align: center" href="https://invest--partners.com/newsletter?email={{ urlencode($data['email']) }}">Se désabonner de la newsletter</a>
        </strong>
    </p>
</body>

</html>
