@extends('layouts.main')

@section('title', 'Ajouter un investissement - ' . config('app.name'))

@section('style')

    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet"
        type="text/css" />

@endsection

@section('content')



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Investissement</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Investissement</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ajouter un investissement</h4>

                        <form id="profilInvestisseurForm" action="{{route('investissement.update', $investissement->id)}}"
                            method="POST">
                            @csrf


                            <div class="row">

                                <div class="row mb-4">
                                    <label class="col-form-label col-lg-2">Date de versement</label>
                                    <div class="col-lg-10">
                                        <div class="input-daterange input-group" id="project-date-inputgroup" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-container="#project-date-inputgroup" data-date-autoclose="true">
                                            <input type="text" class="form-control" value="{{$investissement->date_versement}}" name="date_versement">

                                            @error('date_versement')
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Investisseur</label>

                                    <select class="form-control" id="investisseur" name="investisseur">
                                        <option disabled="" selected="">-- Selectionner un investisseur --</option>
                                        @foreach($investisseurs as $row)
                                        <option value="{{ $row->id }}" <?php if($row->id == $investissement->user){
                                                echo "selected";
                                            } ?>>{{ $row->nom}} {{ $row->prenom}}</option>
                                        @endforeach
        
                                    </select>


                                    @error('investisseur')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Projet</label>

                                    <select class="form-control" id="projet" name="projet">
                                        <option disabled="" selected="">-- Selectionner un projet --</option>
                                        @foreach($projets as $row)
                                        <option value="{{ $row->id }}" <?php if($row->id == $investissement->projet){
                                                echo "selected";
                                            } ?>>{{ $row->intitule}}</option>
                                        @endforeach
        
                                    </select>

                                    @error('projet')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group col-md-12 mb-3">
                                    <label>Montant Investi</label>
                                    <input type="number" class="form-control" name="montant_investi" 
                                        value="{{$investissement->montant}}">

                                        @error('montant_investi')
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

@section('script')
    <script type="text/javascript" src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
    <script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}">
@endsection