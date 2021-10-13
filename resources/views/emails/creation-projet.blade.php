<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Bonjour {{$projet['secteur_data']['conseiller_data']['nom_complet']}},</p>
    
    <p>Le projet <strong>{{$projet['intitule']}}</strong> vient d'être soumis par le proteur de projet {{$projet['user_data']['nom_complet']}}. Jetez-y un coup d'œil <a href="{{ route('projet.details', $projet['id']) }}">{{ route('projet.home', $projet['id']) }}</a></p>
    
    <br><br>
    
    <p>Cordialement,</p>
    
    <br><br>

    <p><strong>Invest & Partners</strong></p>
  </body>
</html>