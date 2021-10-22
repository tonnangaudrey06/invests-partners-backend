@extends('layouts.main')

@section('title', 'Ajouter une actualité - ' . config('app.name'))

@section('content')



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Actualités</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Actualités</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ajouter une actualité</h4>

                        @php
                            if($type == 'secteur'){
                                $choice = true;
                            }
                            else{
                                $choice = false;
                            }
                        @endphp

                        <form action="{{isset($choice) ? route('actualites.store', [$type, $secteur->id]) : route('actualites.store', [$type, $projet->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label>Libelle</label>
                                    <input type="text" class="form-control" name="libelle" required>

                                    @error('libelle')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- @if($type == 'secteur')
                                <div class="form-group col-md-12 mb-3">
                                    <label>Secteur d'activité</label>
                                    <select class="form-control" name="secteur">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nom_complet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif --}}

                                <div class="form-group col-md-12 mb-3">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" aria-describedby="emailHelp" required>


                                    @error('image')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
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