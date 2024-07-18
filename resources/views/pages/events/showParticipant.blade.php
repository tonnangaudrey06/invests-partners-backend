@extends('layouts.main')

@section('title', 'Évenement - ' . config('app.name'))

@section('style')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Informations personnelles du participant</h4>
                        <div class="page-title-right">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Section -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informations Personnelles</h5>
                            <div class="row mb-3">
                                <label for="nom" class="col-sm-4 col-form-label">Nom</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->nom }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="prenom" class="col-sm-4 col-form-label">Prénom</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->prenom }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dateNais" class="col-sm-4 col-form-label">Date de naissance</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($participant->dateNais)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sexe" class="col-sm-4 col-form-label">Sexe</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->sexe }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ville" class="col-sm-4 col-form-label">Ville</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->ville }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="numeroCNI" class="col-sm-4 col-form-label">Numéro de CNI</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->numeroCNI }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telephone" class="col-sm-4 col-form-label">Téléphone</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->telephone }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $participant->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet</h5>
                            @if($participant->porteurProjet)
                            <div class="row mb-3">
                                <label for="porteurProjet" class="col-sm-2 col-form-label">Porteur de projet</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->porteurProjet }}</p>
                                </div>
                            </div>
                            @endif
                            @if($participant->presentationUn)
                            <div class="row mb-3">
                                <label for="presentationUn" class="col-sm-2 col-form-label">Présentation</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->presentationUn }}</p>
                                </div>
                            </div>
                            @endif
                            @if($participant->presentationDeux)
                            <div class="row mb-3">
                                <label for="presentationDeux" class="col-sm-2 col-form-label">Présentation 2</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->presentationDeux }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Bottom Section -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Autres Informations</h5>
                            @if($participant->environnement)
                            <div class="row mb-3">
                                <label for="environnement" class="col-sm-2 col-form-label">Environnement</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->environnement }}</p>
                                </div>
                            </div>
                            @endif
                            @if($participant->impact)
                            <div class="row mb-3">
                                <label for="impact" class="col-sm-2 col-form-label">Impact</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->impact }}</p>
                                </div>
                            </div>
                            @endif
                            @if($participant->financement)
                            <div class="row mb-3">
                                <label for="financement" class="col-sm-2 col-form-label">Financement</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $participant->financement }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
