<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Publication de votre projet </h2>
    <p>Bonjour M./Mme/Mlle <strong>{{$projet['user_data']['nom_complet']}}</strong>, Votre projet <strong>{{$projet['intitule']}}</strong> est publié sur notre plateforme. Nous pouvons donc commencer dès à présent le travail de recherche d'investissements. <br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>