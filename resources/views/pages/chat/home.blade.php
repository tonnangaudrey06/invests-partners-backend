@extends('layouts.main')

@section('title', 'Messagerie - ' . config('app.name'))

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Messagerie</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ $sender->nom . ' ' . $sender->prenom }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Messagerie</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="d-lg-flex">
                    <div class="chat-leftsidebar me-lg-4">
                        <div class="">
                            <div class=" py-4 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                        class="avatar-xs rounded-circle" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">{{ $sender->nom . ' ' . $sender->prenom }}</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>
                                        En ligne</p>
                                </div>
                            </div>
                        </div>

                        <div class="search-box chat-search-box py-4">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <div>
                                <h5 class="font-size-14 mb-4">Nouveaux messages</h5>
                                <ul class="list-unstyled chat-list" data-simplebar style="max-height: 500px;">
                                    <li class="active">
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Steven Franklin</h5>
                                                    <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                </div>
                                                <div class="font-size-11">05 min</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Adam Miller</h5>
                                                    <p class="text-truncate mb-0">I've finished it! See you so</p>
                                                </div>
                                                <div class="font-size-11">12 min</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="avatar-xs align-self-center me-3">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                        K
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-warning font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Jose Vickery</h5>
                                                    <p class="text-truncate mb-0">Nice to meet you</p>
                                                </div>
                                                <div class="font-size-11">1 hr</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            M
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Mitchel Givens</h5>
                                                    <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                </div>
                                                <div class="font-size-11">3 hrs</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/images/users/avatar-6.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Stephen Hadley</h5>
                                                    <p class="text-truncate mb-0">I've finished it! See you so</p>
                                                </div>
                                                <div class="font-size-11">5hrs</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <div class="avatar-xs">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            K
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Keith Gonzales</h5>
                                                    <p class="text-truncate mb-0">This theme is awesome!</p>
                                                </div>
                                                <div class="font-size-11">24 min</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="w-100 user-chat">
                    <div class="card">
                        <div class="p-4 border-bottom ">
                            <div class="row">
                                <div class="col-md-4 col-9">
                                    <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>
                                        Active now</p>
                                </div>
                                <div class="col-md-8 col-3">
                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                        <li class="list-inline-item  d-none d-sm-inline-block">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-cog"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Voir le profil</a>
                                                    <a class="dropdown-item" href="#">Supprimer la conversation</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div>
                            <div class="chat-conversation p-3">
                                <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                    <li>
                                        <div class="chat-day-title">
                                            <span class="title">Today</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="conversation-list">
                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Steven Franklin</div>
                                                <p>
                                                    Hello!
                                                </p>
                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="right">
                                        <div class="conversation-list">
                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Henry Wells</div>
                                                <p>
                                                    Hi, How are you? What about our next meeting?
                                                </p>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="conversation-list">
                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Steven Franklin</div>
                                                <p>
                                                    Yeah everything is fine
                                                </p>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="last-chat">
                                        <div class="conversation-list">
                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Steven Franklin</div>
                                                <p>& Next meeting tomorrow 10.00AM</p>
                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class=" right">
                                        <div class="conversation-list">
                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Henry Wells</div>
                                                <p>
                                                    Wow that's great
                                                </p>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <div class="p-3 chat-input-section">
                                <div class="row">
                                    <div class="col">
                                        <div class="position-relative">
                                            <input type="text" class="form-control chat-input"
                                                placeholder="Enter Message...">
                                            <div class="chat-input-links" id="tooltip-container">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><a href="javascript: void(0);"
                                                            title="Emoji"><i
                                                                class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                    <li class="list-inline-item"><a href="javascript: void(0);"
                                                            title="Images"><i class="mdi mdi-file-image-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="javascript: void(0);"
                                                            title="Add Files"><i
                                                                class="mdi mdi-file-document-outline"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit"
                                            class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                                class="d-none d-sm-inline-block me-2">Send</span> <i
                                                class="mdi mdi-send"></i></button>
                                    </div>
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
@endsection
