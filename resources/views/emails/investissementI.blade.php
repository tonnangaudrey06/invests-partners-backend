<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Approbation de votre investissement sur le projet {{$projet['intitule']}}</title>
</head>

<body>
  <p>Cher <strong>{{$investissement['user_data']['nom_complet']}}</strong>,</p>
  <p>L'équipe d'Invest & Partners a le plaisir de vous annoncer que votre investissement pour le compte du projet
    <strong>"{{$investissement['projet_data']['intitule']}}"</strong> a été approuvé sur notre plateforme. <br>
    Suivez vos investissements, restez connecté pour en recevoir les mises à jour, échangez avec nos conseillers.
  </p>
  <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
  @include('partials.signature')
</body>

</html>