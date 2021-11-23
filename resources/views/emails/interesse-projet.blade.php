<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Nouvelle investiisseur pour le projet {{$projet['intitule']}}</title>
</head>

<body>
  <p>L'investisseur {{$investisseur['nom_complet']}} est intéressé sur le projet
    <strong>{{$projet['intitule']}}</strong>.
    <a href="{{ route('chat.home') }}">Discuter avec {{$investisseur['nom_complet']}}</a>
  </p>

  <p>Cordialement,<br /><strong>Invest & Partners</strong></p>
  @include('partials.signature')
</body>

</html>