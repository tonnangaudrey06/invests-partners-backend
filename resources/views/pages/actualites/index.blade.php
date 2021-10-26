@extends('layouts.main')

@section('title', 'Actualités - ' . config('app.name'))

@section('style')
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title">Liste des actualités</h4>
                                <div class="actions d-flex align-items-center">
                                    {{-- <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#profilInvestisseurModal">Nouveau profil</button> --}}
                                            @if($type=='secteur')
                                                <a href=" {{route('actualites.add', [$type, $secteur->id])}}" class="btn btn-sm btn-primary me-2">Ajouter une actualité</a>
                                            @else
                                                <a href=" {{route('actualites.add', [$type, $projet->id]) }}" class="btn btn-sm btn-primary me-2">Ajouter une actualité</a>
                                            @endif
                                    <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                                </div>
                            </div>

                            {{-- @json($projet->id) --}}

                            <div class="row">
                                @foreach ($actualites as $item)
                                <div class="col-sm-3 rounded">
                                    <div class="card p-1 border shadow-none">
                                        <div class="p-3">
                                            <h5><a href="blog-details.html" class="text-dark">{{$item->libelle}}</a></h5>
                                            <p class="text-muted mb-0">{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</p>
                                        </div>
                                        
                                        @if($item->image)
                                        <div class="position-relative">
                                            <img src="{{$item->image}}" alt="" class="img-thumbnail">
                                        </div>
                                        @endif

                                        <div class="p-3">
                                            <ul class="list-inline">
                                                <li class="list-inline-item me-3">
                                                    <a href="javascript: void(0);" class="text-muted">
                                                        @if($item->secteur)
                                                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> {{$item->secteur_data->libelle}}
                                                        @else
                                                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> {{$item->projet_invest->intitule}}
                                                        @endif
                                                    </a>
                                                </li>
                                                {{-- <li class="list-inline-item me-3">
                                                    <a href="javascript: void(0);" class="text-muted">
                                                        <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 12 Comments
                                                    </a>
                                                </li> --}}
                                            </ul>
                                            <p>{{Str::limit($item->description, 100)}}</p>

                                            <div>
                                                <a href="{{($item->secteur) ? route('actualites.details', [$type, $item->id, $item->secteur]) : route('actualites.details', [$type, $item->id, $item->projet])}}" class="text-primary">En savoir plus <i class="mdi mdi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                

                                
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div>
    </div>

    @include('partials.footer')
</div>

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>    
@endsection