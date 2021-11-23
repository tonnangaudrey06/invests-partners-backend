<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Accusé de réception du paiement des frais de votre {{$projet['intitule']}}</title>
</head>

<body>
  <p>Félicitations <strong>{{$projet['user_data']['nom_complet']}}</strong>! Votre paiement a été approuvé.<br/>
  Votre projet en bonne et due forme sera visible par tous les investisseurs dans un délai de <strong>15 jours</strong>.<br/>
  N'hésitez pas à communiquer avec votre conseiller sur son évolution.</p>
  <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
  @include('partials.signature')
</body>

</html>