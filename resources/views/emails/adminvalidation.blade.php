<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Approbation de votre projet </h2>
    <p>Bonjour M./Mme/Mlle <strong>{{$projet['user_data']['nom_complet']}}</strong>, L'équipe Invest & Partners a trouvé votre projet <strong>{{$projet['intitule']}}</strong></a> interessant. Nous pouvons donc commencer dès à présent le travail de recherche d'investissements. Toutefois, celà ne pourrais se faire sans que vous ayez payer les frais d'abonnement annuel pour le travail que nous effectuerons pour votre projet. Si vous etes d'accord, veuillez suivre <strong><a href="{{url('dashboard/projets'). '/'. $projet['id'] }}"></strong> ce lien </a> pour finaliser le payement et Commencer l'avanture avec Invest & Partners. <br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>