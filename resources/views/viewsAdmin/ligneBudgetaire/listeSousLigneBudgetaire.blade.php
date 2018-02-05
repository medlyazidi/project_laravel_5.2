@extends('adminNew')
<?php
    include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $nomSousLignB !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $nomSousLignB !!}</strong>
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
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="form-horizontal"  >
                        @foreach($ssLigneBudgetaires as $ssLigneBudgetaire)
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {!! $ssLigneBudgetaire->libelle_ss_ligneB !!}</br>
                                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalSsEditLign{!! $ssLigneBudgetaire->id_sousLigneBs !!}">{!! $modifier !!} <i class="fa fa-gear"></i> </button>
                                    <button class="btn btn-xs btn-danger delete-demmo-LigneB" value="myformSsLigneBdelete{!! $ssLigneBudgetaire->id_sousLigneBs !!}">{!! $supprimer !!} <i class="fa fa-close"></i> </button>
                                    <form id="myformSsLigneBdelete{!! $ssLigneBudgetaire->id_sousLigneBs !!}" action="{!! route('deleteSsLigneBudgetaire') !!}" style="display: none">
                                        {{ csrf_field() }}
                                        <input name="id_sousLigneBs" type="hidden" class="form-control" value="{!! $ssLigneBudgetaire->id_sousLigneBs !!}">
                                        <input name="typeView" type="hidden" class="form-control" value="true">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </label>
                                <div class="col-sm-9">
                                    <ul style="list-style-type:decimal;">
                                        <?php $var = 0;  ?>
                                        @foreach($ssSSLigneBs as $ssSSLigneB)
                                            @if($ssSSLigneB->id_ss_ligneB == $ssLigneBudgetaire->id_sousLigneBs)
                                                <?php $var++;  ?>
                                                <div class="row">
                                                    <li>
                                                        <h5 style="display: inline-block;" class="col-lg-2">{!! $ssSSLigneB->libelle_ss_ss_ligneB !!}</h5> :

                                                        <button type="submit" data-toggle="modal" data-target="#modalSsSsEditSsLign{!! $ssSSLigneB->id_sousSousligneBs !!}" class="btn btn-xs btn-outline btn-warning">{!! $modifier !!} <i class="fa fa-gear"></i> </button> ||

                                                        <button style="display: inline-block;" value="myformSsLigneB{!! $ssSSLigneB->id_sousSousligneBs !!}" class="btn btn-xs btn-outline btn-danger delete-demmo">{!! $supprimer !!} <i class="fa fa-close"></i></button>
                                                        <form id="myformSsLigneB{!! $ssSSLigneB->id_sousSousligneBs !!}" action="{!! route('deleteSsSsLigneBudgetaire') !!}" style="display: none" >
                                                            {{ csrf_field() }}
                                                            <input name="id_sousSousligneBs" type="hidden" class="form-control" value="{!! $ssSSLigneB->id_sousSousligneBs !!}">
                                                            <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                                        </form>
                                                    </li>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($var == 0)
                                            <h5 style="display: inline-block;" class="col-lg-6">{!! $yaPasSsLign !!}</h5>
                                        @endif

                                    </ul>
                                    <ul style="list-style-type:none;">
                                        <li>
                                            <button class="btn btn-sm btn-outline btn-primary" data-toggle="modal" data-target="#modalAddSsLign{!! $ssLigneBudgetaire->id_sousLigneBs !!}">{!! $ajouterSousSSLigneB !!} <i class="fa fa-plus-circle"></i></button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        @endforeach

                    </div>
                </div>

                @foreach($ssLigneBudgetaires as $ssLigneBudgetaire)
                    <div class="modal inmodal" id="modalAddSsLign{!! $ssLigneBudgetaire->id_sousLigneBs !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouterSousSSLigneB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('postSsSsLigneBudgetaire') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $ssLigneBudgetaire->id_sousLigneBs !!}" name="id_ss_ligneB">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomSousSousLignB !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ss_ss_ligneB"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomSousLignB !!}</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $ssLigneBudgetaire->libelle_ss_ligneB !!}" class="form-control">
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
                    <div class="modal inmodal" id="modalSsEditLign{!! $ssLigneBudgetaire->id_sousLigneBs !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierSSLignB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action="{!! route('editSsLigneBudgetaire') !!}" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><input name="id_sousLigneBs" type="hidden" value="{!! $ssLigneBudgetaire->id_sousLigneBs !!}"></div>
                                            <div class="form-group"><input name="typeView" type="hidden" value="true"></div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomSousLignB !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ss_ligneB" value="{!! $ssLigneBudgetaire->libelle_ss_ligneB !!}" type="text" class="form-control">
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

                @foreach($ssSSLigneBs as $ssSSLigneB)
                    <div class="modal inmodal" id="modalSsSsEditSsLign{!! $ssSSLigneB->id_sousSousligneBs !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierSsSsLignB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editSsSsLigneBudgetaire') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $ssSSLigneB->id_sousSousligneBs !!}" name="id_sousSousligneBs">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomSousSousLignB !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ss_ss_ligneB" value="{!! $ssSSLigneB->libelle_ss_ss_ligneB !!}"  type="text" class="form-control">
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
            $('.delete-demmo-LigneB').click(function () {
                var idForm = "#" + $(this).val();
                //alerte(idForm);


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