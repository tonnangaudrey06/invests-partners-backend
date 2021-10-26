@extends('layouts.main')

@section('title', 'Slides - ' . config('app.name'))

@section('style')
{{-- <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}

<!-- Datatable -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
@endsection


@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Slides</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Slides</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card w-75">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ajouter une slide</h4>
                        <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-12 mb-3">
                                <label>Titre</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Slider Title">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label>Description</label>
                                <textarea class="form-control" name="description"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-footer pt-4 pt-5 mt-4 border-top text-center">
                                <button type="submit" class="btn btn-primary btn-default">Ajouter une slide</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('partials.footer')
</div>
@endsection

@section('script')
{{-- <script type="text/javascript" src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}

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

{{-- <script type="text/javascript" src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
@endsection