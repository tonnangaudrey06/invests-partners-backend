<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>{{$data['objet']}}</title>
</head>

<body>
  <p>{{$data['message']}}</p>

  <p>Cordialement, <br />
    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
  </p>

</body>

</html>