@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Member</h2>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('store.membre') }}" method="post" enctype="multipart/form-data">
                @csrf
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleInputName1">Nom </label>
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
                    <label for="exampleInputName1">Email</label>
                    <input type="email" class="form-control" id="exampleInputName1" name="email_membre">
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleFormControlFile1">Photo</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                        name="photo_membre">
                </div>

            </div>
            {{-- End Row --}}

            <div class="form-group ">
                <label for="exampleInputName1">Statut dans le projet</label>
                <select class="form-control" id="exampleSelectGender" name="statut">
                    <option disabled="" selected="">-- Selectionnez votre statut --</option>

                    <option value="FONDATEUR">Fondateur </option>
                    <option value="CO-FONDATEUR">Co-Fondateur </option>
                    <option value="EMPLOYE">Employé </option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Ajouter</button>

        </form>
        </div>
    </div>

</div>

@endsection