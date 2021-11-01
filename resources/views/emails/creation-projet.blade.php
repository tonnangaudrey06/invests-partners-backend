<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Nouveau projet dans le secteur "{{$projet['secteur_data']['libelle']}}"</title>
</head>

<body>
  <p>Le projet <strong>{{$projet['intitule']}}</strong> vient d'être soumis par le proteur de projet
    {{$projet['user_data']['nom_complet']}}. Jetez-y un coup d'œil <a
      href="{{ route('projet.details', $projet['id']) }}">{{ route('projet.home', $projet['id']) }}</a>
  </p>
  <p>Cordialement<br />
    <strong>Invest & Partners</strong>
  </p>
</body>

</html>