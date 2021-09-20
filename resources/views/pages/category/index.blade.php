@extends('layouts.main.app')

@section('title', 'Catégorie - ' . config('app.name'))

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card corona-gradient-card">
                <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                        <div class="col-4 col-sm-3 col-xl-2">
                            <img src="{{ asset('assets/images/dashboard/Group126@2x.png') }}"
                                class="gradient-corona-img img-fluid" alt="">
                        </div>
                        <div class="col-5 col-sm-7 col-xl-8 p-0">
                            <h4 class="mb-1 mb-sm-0">Bienvenue sur Invest & Partners</h4>
                            <p class="mb-0 font-weight-normal d-none d-sm-block">Votre plateforme de mise en relation de
                                porteurs de projets et investisseurs.</p>
                        </div>
                        <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                            <span>
                                <a href="{{ url('/') }}" target="_blank"
                                    class="btn btn-outline-light btn-rounded get-started-btn">Allez sur le site</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Page Catégorie</h4>

                <div class="template-demo">
                    <a href="{{ route('add.category') }}"><button class="btn btn-primary btn-fw" style="float:right;">
                            Ajouter une
                            Catégorie</button></a>
                </div> <br>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Catégorie Anglais </th>
                                <th> Catégorie Francais </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($category as $row)
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ $row->category_en }} </td>

                                    <td> {{ $row->category_fr }} </td>
                                    <td>
                                        <a href="{{ route('edit.category', $row->id) }}" class="btn btn-info"> Editer
                                        </a>
                                        <a href="{{ route('delete.category', $row->id) }}"
                                            onclick="return confirm('Voulez vous vraiment supprimer?')"
                                            class="btn btn-danger"> Supprimer </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $category->links('pagination-links') }}
                </div>
            </div>
        </div>
    </div>
@endsection
