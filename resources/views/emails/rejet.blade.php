@extends('emails.template', ['subject' => 'Refus de votre projet {{ $projet["intitule"] }}'])

@section('content')
    <p>M./Mme {{ $projet['secteur_data']['conseiller_data']['nom_complet'] }},</p>
    <p>Nous vous informons que votre projet 
        <a href="{{ route('projet.details', $projet['id']) }}"><strong>{{ $projet['intitule'] }}</strong></a>
            a été rejeter.<br />
            Nous restons à votre écoute au besoin.</p>
    @include('partials.signature')
@endsection
