@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Création d'un projet</h4>

                <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <hr>
                    <h4 class="text-center"> INFORMATIONS PERSONNELLES </h4> <hr><br>
                    

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Nom</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="nom_membre">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Telephone</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="telephone_membre">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Pays</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="pays_membre">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Ville</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="ville_membre">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Date de naissance</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="date_naissance_membre">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Profession</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="profession_membre">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Photo de profil</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="photo_membre">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Scan</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="cni_membre">
                            </div>
                        </div>

                    </div>
                    {{-- End Row --}}

                    <hr>
                    <h4 class="text-center"> VOTRE PROJET</h4> <hr><br>
                    


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Nom du projet</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="intitule">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Site Web</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="site">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Pays d'activité</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="pays_activite">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Ville d'activité</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="ville_activite">
                        </div>

                    </div>
                    {{-- End Row --}}



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Medias projets</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                name="media[]" multiple="">
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col-md-6">

                            <label for="exampleFormControlFile1">Logo Projet</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="logo">

                        </div>

                        <div class="form-group col-md-6">

                            <label for="exampleFormControlFile1">Fichier de présenation du projet</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                name="doc_presentation">

                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Niveau d'évolution du projet</label>
                            <select class="form-control" id="exampleSelectGender" name="etat">
                                <option disabled="" selected="">-- Selectionnez le niveau --</option>

                                <option value="IDEE">Idée </option>
                                <option value="PROTOTYPE">Prototype </option>
                                <option value="SUR_LE_MARCHE"> Sur le marché </option>


                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Statut dans le projet</label>
                            <select class="form-control" id="exampleSelectGender" name="statut">
                                <option disabled="" selected="">-- Selectionnez votre statut --</option>

                                <option value="FONDATEUR">Fondateur </option>
                                <option value="CO-FONDATEUR">Co-Fondateur </option>
                                <option value="EMPLOYE">Employé </option>

                            </select>
                        </div>

                    </div>
                    {{-- End Row --}}

                    <hr>
                    <h4 class="text-center"> EQUIPE</h4> <hr><br>

                    <a href="{{ route('add.membre') }}"> Ajouter un membre de l'équipe</a> 

                <br><br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" >SL </th>
                                <th scope="col">Nom</th>
                                <th scope="col" >Email</th>
                                <th scope="col" >Telephone</th>
                                <th scope="col" >Photo</th>
                                <th scope="col" >Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i = 1)
                            @foreach($membres as $membre)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$membre->nom_membre}}</td>
                                <td>{{$membre->email_membre}}</td>
                                <td>{{$membre->telephone_membre}}</td>
                                <td><img src="{{asset($membre->photo_membre)}}" style="height:50px; width: 50px;"></td>
                                
                                <td>
                                    <a href="" class="btn btn-info">Edit</a>
                                    <a href=""
                                        onclick="return confirm('Are you sure to delete?')"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    

                    <br><br>



                    <button type="submit" class="btn btn-primary mr-2">Soumettre</button>

                </form>
            </div>
        </div>
    </div>
</div>





@endsection