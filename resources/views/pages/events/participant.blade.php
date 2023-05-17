@extends('layouts.main')

@section('title', 'Évenement - ' . config('app.name'))

@section('style')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" id="bootstrap-style"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        id="bootstrap-style" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@php
    $privileges = DB::table('privileges')
        ->where('user', auth()->user()->id)
        ->get();
@endphp
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $event->libelle }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Évenement</li>
                                    {{-- <li class="breadcrumb-item active">Profil</li> --}}
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card overflow-hidden">
                            {{-- <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-8">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Bon retour {{ $user->prenom }}!</h5>
                                        <p>Cela semblera simplifié</p>
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{-- <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ $event->image ? $event->image : asset('assets/images/profil.jpg') }}"
                                            alt="" class="img-thumbnail avatar-md rounded-circle">
                                    </div> --}}
                                        <h5 class="font-size-15 text-truncate">{{ $event->libelle }}</h5>
                                        <p class="text-muted mb-0 text-truncate">{{ $event->lieu }}</p>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="pt-4 d-flex justify-content-between">
                                            @foreach ($privileges as $privilege)
                                                @if ($privilege->module == 8 && $privilege->modifier == 1)
                                                    <div>
                                                        <a href="{{ route('events.edit', $event->id) }}"
                                                            class="btn btn-primary waves-effect waves-light btn-sm">Modifier
                                                            <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                    </div>
                                                @endif
                                                @if ($privilege->module == 8 && $privilege->supprimer == 1)
                                                    <div>
                                                        <a href="{{ route('events.delete', $event->id) }}"
                                                            onclick="return confirm('Voulez-vous vraiment supprimer?')"
                                                            class="btn btn-primary waves-effect waves-light btn-sm">Supprimer
                                                            <i class="mdi mdi-trash-can ms-1"></i></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Informations sur l'evenement</h4>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Date :</th>
                                                <td>
                                                    @dateFormat($event->date_evenement) à @timeFormat($event->heure_debut)
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Prix :</th>
                                                <td>
                                                    @if (!empty($event->prix))
                                                        @numberFormat($event->prix) XAF
                                                    @else
                                                        Gratuit
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Places reservées :</th>
                                                <td>@numberFormat($event->total_reserve) places</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Places disponibles :</th>
                                                <td>@numberFormat($event->places - $event->total_reserve) / @numberFormat($event->places) places</td>
                                            </tr>
                                            {{-- <tr>
                                                <th scope="row">Places restants :</th>
                                                <td>@numberFormat($event->places - $event->total_reserve) places</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Participants</h4>
                                <div class="table-responsive">
                                    <table id="datatable" class="table align-middle w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nom complet</th>
                                                {{-- <th scope="col">Email</th>
                                                <th scope="col">Téléphone</th> --}}
                                                <th scope="col">Reserver</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($event->participants as $participant)
                                                <tr>
                                                    <th class="text-truncate">
                                                        <p class="mb-0">
                                                            {{ $participant->nom_complet }}
                                                        </p>
                                                        <div class="d-flex gap-2">
                                                            <small>{{ $participant->email }}</small>
                                                            <small>{{ $participant->telephone }}</small>
                                                        </div>
                                                    </th>
                                                    {{-- <td style="width: 20%">
                                                        {{ $participant->email }}
                                                    </td>
                                                    <td style="width: 15%">
                                                        {{ $participant->telephone }}
                                                    </td> --}}
                                                    <td style="width: 15%">
                                                        @numberFormat($participant->places) places
                                                    </td>
                                                    <td style="width: 5%" class="text-center">
                                                        <a href="{{ route('events.delete.participant', $participant->id) }}"
                                                            onclick="return confirm('Voulez-vous vraiment supprimer la paticipation de {{ $participant->nom_complet }}?')"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
    <script type="text/javascript" src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>

    <script type="text/javascript"
        src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/profile.init.js') }}"></script>
@endsection
