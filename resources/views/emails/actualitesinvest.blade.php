<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Nouvelle actualité </title>
</head>

<body>
    <p>Cher <strong>{{ $investisseur['nom_complet'] }}</strong>,</p>
    <p>Découvrez de nouvelles actualités pour vous en cliquant sur le lien <a href="https://invest--partners.com/investor/projets/{{ $projet['id'] }}">https://invest--partners.com</a>
    </p>
    <p><strong>Entreprendre et investir autrement !</strong></p>
    @include('partials.signature')
</body>

</html>