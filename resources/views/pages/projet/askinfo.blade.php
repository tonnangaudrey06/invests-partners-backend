@extends('layouts.main')


@section('style')
<!-- dropzone css -->
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Demande informations | {{$projet->intitule}}</h4>
                            <form
                                action="{{ (auth()->user()->role == 1) ? route('projet.admin.infosupp', $projet->id) : route('projet.ci.infosupp', $projet->id)  }}"
                                method="POST">

                                @csrf

                                <div class="row mb-4">
                                    <label for="objet" class="col-form-label col-lg-2">Objet *</label>
                                    <div class="col-lg-10">
                                        <input id="objet" name="objet" type="text" class="form-control">

                                        @error('objet')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="message" class="col-form-label col-lg-2">Message *</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="message" name="message" rows="3"
                                            placeholder="Entrer votre message"></textarea>

                                        @error('message')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
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