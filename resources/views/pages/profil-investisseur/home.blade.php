@extends('layouts.main')

@section('title', 'Profil des investisseurs - ' . config('app.name'))

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
                            <h4 class="mb-sm-0 font-size-18">Profil des investisseurs</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Profil des investisseurs</li>
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
                                    <h4 class="card-title">Liste des profils disponible pour un investisseurs</h4>
                                    <div class="actions d-flex align-items-center">
                                        {{-- <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#profilInvestisseurModal">Nouveau profil</button> --}}
                                            <a href="{{route('profil.investisseur.add')}}" class="btn btn-sm btn-primary me-2" >Nouveau profil</a>
                                        <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                                    </div>
                                </div>

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Montant minimal</th>
                                            <th>Montant maximal</th>
                                            <th>Montant abonnement</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($profils as $profil)
                                            <tr>
                                                <td>
                                                    <strong>{{ $profil->type }}</strong>
                                                </td>
                                                <td>{{ $profil->montant_min }}</td>
                                                <td>{{ $profil->montant_max }}</td>
                                                <td>{{ $profil->frais_abonnement }}</td>
                                                <td>
                                                    <a href="{{route('profil.investisseur.edit', $profil->id)}}" class="btn btn-xs btn-warning pull-right"><i class="bx bx-edit"></i></a>
                                                    <a href="{{route('profil.investisseur.delete', $profil->id)}}" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="btn btn-xs btn-danger pull-right"><i class="bx bx-trash"></i></i></a>
        
                                                </td>
                                            </tr>
                                        @endforeach
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

    <div id="profilInvestisseurModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form id="profilInvestisseurForm" action="{{ route('profil.investisseur.add') }}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profilInvestisseurModalLabel">Nouveau profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 mb-3">
                                <label>Type</label>
                                <select class="form-control" name="type">
                                    <option value="BRONZE" selected>BRONZE</option>
                                    <option value="EMERALD">EMERALD</option>
                                    <option value="GOLD">GOLD</option>
                                    <option value="PLATINUM">PLATINUM</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label>Montant minimal</label>
                                <input type="number" class="form-control" name="montant_min" min="1" value="1"
                                    placeholder="0 XAF">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label>Montant maximal</label>
                                <input type="number" class="form-control" name="montant_max" min="1" placeholder="0 XAF">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label>Montant abonnement</label>
                                <input type="number" class="form-control" name="montant_abonnement" min="1" placeholder="0 XAF">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit"
                            class="btn btn-sm btn-primary waves-effect waves-light">Enregistrement</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </form>
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
