@extends('layouts.main')

@section('title', $title . ' - ' . config('app.name'))

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
                            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                    <li class="breadcrumb-item active">{{ $title }}</li>
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
                                    <h4 class="card-title">Liste des {{ lcfirst($title) }}</h4>
                                    <div class="actions">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#userModal">Nouveau {{ $role->name }}</button>
                                    </div>
                                </div>

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Utilisateur</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            @if ($role->value == 3)
                                                <th>Statut</th>
                                            @endif
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    @if (!empty($user->photo))
                                                        <div>
                                                            <img class="rounded-circle avatar-xs" src="assets/images/users/avatar-2.jpg" alt="">
                                                        </div>
                                                    @else
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle">
                                                                {{ strtoupper(substr($user->nom, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{ $user->nom_complet }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telephone }}</td>
                                                @if ($role->value == 3)
                                                    <td><strong>{{ $user->status }}</strong></td>
                                                @endif
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-secondary btn-sm">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
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

    <div id="userModal" class="modal fade" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <form id="userForm" action="{{ route('user.add') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="{{ $role->value }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Nouveau {{ $role->name }}
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
                                <input type="text" class="form-control" name="prenom" placeholder="Prenom" required>
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
                            @if ($role->value == 3)
                                <div class="form-group col-md-12 mb-3">
                                    <label>Statut</label>
                                    <select class="form-control" name="status" required>
                                        <option selected>Aucun</option>
                                        <option value="PARTICULIER">Particulier</option>
                                        <option value="ENTREPRISE">Entreprise</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label>Ancienente</label>
                                    <select class="form-control" name="anciennete">
                                        <option selected>Aucun</option>
                                        <option value="PARTICULIER">Plus d'un ans</option>
                                        <option value="ENTREPRISE">Moins d'un ans</option>
                                    </select>
                                </div>
                            @endif
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
    </div>
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
