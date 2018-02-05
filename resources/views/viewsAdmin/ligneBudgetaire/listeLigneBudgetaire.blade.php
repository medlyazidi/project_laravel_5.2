@extends('adminNew')
<?php
    include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $ligneBud_var !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $ligneBud_var !!}</strong>
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

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createLigneDepute">
                            {!! $ajouterLignB !!}
                        </button>

                        <div class="modal inmodal" id="createLigneDepute" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $ajouterLignB !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action="ajouter" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $nomLignB !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="libelle_ligneB" type="text" class="form-control">
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
                        @foreach($ligneBudgetaires as $budgetaire)
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {!! $budgetaire->libelle_ligneB !!}</br>
                                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditLign{!! $budgetaire->id_ligneBudgetaire !!}">{!! $modifier !!} <i class="fa fa-gear"></i> </button>
                                    <button class="btn btn-xs btn-danger delete-demmo-LigneB" value="myformLigneBdelete{!! $budgetaire->id_ligneBudgetaire !!}">{!! $supprimer !!} <i class="fa fa-close"></i> </button>
                                    <form id="myformLigneBdelete{!! $budgetaire->id_ligneBudgetaire !!}" action="{!! route('deleteLigneBudgetaire') !!}" style="display: none">
                                        {{ csrf_field() }}
                                        <input name="id_ligneBudgetaire" type="hidden" class="form-control" value="{!! $budgetaire->id_ligneBudgetaire !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </label>
                                <div class="col-sm-9">
                                    <ul style="list-style-type:decimal;">
                                            <?php $var = 0;  ?>
                                            @foreach($ssLigneBudgetaires as $ssLigne)
                                                    @if($ssLigne->id_ligneB == $budgetaire->id_ligneBudgetaire)
                                                        <?php $var++;  ?>
                                                            <div class="row">
                                                                <li>
                                                                    <h5 style="display: inline-block;" class="col-lg-2">{!! $ssLigne->libelle_ss_ligneB !!}</h5> :

                                                                    <button type="submit" data-toggle="modal" data-target="#modalEditSsLign{!! $ssLigne->id_sousLigneBs !!}" class="btn btn-xs btn-outline btn-warning">{!! $modifier !!} <i class="fa fa-gear"></i> </button> ||

                                                                    <button style="display: inline-block;" value="myformLigneB{!! $ssLigne->id_sousLigneBs !!}" class="btn btn-xs btn-outline btn-danger delete-demmo">{!! $supprimer !!} <i class="fa fa-close"></i></button> ||
                                                                    <form  action="{!! route('listSsLigneBudgetaire') !!}" style="display: inline-block;">
                                                                        {{ csrf_field() }}
                                                                        <input name="id_sousLigneBs" type="hidden" class="form-control" value="{!! $ssLigne->id_sousLigneBs !!}">
                                                                        <button style="display: inline-block;" value="myformLigneB{!! $ssLigne->id_sousLigneBs !!}" class="btn btn-xs btn-outline btn-success">{!! $afficher !!} <i class="fa fa-folder"></i></button>
                                                                    </form>
                                                                    <form id="myformLigneB{!! $ssLigne->id_sousLigneBs !!}" action="{!! route('deleteSsLigneBudgetaire') !!}" style="display: none" >
                                                                        {{ csrf_field() }}
                                                                        <input name="id_sousLigneBs" type="hidden" class="form-control" value="{!! $ssLigne->id_sousLigneBs !!}">
                                                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                                                    </form>
                                                                </li>
                                                            </div>
                                                    @endif
                                            @endforeach
                                            @if($var == 0)
                                                    <h5 style="display: inline-block;" class="col-lg-6">{!! $yaPasLign !!}</h5>
                                            @endif

                                    </ul>
                                    <ul style="list-style-type:none;">
                                        <li>
                                                <button class="btn btn-sm btn-outline btn-primary" data-toggle="modal" data-target="#modalAddSsLign{!! $budgetaire->id_ligneBudgetaire !!}">{!! $ajouterSousLigneB !!} <i class="fa fa-plus-circle"></i></button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        @endforeach

                    </div>
                </div>
                <div class="form-group" dir="rtl">{{ $ligneBudgetaires->links() }}</div>
                @foreach($ligneBudgetaires as $budgetaire)
                    <div class="modal inmodal" id="modalAddSsLign{!! $budgetaire->id_ligneBudgetaire !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouter_sous_ligneB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('postSsLigneBudgetaire') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $budgetaire->id_ligneBudgetaire !!}" name="id_ligneB">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomSousLignB !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ss_ligneB"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomLignB !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $budgetaire->libelle_ligneB !!}" class="form-control">
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
                    <div class="modal inmodal" id="modalEditLign{!! $budgetaire->id_ligneBudgetaire !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierLignB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action="{!! route('editLigneBudgetaire') !!}" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><input name="id_ligneBudgetaire" type="hidden" value="{!! $budgetaire->id_ligneBudgetaire !!}"></div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomLignB !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ligneB" dir="rtl" value="{!! $budgetaire->libelle_ligneB !!}" type="text" class="form-control">
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

                @foreach($ssLigneBudgetaires as $ssLigne)
                    <div class="modal inmodal" id="modalEditSsLign{!! $ssLigne->id_sousLigneBs !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajouterSousLigneB !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editSsLigneBudgetaire') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $ssLigne->id_sousLigneBs !!}" name="id_sousLigneBs">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nomSousLignB !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="libelle_ss_ligneB" value="{!! $ssLigne->libelle_ss_ligneB !!}"  type="text" class="form-control">
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