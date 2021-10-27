@extends('layouts.main')

@section('title', 'Messagerie - ' . config('app.name'))

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Messagerie</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $sender->nom . ' ' .
                                        $sender->prenom }}</a>
                                </li>
                                <li class="breadcrumb-item active">Messagerie</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4">
                    <div class="card">
                        <div class="px-3 py-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    @if (!empty($sender->photo))
                                    <div>
                                        <img class="rounded-circle avatar-xs" src="{{ $sender->photo }}" alt="">
                                    </div>
                                    @else
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle">
                                            {{ strtoupper(substr($sender->nom, 0, 1)) }}
                                        </span>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">{{ $sender->nom . ' ' . $sender->prenom }}</h5>
                                    <p class="text-muted mb-0"><i
                                            class="mdi mdi-circle text-success align-middle me-1"></i>
                                        En ligne</p>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="px-3 py-4">
                            <button class="btn btn-primary btn-rounded w-100 btn-block" type="button">Nouvelle
                                conversation</button>
                        </div> --}}

                        <div class="chat-leftsidebar-nav">
                            <ul class="list-unstyled chat-list bg-white" data-simplebar style="max-height: 500px;">
                                @if (!empty($contacts))
                                @foreach($contacts as $key => $contact)
                                <li>
                                    <a
                                        href="{{ route('chat.conversation', ['id' => $contact->recepteur->id, 'conversation' => $contact->conversation]) }}">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                @if (!empty($contact->recepteur->photo))
                                                <img class="rounded-circle avatar-xs"
                                                    src="{{ $contact->recepteur->photo }}" alt="">
                                                @else
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">
                                                        {{ strtoupper(substr($contact->recepteur->nom, 0, 1)) }}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <div>
                                                    <h5
                                                        class="text-truncate font-size-14 d-flex justify-content-between align-items-center mb-1">
                                                        <span>{{ $contact->recepteur->nom_complet }}</span>
                                                        <span><i class="mdi {{ $contact->vu == 1 ? " mdi-email-open
                                                                text-success" : "mdi-email text-danger" }}
                                                                font-size-16"></i></span>
                                                    </h5>
                                                    <p class="text-truncate mb-0 {{ $contact->vu == 1 ? "" : "
                                                        fw-bolder" }}">{{ $contact->projet ?
                                                        $contact->projet->intitule : 'Renseignements' }}</p>
                                                    <p class="text-truncate small mb-0 {{ $contact->vu == 1 ? "" : "
                                                        fw-bolder" }}">{{ $contact->message }}</p>
                                                </div>
                                                <div class="font-size-10 mt-2 {{ $contact->vu == 1 ? "" : " fw-bolder"
                                                    }}">{{
                                                    \Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="w-100 user-chat">
                    <div class="card">
                        @if(!empty($messages))
                        <div class="p-4 border-bottom ">
                            <div class="row">
                                <div class="col-md-4 col-9">
                                    @if(!empty($projet))
                                    <h5 class="font-size-15 mb-1">{{ $projet->intitule }}</h5>
                                    @else
                                    <h5 class="font-size-15 mb-1">Renseignements</h5>
                                    @endif
                                    @if(!empty($receiver))
                                    <p class="text-muted mb-0">
                                        {{ $receiver->nom_complet }}
                                    </p>
                                    @endif
                                </div>
                                <div class="col-md-8 col-3">
                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                        <li class="list-inline-item  d-none d-sm-inline-block">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-menu-open"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if(!empty($projet))
                                                    <a class="dropdown-item" href="{{ route('projet.details', $projet->id) }}">Voir le projet</a>
                                                    @endif
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.profile', $receiver->id) }}">Voir de {{
                                                        $receiver->nom_complet }}</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="chat-conversation p-3">
                                <ul class="list-unstyled mb-0" id="chat-message" data-simplebar style="height: 486px;">
                                    @foreach($messages as $key => $message)

                                    @if($message->envoyeur == auth()->user()->id)
                                    <li class="w-50 float-start">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Vous</div>
                                                <p>
                                                    {{ $message->message }}
                                                </p>
                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> {{
                                                    \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                                            </div>

                                        </div>
                                    </li>
                                    @else
                                    <li class="w-50 float-end d-flex justify-content-end">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="conversation-name"><a class="text-decoration-none"
                                                    href="{{ route('user.profile', $message->sender->id) }}">{{ $message->sender->nom_complet }}</a></div>
                                                <p>
                                                    {{ $message->message }}
                                                </p>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> {{
                                                    \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif

                                    @endforeach
                                </ul>
                            </div>
                            <div class="p-3 chat-input-section">
                                <form
                                    action="{{ route('chat.send', ['sender' => auth()->user()->id, 'conversation' => $conversation, 'receiver' => $receiver->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="hidden" name="projet" value="{{$message->projet}}">
                                                <textarea id="autoresize" name="body"
                                                    class="form-control overflow-hidden" placeholder="Votre message..."
                                                    rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center flex-column">
                                            <button type="submit"
                                                class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                                    class="d-none d-sm-inline-block me-2">Fichier</span><i
                                                    class="mdi mdi-file-document-outline"></i></button>
                                            <button type="submit"
                                                class="btn btn-primary btn-rounded chat-send w-md mt-2 waves-effect waves-light"><span
                                                    class="d-none d-sm-inline-block me-2">Envoyer</span> <i
                                                    class="mdi mdi-send"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="py-5 d-flex justify-content-center align-items-center flex-column">
                            @if(empty($contacts))
                            <h4 class="mb-sm-0 font-size-15">Aucune conversation pour l'instant</h4>
                            @else
                            <h4 class="mb-sm-0 font-size-15">Sélectionnez une conversation</h4>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var selects = $('#chat-message');
        selects.last().scrollTop(selects.last().get(0).scrollHeight);

        var lastScroll = {
            whichEle: null,
            position: 0
        };
            
        function scrollOther() {
            var currPosition = $(this).scrollTop();

            if ($(this).is(lastScroll.whichEle)) {
                var positionDiff = currPosition - lastScroll.position;
            
                if(positionDiff === 0) { return; }

                var $other = $selects.not(this);
            
                $other.off('scroll');
            
                window.requestAnimationFrame(function() {
                    $other.scrollTop($other.scrollTop() - positionDiff);
                    window.requestAnimationFrame(function() {
                        $other.on('scroll', scrollOther);
                    });
                });
            } else {
                lastScroll.whichEle = $(this);
            }

            lastScroll.position = currPosition;
        }
        
        window.requestAnimationFrame(function() {
            selects.on('scroll', scrollOther);
        });
    });
</script>
@endsection