@extends('layouts.main')

@section('title', 'Projets - ' . config('app.name'))

@section('style')
{{--
<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}

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
                    <div class="d-flex justify-content-end align-items-center">
                        {{-- <h4 class="card-title">Actions</h4> --}}


                        <div class="actions d-flex align-items-center">
                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->modifier == 1)

                            @if (Auth()->user()->role == 1)

                            @if ($projet->etat == 'ATTENTE_VALIDATION_ADMIN' || $projet->etat == 'ATTENTE_INFO_SUPPL')
                            <a href="{{ route('projet.admin.validate', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Approuver</a>
                            <a href="{{ route('projet.askinfosupp', $projet->id) }}"
                                class="btn btn-sm btn-info me-2">Demander info supple</a>
                            <a href="{{ route('projet.rejet', $projet->id) }}"
                                class="btn btn-sm btn-dark me-2">Rejeter</a>
                            @endif

                            @else
                            @if ($projet->etat == 'ATTENTE' || $projet->etat == 'ATTENTE_INFO_SUPPL')
                            <a href="{{ route('projet.civalidate', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Approuver</a>
                            <a href="{{ route('projet.askinfosupp', $projet->id) }}"
                                class="btn btn-sm btn-info me-2">Demander info supp</a>
                            <a href="{{ route('projet.rejet', $projet->id) }}"
                                class="btn btn-sm btn-dark me-2">Rejeter</a>
                            @endif

                            @endif

                            @endif

                            @endforeach

                            @if($projet->etat == 'VALIDE' || $projet->etat == 'COMPLET' || $projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.edit', $projet->id) }}"
                                class="btn btn-sm btn-warning me-2">Modifier</a>
                            @endif

                            @if( $projet->etat == 'PUBLIE')
                            <a href="{{route('actualites.home', ['projet', $projet->id])}}"  class="btn btn-sm btn-info me-2">Actualités</a>
                            {{-- <a href="{{ route('projet.add') }}" class="btn btn-sm btn-info me-2">Actualités</a> --}}
                            @endif

                            @foreach ($privileges as $privilege)

                            @if( $privilege->module == 1 && $privilege->supprimer == 1)
                            <a href="{{ route('projet.delete', $projet->id) }}" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="btn btn-sm btn-danger me-2">Supprimer</a>
                            @endif
                            @endforeach

                            @if (Auth()->user()->role == 1 )
                            @if($projet->etat == 'COMPLET')
                            <a href="{{ route('projet.publish', $projet->id) }}"
                                class="btn btn-sm btn-primary me-2">Publier</a>
                            @endif

                            @if($projet->etat == 'PUBLIE')
                            <a href="{{ route('projet.cloture', $projet->id) }}"
                                class="btn btn-sm btn-success me-2">Cloturer</a>
                            @endif

                            @endif

                            <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
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
                                    <div class="d-flex mb-5">
                                        <div class="flex-shrink-0 me-4">
                                            <img src="{{ $projet->logo }}" alt="" class="avatar-md">
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="text-wrap font-size-16">
                                                    {{ $projet->intitule }}
                                                </h4>
                                                <p class="fw-bolder text-primary font-size-15">{{
                                                    number_format($projet->financement, 0, ',', ' ') }} XAF</p>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="verti-timeline list-unstyled">
                                        <li class="event-list">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="event-timeline-dot align-self-center">
                                                        <i
                                                            class="bx bxs-right-arrow-circle font-size-18 text-primary"></i>
                                                    </div>
                                                    <h5 class="font-size-15 text-primary">
                                                        {{ $projet->secteur_data->libelle }} <br/>
                                                        <span class="font-size-12 text-muted"><a class="text-muted" href="{{route('user.profile', $projet->secteur_data->conseiller_data->id)}}">Conseiller: {{$projet->secteur_data->conseiller_data->nom_complet }}</a></span>
                                                    <h5>
                                                </div>
                                                <span class="badge bg-info p-2">{{ $projet->etat }}</span>
                                            </div>
                                        </li>
                                    </ul>

                                    <hr>

                                    <div class="row text-center mb-4">
                                        <div class="col-md-6 col-lg-3">
                                            <div>
                                                <p class="text-muted fw-bolder mb-2">Créer</p>
                                                <h6 class="mb-0 text-primary">{{
                                                    Carbon\Carbon::parse($projet->created_at)->diffForHumans() }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div>
                                                <p class="text-muted fw-bolder mb-2">Niveau d'avancement</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->avancement }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div>
                                                <p class="text-muted fw-bolder mb-2">Pays</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->pays_activite }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div>
                                                <p class="text-muted fw-bolder mb-2">Ville</p>
                                                <h6 class="mb-0 text-primary">{{ $projet->ville_activite }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="text-muted mb-4">
                                        <strong>
                                            <p>
                                                <i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                INVESTISSEMENT RECUS : <span class="text-primary fw-bolder">{{
                                                    number_format($total_invest, 0, ',', ' ') }} XAF</span>
                                            </p>
                                            <p>
                                                <i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                NOMBRE D'INVESTISSEUR : <span
                                                    class="text-primary text-primary">{{ $nber_invest }}</span>
                                                investisseurs
                                            </p>
                                        </strong>
                                    </div>

                                    <hr>

                                    <div class="row mb-4">
                                        <div class="col-sm-12 col-md-12">
                                            <h5 class="font-size-15 fw-bolder">Description</h5>
                                            <p class="text-muted">{{ $projet->description }}</p>
                                        </div>
                                    </div>

                                    @if($projet->duree)

                                    <hr>

                                    <div class="text-muted">
                                        <strong>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> TAUX DE
                                                RENTABILITE : <span class="text-primary">{{$projet->taux_rentabilite}}
                                                    %</span> </p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> RESTOUR SUR
                                                INVESTISSEMENT: <span class="text-primary">{{$projet->rsi}}
                                                    mois</span>
                                            </p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> CA PREVISIONNEL:
                                                <span class="text-primary">{{number_format($projet->ca_previsionnel, 0,
                                                    ',', ' ')}} XAF</span>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> DUREE DU
                                                PROJET: <span class="text-primary">{{$projet->duree}} mois</span>
                                            </p>
                                        </strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            @if (count($projet->membres) > 0)
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Membres de l'equipe du projet</h4>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap">
                                            <tbody>
                                                @foreach ($projet->membres as $item)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $item->photo }}"
                                                            class="rounded-circle avatar-xs" alt="">
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 m-0">
                                                            <a href="javascript: void(0);" class="text-dark">{{
                                                                $item->nom_complet }}</a>
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-primary bg-soft text-primary font-size-11">{{
                                                            $item->pivot->statut }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card">
                                <div class="card-body d-flex justify-content-center align-items-center py-4">
                                    <h4 class="card-title mb-4">Aucune équipe pour ce projet</h4>
                                </div>
                            </div>
                            @endif
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
                                            <button class="accordion-button fw-bolder collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                Documents
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
                                                                <h5 class="font-size-14 mb-1"><a download target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                                {{-- <small>{{ $row->type }}</small> --}}
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download target="_blank" href="{{ asset($row->url) }}"
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
                                            <button class="accordion-button fw-bolder collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Images
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
                                                                <h5 class="font-size-14 mb-1"><a download target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                                {{-- <small>{{ $row->type }}</small> --}}
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download target="_blank" href="{{ asset($row->url) }}"
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
                                            <button class="accordion-button fw-bolder collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Vidéos
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
                                                                <h5 class="font-size-14 mb-1"><a download target="_blank"
                                                                        href="{{ asset($row->url) }}"
                                                                        class="text-dark">{{ $row->nom }}</a></h5>
                                                            </td>
                                                            <td style="width: 10%;">
                                                                <div class="text-center">
                                                                    <a download target="_blank" href="{{ asset($row->url) }}"
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

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Documents du porteur de projet</h4>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                        <tbody>
                                            @foreach ($docs as $row)
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
                                                    <h5 class="font-size-14 mb-1"><a target="_blank" download
                                                            href="{{ $row->document }}"
                                                            class="text-dark">{{$row->type}}</a></h5>
                                                </td>
                                                <td style="width: 10%;">
                                                    <div class="text-center">
                                                        <a download target="_blank" href="{{ $row->document }}" class="text-dark"><i
                                                                class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if(!empty($projet->user_data->cni))
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
                                                    <h5 class="font-size-14 mb-1"><a target="_blank" download
                                                            href="{{ $projet->user_data->cni }}"
                                                            class="text-dark">CNI / Passport</a></h5>
                                                </td>
                                                <td style="width: 10%;">
                                                    <div class="text-center">
                                                        <a download target="_blank" href="{{ $projet->user_data->cni }}" class="text-dark"><i
                                                                class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<!-- crypto dash init js -->
<script type="text/javascript" src="{{ asset('assets/js/pages/project-overview.init.js') }}"></script>
@endsection