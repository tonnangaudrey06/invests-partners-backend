<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Bienvenue chez Invest & Partners</title>
</head>

<body>
  <p>Félicitations ! Vous vous êtes inscrit à notre plateforme <strong>{{$user['nom']}} {{$user['prenom']}}</strong> en
    qualité <strong>{{$user['role'] == 3 ? 'Porteur de projet' : 'Investisseur'}}</strong>!
    @if($user['role'] == 4)
    Afin de compléter votre profil et de valider votre abonnement, signez le document en pièce jointe et téléchargez le
    dans votre <strong><a href="https://invest--partners.com/dashboard/profil">tableau de bord</a>.</strong>
    @endif
  </p>
  <p>Télécharger un projet (le lien qui renvoi à la page lui permettant de soumettre un projet).</p>

  <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
</body>

</html>