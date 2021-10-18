@extends('layouts.main')

@section('title', 'Évenements - ' . config('app.name'))

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
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Évenements</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Évenements</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title">Liste des différents évenements</h4>
                                <div class="actions d-flex align-items-center">
                                    {{-- <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#profilInvestisseurModal">Nouveau profil</button> --}}
                                    <a href="{{route('events.add')}}" class="btn btn-sm btn-primary me-2">Nouveau
                                        évenement</a>
                                    <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered dt-responsive align-middle nowrap w-100">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Évenement</th>
                                        <th rowspan="2">Date</th>
                                        <th rowspan="2">Prix</th>
                                        <th colspan="2">Places</th>
                                        <th rowspan="2">Actions</th>
                                    </tr>
                                    <tr>
                                        <th>Disponible</th>
                                        <th>Reserver</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">David McHenry</a></h5>
                                            <p class="text-muted mb-0">UI/UX Designer</p>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">David McHenry</a></h5>
                                            <p class="text-muted mb-0">UI/UX Designer</p>
                                        </td>
                                        <td>
                                            5 000 XAF
                                        </td>
                                        <td>
                                            50 places
                                        </td>
                                        <td>
                                            20 places
                                        </td>
                                        <td>
                                            20 places
                                        </td>
                                    </tr>
                                    {{-- @foreach ($evenements as $evenement)
                                    <tr>
                                        <td>
                                            <strong>{{$evenement->libelle}}</strong>
                                        </td>
                                        <td>{{$evenement->lieu}}</td>
                                        <td>{{number_format($investissement->montant, 0, ',', ' ')}} XAF</td>
                                        <td>{{$investissement->date_versement}}</td>
                                        <td>{{$investissement->numero_versement}}</td>
                                        <td>
                                            <a href="{{route('investissement.edit', $investissement->id)}}"
                                                class="btn btn-xs btn-warning pull-right"><i class="bx bx-edit"></i></a>
                                            <a href="{{route('investissement.delete', $investissement->id)}}"
                                                onclick="return confirm('Voulez-vous vraiment supprimer?')"
                                                class="btn btn-xs btn-danger pull-right"><i
                                                    class="bx bx-trash"></i></i></a>

                                        </td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

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