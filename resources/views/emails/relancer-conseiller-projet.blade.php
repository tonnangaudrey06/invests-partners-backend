<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Relance sur les projets en attente</title>
</head>

<body>
    <p>
        Vous avez
        <a href="{{ route('projet.home_etat', 'ATTENTE') }}">
            <strong>{{ $data['count'] }} projets</strong>
        </a>
        qui vous ont été soumis et sont en attente d'approbation depuis {{ $data['days'] }} jours. Veuillez SVP le(s) prendre en considération. 
    </p>
    @include('partials.signature')
</body>

</html>
