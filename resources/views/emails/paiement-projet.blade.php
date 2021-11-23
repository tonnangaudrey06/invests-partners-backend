<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Paiement des frais d'etude du projet {{$projet['intitule']}}</title>
</head>

<body>
  {{-- <p>Cher conseiller,</p> --}}
  <p>Paiement de la somme de ({{$projet['user_data']['status'] == 'PARTICULIER' ? '15 000' : '50 000'}} XAF) effectué pour le projet <a
    href="{{ route('projet.details', $projet['id']) }}"><strong>{{$projet['intitule']}}</strong></a><br />
  Le délai pour le traitement et la publication sur le site est de 15 jours.</p>
  <p><strong>Bonne chance!</strong></p>
  @include('partials.signature')
</body>

</html>