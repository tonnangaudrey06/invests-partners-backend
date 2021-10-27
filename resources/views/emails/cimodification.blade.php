<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Modification d'un projet</h2>
    <p>Bonjour Admin, j'ai modifié le projet <a href="{{url('projet'). '/'. $projet['id'] }}">{{$projet['intitule']}}</a>. Je le soumets à votre appréciation pour la publication. <br><br>
    
    Cordialement, <br><br>

    <strong>{{Auth()->user()->nom}} {{Auth()->user()->prenom}}</strong>
    </p>
    
  </body>
</html>