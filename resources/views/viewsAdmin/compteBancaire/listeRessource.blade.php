@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $liste_ressource !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $liste_ressource !!}</strong>
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
                            <th>{!! $nomBanque !!}</th>
                            <th>{!! $date !!}</th>
                            <th>{!! $type_ressource_one !!}</th>
                            <th>{!! $montant !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($ressources as $key => $ressource)
                                <tr class="gradeX">
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalRessourceView{!! $ressource->id_ressource  !!}"><i class="fa fa-info"></i> {!! $afficher !!} </button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalRessourceEdit{!! $ressource->id_ressource !!}"><i class="fa fa-pencil"></i> {!! $modifier !!} </button>
                                        <button class="btn btn-danger btn-sm delete-demmo" value="myform{!! $ressource->id_ressource !!}" ><i class="fa fa-trash"></i> {!! $supprimer !!} </button>
                                        <form id="myform{!! $ressource->id_ressource !!}" action="{!! route('deleteRessource') !!}" style="display: none" >
                                            {{ csrf_field() }}
                                            <input name="id_ressource" type="hidden" class="form-control" value="{!! $ressource->id_ressource !!}">
                                            <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                        </form>
                                        <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceView{!! $ressource->id_ressource  !!}"><i class="fa fa-folder"></i> {!! $documents_var !!} </button>
                                        <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceAdd{!! $ressource->id_ressource !!}"><i class="fa fa-plus"></i> {!! $ajout_docu !!} </button>
                                    </td>
                                    <td ><h4>{!! $ressource->nom_banque !!} DH</h4></td>
                                    <td ><h4>{!! $ressource->date !!}</h4></td>
                                    <td ><h4>{!! $ressource->libelle_type_ressouurce !!}</h4></td>
                                    <td ><h4>{!! $ressource->montant !!}</h4></td>
                                    <td>{!! $key+1 !!}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tfoot>
                        <tr>
                            <td colspan="50">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                        </tfoot>
                    </table>
                </div>
                    @foreach($ressources as $ressource)
                        <div class="modal inmodal" id="modalRessourceEdit{!! $ressource->id_ressource !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $modifier_depesne !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('editRessource') !!} class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $montant !!} :</label>
                                                    <input name="id_ressource" value="{!! $ressource->id_ressource!!}" type="hidden">
                                                    <div class="col-sm-8"><input name="montant" type="number" step="0.01" class="form-control" value="{!! $ressource->montant!!}"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $nomBanque !!} :</label>
                                                    <div class="col-sm-8"><input name="nom_banque" disabled="" placeholder="{!! $ressource->nom_banque !!}" class="form-control" type="text"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $type_ressource_one !!} :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control m-b" name="id_type_ressouurce">
                                                            @foreach($type_ressources as $type_ressource)
                                                                @if($ressource->id_type_ressouurce == $type_ressource->id_type_ressouurce)
                                                                    <option value="{!! $type_ressource->id_type_ressouurce !!}" selected>{!! $type_ressource->libelle_type_ressouurce !!}</option>
                                                                @else
                                                                    <option value="{!! $type_ressource->id_type_ressouurce !!}">{!! $type_ressource->libelle_type_ressouurce !!}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $type_operation !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="date"  type="date" value="{!! $ressource->date !!}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                    <div class="col-sm-8">
                                                        <textarea name ="descriptif" rows="4" class="form-control" required>{!! $ressource->descriptif !!}</textarea>
                                                    </div>
                                                </div>


                                                <div class="hr-line-dashed"></div>
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
                        <div class="modal inmodal" id="modalRessourceView{!! $ressource->id_ressource !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $afficher_ressource !!} :</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $montant !!}</label>
                                            <div class="col-sm-5">: {!! $ressource->montant !!}</div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $type_ressource_one !!} :</label>
                                            <div class="col-sm-5">: {!! $ressource->libelle_type_ressouurce !!}</div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $date !!} :</label>
                                            <div class="col-sm-5">: {!! $ressource->date !!}</div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomBanque !!}</label>

                                            <div class="col-sm-5">: {!! $ressource->nom_banque !!}</div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">{!! $annuler !!}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="modalPieceView{!! $ressource->id_ressource !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $document_depsense !!} :</h4>
                                    </div>
                                    @foreach($files as $item)
                                        @if($item->id_file == $ressource->id_ressource)
                                            @foreach($item->piece_joint as $file)
                                                <div class="modal-body">
                                                    <?php
                                                    $var_file  = substr($file, strpos($file, "admin"));
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-10">
                                                            <a href={{ asset($var_file) }} target="_blank">{!! $file->getFilename() !!}</a>
                                                        </label>
                                                        <form method="post" action="{!! route('delete_folder') !!}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="path" value="{!! $file->getPathname() !!}">
                                                            <button type="submit">{!! $supprimer !!}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="modalPieceAdd{!! $ressource->id_ressource !!}" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                            <input type="hidden" value="{!! $ressource->lien !!}" name="lien">
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