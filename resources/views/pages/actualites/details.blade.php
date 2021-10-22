@extends('layouts.main')

@section('title', 'Projets - ' . config('app.name'))

@section('style')
{{-- <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}

<!-- Datatable -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
@endsection


@section('content')
@php
$privileges = DB::table('privileges')->where('role', Auth::user()->role)->get();
@endphp

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Projets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Projets</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Actions</h4>


                        <div class="actions d-flex align-items-center">
                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->modifier == 1)

                            @if (Auth()->user()->role == 1)

                            @if ($projet->etat == 'ATTENTE_VALIDATION_ADMIN' || $projet->etat == 'ATTENTE_INFO_SUPPL')
                            <a href="{{ route('projet.admin.validate', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Approuver</a>
                            <a href="{{ route('projet.askinfosupp', $projet->id) }}"
                                class="btn btn-sm btn-info me-2">Demander info supp</a>
                            <a href="{{ route('projet.rejet', $projet->id) }}" class="btn btn-sm btn-dark me-2">Rejeter</a>
                            {{-- @else
                            <a href=""
                                class="btn btn-sm btn-success disabled me-2">Approuver</a>
                            <a href="" class="btn btn-sm btn-dark disabled me-2">Rejeter</a> --}}
                            @endif

                            @else
                            @if ($projet->etat == 'ATTENTE' || $projet->etat == 'ATTENTE_INFO_SUPPL')
                            <a href="{{ route('projet.civalidate', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Approuver</a>
                            <a href="{{ route('projet.askinfosupp', $projet->id) }}"
                                class="btn btn-sm btn-info me-2">Demander info supp</a>
                            <a href="{{ route('projet.rejet', $projet->id) }}" class="btn btn-sm btn-dark me-2">Rejeter</a>
                            {{-- @else
                            <a href="" class="btn btn-sm btn-success disabled me-2">Approuver</a>
                            <a href="" class="btn btn-sm btn-info disabled me-2">Demander info supp</a>
                            <a href="" class="btn btn-sm btn-dark disabled me-2">Rejeter</a> --}}
                            @endif

                            @endif

                            @endif

                            @endforeach

                            @if($projet->etat == 'VALIDE' || $projet->etat == 'COMPLET' || $projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.edit', $projet->id) }}"
                                class="btn btn-sm btn-warning me-2">Modifier</a>
                            {{-- @else
                            <a class="btn btn-sm btn-warning disabled me-2">Modifier</a> --}}
                            @endif

                            @if( $projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.add') }}" class="btn btn-sm btn-info me-2">Actualités</a>
                            @endif

                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->supprimer == 1)
                            <a href="{{ route('projet.delete', $projet->id) }}" class="btn btn-sm btn-danger me-2">Supprimer</a>
                            @endif
                            @endforeach

                            @if (Auth()->user()->role == 1 )
                            @if($projet->etat == 'COMPLET')
                            <a href="{{ route('projet.publish', $projet->id) }}" class="btn btn-sm btn-primary me-2">Publier</a>
                            {{-- @else
                            <a href="" class="btn btn-sm btn-primary disabled me-2">Publier</a> --}}
                            @endif


                            @endif

                            <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>


                        </div>
                    </div>
                </div>
            </div>



            <!-- end row -->


            <!-- end row -->
        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<!-- apexcharts -->
<script type="text/javascript" src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- crypto dash init js -->
<script type="text/javascript" src="{{ asset('assets/js/pages/project-overview.init.js') }}"></script>
@endsection