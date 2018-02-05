@extends('adminNew')

<?php
include public_path().'/traduction.php';
?>

@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $depense !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $depense !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">



                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget style1">
                                @foreach($comptes as $compte)
                                    <div class="row">
                                        <div class="col-lg-3 text-left">
                                            <h1>{!! $compte->nom_banque !!}</h1>
                                        </div>

                                        <div class="col-lg-4 text-left">
                                            <h1 class="font-bold">:  {!! number_format($compte->somme_compte,2,","," ")  !!} DH</h1>
                                        </div>
                                        <div class="col-lg-5 text-center">
                                            <h1>
                                                <button data-toggle="modal" type="submit" class="btn btn-primary btn-sm" data-target="#modalDepenseAdd{!! $compte->id_compte !!}" > <h3>{!! $ajouterAgentAuCompte !!} <i class="fa fa-plus"></i> </h3> </button>
                                                || <button data-toggle="modal" class="btn btn-warning btn-sm" data-target="#modalCotisationAdd{!! $compte->id_compte !!}"> <h3>{!! $ajouterCotisation !!} <i class="fa fa-plus"></i></h3> </button>
                                                || <button data-toggle="modal" class="btn btn-info btn-sm" data-target="#modalRessourceAdd{!! $compte->id_compte !!}"> <h3>{!! $ajouterRessource !!} <i class="fa fa-plus"></i></h3></button>

                                            </h1>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                @foreach($comptes as $compte)
                    <div class="modal inmodal" id="modalDepenseAdd{!! $compte->id_compte !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouterAgentAuCompte !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('depenseAg') !!} enctype="multipart/form-data" class="form-horizontal">
                                            {{ csrf_field() }}

                                            <input type="hidden" value="{!! $compte->id_compte !!}" name="id_compte">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomBanque !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $compte->nom_banque !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $soldeMnt !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $compte->somme_compte !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $solde !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="solde"  type="number" step="0.01" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $nomLignBM !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b mySelectLign" name="id_ligneB"  required>
                                                        <option  class="optionGroup" value="{!! null !!}">{!! $select !!}</option>
                                                    @foreach($ligneBudgetaires as $ligneBudgetaire)
                                                            <option value="{!! $ligneBudgetaire->id_ligneBudgetaire !!}" class="optionGroup">{!! $ligneBudgetaire->libelle_ligneB !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group sousLigne" style="display: none" ><label class="col-sm-4 control-label">{!! $nomSousLignBM !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b mySelectSsLign" name="id_ss_ligneB" >

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group sousSousLigne" style="display: none"><label class="col-sm-4 control-label">{!! $nomSousSousLignBM !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b mySelectSsSsLign" name="id_ss_ss_ligneB" >

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $type_operation !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="date_operation"  type="date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $numero_cheque !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="num_cheque"  type="text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $classement !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="calssement"  type="text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $piece_joint !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="img[]" multiple type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                <div class="col-sm-8">
                                                    <textarea name ="descriptif" rows="4" class="form-control" required>

                                                    </textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-primary" type="submit">{!! $save !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalCotisationAdd{!! $compte->id_compte !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header" style="background-color: #FFFFFF">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouterCotisation !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('ajoutCotisation') !!} enctype="multipart/form-data" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $compte->id_compte !!}" name="id_compte">

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomBanque !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $compte->nom_banque !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $nomDepute !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b depute selectpicker" name="id_depute" data-live-search="true"  required>
                                                        <option  value="{!! null !!}">{!! $select !!}</option>
                                                        @foreach($deputes as $depute)
                                                            <option value="{!! $depute->id_depute !!}" class="optionGroup">{!! $depute->nom!!} {!! $depute->prenom!!} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $mode_paiement !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b mode_paiement" name="id_mode_paiement"  required>
                                                        <option  value="{!! null !!}">{!! $select !!}</option>
                                                        @foreach($mode_paiements as $paiement)
                                                            <option value="{!! $paiement->id_mode_paiement !!}" >{!! $paiement->libelle_mode_paiement!!} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $date_reception !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input required type="date" name="date_reception" class="form-control" value="10/11/2013">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group date_erncaissment" style="display: none">
                                                <label class="col-sm-4 control-label">{!! $date_erncaissment !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input  type="date" name="date_encaissement" class="form-control" value="10/11/2013">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $montant !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="montant"  type="number" step="0.01" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $piece_joint !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="img[]" multiple type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                <div class="col-sm-8">
                                                    <textarea name ="descriptif" rows="4" class="form-control"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-primary" type="submit">{!! $save !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalRessourceAdd{!! $compte->id_compte !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouterRessource !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('ajoutRessource') !!} enctype="multipart/form-data" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $compte->id_compte !!}" name="id_compte">

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomBanque !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $compte->nom_banque !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $type_ressource_one !!}</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b" name="id_type_ressouurce"  required>
                                                        <option  value="{!! null !!}">{!! $select !!}</option>
                                                        @foreach($type_ressources as $type_ressource)
                                                            <option value="{!! $type_ressource->id_type_ressouurce !!}">{!! $type_ressource->libelle_type_ressouurce!!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $date !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input required type="date" name="date" class="form-control" value="10/11/2013">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $montant !!} (DH):</label>
                                                <div class="col-sm-8">
                                                    <input name="montant"  type="number" step="0.01" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $piece_joint !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="img[]" multiple type="file" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                <div class="col-sm-8">
                                                    <textarea name ="descriptif" rows="4" class="form-control" required>

                                                    </textarea>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-primary" type="submit">{!! $save !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach





            </div>
        </div>
    </div>

@endsection

@section('scripts')


    <script>
        $(document).ready(function () {

            $('.mode_paiement').change(function(){
                var value = $(this).val();
                var id = $(this).find(":selected").text();
                var test = "chèque  ";

                if(id == test)
                    $('.date_erncaissment').show();
                else $('.date_erncaissment').hide();

            });


            $('.mySelectLign').change(function(){
                var value = $(this).val();
                var id = $(this).val();
                var text = $('option:selected', this).text(); //to get selected text

                url = '{{route('getSousLigne')}}';
                data = {id_ligneB: value};
                $.ajax({
                    url: url,
                    data: data,
                    type: 'get',
                    datatype: 'JSON',
                    success: function (resp) {
                        $('.mySelectSsLign')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="{!! null !!}">{!! $select !!}</option>');
                        $('.sousSousLigne').hide();
                        $('.sousLigne').show();
                        $.each(resp.sousLigne, function (key, value) {
                            $('.mySelectSsLign').append('<option value="'+ value.id_sousLigneBs+'">' + value.libelle_ss_ligneB +'</option>');
                        });
                    }
                });
            });

            $('.mySelectSsLign').change(function(){
                var value = $(this).val();


                url = '{{route('getSousSousLigne')}}';
                data = {id_ss_ligneB: value};

                $.ajax({
                    url: url,
                    data: data,
                    type: 'get',
                    datatype: 'JSON',
                    success: function (resp) {

                        $('.mySelectSsSsLign')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="{!! null !!}">{!! $select !!}</option>');
                        $('.sousSousLigne').show();

                        $.each(resp.sousSousLigne, function (key, value) {
                            $('.mySelectSsSsLign').append('<option value="'+ value.id_sousSousligneBs+'">' + value.libelle_ss_ss_ligneB +'</option>');
                        });

                    }
                });
            });

            $('.delete-demmo').click(function () {
                var idForm = "#" + $(this).val();
                swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            $(idForm).submit();
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
            });


            $('.delete-demmo-LigneB').click(function () {
                var idForm = "#" + $(this).val();
                swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            $(idForm).submit();
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
            });
        });
    </script>
@endsection