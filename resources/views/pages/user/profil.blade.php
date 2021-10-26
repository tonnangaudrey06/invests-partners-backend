@extends('layouts.main')

@section('title', $user->nom . ' ' . $user->prenom . ' - ' . config('app.name'))

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $user->nom . ' ' . $user->prenom }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-8">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Bon retour {{ $user->prenom }}!</h5>
                                        {{-- <p>Cela semblera simplifié</p> --}}
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{ $user->role_data->libelle }}</h5>
                                    {{-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                                </div>

                                <div class="col-sm-12">
                                    <div class="pt-4 d-flex justify-content-between">
                                        @if (auth()->user()->id == $user->id)
                                        <div>
                                            <a href="{{ route('user.profile.edit', $user->id) }}"
                                                class="btn btn-primary waves-effect waves-light btn-sm">Modifier profil
                                                <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div>
                                        @endif
                                        @if ($user->role == 2)
                                        <div>
                                            <a href="{{ route('chat.view', $user->id) }}"
                                                class="btn btn-primary waves-effect waves-light btn-sm">Voir les
                                                conversations
                                                <i class="mdi mdi-message-text ms-1"></i></a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Informations personnelles</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nom complet :</th>
                                            <td>{{ $user->nom_complet }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mobile :</th>
                                            <td>{{ $user->telephone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail :</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($user->role == 2)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Secteurs couverts</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        @forelse ($user->secteurs as $secteur)
                                        <tr>
                                            <th scope="row">{{ $secteur->libelle }}</th>
                                            <td>{{ count($secteur->projets) }} projets</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th colspan="2" scope="row">Aucun secteur pour l'instant</th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-xl-8">
                    @if($user->role == 2)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Secteurs</p>
                                            <h4 class="mb-0">125</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-check-circle font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Projets</p>
                                            <h4 class="mb-0">12</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-hourglass font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Total Revenue</p>
                                            <h4 class="mb-0">$36,524</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-package font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->role == 3)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Projets</p>
                                            <h4 class="mb-0">12</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-hourglass font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Financements demandés</p>
                                            <h4 class="mb-0">$36,524</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-package font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->role == 4)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Projets investis</p>
                                            <h4 class="mb-0">12</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-hourglass font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Investissements effectués</p>
                                            <h4 class="mb-0">$36,524</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-package font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Investissement</h4>
                            <div id="revenue-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div> --}}

                    @if($user->role == 2)
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Projets</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Projets</th>
                                            <th scope="col">Financement</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Skote admin UI</td>
                                            <td>2 Sep, 2019</td>
                                            <td>20 Oct, 2019</td>
                                            <td>$506</td>
                                        </tr>

                                        <tr>
                                            <td>Skote admin Logo</td>
                                            <td>1 Sep, 2019</td>
                                            <td>2 Sep, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Landing page</td>
                                            <td>21 Sep, 2019</td>
                                            <td>29 Sep, 2019</td>
                                            <td>$156</td>
                                        </tr>
                                        <tr>
                                            <td>App Landing UI</td>
                                            <td>29 Sep, 2019</td>
                                            <td>04 Oct, 2019</td>
                                            <td>$122</td>
                                        </tr>
                                        <tr>
                                            <td>Blog Template</td>
                                            <td>05 Oct, 2019</td>
                                            <td>16 Oct, 2019</td>
                                            <td>$164</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Multipurpose Landing</td>
                                            <td>17 Oct, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$192</td>
                                        </tr>
                                        <tr>
                                            <td>Logo Branding</td>
                                            <td>04 Nov, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->role == 3)
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Projets</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Projets</th>
                                            <th scope="col">Financement</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Skote admin UI</td>
                                            <td>2 Sep, 2019</td>
                                            <td>20 Oct, 2019</td>
                                            <td>$506</td>
                                        </tr>

                                        <tr>
                                            <td>Skote admin Logo</td>
                                            <td>1 Sep, 2019</td>
                                            <td>2 Sep, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Landing page</td>
                                            <td>21 Sep, 2019</td>
                                            <td>29 Sep, 2019</td>
                                            <td>$156</td>
                                        </tr>
                                        <tr>
                                            <td>App Landing UI</td>
                                            <td>29 Sep, 2019</td>
                                            <td>04 Oct, 2019</td>
                                            <td>$122</td>
                                        </tr>
                                        <tr>
                                            <td>Blog Template</td>
                                            <td>05 Oct, 2019</td>
                                            <td>16 Oct, 2019</td>
                                            <td>$164</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Multipurpose Landing</td>
                                            <td>17 Oct, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$192</td>
                                        </tr>
                                        <tr>
                                            <td>Logo Branding</td>
                                            <td>04 Nov, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->role == 4)
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Projets</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Projet</th>
                                            <th scope="col">Secteur</th>
                                            <th scope="col">Financement</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Skote admin UI</td>
                                            <td>2 Sep, 2019</td>
                                            <td>20 Oct, 2019</td>
                                            <td>$506</td>
                                        </tr>

                                        <tr>
                                            <td>Skote admin Logo</td>
                                            <td>1 Sep, 2019</td>
                                            <td>2 Sep, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Landing page</td>
                                            <td>21 Sep, 2019</td>
                                            <td>29 Sep, 2019</td>
                                            <td>$156</td>
                                        </tr>
                                        <tr>
                                            <td>App Landing UI</td>
                                            <td>29 Sep, 2019</td>
                                            <td>04 Oct, 2019</td>
                                            <td>$122</td>
                                        </tr>
                                        <tr>
                                            <td>Blog Template</td>
                                            <td>05 Oct, 2019</td>
                                            <td>16 Oct, 2019</td>
                                            <td>$164</td>
                                        </tr>
                                        <tr>
                                            <td>Redesign - Multipurpose Landing</td>
                                            <td>17 Oct, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$192</td>
                                        </tr>
                                        <tr>
                                            <td>Logo Branding</td>
                                            <td>04 Nov, 2019</td>
                                            <td>05 Nov, 2019</td>
                                            <td>$94</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<!-- apexcharts -->
<script type="text/javascript" src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- crypto dash init js -->
<script type="text/javascript" src="{{ asset('assets/js/pages/profile.init.js') }}"></script>
@endsection