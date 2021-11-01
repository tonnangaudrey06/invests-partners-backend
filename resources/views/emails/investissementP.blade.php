<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <h2>Nouvelle investissement sur votre projet {{$projet['intitule']}}</h2>
</head>

<body>
  <p>Cher <strong>{{$projet['user_data']['nom_complet']}}</strong>,</p>
  <p>L'équipe Invest & Partners a le
    plaisir de vous annoncer que pour votre projet <strong>{{$projet['intitule']}}</strong>, vous avez recu un
    investissement de <strong>{{$investissement['montant']}} XAF</strong>. <br />
    Vous continuerez d'etre informé de tous les avancements dudit projet.
  </p>
</body>

</html>