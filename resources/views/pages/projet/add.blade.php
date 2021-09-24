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
                                <h4 class="card-title mb-4">Modifier le projet</h4>
                                <form>
                                    <div class="row mb-4">
                                        <label for="projectname" class="col-form-label col-lg-2">Intitule</label>
                                        <div class="col-lg-10">
                                            <input id="projectname" name="projectname" type="text" class="form-control" placeholder="Intitule">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="projectdesc" class="col-form-label col-lg-2">Description</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" id="projectdesc" rows="3" placeholder="Enter Project Description..."></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="projectbudget" class="col-form-label col-lg-2">Chiffre d'affaire</label>
                                        <div class="col-lg-10">
                                            <input id="projectbudget" name="projectbudget" type="text" placeholder="Chiffre d'affaire" class="form-control">
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
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>

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
