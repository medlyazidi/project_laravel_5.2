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


                <div class="ibox-content">
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="Search in table">

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $nomBanque !!}</th>
                            <th>{!! $nomDepute !!} </th>
                            <th>{!! $mode_paiement_var !!}</th>
                            <th>{!! $date_reception !!}</th>
                            <th>{!! $montant !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cotisations as $key => $cotisation)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCotisatioView{!! $cotisation->id_cotisation  !!}"><i class="fa fa-info"></i> {!! $afficher !!} </button>
                                    <a href={!! route('getEditCotisation').'?id_cotisation='.$cotisation->id_cotisation !!}><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalCotisationEdit{!! $cotisation->id_cotisation  !!}"><i class="fa fa-pencil"></i> {!! $modifier !!} </button></a>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myform{!! $cotisation->id_cotisation  !!}" ><i class="fa fa-trash"></i> {!! $supprimer !!} </button>
                                    <form id="myform{!! $cotisation->id_cotisation  !!}" action="{!! route('deleteCotisation') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_cotisation" type="hidden" class="form-control" value="{!! $cotisation->id_cotisation  !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceView{!! $cotisation->id_cotisation  !!}"><i class="fa fa-folder"></i> {!! $documents_var !!} </button>
                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPieceAdd{!! $cotisation->id_cotisation !!}"><i class="fa fa-plus"></i> {!! $ajout_docu !!} </button>
                                </td>
                                <td ><h4>{!! $cotisation->nom_banque !!} DH</h4></td>
                                <td ><h4>{!! $cotisation->nom !!} {!! $cotisation->prenom !!}</h4></td>
                                <td ><h4>{!! $cotisation->libelle_mode_paiement !!}</h4></td>
                                <td ><h4>{!! $cotisation->date_reception !!}</h4></td>
                                <td ><h4>{!! $cotisation->montant !!}</h4></td>
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

                @foreach($cotisations as $cotisation)
                    <div class="modal inmodal" id="modalCotisationEdit{!! $cotisation->id_cotisation!!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifier_cotisation !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editCotisation') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $montant !!}</label>
                                                <input name="id_cotisation" value="{!! $cotisation->id_cotisation !!}" type="hidden">
                                                <div class="col-sm-8"><input name="montant" type="number" step="0.01" class="form-control" value="{!! $cotisation->montant!!}"></div>
                                            </div>

                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $mode_paiement_var !!} :</label>
                                                <div class="col-sm-8">
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
                                                <div class="col-sm-8"><input name="nom_banque" disabled="" placeholder="{!! $cotisation->nom_banque !!}" class="form-control" type="text"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $nomDepute !!} :</label>
                                                <div class="col-sm-8">
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
                                                <div class="col-sm-8" >
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input required type="date" name="date_reception" class="form-control" value="{!! $cotisation->date_reception !!}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group date_erncaissment" style="display: none">
                                                <label class="col-sm-4 control-label">{!! $date_erncaissment !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input  type="date" name="date_encaissement" class="form-control" value="{!! $cotisation->date_encaissement !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $detail !!} :</label>
                                                <div class="col-sm-8">
                                                    <textarea name ="descriptif" rows="4" class="form-control" >{!! $cotisation->descriptif !!}</textarea>
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
                    <div class="modal inmodal" id="modalCotisatioView{!! $cotisation->id_cotisation !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $afficher_cotisation !!} :</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $montant !!} :</label>

                                        <div class="col-sm-5">: {!! $cotisation->montant !!}</div>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $mode_paiement_var !!} </label>

                                        <div class="col-sm-5">
                                            @foreach($mode_paiements as $mode_paiement)
                                                @if($cotisation->id_mode_paiement == $mode_paiement->id_mode_paiement)
                                                    : {!! $var =  $mode_paiement->libelle_mode_paiement !!}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $date_reception !!} :</label>

                                        <div class="col-sm-5">: {!! $cotisation->date_reception !!}</div>
                                    </div>
                                </div>
                                @if($var == "chèque ")
                                    <div class="modal-body">
                                        <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $date_erncaissment !!} :</label>

                                            <div class="col-sm-5">: {!! $cotisation->date_encaissement !!}</div>
                                        </div>
                                    </div>
                                @endif
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomBanque !!}</label>

                                        <div class="col-sm-5">: {!! $cotisation->nom_banque !!}</div>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-4 col-sm-offset-2">{!! $nomDepute !!}</label>

                                        <div class="col-sm-5">
                                            @foreach($deputes as $depute)
                                                @if($cotisation->id_depute== $depute->id_depute)
                                                    : {!! $depute->nom !!} {!! $depute->prenom !!}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">{!! $annuler !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalPieceView{!! $cotisation->id_cotisation !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $document_depsense !!} :</h4>
                                </div>
                                @foreach($files as $item)
                                    @if($item->id_file == $cotisation->id_cotisation)
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
                    <div class="modal inmodal" id="modalPieceAdd{!! $cotisation->id_cotisation !!}" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                            <input type="hidden" value="{!! $cotisation->lien !!}" name="lien">
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

            /*
            if($('.mode_paiement').val() == 1)
                $('.date_erncaissment').show();
            */
            $('.mode_paiement').change(function(){
                var value = $(this).val();

                var test = 1;
                if(value == test)
                    $('.date_erncaissment').show();
                else{
                    $('.date_erncaissment').hide();
                }

            });

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