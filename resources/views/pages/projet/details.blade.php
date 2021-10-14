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
                            @else
                            <a href=""
                                class="btn btn-sm btn-success disabled me-2">Approuver</a>
                            <a href="" class="btn btn-sm btn-dark disabled me-2">Rejeter</a>
                            @endif

                            @else
                            @if ($projet->etat == 'ATTENTE' || $projet->etat == 'ATTENTE_INFO_SUPPL')
                            <a href="{{ route('projet.civalidate', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Approuver</a>
                            <a href="{{ route('projet.askinfosupp', $projet->id) }}"
                                class="btn btn-sm btn-info me-2">Demander info supp</a>
                            <a href="{{ route('projet.rejet', $projet->id) }}" class="btn btn-sm btn-dark me-2">Rejeter</a>
                            @else
                            <a href="" class="btn btn-sm btn-success disabled me-2">Approuver</a>
                            <a href="" class="btn btn-sm btn-info disabled me-2">Demander info supp</a>
                            <a href="" class="btn btn-sm btn-dark disabled me-2">Rejeter</a>
                            @endif

                            @endif

                            @endif

                            @endforeach

                            @if($projet->etat == 'VALIDE' || $projet->etat == 'COMPLET' || $projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.edit', $projet->id) }}"
                                class="btn btn-sm btn-warning me-2">Modifier</a>
                            @else
                            <a class="btn btn-sm btn-warning disabled me-2">Modifier</a>
                            @endif

                            <a href="{{ route('projet.add') }}" class="btn btn-sm btn-info me-2">Actualités</a>

                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->supprimer == 1)
                            <a href="{{ route('projet.add') }}" class="btn btn-sm btn-danger me-2">Supprimer</a>
                            @endif
                            @endforeach

                            @if (Auth()->user()->role == 1 )
                            @if($projet->etat == 'COMPLET')
                            <a href="{{ route('projet.publish', $projet->id) }}" class="btn btn-sm btn-primary me-2">Publier</a>
                            @else
                            <a href="" class="btn btn-sm btn-primary disabled me-2">Publier</a>
                            @endif

                            @if($projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.cloture', $projet->id) }}" class="btn btn-sm btn-success me-2">Cloturer</a>
                            @endif

                            @endif

                            {{-- <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button> --}}


                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-7 h-100">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Apercu</h4>

                                        <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div> --}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-4">
                                            <img src="{{ asset($projet->logo) }}" alt="" class="avatar-md">
                                        </div>

                                        <div class="row col-10">
                                            <div class=" col-6 flex-grow-1 overflow-hidden">
                                                <strong>
                                                    <h4 class="text-wrap font-size-16">{{ $projet->intitule }} <span class="btn btn-info mr-auto">{{ $projet->etat }}</span></h4>
                                                </strong>
                                                <strong>
                                                    <p class=" text-primary font-size-15">{{ $projet->financement }} XAF</p>
                                                </strong>
                                            </div>

                                            <div class=" col-6 flex-grow-1 overflow-hidden">

                                                @php
                                                    // $invests = DB::table('investissements')->where('projet', $projet->id);
                                                    $total_invest = DB::table('investissements')->where('projet', $projet->id)->sum('montant');
                                                    $nber_invest = DB::table('investissements')->where('projet', $projet->id)->count();
                                                @endphp
                                                <strong>
                                                    <h4 class="text-wrap float-end  font-size-16">Investissement(s) recu(s) <span class="btn btn-success mr-auto">{{ $nber_invest }} investisseurs</h4>
                                                </strong>
                                                <strong>
                                                    <p class=" text-primary float-end font-size-15">{{ $total_invest }} XAF</p>
                                                </strong>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <br>

                                    <ul class="verti-timeline list-unstyled">
                                        <li class="event-list active">
                                            <div class="event-timeline-dot">
                                                <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <h5 class="font-size-15 text-primary">{{ $projet->secteur_data->libelle }}
                                                </div>
                                                
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>

                                    <div class="row text-center">
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Crée </p>
                                                <h6 class="mb-0 text-primary">{{ Carbon\Carbon::parse($projet->created_at)->diffForHumans() }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Niveau d'avancement</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->avancement }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Pays</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->pays_activite }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Ville</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->ville_activite }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>

                                   
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <h5 class="font-size-15 mt-4">Description</h5>
                                            <hr>
                                            <p class="text-muted">{{ $projet->description }}</p>
                                        </div>
                                        {{-- <div class="col-sm-12 col-md-6">
                                                <div class="row task-dates">
                                                    <div class="col-sm-4 col-12">
                                                        <div class="mt-4">
                                                            <h5 class="font-size-14"><i
                                                                    class="bx bx-calendar me-1 text-primary"></i>
                                                                Date de début</h5>
                                                            <p class="text-muted mb-0">Non définie</p>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-sm-4 col-12">
                                                        <div class="mt-4">
                                                            <h5 class="font-size-14"><i
                                                                    class="bx bx-calendar-check me-1 text-primary"></i>
                                                                Date de fin</h5>
                                                            <p class="text-muted mb-0">Indeterminée</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                    </div>
                                    @if($projet->duree)
                                    <div class="text-muted mt-4 ">
                                        <strong>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> TAUX DE
                                                RENTABILITE : <span class="text-primary">{{$projet->taux_rentabilite}}
                                                    %</span> </p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> RESTOUR SUR
                                                INVESTISSEMENT: <span class="text-primary">{{$projet->rsi}}
                                                    mois</span>
                                            </p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> CA PREVISIONNEL:
                                                <span class="text-primary">{{$projet->ca_previsionnel}} XAF</span>
                                                <p><i class="mdi mdi-chevron-right text-primary me-1"></i> DUREE DU
                                                    PROJET: <span class="text-primary">{{$projet->duree}} mois</span>
                                                </p>
                                        </strong>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Commentaires</h4>

                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="d-flex-object rounded-circle avatar-xs" alt=""
                                                src="assets/images/users/avatar-2.jpg">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">David Lambert</h5>
                                            <p class="text-muted mb-1">
                                                Separate existence is a myth.
                                            </p>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="d-flex-object rounded-circle avatar-xs" alt=""
                                                src="assets/images/users/avatar-3.jpg">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">Steve Foster</h5>
                                            <p class="text-muted mb-1">
                                                <a href="javascript: void(0);" class="text-success">@Henry</a>
                                                To an English person it will like simplified
                                            </p>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                            J
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-13 mb-1">Jeffrey Walker</h5>
                                                    <p class="text-muted mb-1">
                                                        as a skeptical Cambridge friend
                                                    </p>
                                                </div>
                                                <div class="ms-3">
                                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                    S
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">Steven Carlson</h5>
                                            <p class="text-muted mb-1">
                                                Separate existence is a myth.
                                            </p>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4 pt-2">
                                        <a href="javascript: void(0);" class="btn btn-primary btn-sm">View more</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Membres du projet</h4>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap">
                                            <tbody>
                                                @foreach ($projet->membres as $item)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($item->photo) }}"
                                                            class="rounded-circle avatar-xs" alt="">
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 m-0">
                                                            <a href="javascript: void(0);"
                                                                class="text-dark">{{ $item->nom_complet }}</a>
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-primary bg-soft text-primary font-size-11">{{ $item->pivot->statut }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach


                                                {{-- <tr>
                                                <td>
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                            T
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                            class="text-dark">Tony Brafford</a></h5>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="javascript: void(0);"
                                                            class="badge bg-primary bg-soft text-primary font-size-11">Backend</a>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <!-- end col -->
                    </div>
                </div>

                <div class="col-lg-5 h-100">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Fichiers joints</h4>
                            <div class="table-responsive">

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                Documents #1
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                @foreach ($projet->medias as $row)
                                                @if ($row->type == 'FICHIER')
                                                <table class="table table-nowrap align-middle table-hover mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 10%;">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td style="width: 80%;">
                                                                <h5 class="font-size-14 mb-1"><a target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                                {{-- <small>{{ $row->type }}</small> --}}
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download href="{{ asset($row->url) }}"
                                                                        class="text-dark"><i
                                                                            class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                @endif





                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Images #2
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($projet->medias as $row)
                                                @if ($row->type == 'IMAGE')
                                                <table class="table table-nowrap align-middle table-hover mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 10%;">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                        <i class="mdi mdi-image"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td style="width: 80%;">
                                                                <h5 class="font-size-14 mb-1"><a target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                                {{-- <small>{{ $row->type }}</small> --}}
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download href="{{ asset($row->url) }}"
                                                                        class="text-dark"><i
                                                                            class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Vidéos #3
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($projet->medias as $row)
                                                @if ($row->type == 'VIDEO')
                                                <table class="table table-nowrap align-middle table-hover mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 10%;">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                        <i class="mdi mdi-play-circle-outline"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td style="width: 80%;">
                                                                <h5 class="font-size-14 mb-1"><a target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                                {{-- <small>{{ $row->type }}</small> --}}
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download href="{{ asset($row->url) }}"
                                                                        class="text-dark"><i
                                                                            class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- end col -->
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