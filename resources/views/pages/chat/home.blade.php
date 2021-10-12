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
                    <div class="">
                        <div class=" py-4 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                        class="avatar-xs rounded-circle" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">{{ $sender->nom . ' ' . $sender->prenom }}</h5>
                                    <p class="text-muted mb-0"><i
                                            class="mdi mdi-circle text-success align-middle me-1"></i>
                                        En ligne</p>
                                </div>
                            </div>
                        </div>

                        <div class="search-box chat-search-box py-4">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <div>
                                <h5 class="font-size-14 mb-4">Nouveaux messages</h5>
                                <ul class="list-unstyled chat-list" data-simplebar style="height: 500px;">
                                    @foreach($contacts as $key => $contact)
                                    <li class="active">
                                        <a
                                            href="{{ route('chat.conversation', ['id' => $contact->recepteur->id, 'conversation' => $contact->conversation]) }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle {{ $contact->vu == 1 ? " text-success"
                                                        : "text-danger" }} font-size-10"></i>
                                                </div>
                                                {{-- <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div> --}}
                                                <div class="avatar-xs align-self-center me-3">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                        K
                                                    </span>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">{{
                                                        $contact->recepteur->nom_complet }}</h5>
                                                    <p class="text-truncate mb-0">{{ $contact->projet->intitule }}</p>
                                                    <p class="text-truncate small mb-0">{{  $contact->message }}</p>
                                                </div>
                                                <div class="font-size-11">{{
                                                    \Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-100 user-chat">
                    <div class="card">
                        <div class="p-4 border-bottom ">
                            <div class="row">
                                <div class="col-md-4 col-9">
                                    @if(!empty($projet))
                                    <h5 class="font-size-15 mb-1">{{ $projet->intitule }}</h5>
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
                                                    <i class="bx bx-cog"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Voir le profil</a>
                                                    <a class="dropdown-item" href="#">Supprimer la conversation</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div>
                            <div class="chat-conversation p-3">

                                <ul class="list-unstyled mb-0" data-simplebar style="height: 486px;">
                                    @if(!empty($messages))
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
                                                <div class="conversation-name">{{ $message->sender->nom_complet }}</div>
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
                                    @endif
                                </ul>
                            </div>
                            <div class="p-3 chat-input-section">
                                @if(!empty($messages))
                                <form
                                    action="{{ route('chat.send', ['sender' => auth()->user()->id, 'receiver' => $receiver->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="hidden" name="projet" value="{{$message->projet}}">
                                                <textarea id="autoresize" name="body"
                                                    class="form-control chat-input overflow-hidden"
                                                    placeholder="Enter Message..." cols="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center flex-column">
                                            <button type="submit"
                                                class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                                    class="d-none d-sm-inline-block me-2">Envoyer</span> <i
                                                    class="mdi mdi-send"></i></button>
                                            <button type="submit"
                                                class="btn btn-primary btn-rounded chat-send w-md mt-2 waves-effect waves-light"><i
                                                    class="mdi mdi-file-document-outline"></i></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
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
@endsection