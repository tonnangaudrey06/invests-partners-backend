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
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
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
                                                <img src="{{ asset($projet->logo) }}" alt="" class="avatar-sm">
                                            </div>

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-18">{{ $projet->intitule }}</h5>
                                                <p class=" text-primary font-size-15">{{ $projet->financement }} XAF</p>
                                            </div>
                                        </div>
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
                                        {{-- <div class="text-muted mt-4">
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> To achieve this, it would be
                                                necessary</p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Separate existence is a myth.
                                            </p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> If several languages coalesce
                                            </p>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
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
                            </div>

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
                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                        <tbody>

                                            <tr>
                                                <td style="width: 45px;">
                                                    <div class="avatar-sm">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a target="_blank"
                                                            href="{{ asset($projet->doc_presentation) }}"
                                                            class="text-dark">Document de présentation</a></h5>
                                                    <small>Important</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="{{ asset($projet->doc_presentation) }}"
                                                            class="text-dark" download><i
                                                                class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                            @foreach ($projet->medias as $row)
                                                <tr>
                                                    <td style="width: 45px;">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                <i class="bx bxs-file-doc"></i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 mb-1"><a target="_blank"
                                                                href="{{ asset($row->url) }}"
                                                                class="text-dark">{{ $row->nom }}</a></h5>
                                                        <small>{{ $row->type }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a download href="{{ asset($row->url) }}"
                                                                class="text-dark"><i
                                                                    class="bx bx-download h3 m-0"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
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
