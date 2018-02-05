@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $type_ressource_var !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $type_ressource_var !!}</strong>
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

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal4">
                            {!! $ajouter_type_resource!!}
                        </button>

                        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $ajouter_type_resource !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action="{!! route('addTypeRessource') !!}" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-2 control-label">{!! $type_ressource_one !!}</label>

                                                    <div class="col-sm-10"><input name="libelle_type_ressouurce" dir="rtl" type="text" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-2">
                                                        <button class="btn btn-primary" type="submit"><?php echo $save; ?></button>
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
                    <<input type="text" class="form-control input-sm m-b-xs" id="filter"
                            placeholder="{!! $recherche !!}" dir="rtl" >

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $type_ressource_var !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($type_ressources as $key => $type_ressource)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalTypeRessourceEdit{!! $type_ressource->id_type_ressouurce  !!}"><i class="fa fa-pencil"></i> {!! $modifier !!} </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myform{!! $type_ressource->id_type_ressouurce  !!}" ><i class="fa fa-trash"></i> {!! $supprimer !!} </button>
                                    <form id="myform{!! $type_ressource->id_type_ressouurce  !!}" action="{!! route('deleteTypeRessource') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_type_ressouurce" type="hidden" class="form-control" value="{!! $type_ressource->id_type_ressouurce  !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </td>
                                <td ><h4>{!! $type_ressource->libelle_type_ressouurce !!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>

                            <td>

                            </td>


                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($type_ressources as $type_ressource)
                    <div class="modal inmodal" id="modalTypeRessourceEdit{!! $type_ressource->id_type_ressouurce  !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierTypeDepute !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editTypeRessource') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><label class="col-sm-2 control-label">solde</label>
                                                <input name="id_type_ressouurce" value="{!! $type_ressource->id_type_ressouurce !!}" type="hidden">
                                                <div class="col-sm-10"><input name="libelle_type_ressouurce" type="text"  class="form-control" value="{!! $type_ressource->libelle_type_ressouurce !!}"></div>
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