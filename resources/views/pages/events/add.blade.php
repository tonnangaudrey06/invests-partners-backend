@extends('layouts.main')

@section('title', 'Évènements - ' . config('app.name'))

@section('style')

<link href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
    type="text/css" />

@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Évènements</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Évènements</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 d-flex justify-content-start">
                    <div class="card w-75 rounded shadow">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Créer un nouvel événement</h4>
                            <form class="row" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 mb-4">
                                    <label for="projectname">Titre de l'événement</label>
                                    <input id="projectname" name="libelle" type="text" class="form-control"
                                        placeholder="Titre">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="projectname">Lieu de l'événement</label>
                                    <input id="projectname" name="lieu" type="text" class="form-control"
                                        placeholder="Lieu">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label git for="dateevent">Date de l'événement</label>
                                    <div class="input-group" id="dateevent">
                                        <input type="text" class="form-control" name="date_evenement" placeholder="dd M, yyyy"
                                            data-date-format="yyyy-mm-dd" data-date-container='#dateevent'
                                            data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="heureevent">Heure de l'événement</label>
                                    <div class="input-group" id="heureevent">
                                        <input id="heureevent-input" type="text" name="heure_debut" class="form-control"
                                            data-provide="timepicker">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Durée (en heures)</label>
                                    <input name="duree" type="number" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Nombre de places</label>
                                    <input name="places" type="number" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="font-size-14 mb-3">Payant?</h5>
                                    <div>
                                        <input type="checkbox" id="paiement" switch="bool" checked />
                                        <label for="paiement" data-on-label="Oui" data-off-label="Non"></label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="event-prix-block">
                                    <label class="form-label">Prix</label>
                                    <input name="prix" type="number" class="form-control" min="0">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Image</label>
                                    <div class="input-group">
                                        <input type="file" accept="image/*" name="image" class="form-control" id="event-image">
                                        <label class="input-group-text" for="event-image">Télécharger</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

        </div>
    </div>

    @include('partials.footer')
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('#paiement').is(':checked')) {
            $('#event-prix-block').show();
            $('input[name="prix"]').val('');
        } else {
            $('#event-prix-block').hide();
            $('input[name="prix"]').val('');
        }
        $('[data-toggle="touchspin"]').each(function (e, t) {
            var a = $.extend({}, $(t).data());
            $(t).TouchSpin(a);
        })

        $('#heureevent-input').timepicker({
            minuteStep: 1,
            template: 'dropdown',
            appendWidgetTo: '#heureevent',
            showSeconds: false,
            showMeridian: false,
            defaultTime: 'current',
            icons: { up: "mdi mdi-chevron-up", down: "mdi mdi-chevron-down" }
        });

        $('#paiement').on('change', (e) => {
            if ($(e.target).is(':checked')) {
                $('#event-prix-block').show();
                $('input[name="prix"]').val('');
            } else {
                $('input[name="prix"]').val('');
                $('#event-prix-block').hide();
            }
        });
        
    });
</script>
@endsection