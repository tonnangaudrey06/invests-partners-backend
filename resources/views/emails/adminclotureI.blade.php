<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Projet Cloturé </h2>
    <p>Bonjour cher investisseur, nous avons le plaisir de vous annoncer que le financement demandé pour le projet <strong>{{$projet['intitule']}}</strong> est achevé. Merci d'avoir investi dans ce projet et  surtout fait confiance à Invest & Partners pour trouver les meilleures opportunités pour vous<br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>