@extends('layouts.main')

@section('title', 'Projets - ' . config('app.name'))

@section('style')
@endsection


@section('content')

@php
$privileges = DB::table('privileges')->where('role', auth()->user()->role)->get();
@endphp

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Projets {{ $type == 'IP' ? 'de Invest & Partners' : ($type ==
                            'AUTRE' ? 'des porteurs de projet' : ' archivés') }}</h4>

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

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Liste des projets par secteur</h4>


                        <div class="actions d-flex align-items-center">
                            @if($type == 'IP')
                            @foreach ($privileges as $privilege)
                            @if( $privilege->module == 1 && $privilege->ajouter == 1)
                            <a href="{{ route('projet.add') }}" class="btn btn-sm btn-primary me-2">Nouveau projet</a>
                            @endif
                            @endforeach
                            @endif

                            <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($secteurs as $secteur)
            @if(count($secteur->projets) > 0)
            <div class="card bg-primary">
                <div class="card-body p-2 d-flex justify-content-between align-items-center text-white">
                    <h4 class="card-title m-0 text-white"><i class="mdi mdi-chevron-right me-1"></i>
                        {{$secteur->libelle}}</h4>
                    <h4 class="card-title m-0 text-white">{{count($secteur->projets)}} projet(s)</h4>
                </div>
            </div>
            <div class="row">
                @foreach ($secteur->projets as $projet)
                <div class="col-lg-6 col-xl-4">
                    <div class="card"
                        style="border-radius: 0.75rem; box-shadow: 0 -0.25rem 3.5rem rgb(18 38 63 / 26%); cursor: pointer;"
                        onclick="redirectTo('{{ route('projet.details', ['id' => $projet->id]) }}')">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <a href="{{ route('projet.details', ['id' => $projet->id]) }}">
                                                <img class="rounded-circle avatar-sm"
                                                    src="{{ $projet->logo ? $projet->logo : asset('assets/images/projet.jpg') }}"
                                                    alt="" height="30">
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15">
                                        <a href="{{ route('projet.details', ['id' => $projet->id]) }}"
                                            class="text-decoration-none">
                                            {{ $projet->intitule }}
                                        </a>
                                    </h5>
                                    <p class="font-size-14 fw-bolder">@numberFormat($projet->financement) XAF</p>
                                    <hr>
                                    <div class="text-muted fw-bolder">
                                        <p>
                                            <i class="mdi mdi-domain me-1"></i> {{ $projet->secteur_data->libelle }}
                                        </p>
                                        <p>
                                            <i class="mdi mdi-lightbulb-multiple me-1"></i> {{
                                            $projet->avancement_complet }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 border-top">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <i class="bx bx-calendar me-1"></i> Crée {{
                                    Carbon\Carbon::parse($projet->created_at)->diffForHumans() }}
                                </div>
                                <span class="badge bg-info p-2">{{ $projet->etat }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endforeach
            {{--
            <div class="row">




                @if (auth()->user()->role == 1)

                @foreach ($projets as $projet)
                <div class="col-xl-4 col-sm-6">
                    <div class="card "
                        style="border-radius: 0.75rem; box-shadow: 0 -0.25rem 3.5rem rgb(18 38 63 / 26%)">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <a href="{{ route('projet.details', ['id' => $projet->id]) }}">
                                                <img class="rounded-circle avatar-sm" src="{{ asset($projet->logo) }}"
                                                    alt="" height="30">
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15">
                                        <a href="{{ route('projet.details', ['id' => $projet->id]) }}"
                                            class="text-decoration-none">
                                            {{ $projet->intitule }}
                                        </a>
                                    </h5>
                                    <p class="font-size-14 fw-bolder">@numberFormat($projet->financement) XAF</p>
                                    <hr>
                                    <div class="text-muted fw-bolder">
                                        <p>
                                            <i class="mdi mdi-domain me-1"></i> {{ $projet->secteur_data->libelle }}
                                        </p>
                                        <p>
                                            <i class="mdi mdi-lightbulb-multiple me-1"></i> {{
                                            $projet->avancement_complet }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 border-top">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <i class="bx bx-calendar me-1"></i> Crée {{
                                    Carbon\Carbon::parse($projet->created_at)->diffForHumans() }}
                                </div>
                                <span class="badge bg-info p-2">{{ $projet->etat }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @else

                @foreach ($pro as $item)

                @php
                //$prosect = DB::table('projets')->where('secteur', $item->id)->where('type', 'AUTRE')->get();
                $i = 0;
                @endphp


                <div class="d-flex justify-content-center">
                    <h4 class=" col-md-4 text-center btn btn-primary">{{$item->libelle}}</h4><br><br>
                </div>


                @foreach ($projets as $boss)


                @if($item->id == $boss->secteur_data->id )


                <div class="col-xl-4 col-sm-6">
                    <div class="card "
                        style="border-radius: 0.75rem; box-shadow: 0 -0.25rem 3.5rem rgb(18 38 63 / 26%)">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <a href="{{ route('projet.details', ['id' => $boss->id]) }}">
                                                <img class="rounded-circle avatar-sm" src="{{ asset($boss->logo) }}"
                                                    alt="" height="30">
                                            </a>
                                        </span>
                                    </div>
                                </div>


                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15">
                                        <a href="{{ route('projet.details', ['id' => $boss->id]) }}" class="text-dark">
                                            {{ $boss->intitule }}
                                        </a>
                                    </h5>

                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center mt-4 mb-4 font-size-14 font-weight-bolder">
                                        <p class="text-muted">STATUT : {{ $boss->avancement }}</p>
                                        <p class="text-primary">{{ $boss->financement }} XAF</p>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0 d-flex justify-content-between align-items-center w-100">
                                <li class="list-inline-item me-3">
                                    <span class="badge bg-success p-2">{{ $boss->etat }}</span>
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i>{{
                                    Carbon\Carbon::parse($boss->created_at)->diffForHumans() }}
                                </li>
                                <li class="list-inline-item me-3 text-primary">
                                    {{-- <i class="bx bxs-data me-1"></i> {{ $projet->secteur_data->libelle }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                @php
                $i = 1;
                @endphp
                @endif

                @endforeach

                @if( $i == 0)
                <h5 class="text-center">Aucun projet pour l'instant</h5><br><br>
                @endif

                @endforeach
                @endif

            </div>
            <!-- end row -->
            --}}

            {{-- <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
                        <li class="page-item disabled">
                            <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">1</a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript: void(0);" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <!-- end row -->
        </div>

    </div>
</div>

@include('partials.footer')
</div>
@endsection

@section('script')
@endsection