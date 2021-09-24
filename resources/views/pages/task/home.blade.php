@extends('layouts.main')

@section('title', 'Projets - ' . config('app.name'))

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

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Liste de tout les projets</h4>
                            <div class="actions d-flex align-items-center">
                                <a href="{{ route('projet.add') }}" class="btn btn-sm btn-primary me-2">Nouveau projet</a>
                                <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-1.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="{{ route('projet.details', ['id' => 1]) }}"
                                                class="text-dark">New admin Design</a></h5>
                                        <p class="text-muted mb-4">It will be as simple as Occidental</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                            A
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-success">Completed</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 15 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 214
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-2.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">Brand logo design</a></h5>
                                        <p class="text-muted mb-4">To achieve it would be necessary</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-8.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-warning">Pending</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 22 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 183
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-3.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">New Landing Design</a></h5>
                                        <p class="text-muted mb-4"> For science, music, sport, etc</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info text-white font-size-16">
                                                            K
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-danger">Delay</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 13 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 175
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-4.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">Redesign - Landing page</a></h5>
                                        <p class="text-muted mb-4">If several languages coalesce</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-7.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-success">Completed</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 14 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 202
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-5.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">Skote Dashboard UI</a></h5>
                                        <p class="text-muted mb-4">Separate existence is a myth</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-danger text-white font-size-16">
                                                            3+
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-success">Completed</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 13 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 194
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-6.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">Blog Template UI</a></h5>
                                        <p class="text-muted mb-4"> For science, music, sport, etc</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-warning">Pending</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 24 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 122
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-3.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">Multipurpose Landing</a></h5>
                                        <p class="text-muted mb-4">It will be as simple as Occidental</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-warning text-white font-size-16">
                                                            R
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-danger">Delay</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 15 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 214
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-4.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">App Landing UI</a></h5>
                                        <p class="text-muted mb-4">To achieve it would be necessary</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-pink text-white font-size-16">
                                                            L
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-success">Completed</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 11 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 185
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                <img src="{{ asset('assets/images/companies/img-2.png') }}" alt="" height="30">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">New admin Design</a></h5>
                                        <p class="text-muted mb-4"> Their most common words.</p>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                            A
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xs">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <span class="badge bg-success">Completed</span>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-calendar me-1"></i> 12 Oct, 19
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <i class="bx bx-comment-dots me-1"></i> 106
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
                            <li class="page-item disabled">
                                <a href="javascript: void(0);" class="page-link"><i
                                        class="mdi mdi-chevron-left"></i></a>
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
                                <a href="javascript: void(0);" class="page-link"><i
                                        class="mdi mdi-chevron-right"></i></a>
                            </li>
                        </ul>
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
