<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Bienvenue chez Invest & Partners</title>
</head>

<body>
    <p>
        Bienvenue sur notre plateforme <strong>'TCHOUAH'</strong> en qualité
        <strong>{{ $user['role'] == 3 ? 'de porteur de projet' : 'd\'investisseur' }}</strong>!
    </p>
    <p>
        Voici vos identifiants : <br/>
        <strong>Email: </strong> {{ $user['email'] }} <br/>
        <strong>Mot de passe: </strong> {{ $user['pass'] }}
    </p>
    {{-- <p>
        Afin de compléter votre profil et de valider votre abonnement, signez le document en pièce jointe et
        téléchargez le dans votre <strong><a href="https://invest--partners.com/{{ $user['role'] == 4 ? 'investor' : 'dashboard' }}/profil">tableau de
                bord</a>.</strong>
    </p> --}}
    <p>
        Connectez-vous maintenant !
        (<strong><a href="https://invest--partners.com/auth">https://invest--partners.com</a>.</strong>).
    </p>

    <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
    @include('partials.signature')
</body>

</html>
