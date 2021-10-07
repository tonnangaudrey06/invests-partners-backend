@extends('layouts.main')

@section('title', 'Projets - ' . config('app.name'))

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Modifier le projet {{$projet->intitule}}</h4>
                            <form action="{{ route('projet.update', $projet->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="row mb-4">
                                    <label for="taux_rentabilite" class="col-form-label col-lg-2">Taux de
                                        rentabilité *</label>
                                    <div class="col-lg-10">
                                        <input id="taux_rentabilite" name="taux_rentabilite" type="text"
                                            class="form-control">

                                            @error('taux_rentabilite')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="duree" class="col-form-label col-lg-2">Durée du projet (en mois) *</label>
                                    <div class="col-lg-10">
                                        <input id="duree" name="duree" type="text" class="form-control">

                                            @error('duree')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="delai_recup" class="col-form-label col-lg-2">Délai de recupération (en
                                        mois) *</label>
                                    <div class="col-lg-10">
                                        <input id="delai_recup" name="delai_recup" type="text" class="form-control">

                                            @error('delai_recup')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="ca_previsionnel" class="col-form-label col-lg-2">Chiffre d'affaires
                                        prévisionnel *</label>
                                    <div class="col-lg-10">
                                        <input id="ca_previsionnel" name="ca_previsionnel" type="text"
                                            class="form-control">

                                            @error('ca_previsionnel')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-form-label col-lg-2">Fichiers joints</label>
                                    <div class="col-lg-10">

                                        <input type="file" name="fichier[]" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" multiple="">

                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
{{-- <script type="text/javascript" src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}

<!-- dropzone plugin -->
<script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
@endsection