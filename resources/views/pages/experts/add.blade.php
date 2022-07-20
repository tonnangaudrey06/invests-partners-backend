@extends('layouts.main')

@section('title', 'Ajouter un expert - ' . config('app.name'))

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Experts</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Experts</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Ajouter un expert</h4>

                            <form action="{{ route('experts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Nom complet</label>
                                        <input type="text" required class="form-control" name="nom_complet"
                                            placeholder="Nom & prenom">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Occupation</label>
                                        <input type="text" required class="form-control" name="fonction"
                                            placeholder="Occupation">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" class="form-control" name="telephone"
                                            placeholder="Téléphone">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control" required accept="image/*">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-md">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection
