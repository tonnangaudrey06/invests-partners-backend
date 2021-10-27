<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Projet Cloturé </h2>
    <p>Félicitations M./Mme/Mlle <strong>{{$projet['user_data']['nom_complet']}}</strong>, Votre projet <strong>{{$projet['intitule']}}</strong> est désormais cloturé car ayant recu le montant de financement demandé. Merci d'avoir fait confiance à Invest & Partners et à bientot sur notre plateforme<br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>