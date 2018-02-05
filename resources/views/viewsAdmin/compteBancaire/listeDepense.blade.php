@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $liste_depense !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $liste_depense !!}</strong>
            </li>
        </ol>
    </div>
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">


                <div class="ibox-content">
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="Search in table">

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $nomSousSousLignBM !!}</th>
                            <th>{!! $nomSousLignBM !!}</th>
                            <th>{!! $nomLignBM !!}</th>
                            <th>{!! $nomBanque !!}</th>
                            <th>{!! $montant !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($depenses as $key => $depense)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDepenseView{!! $depense->id_depense  !!}"><i class="fa fa-info"></i> {!! $afficher !!} </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDepenseEdit{!! $depense->id_depense !!}"><i class="fa fa-pencil"></i> {!! $modifier !!} </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myform{!! $depense->id_depense !!}" ><i class="fa fa-trash"></i> {!! $supprimer !!} </button>
                                    <form id="myform{!! $depense->id_depense !!}" action="{!! route('deleteDepense') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_depense" type="hidden" class="form-control" value="{!! $depense->id_depense !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceView{!! $depense->id_depense  !!}"><i class="fa fa-folder"></i> {!! $documents_var !!} </button>
                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceAdd{!! $depense->id_depense !!}"><i class="fa fa-plus"></i> {!! $ajout_docu !!} </button>
                                </td>
                                <td ><h4>{!! $depense->libelle_ss_ss_ligneB !!}</h4></td>
                                <td ><h4>{!! $depense->libelle_ss_ligneB !!}</h4></td>
                                <td ><h4>{!! $depense->libelle_ligneB !!}</h4></td>
                                <td ><h4>{!! $depense->nom_banque !!} </h4></td>
                                <td ><h4>{!! $depense->solde !!} DH</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="50">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($depenses as $depense)
                    <div class="modal inmodal" id="modalDepenseEdit{!! $depense->id_depense !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifier_depesne !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editDepense') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $depense->id_depense !!}" name="id_depense">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">{!! $nomBanque !!} :</label>

                                                <div class="col-lg-8">
                                                    <input type="text" disabled="" placeholder="{!! $depense->nom_banque !!}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $solde !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="solde"  type="number" step="0.01" class="form-control" value="{!! $depense->solde !!}" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $type_operation !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="date_operation"  type="date" value="{!! $depense->date_operation !!}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $numero_cheque !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="num_cheque"  value="{!! $depense->num_cheque !!}" type="text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $classement !!}:</label>
                                                <div class="col-sm-8">
                                                    <input name="calssement" value="{!! $depense->calssement !!}" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                <div class="col-sm-8">
                                                    <textarea name ="descriptif" rows="4" class="form-control" required>{!! $depense->descriptif !!}</textarea>
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
                    <div class="modal inmodal" id="modalDepenseView{!! $depense->id_depense !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $afficher_depense !!} :</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $montant !!} :</label>
                                        <div class="col-sm-5">: {!! $depense->solde !!}</div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomBanque !!} :</label>

                                        <div class="col-sm-5">: {!! $depense->nom_banque !!}</div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomLignBM !!} :</label>
                                        <div class="col-sm-5">: {!! $depense->libelle_ligneB !!}</div>
                                    </div>
                                </div>
                                @if(!empty($depense->libelle_ss_ligneB))
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomSousLignBM !!} :</label>
                                            <div class="col-sm-5">: {!! $depense->libelle_ss_ligneB !!}</div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($depense->libelle_ss_ss_ligneB))
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomSousSousLignBM !!} :</label>
                                            <div class="col-sm-5">: {!! $depense->libelle_ss_ss_ligneB !!}</div>
                                        </div>
                                    </div>
                                @endif

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">{!! $annuler !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalPieceView{!! $depense->id_depense !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $document_depsense !!} :</h4>
                                </div>
                                @if(isset($depense->piece_joint))
                                    @foreach($depense->piece_joint as $item)
                                        <div class="modal-body">
                                            <?php
                                            $var_file  = substr($item, strpos($item, "admin"));
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-10">
                                                    <a href={{ asset($var_file) }} target="_blank">{!! $item->getFilename() !!}</a>
                                                </label>
                                                <form method="post" action="{!! route('delete_folder') !!}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="path" value="{!! $item->getPathname() !!}">
                                                    <button type="submit">{!! $supprimer !!}</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalPieceAdd{!! $depense->id_depense !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $ajout_docu !!} :</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action={!! route('ajoutPienceJoint') !!} enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" value="{!! $depense->lien !!}" name="lien">
                                            <label class="col-sm-4 control-label">{!! $piece_joint !!}:</label>
                                            <div class="col-sm-8">
                                                <input name="img[]" multiple type="file" class="form-control" required>
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
                //alert(idForm);
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