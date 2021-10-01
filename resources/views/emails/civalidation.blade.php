<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Approbation d'un projet</h2>
    <p>Bonjour Admin, j'ai trouvé le projet <a href="http://127.0.0.1:8000/projet/{{$projet['id']}}">{{$projet['intitule']}}</a> interessant. Je le soumets à votre appréciation pour la suite. <br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>