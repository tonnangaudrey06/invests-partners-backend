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
                <div class="col-lg-4">
                    <div class="card" style="cursor: pointer" onclick="redirectTo('{{ route('user.investisseur') }}')">
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
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card" style="cursor: pointer" onclick="redirectTo('{{ route('user.porteur.projet') }}')">
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

                <div class="col-lg-4">
                    <div class="card" style="cursor: pointer" onclick="redirectTo('{{ route('user.conseiller') }}')">
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
                                <div class="mb-4 pt-0 mt-0 col-md-4" style="cursor: pointer" onclick="redirectTo('{{ route('projet.home_etat', $item->etat) }}')">
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
                                                <a class="text-decoration-none" href="{{ route('projet.home_secteur', $secteurItem->id) }}">{{ $secteurItem->libelle }}</a>
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
                                                            <th><a class="text-decoration-none" href="{{ route('projet.home_ville', $item2->ville_activite) }}">{{ $item2->ville_activite }}</a></th>
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
        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
@endsection