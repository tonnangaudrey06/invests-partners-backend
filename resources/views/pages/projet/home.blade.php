@extends('layouts.main')

@section('title', 'Nos projets - ' . config('app.name'))

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
$privileges = DB::table('privileges')->where('role', Auth()->user()->role)->get();

$pro = DB::table('secteurs')->where('user', Auth()->user()->id)->get();
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
                        <h4 class="card-title">Liste de tous les projets</h4>


                        <div class="actions d-flex align-items-center">
                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->ajouter == 1)
                            <a href="{{ route('projet.add') }}" class="btn btn-sm btn-primary me-2">Nouveau projet</a>
                            @endif
                            @endforeach

                            <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if (Auth()->user()->role == 1)
                @foreach ($projets as $projet)
                <div class="col-xl-4 col-sm-6">
                    <div class="card "
                        style="border-radius: 0.75rem; box-shadow: 0 -0.25rem 3.5rem rgb(18 38 63 / 26%)">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <a href="{{ route('projet.details', ['id' => $projet->id]) }}">
                                                <img class="rounded-circle avatar-sm" src="{{ asset($projet->logo) }}"
                                                    alt="" height="30">
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15">
                                        <a href="{{ route('projet.details', ['id' => $projet->id]) }}"
                                            class="text-dark">
                                            {{ $projet->intitule }}
                                        </a>
                                    </h5>

                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center mt-4 mb-4 font-size-14 font-weight-bolder">
                                        <p class="text-muted">STATUT : {{ $projet->avancement }}</p>
                                        <p class="text-primary">@numberFormat($projet->financement) XAF</p>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0 d-flex justify-content-between align-items-center w-100">
                                <li class="list-inline-item me-3">
                                    <span class="badge bg-success p-2">{{ $projet->etat }}</span>
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i> {{ Carbon\Carbon::parse($projet->created_at)->diffForHumans() }}
                                </li>
                                <li class="list-inline-item me-3 text-primary">
                                    <i class="bx bxs-data me-1"></i> {{ $projet->secteur_data->libelle }}
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

                @endforeach

                @else

                @foreach ($pro as $item)

                @php
                //$prosect = DB::table('projets')->where('secteur', $item->id)->where('type', 'AUTRE')->get();
                $i = 0;
                @endphp


                <div class="d-flex justify-content-center">
                    <h4 class=" col-md-4 text-center btn btn-primary">{{$item->libelle}}</h4><br><br>
                </div>


                @foreach ($projets as $boss)


                @if($item->id == $boss->secteur_data->id )
                

                <div class="col-xl-4 col-sm-6">
                    <div class="card "
                        style="border-radius: 0.75rem; box-shadow: 0 -0.25rem 3.5rem rgb(18 38 63 / 26%)">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <a href="{{ route('projet.details', ['id' => $boss->id]) }}">
                                                <img class="rounded-circle avatar-sm" src="{{ asset($boss->logo) }}"
                                                    alt="" height="30">
                                            </a>
                                        </span>
                                    </div>
                                </div>


                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15">
                                        <a href="{{ route('projet.details', ['id' => $boss->id]) }}" class="text-dark">
                                            {{ $boss->intitule }}
                                        </a>
                                    </h5>

                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center mt-4 mb-4 font-size-14 font-weight-bolder">
                                        <p class="text-muted">STATUT : {{ $boss->avancement }}</p>
                                        <p class="text-primary">{{ $boss->financement }} XAF</p>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0 d-flex justify-content-between align-items-center w-100">
                                <li class="list-inline-item me-3">
                                    <span class="badge bg-success p-2">{{ $boss->etat }}</span>
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i>{{ Carbon\Carbon::parse($boss->created_at)->diffForHumans() }}
                                </li>
                                <li class="list-inline-item me-3 text-primary">
                                    {{-- <i class="bx bxs-data me-1"></i> {{ $projet->secteur_data->libelle }}
                                    --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                @php
                $i = 1;
                @endphp
                @endif

                @endforeach

                @if( $i == 0)
                <h5 class="text-center">Aucun Projet disponible</h5><br><br>
                @endif

                @endforeach
                @endif

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
                        <li class="page-item disabled">
                            <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">1</a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript: void(0);" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end row -->
        </div>

    </div>
</div>

@include('partials.footer')
</div>
@endsection

@section('script')
{{-- <script type="text/javascript" src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}

<!-- Required datatable js -->
<script type="text/javascript" src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
</script>

<!-- Responsive examples -->
<script type="text/javascript"
    src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

{{-- <script type="text/javascript" src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
@endsection