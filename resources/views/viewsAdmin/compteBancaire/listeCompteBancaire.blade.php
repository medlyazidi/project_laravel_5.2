@extends('adminNew')

<?php
    include public_path().'/traduction.php';
?>

@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $nomCompteBancaire !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $nomCompteBancaire !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <div class="ibox-tools">

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createBanque">
                            {!! $ajouteBancaire !!}
                        </button>


                        <div class="modal inmodal" id="createBanque" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $ajouteBancaire !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('ajouterBanque') !!} class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $nomBanque !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="libelle_banque" type="text" class="form-control">
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="form-horizontal"  >
                        @foreach($banques as $banque)
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <h2>{!! $banque->libelle_banque !!}</h2></br>
                                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditBanque{!! $banque->id_banque !!}">{!! $modifier !!} <i class="fa fa-gear"></i> </button>
                                    <button class="btn btn-xs btn-danger delete-demmo-LigneB" value="myformBanqueBdelete{!! $banque->id_banque  !!}">{!! $supprimer !!} <i class="fa fa-close"></i> </button>
                                    <form id="myformBanqueBdelete{!! $banque->id_banque !!}" action="{!! route('deleteBanque') !!}" style="display: none">
                                        {{ csrf_field() }}
                                        <input name="id_banque" type="hidden" class="form-control" value="{!! $banque->id_banque !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </label>
                                <div class="col-sm-offset-1 col-sm-7">
                                    <ul >
                                        <?php $var = 0;  ?>
                                        @foreach($comptes as $key => $compte)
                                            @if($compte->id_banque== $banque->id_banque )
                                                <?php $var++;  ?>
                                                <div class="row">
                                                    <li>
                                                        <h3 style="display: inline-block;" class="col-lg-4">{!! $var !!} - {!! $compte->numero_banque !!}</h3> :

                                                        <button type="submit" data-toggle="modal" data-target="#modalEditCompte{!! $compte->id_compte !!}" class="btn btn-xs btn-outline btn-warning">{!! $modifier !!} <i class="fa fa-gear"></i> </button> ||

                                                        <button style="display: inline-block;" value="myformLigneB{!! $compte->id_compte !!}" class="btn btn-xs btn-outline btn-danger delete-demmo">{!! $supprimer !!} <i class="fa fa-close"></i></button>
                                                        <form id="myformLigneB{!! $compte->id_compte !!}" action="{!! route('deleteCompte') !!}" style="display: none" >
                                                            {{ csrf_field() }}
                                                            <input name="id_compte" type="hidden" class="form-control" value="{!! $compte->id_compte !!}">
                                                            <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                                        </form>
                                                    </li>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($var == 0)
                                            <h5 style="display: inline-block;" class="col-lg-6">{!! $yaPasCompte !!}</h5>
                                        @endif

                                    </ul>
                                    <ul style="list-style-type:none;">
                                        <li>
                                            <button class="btn btn-sm btn-outline btn-primary" data-toggle="modal" data-target="#modalAddCompte{!! $banque->id_banque !!}">{!! $ajouteCompte !!}<i class="fa fa-plus-circle"></i></button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        @endforeach

                    </div>
                </div>


                @foreach($banques as $banque)
                    <div class="modal inmodal" id="modalAddCompte{!! $banque->id_banque !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouteCompte !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('ajouterCompte') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $banque->id_banque !!}" name="id_banque">
                                            <input type="hidden" value="0" name="somme_compte">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $numeroBanque !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="numero_banque"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomCompte !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="nom_banque"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $signataire !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="sugnataire"  type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomBanque !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $banque->libelle_banque !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $dateAjout !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateAjout" type="text" class="form-control" value="{!! date('Y/m/d');  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $dateOuvrageCompte !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateOuvrageCompte" type="text" class="form-control" value="{!! date('Y/m/d');  !!}">
                                                    </div>
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
                    <div class="modal inmodal" id="modalEditBanque{!! $banque->id_banque !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierBanque !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action="{!! route('editBanque') !!}" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><input name="id_banque" type="hidden" value="{!! $banque->id_banque !!}"></div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomBanque !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_banque" value="{!! $banque->libelle_banque !!}" type="text" class="form-control">
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
                        </div>
                    </div>
                @endforeach


                @foreach($comptes as $compte)
                    <div class="modal inmodal" id="modalEditCompte{!! $compte->id_compte !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifier_compte !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editCompte') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $compte->id_compte !!}" name="id_compte">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $numeroBanque !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="numero_banque" value="{!! $compte->numero_banque !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomBanque !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="nom_banque" value="{!! $compte->nom_banque !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $signataire !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="sugnataire" value="{!! $compte->sugnataire !!}"  type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $date_ajout_compte !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateAjout" type="date" class="form-control" value="{!! date('Y/m/d');  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $dateOuvrageCompte !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateOuvrageCompte" type="date" class="form-control" value="{!! date('Y/m/d');  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $banque_var !!}</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $compte->libelle_banque !!}" class="form-control">
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

            $('.delete-demmo-LigneB').click(function () {
                var idForm = "#" + $(this).val();

                swal({
                        title: "{!! $sur_supp !!}",
                        text: "{!! $msg_supp !!}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! $yes !!}, {!! $do_supp !!}",
                        cancelButtonText: "{!! $non !!}, {!! $not_supp !!}",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("{!! $do_supp_after !!}!", "{!! $do_supp_nice !!}.", "success");
                            $(idForm).submit();
                        } else {
                            swal("{!! $not_supp_after !!}", "{!! $not_supp_after2 !!}", "error");
                        }
                    });
            });
            $('.delete-demmo').click(function () {
                var idForm = "#" + $(this).val();

                swal({
                        title: "{!! $sur_supp !!}",
                        text: "{!! $msg_supp !!}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! $yes !!}, {!! $do_supp !!}",
                        cancelButtonText: "{!! $non !!}, {!! $not_supp !!}",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("{!! $do_supp_after !!}!", "{!! $do_supp_nice !!}.", "success");
                            $(idForm).submit();
                        } else {
                            swal("{!! $not_supp_after !!}", "{!! $not_supp_after2 !!}", "error");
                        }
                    });
            });
        });
    </script>
@endsection