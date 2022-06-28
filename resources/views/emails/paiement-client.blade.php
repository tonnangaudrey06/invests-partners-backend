<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Avis de réception de votre paiement sur Invest & Patners</title>
</head>

<body>
    @if ($transaction['is_client'])
        <p>Cher <strong>{{ $transaction['user']['nom_complet'] }}</strong>,</p>
    @else
        <p>Cher <strong>{{ $transaction['participant']['nom_complet'] }}</strong>,</p>
    @endif
    <p>
        Nous affirmons avoir perçu un montant de <strong>{{ $transaction['montant'] }} FCFA</strong>
        @switch($transaction['type'])
            @case('PROFIL')
                lors de la mise à jour de votre plage d'investissement.
            @break

            @case('EVENT')
                lors de votre enregistrement à un évenement.
            @break

            @default
                lors de votre inscription sur notre plateforme.
        @endswitch
    </p>
    <p>
        <strong>Merci pour votre confiance et à bientôt sur <a href="https://invest--partners.com">Invest &
                Partners</a></strong>.
    </p>

    <p><strong><em>Entreprendre et investir autrement!</em></strong></p>
    @include('partials.signature')
</body>

</html>
