@extends('layouts.main')

@section('title', ' PRIVILEGES - ' . config('app.name'))

@section('style')
<!-- Datatable -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" id="bootstrap-style"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" id="bootstrap-style"
    rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    id="bootstrap-style" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Privileges</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Privileges</a></li>
                                <li class="breadcrumb-item active">Privileges</li>
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
                                <h4 class="card-title">Liste des Privilèges</h4>
                                <div class="actions d-flex align-items-center">
                                    <button class="btn btn-sm btn-primary me-2" 
                                        Onclick()="{{route('add.writer')}}">Nouveau Privilège</button>
                                    <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"></th>
                                        <th style="width: 20%">Role</th>
                                        <th>#</th>

                                    </tr>
                                </thead>

                                <tbody>@php($i = 1)
                                    @foreach ($writers as $writer)
                                    <tr>

                                        <td> {{$i++}}</td>
                                        <td>{{$writer->libelle}}</td>
                                        <td>

                                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 15%"> Module</th>
                                                        <th style="width: 50%">Privilèges</th>
                                                        <th class="text-center" style="width: 10%">Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($writer->modules as $item)


                                                    <tr>
                                                        <td>
                                                            {{$item->module}}
                                                        </td>
                                                        <td>
                                                            {{-- @json($item->pivot->consulter) --}}
                                                            @if($item->pivot->consulter == 1)
                                                            <button class="btn btn-sm btn-info me-2"
                                                                data-bs-toggle="modal">Consulter</button>
                                                            
                                                            @endif

                                                            @if($item->pivot->modifier == 1)
                                                            <button class="btn btn-sm btn-warning me-2"
                                                                data-bs-toggle="modal">Modifier</button>
                                                            @endif

                                                            @if($item->pivot->ajouter == 1)
                                                            <button class="btn btn-sm btn-success me-2"
                                                                data-bs-toggle="modal">Ajouter</button>
                                                            @endif

                                                            @if($item->pivot->supprimer == 1)
                                                            <button class="btn btn-sm btn-danger me-2"
                                                                data-bs-toggle="modal">Supprimer</button>
                                                            @endif

                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{route('edit.writer', [$writer->id, $item->id])}}"
                                                                class="btn btn-xs btn-warning pull-right"><i class="bx bx-edit"></i></a>
                                                            <a href="{{route('delete.writer', [$writer->id, $item->id])}}"
                                                                onclick="return confirm('Voulez-vous vraiment supprimer?')"
                                                                class="btn btn-xs btn-danger pull-right"><i
                                                                    class="bx bx-trash"></i></i></a>
                
                                                        </td>

                                                    </tr>


                                                    @endforeach
                                                </tbody>

                                            </table>




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
    </div>

    @include('partials.footer')
</div>

{{-- <div id="userModal" class="modal fade" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <form id="userForm" action="{{ route('user.add') }}" method="POST">
        @csrf
        <input type="hidden" name="role" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Nouveau
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            <label>Civilité</label>
                            <select class="form-control" name="civilite">
                                <option selected>Aucun</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mme.">Mme.</option>
                                <option value="Mlle.">Mlle.</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Nom</label>
                            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Prenom</label>
                            <input type="text" class="form-control" name="prenom" placeholder="Prenom">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Téléphone</label>
                            <input type="text" class="form-control" name="telephone" placeholder="Téléphone">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe"
                                required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect"
                        data-bs-dismiss="modal">Fermer</button>
                    <button type="submit"
                        class="btn btn-sm btn-primary waves-effect waves-light">Enregistrement</button>
                </div>
            </div>
        </div>
    </form>
</div> --}}
@endsection

@section('script')
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
@endsection