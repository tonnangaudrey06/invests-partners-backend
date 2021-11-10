<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Bienvenue chez Invest & Partners</title>
</head>

<body>
    <p>
        Félicitations ! Vous vous êtes inscrit à notre plateforme <strong>Invest & Partners</strong> en qualité
        <strong>{{ $user['role'] == 3 ? 'Porteur de projet' : 'Investisseur' }}</strong>!
    </p>
    {{-- <p>
        Afin de compléter votre profil et de valider votre abonnement, signez le document en pièce jointe et
        téléchargez le dans votre <strong><a href="https://invest--partners.com/{{ $user['role'] == 4 ? 'investor' : 'dashboard' }}/profil">tableau de
                bord</a>.</strong>
    </p> --}}
    @if ($user['role'] == 4)
        <p>
            Investissez maintenant !
            (<strong><a href="https://invest--partners.com/projets">https://invest--partners.com/projets</a>.</strong>).
        </p>
    @else
        <p>
            Soumettre un projet
            (<strong><a
                    href="https://invest--partners.com/dashboard/projets/add">https://invest--partners.com/dashboard/projets/add</a>.</strong>).
        </p>
    @endif

    <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
</body>

</html>
