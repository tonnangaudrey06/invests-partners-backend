<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Refus de votre projet {{ $projet['intitule'] }}</title>
</head>

<body>
    <p>Cher <strong>{{ $projet['user_data']['nom_complet'] }}</strong>,</p>
    <p>Votre projet ne répond malheureusement pas aux critères requis pour être retenu sur notre plateforme 😞.<br />
        Pour plus de détails, veuillez contacter un conseiller.<br />
        Au plaisir de travailler avec vous dans un avenir proche!</p>
    <p><strong>Bonne chance!</strong></p>
    <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
    @include('partials.signature')
</body>

</html>