@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $liste_cotisation !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $liste_cotisation !!}</strong>
            </li>
        </ol>
    </div>
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <form method="post" action={!! route('editCotisation') !!} class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group"><label class="col-sm-4 control-label">{!! $montant !!}</label>
                        <input name="id_cotisation" value="{!! $cotisation->id_cotisation !!}" type="hidden">
                        <div class="col-sm-6"><input name="montant" type="number" step="0.01" class="form-control" value="{!! $cotisation->montant!!}"></div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">{!! $mode_paiement_var !!} :</label>
                        <div class="col-sm-6">
                            <select class="form-control m-b mode_paiement" name="id_mode_paiement">
                                @foreach($mode_paiements as $mode_paiement)
                                    @if($cotisation->id_mode_paiement == $mode_paiement->id_mode_paiement)
                                        <option value="{!! $mode_paiement->id_mode_paiement !!}" selected>{!! $mode_paiement->libelle_mode_paiement !!}</option>
                                    @else
                                        <option value="{!! $mode_paiement->id_mode_paiement !!}">{!! $mode_paiement->libelle_mode_paiement !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">{!! $nomBanque !!} :</label>
                        <div class="col-sm-6"><input name="nom_banque" disabled="" placeholder="{!! $nom_banque_db !!}" class="form-control" type="text"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">{!! $nomDepute !!} :</label>
                        <div class="col-sm-6">
                            <select class="form-control m-b depute selectpicker" name="id_depute" data-live-search="true">
                                @foreach($deputes as $depute)
                                    @if($cotisation->id_depute== $depute->id_depute)
                                        <option value="{!! $depute->id_depute !!}" selected>{!! $depute->nom !!} {!! $depute->prenom !!}</option>
                                    @else
                                        <option value="{!! $depute->id_depute !!}">{!! $depute->nom !!} {!! $depute->prenom !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">{!! $date_reception !!} :</label>
                        <div class="col-sm-6" >
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input required type="date" name="date_reception" id="date_reception" class="form-control" value="{!! $cotisation->date_reception !!}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group date_erncaissment" style="display: none">
                        <label class="col-sm-4 control-label">{!! $date_erncaissment !!} :</label>
                        <div class="col-sm-6" >
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input  type="date" name="date_encaissement" id="date_encaissement" class="form-control" value="{!! $cotisation->date_encaissement !!}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                        <div class="col-sm-6">
                            <textarea name ="descriptif" rows="4" class="form-control" >{!! $cotisation->descriptif !!}</textarea>
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button class="btn btn-primary" type="submit">{!! $save !!}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            //alert($('#date_erncaissment').val());
            //if($('#date_erncaissment').val())
            if($('.mode_paiement').val() == 1) {
                $('.date_erncaissment').show();
            }


            $('.mode_paiement').change(function(){
                var value = $(this).val();

                var test = 1;
                if(value == test)
                    $('.date_erncaissment').show();
                else{
                    //$('#date_encaissement').val($('#date_reception').val());

                    $('.date_erncaissment').hide();

                }

            });

        });
    </script>

@endsection