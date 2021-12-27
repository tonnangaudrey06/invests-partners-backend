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
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection)

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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Modifier Slide</h4>
                            <form action="{{ route('slider.update', $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Titre</label>
                                        <input type="text" class="form-control" name="title" value={{ $slider->title }}>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Titre en anglais</label>
                                        <input type="text" class="form-control" name="title_en"
                                            value={{ $slider->title_en }}>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"
                                            rows="3">{{ $slider->description }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Description en anglais</label>
                                        <textarea class="form-control" name="description_en"
                                            rows="3">{{ $slider->description_en }}</textarea>
                                    </div>
                                    <div class="row col-md-12 mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="slideImageUpload">Telecharger nouvelle image</label>
                                            <input type="file" class="form-control" id="slideImageUpload" name="image">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="slideImageUpload">Ancienne Image</label>
                                            <img src="{{ URL::to($slider->image) }}" style="width: 70px; height:50px;">
                                            <input type="hidden" name="oldimage" value={{ $slider->image }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default">Mettre à jour</button>
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
