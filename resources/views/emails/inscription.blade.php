@extends('emails.template', ['subject' => 'Bienvenue chez IP Investment'])

@section('content')
    <p>
        Félicitations ! Vous vous êtes inscrits à notre plateforme <strong>'TCHOUAH'</strong> en qualité
        <strong>{{ $user['role'] == 3 ? 'de porteur de projet' : 'd\'investisseur' }}</strong>!
    </p>
    @if ($user['role'] == 4)
        <p>
            Investissez maintenant !
            (<strong><a href="https://invest--partners.com/projets">https://invest--partners.com</a>.</strong>).
        </p>
    @else
        <p>
            Soumettre un projet
            (<strong><a
                    href="https://invest--partners.com/dashboard/projets/add">https://invest--partners.com</a>.</strong>).
        </p>
    @endif

    <p><strong><em>Construire Ensemble!</em></strong></p>
    @include('partials.signature')
@endsection
