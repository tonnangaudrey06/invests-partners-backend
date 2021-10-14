@extends('layouts.main')

@section('title', 'Utilisatuers - ' . config('app.name'))

@section('style')
<!-- dropzone css -->
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Utilisateurs</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Utilisateurs</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Modifier l'utilisateur {{$user->nom}} {{$user->prenom}}</h4>
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf

                                <input type="hidden" name="role" value="{{ $user->role }}">

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
                                        <input type="text" class="form-control" name="nom" value="{{$user->nom}}"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Prenom</label>
                                        <input type="text" class="form-control" name="prenom" value="{{$user->prenom}}">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" class="form-control" name="telephone"
                                            value="{{$user->telephone}}">
                                    </div>
                                    {{-- <div class="form-group col-md-12 mb-3">
                                                    <label>Mot de passe</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Mot de passe"
                                                        required>
                                                </div> --}}
                                    @if ($user->role == 3)
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Statut</label>
                                        <select class="form-control" name="status" required>
                                            <option {{ ($user->status) =='PARTICULIER' ? 'selected' : '' }}>Particulier</option>
                                            <option {{ ($user->status) =='ENTREPRISE' ? 'selected' : '' }}>Entreprise</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Ancienente</label>
                                        <select class="form-control" name="anciennete">
                                            <option value = "1" {{ ($user->anciennete) == 1 ? 'selected' : '' }}>
                                                Plus d'un an</option>
                                            <option  value = "-1" {{ ($user->anciennete) == -1 ? 'selected' : '' }}>
                                                Moins d'un an
                                            </option>
                                        </select>
                                    </div>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-md">Mettre à jour</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>

@include('partials.footer')
</div>
@endsection

@section('script')
{{-- <script type="text/javascript" src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}

<!-- dropzone plugin -->
<script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
@endsection