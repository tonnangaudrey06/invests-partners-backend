@extends('emails.template', ['subject' => 'Refus de votre projet {{ $projet["intitule"] }}'])

@section('content')
    <p>M./Mme {{ $projet['user_data']['nom_complet'] }},</p>
    <p>Nous vous informons que votre projet 
        <a href="https://invest--partners.com/projets/{{$projet['id']}}/details"><strong>{{ $projet['intitule'] }}</strong></a>
            a été rejeté.<br />
            Nous restons à votre écoute au besoin.</p>
    @include('partials.signature')
@endsection
