<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Clôture de votre projet {{ $projet['intitule'] }}</title>
</head>

<body>
    <p>Cher <strong>{{ $projet['user_data']['nom_complet'] }}</strong>,</p>
    <p>Nous avons le plaisir de vous annoncer que les investissements sont officiellement clos pour le projet
        <strong>{{ $projet['intitule'] }}</strong>.<br />
        L'équipe d'Invest & Partners vous remercie pour votre contribution!<br />
        Nous nous engageons à vous informer de toute évolution relative à son exécution.
    </p>
    <p><strong>Restez connecté!</strong></p>
    @include('partials.signature')
</body>

</html>
