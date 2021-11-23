<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Approbation de votre investissement sur le projet {{$projet['intitule']}}</title>
</head>

<body>
  <p>Cher <strong>{{$investissement['user_data']['nom_complet']}}</strong>,</p>
  <p>L'équipe d'Invest & Partners a le plaisir de vous annoncer que votre investissement pour le projet
    <strong>"{{$investissement['projet_data']['intitule']}}"</strong> a été pris
    en compte sur notre plateforme. Suivez vos investissements; continuez à être informé de l'évolution, parlez à nos
    conseillers en investissement.</p>
  <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
  @include('partials.signature')
</body>

</html>