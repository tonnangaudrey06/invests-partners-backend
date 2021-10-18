@extends('layouts.main')

@section('title', 'Évenements - ' . config('app.name'))

@section('style')

<link href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Créer un nouvel événement</h4>
                            <form>
                                <div class="row mb-4">
                                    <label for="projectname" class="col-form-label">Nom de l'événement</label>
                                    <input id="projectname" name="projectname" type="text" class="form-control"
                                        placeholder="Nom">
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Date de l'événement</label>
                                        <div class="input-group" id="dateevent">
                                            <input type="text" class="form-control" placeholder="dd M, yyyy"
                                                data-date-format="dd M, yyyy" data-date-container='#dateevent'
                                                data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Heure de l'événement</label>
                                        <div class="input-group" id="timepicker-input-group2">
                                            <input id="timepicker2" type="text" class="form-control"
                                                data-provide="timepicker">

                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="projectbudget" class="col-form-label col-lg-2">Prix</label>
                                    <div class="col-lg-10">
                                        <input id="projectbudget" name="projectbudget" type="text"
                                            placeholder="Enter Project Budget..." class="form-control">
                                    </div>
                                </div>
                            </form>
                            <div class="row mb-4">
                                <label class="col-form-label col-lg-2">Attached Files</label>
                                <div class="col-lg-10">
                                    <form action="https://themesbrand.com/" method="post" class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>

                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                            </div>

                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary">Create Project</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')

<script type="text/javascript" src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection