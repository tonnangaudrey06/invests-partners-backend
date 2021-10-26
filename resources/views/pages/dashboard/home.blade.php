@extends('layouts.main')

@section('title', 'Tableaux de bord - ' . config('app.name'))

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tableaux de bord</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Tableaux de bord</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4 d-flex align-items-center">
                                <i class="mdi mdi-account-circle text-primary h1 me-3"></i>
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <h4 class="h3"> <a href="{{ route('user.investisseur') }}"
                                            class="text-muted">Investisseurs</a></h4>
                                </div>
                            </div>

                            <div class="text-muted font-size-15 fw-bolder">
                                <p>
                                    <i class="mdi mdi-chevron-right text-primary me-1"></i> <span
                                        class="text-primary">@moneyFormat($investisseurs->count())</span> investisseurs
                                    inscrits
                                </p>
                                <p>
                                    <i class="mdi mdi-chevron-right text-primary me-1"></i> <span
                                        class="text-primary">@moneyFormat($investissement) XAF</span> déjà investis
                                </p>
                            </div>
                        </div>

                        <!--<div class="card-body border-top">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <p class="fw-medium mb-2">Balance :</p>
                                            <h4>@numberFormat($porteurs->count())</h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mt-4 mt-sm-0">
                                            <p class="fw-medium mb-2">Coin :</p>
                                            <div class="d-inline-flex align-items-center mt-1">

                                                <a href="javascript: void(0);" class="m-1">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-18">
                                                            <i class="mdi mdi-bitcoin"></i>
                                                        </span>
                                                    </div>
                                                </a>
                                                <a href="javascript: void(0);" class="m-1">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-ethereum"></i>
                                                        </span>
                                                    </div>
                                                </a>
                                                <a href="javascript: void(0);" class="m-1">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                            <i class="mdi mdi-litecoin"></i>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-top">
                                <div class="text-center">
                                    <a href="javascript: void(0);" class="btn btn-outline-light me-2 w-md">Deposit</a>
                                    <a href="javascript: void(0);" class="btn btn-primary me-2 w-md">Buy / Sell</a>
                                </div>
                            </div>-->
                    </div>
                </div>

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body">

                            <div class="mb-4 d-flex align-items-center">
                                <i class="mdi mdi-account-circle text-success h1 me-3"></i>
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <h4 class="h3"> <a href="{{ route('user.porteur.projet') }}"
                                            class="text-muted">Porteurs de projets</a></h4>
                                </div>
                            </div>

                            <div class="text-muted font-size-15 fw-bolder">
                                <p>
                                    <i class="mdi mdi-chevron-right text-success me-1"></i> <span
                                        class="text-success">@moneyFormat($porteurs->count())</span> porteurs de projets
                                    inscrits
                                </p>
                                <p>
                                    <i class="mdi mdi-chevron-right text-success me-1"></i> Besoin d'un financement de
                                    <span class="text-success"> @moneyFormat($besoinFinancement) XAF</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body">

                            <div class="mb-4 d-flex align-items-center">
                                <i class="mdi mdi-account-circle text-warning h1 me-3"></i>
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <h4 class="h3"> <a href="{{ route('user.conseiller') }}"
                                            class="text-muted">Conseillers</a></h4>
                                </div>
                            </div>

                            <div class="text-muted font-size-15 fw-bolder">
                                <p>
                                    <i class="mdi mdi-chevron-right text-warning me-1"></i> <span
                                        class="text-warning">@numberFormat($conseiller->count())</span> conseillers
                                </p>
                                <p>
                                    <i class="mdi mdi-chevron-right text-primary me-1"></i> <span
                                        class="text-warning">@numberFormat($secteurCouv->count())</span> secteurs
                                    couverts
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="text-center">
                                <div class="mb-4">
                                    <i class="bx bx-briefcase-alt-2 text-primary display-4"></i>
                                </div>
                                {{-- <h3>@numberFormat($nbProjets->count())</h3> --}}

                                <h4 class="card-title mb-4">@numberFormat($nbProjets->count()) projets enregistrés</h4>
                                {{-- <p>Projets enregistrés</p> --}}
                            </div>
                            <hr>

                            <div class="row text-center">
                                @php
                                $ip = DB::table('projets')->where('type', 'IP')->count();
                                $autres = DB::table('projets')->where('type', 'AUTRE')->count();
                                @endphp

                                <div class="col-6">
                                    <div>
                                        <strong>
                                            <p class="text-muted text-truncate mb-2 font-weight-bold text-uppercase">
                                                <a href="{{ route('projet.home_ip') }}" class="text-muted">Invest &
                                                    Partners</a>
                                            </p>
                                        </strong>
                                        <h5 class="mb-0 text-primary">@numberFormat($ip )</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <strong>
                                            <p class="text-muted text-truncate mb-2 font-weight-bold text-uppercase">
                                                <a href="{{ route('projet.home') }}"
                                                    class="text-muted">PLATEFORME</a>
                                            </p>
                                        </strong>
                                        <h5 class="mb-0 text-primary">@numberFormat( $autres )</h5>
                                    </div>
                                </div>
                            </div>
                            <hr><br>

                            <div class="row d-flex justify-content-center text-center">
                                @foreach ($etat as $item)
                                <div class="mb-4 pt-0 mt-0 col-md-4">
                                    <h5 class="card-title"><span>{{$item->etat}}</span></h5>

                                    <p>
                                        @if ($item->etat == "COMPLET")
                                        <span
                                            class="align-items-center justify-content-center badge badge-pill badge-soft-success font-size-15">{{$item->total_etat}}</span>
                                        @else
                                        <span
                                            class="align-items-center justify-content-center badge badge-pill badge-soft-warning font-size-15">{{$item->total_etat}}</span>
                                        @endif
                                    </p>

                                </div>
                                @endforeach
                            </div>
                            {{--
                            <div class="h5 text-center text-info">Secteurs</div>

                            <div class="row table-responsive mt-4">
                                <table class="table align-middle table-nowrap">
                                    <tbody>
                                        @foreach ($secteur as $secteurItem)
                                        <tr>
                                            <td style="width: 30%">
                                                <p class="mb-0">{{ $secteurItem->libelle }}</p>
                                            </td>
                                            @php
                                            $nbProjet1=DB::table('projets')->where('secteur',$secteurItem->id)->get()->count();
                                            @endphp
                                            <td style="width: 25%">
                                                <h5 class="mb-0">{{$nbProjet1}} </h5>
                                            </td>
                                            <td>

                                                @if((int)($nbProjets->count()) > 0 )
                                                @php
                                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a',
                                                'b', 'c', 'd', 'e', 'f');
                                                $color =
                                                '#'.$rand[rand(0,15)].$rand[rand(0,15)].'1'.$rand[rand(0,15)].'f'.'f';
                                                $percentage= round(($nbProjet1/$nbProjets->count())*100);
                                                @endphp
                                                <div class="progress bg-transparent progress-xl">
                                                    <div class="progress-bar rounded" role="progressbar"
                                                        style="width: {{ $percentage }}%; background:{{$color}}"
                                                        aria-valuenow="{{$percentage}}" aria-valuemin="0"
                                                        aria-valuemax="100">{{ $percentage }}%</div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Statistique des projets par secteur</h4>

                            <div class="row table-responsive">
                                <table class="table align-middle table-nowrap">
                                    <tbody>
                                        @foreach ($secteur as $secteurItem)
                                        <tr>
                                            <th style="width: 30%">
                                                {{ $secteurItem->libelle }}
                                            </th>
                                            @php
                                            $nbProjet1=DB::table('projets')->where('secteur',$secteurItem->id)->get()->count();
                                            @endphp
                                            <td class="text-center" style="width: 15%">
                                                {{$nbProjet1}}
                                            </td>
                                            <td>

                                                @if((int)($nbProjets->count()) > 0 )
                                                @php
                                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a',
                                                'b', 'c', 'd', 'e', 'f');
                                                $color =
                                                '#'.$rand[rand(0,15)].$rand[rand(0,15)].'1'.$rand[rand(0,15)].'f'.'f';
                                                $percentage= round(($nbProjet1/$nbProjets->count())*100);
                                                @endphp
                                                <div class="progress bg-transparent progress-xl">
                                                    <div class="progress-bar rounded" role="progressbar"
                                                        style="width: {{ $percentage }}%; background:{{$color}}"
                                                        aria-valuenow="{{$percentage}}" aria-valuemin="0"
                                                        aria-valuemax="100">{{$nbProjet1}} / {{$nbProjets->count()}}
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">

                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <h4 class="card-title mb-4">Pays</h4>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($pays as $item)
                                @php
                                $projetparVille=DB::table('projets')->select('ville_activite',DB::raw('COUNT(id) as
                                total_ville_projet'))->where('pays_activite',$item->pays_activite)->groupBy('ville_activite')->get();
                                @endphp

                                <div class=" accordion-item">

                                    <h2 class="accordion-header" id="heading{{$i}}">
                                        <button class="accordion-button fw-medium" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                                            aria-expanded="true" aria-controls="collapse{{ $i }}">
                                            <h5 class="font-size-14 fw-bolder">
                                                <span class="badge rounded badge-soft-primary p-2 fw-bolder me-2">{{
                                                    $item->total_projets }}</span>
                                                {{ $item->pays_activite }}
                                            </h5>
                                        </button>
                                    </h2>


                                    <div id="collapse{{ $i }}" class="accordion-collapse collapse show"
                                        aria-labelledby="heading{{$i}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap">
                                                    <tbody>
                                                        @foreach ($projetparVille as $item2)
                                                        <tr>
                                                            <th>{{ $item2->ville_activite }}</th>
                                                            <td class="text-end">{{$item2->total_ville_projet }} projets
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $i++;
                                @endphp
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>



                <!--<div class="row">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-muted mb-4">
                                        <i class="mdi mdi-medal h2 text-warning align-middle mb-0 me-3"></i> 
                                    </p>

                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <h5>{{ $nbProjets->count() }}</h5>
                                                <p class="text-muted text-truncate mb-0">+ 0.0012 ( 0.2 % ) <i
                                                        class="mdi mdi-arrow-up ms-1 text-success"></i></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <div id="area-sparkline-chart-1" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-muted mb-4"><i
                                            class="mdi mdi-ethereum h2 text-primary align-middle mb-0 me-3"></i>
                                        Ethereum </p>

                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <h5>$ 245.44</h5>
                                                <p class="text-muted text-truncate mb-0">- 4.102 ( 0.1 % ) <i
                                                        class="mdi mdi-arrow-down ms-1 text-danger"></i></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <div id="area-sparkline-chart-2" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-muted mb-4"><i
                                            class="mdi mdi-litecoin h2 text-info align-middle mb-0 me-3"></i> litecoin
                                    </p>

                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <h5>$ 63.61</h5>
                                                <p class="text-muted text-truncate mb-0">+ 1.792 ( 0.1 % ) <i
                                                        class="mdi mdi-arrow-up ms-1 text-success"></i></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <div id="area-sparkline-chart-3" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>-->


            </div>
            <!--
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end">
                                    <select class="form-select form-select-sm ms-2">
                                        <option value="MA" selected>March</option>
                                        <option value="FE">February</option>
                                        <option value="JA">January</option>
                                        <option value="DE">December</option>
                                    </select>
                                </div>
                                <h4 class="card-title mb-3">Wallet Balance</h4>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mt-4">
                                            <p>Available Balance</p>
                                            <h4>$ 6134.39</h4>

                                            <p class="text-muted mb-4"> + 0.0012.23 ( 0.2 % ) <i
                                                    class="mdi mdi-arrow-up ms-1 text-success"></i></p>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div>
                                                        <p class="mb-2">Income</p>
                                                        <h5>$ 2632.46</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        <p class="mb-2">Expense</p>
                                                        <h5>$ 924.38</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <a href="javascript: void(0);" class="btn btn-primary btn-sm">View more <i
                                                        class="mdi mdi-arrow-right ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <div id="wallet-balance-chart" class="apex-charts"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6 align-self-center">
                                        <div>
                                            <p class="mb-2"><i
                                                    class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i>
                                                Ethereum</p>
                                            <h5>4.5701 ETH = <span class="text-muted font-size-14">$ 1123.64</span></h5>
                                        </div>

                                        <div class="mt-4 pt-2">
                                            <p class="mb-2"><i
                                                    class="mdi mdi-circle align-middle font-size-10 me-2 text-warning"></i>
                                                Bitcoin</p>
                                            <h5>0.4412 BTC = <span class="text-muted font-size-14">$ 4025.32</span></h5>
                                        </div>

                                        <div class="mt-4 pt-2">
                                            <p class="mb-2"><i
                                                    class="mdi mdi-circle align-middle font-size-10 me-2 text-info"></i>
                                                Litecoin</p>
                                            <h5>35.3811 LTC = <span class="text-muted font-size-14">$ 2263.09</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Overview</h4>

                                <div>

                                    <div id="overview-chart" class="apex-charts" dir="ltr">
                                        <div class="toolbar d-flex flex-wrap gap-2 justify-content-center">
                                            <button type="button" class="btn btn-light btn-sm" id="one_month">
                                                1M
                                            </button>
                                            <button type="button" class="btn btn-light btn-sm" id="six_months">
                                                6M
                                            </button>
                                            <button type="button" class="btn btn-light btn-sm active" id="one_year">
                                                1Y
                                            </button>
                                            <button type="button" class="btn btn-light btn-sm" id="all">
                                                ALL
                                            </button>
                                        </div>
                                        <div id="overview-chart-timeline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

            <!-- <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Transactions</h4>

                                <ul class="nav nav-pills bg-light rounded" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab"
                                            role="tab">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab"
                                            role="tab">Buy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#transactions-sell-tab"
                                            role="tab">Sell</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-4">
                                    <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                        <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy LTC</h5>
                                                                <p class="text-muted mb-0">16 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                <p class="text-muted mb-0">17 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                <p class="text-muted mb-0">18 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                        <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                <p class="text-muted mb-0">17 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                            </div>
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy LTC</h5>
                                                                <p class="text-muted mb-0">16 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                <p class="text-muted mb-0">18 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="transactions-sell-tab" role="tabpanel">
                                        <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy LTC</h5>
                                                                <p class="text-muted mb-0">16 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">1.88 LTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$94.22</h5>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy ETH</h5>
                                                                <p class="text-muted mb-0">17 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.42 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$84.32</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell BTC</h5>
                                                                <p class="text-muted mb-0">18 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.018 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$145.80</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-danger">
                                                                <i class="bx bx-up-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Sell ETH</h5>
                                                                <p class="text-muted mb-0">15 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.56 ETH</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$112.34</h5>
                                                            </div>
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <td>
                                                            <div class="font-size-22 text-primary">
                                                                <i class="bx bx-down-arrow-circle"></i>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div>
                                                                <h5 class="font-size-14 mb-1">Buy BTC</h5>
                                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 mb-0">0.016 BTC</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="text-end">
                                                                <h5 class="font-size-14 text-muted mb-0">$125.20</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Notifications</h4>

                                <ul class="list-group" data-simplebar style="max-height: 390px;">
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-1.png" alt="" height="18">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14">Donec vitae sapien ut</h5>
                                                <p class="text-muted">If several languages coalesce, the grammar of the
                                                    resulting language</p>

                                                <div class="float-end">
                                                    <p class="text-muted mb-0"><i class="mdi mdi-account me-1"></i> Joseph
                                                    </p>
                                                </div>
                                                <p class="text-muted mb-0">12 Mar, 2020</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-2.png" alt="" height="18">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14">Cras ultricies mi eu turpis</h5>
                                                <p class="text-muted">To an English person, it will seem like
                                                    simplified English, as a skeptical cambridge</p>

                                                <div class="float-end">
                                                    <p class="text-muted mb-0"><i class="mdi mdi-account me-1"></i> Jerry
                                                    </p>
                                                </div>
                                                <p class="text-muted mb-0">13 Mar, 2020</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-3.png" alt="" height="18">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14">Duis arcu tortor suscipit</h5>
                                                <p class="text-muted">It va esser tam simplic quam occidental in fact,
                                                    it va esser occidental.</p>

                                                <div class="float-end">
                                                    <p class="text-muted mb-0"><i class="mdi mdi-account me-1"></i> Calvin
                                                    </p>
                                                </div>
                                                <p class="text-muted mb-0">14 Mar, 2020</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-1.png" alt="" height="18">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14">Donec vitae sapien ut</h5>
                                                <p class="text-muted">If several languages coalesce, the grammar of the
                                                    resulting language</p>

                                                <div class="float-end">
                                                    <p class="text-muted mb-0"><i class="mdi mdi-account me-1"></i> Joseph
                                                    </p>
                                                </div>
                                                <p class="text-muted mb-0">12 Mar, 2020</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Buy / Sell</h4>

                                <ul class="nav nav-pills bg-light rounded" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Buy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#sell-tab" role="tab">Sell</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-4" style="min-height: 340px;">
                                    <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                        <div class="float-end ms-2">
                                            <h5 class="font-size-14"><i
                                                    class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i>
                                                $4235.23</h5>
                                        </div>
                                        <h5 class="font-size-14 mb-4">Buy Coin</h5>

                                        <div>

                                            <div class="form-group mb-3">
                                                <label>Payment method :</label>
                                                <select class="form-select">
                                                    <option>Credit / Debit Card</option>
                                                    <option>Paypal</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>Add Amount :</label>
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text">Amount</label>
                                                    <select class="form-select" style="max-width: 90px;">
                                                        <option value="BT" selected>BTC</option>
                                                        <option value="ET">ETH</option>
                                                        <option value="LT">LTC</option>
                                                    </select>
                                                    <input type="text" class="form-control">
                                                </div>

                                                <div class="input-group mb-3">
                                                    <label class="input-group-text">Price</label>
                                                    <input type="text" class="form-control">
                                                    <label class="input-group-text">$</label>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <label class="input-group-text">Total</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="button" class="btn btn-success w-md">Buy Coin</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="sell-tab" role="tabpanel">
                                        <div class="float-end ms-2">
                                            <h5 class="font-size-14"><i
                                                    class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i>
                                                $4235.23</h5>
                                        </div>
                                        <h5 class="font-size-14 mb-4">Sell Coin</h5>

                                        <div>

                                            <div class="form-group mb-3">
                                                <label>Email :</label>
                                                <input type="email" class="form-control">
                                            </div>

                                            <div>
                                                <label>Add Amount :</label>
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text">Amount</label>

                                                    <select class="form-select" style="max-width: 90px;">
                                                        <option value="BT" selected>BTC</option>
                                                        <option value="ET">ETH</option>
                                                        <option value="LT">LTC</option>
                                                    </select>
                                                    <input type="text" class="form-control">
                                                </div>

                                                <div class="input-group mb-3">

                                                    <label class="input-group-text">Price</label>

                                                    <input type="text" class="form-control">

                                                    <label class="input-group-text">$</label>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <label class="input-group-text">Total</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="button" class="btn btn-danger w-md">Sell Coin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<!-- apexcharts -->
<script type="text/javascript" src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- crypto dash init js -->
<script type="text/javascript" src="{{ asset('assets/js/pages/crypto-dashboard.init.js') }}"></script>
@endsection