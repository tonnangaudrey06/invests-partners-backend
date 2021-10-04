@extends('layouts.main')

@section('title', 'Secteurs d\'activités - ' . config('app.name'))

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

@php
$privileges = DB::table('privileges')->where('role', Auth()->user()->role)->get();
$sub = DB::table('secteurs')->where('user', Auth()->user()->id)->get();
@endphp

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Secteurs d'activité</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Secteurs d'activité</li>
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
                                <h4 class="card-title">Liste des secteurs d'activité</h4>
                                <div class="actions d-flex align-items-center">
                                    @foreach ($privileges as $privilege)

                                    @if( $privilege->module == 11 && $privilege->ajouter == 1)
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#categorieModal">Ajouter</button>
                                    @endif
                                    @endforeach

                                    <button class="btn btn-sm btn-primary" onclick="reload()">Actualiser</button>
                                </div>
                            </div>

                            @if(Auth()->user()->role == 1)
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"></th>
                                        <th>Secteur d'activité</th>
                                        <th style="width: 30%">Expert</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($secteurs as $categorie)
                                    <tr>
                                        <td>
                                            @if (!empty($categorie->image))
                                            <div>
                                                <img class="rounded-circle avatar-xs"
                                                    src="assets/images/users/avatar-2.jpg" alt="">
                                            </div>
                                            @else
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle">
                                                    {{ strtoupper(substr($categorie->libelle, 0, 1)) }}
                                                </span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $categorie->libelle }}</strong>
                                        </td>
                                        <td>{{ $categorie->user_data->nom_complet ?? 'Aucun' }}</td>
                                        <td class="text-center">
                                            <button id="categorie-edit-button" type="button"
                                                data-id="{{$categorie->id}}" class=" btn btn-secondary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#categorieModalEdit">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                            @else
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"></th>
                                        <th>Secteur d'activité</th>
                                        {{-- <th style="width: 30%">Expert</th>
                                        <th>Actions</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sub as $categorie)
                                    <tr>
                                        <td>
                                            @if (!empty($categorie->image))
                                            <div>
                                                <img class="rounded-circle avatar-xs"
                                                    src="assets/images/users/avatar-2.jpg" alt="">
                                            </div>
                                            @else
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle">
                                                    {{ strtoupper(substr($categorie->libelle, 0, 1)) }}
                                                </span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $categorie->libelle }}</strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif





                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>

    @include('partials.footer')
</div>

<div id="categorieModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="categorieForm" action="{{ route('category.add') }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categorieModalLabel">Nouvelle catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            <label>Libelle</label>
                            <input type="text" class="form-control" name="libelle" placeholder="Libelle">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label>Spécialiste</label>
                            <select class="form-control" name="user">
                                <option>Aucun</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nom_complet }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect"
                        data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="categorieModalEdit" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="categorieFormEdit" action="" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categorieModalLabel">Modifier secteur d'activité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            <label>Libelle</label>
                            <input type="text" class="form-control" name="libelle" id="secteur-intitule">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label>Spécialiste</label>
                            <select class="form-control" name="specialiste" id="secteur-specialiste">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nom_complet }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect"
                        data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Modifier</button>
                </div>
            </div>
        </div>
    </form>
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

<script type="text/javascript">
    $(document).ready(function(){
  		$("#categorieModalEdit").modal({
  			keyboard: true,
  			backdrop: "static",
  			show: false,
  
  		}).on("show.bs.modal", function(event){
  		  var button = $(event.relatedTarget); // button the triggered modal
  			var personId = button.data("id"); 


  			if(personId) {
                  $.ajax({
                      url: "{{  url('/get/user/') }}/"+personId,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                        //   console.log($("#secteur-intitule"));
                        //   console.log(data);
                         $("#secteur-intitule").val(data.libelle)
                         $("#secteur-specialiste").val(data.user).change()
                      },
                     
                  });

                //   $(document).querySelector('#categorieFormEdit-form').addEventListener('submit', (e) => {
                //     e.preventDefault();
                //     var formData = new FormData(e.target);
                //     fetch("{{ route('category/update' $personId) }}", { 
                //         method: 'POST',
                //         body: formData
                //     }).then(() => console.log('success'));
                //     });

                  
              } else {
                  alert('danger');
              }
  		}).on("hide.bs.modal", function (event) {
			$(this).find("#intitule").html("");
		});
  	});
</script>

<script type="text/javascript">
    document.querySelector('#categorieFormEdit-form').addEventListener('submit', (e) => {
  e.preventDefault();
  var formData = new FormData(e.target);
  var personId = button.data("id"); 
  fetch("{{ route('category/update', $personId) }}", { 
    method: 'POST',
    body: formData
  }).then(() => console.log('success'));
});
</script>

@endsection