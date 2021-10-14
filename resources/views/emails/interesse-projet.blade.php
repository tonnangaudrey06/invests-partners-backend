<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Bonjour {{$projet['secteur_data']['conseiller_data']['nom_complet']}},</p>
    
    <p>L'investisseur {{$investisseur['nom_complet']}} est intéressé sur le projet <strong>{{$projet['intitule']}}</strong>. Jetez-y un coup d'œil <a href="{{ route('chat.home') }}">{{ route('chat.home') }}</a></p>
    
    <br><br>
    
    <p>Cordialement,</p>

    <p><strong>Invest & Partners</strong></p>
  </body>
</html>