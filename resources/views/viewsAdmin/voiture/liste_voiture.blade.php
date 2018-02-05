@extends('adminNew')
<?php
    include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $voiture_var !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $voiture_var !!}</strong>
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

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createTypeDepute">
                            {!! $ajouter_voiture !!}
                        </button>

                        <div class="modal inmodal" id="createTypeDepute" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $ajouter_voiture !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action="ajouter" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-3 control-label">{!! $marque !!}</label>

                                                    <div class="col-sm-7"><input name="marque" type="text" class="form-control" required></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-3 control-label">{!! $matricule !!}</label>

                                                    <div class="col-sm-7"><input name="matricule" type="text"  class="form-control" required></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-3 control-label">{!! $date_assurance !!}</label>

                                                    <div class="col-sm-7"><input name="date_prochaine_assurance" type="date"  class="form-control" required></div>
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
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="{!! $recherche !!}" dir="rtl" >

                    <table class="footable table table-stripped" data-page-size="50" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $date_assurance !!}</th>
                            <th>{!! $matricule !!}</th>
                            <th>{!! $marque !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($voitures as $key => $voiture)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalVoitureEdit{!! $voiture->id_voiture !!}"><i class="fa fa-pencil"></i> {!! $modifier !!} </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myform{!! $voiture->id_voiture !!}" ><i class="fa fa-trash"></i> {!! $supprimer !!} </button>
                                    <form id="myform{!! $voiture->id_voiture !!}" action="{!! route('deleteVoiture') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_voiture" type="hidden" class="form-control" value="{!! $voiture->id_voiture !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </td>
                                <td>{!! $voiture->date_prochaine_assurance !!}</td>
                                <td ><h4>{!! $voiture->marque !!} </h4></td>
                                <td ><h4>{!! $voiture->matricule !!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="15">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($voitures as $voiture)
                    <div class="modal inmodal" id="modalVoitureEdit{!! $voiture->id_voiture !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modif_voiture !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="get" action={!! route('editVoiture') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><label class="col-sm-2 control-label">{!! $marque !!}</label>
                                                <input name="id_voiture" value="{!! $voiture->id_voiture !!}" type="hidden">
                                                <div class="col-sm-10"><input name="marque" type="text" class="form-control" value="{!! $voiture->marque !!}" required></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">{!! $matricule !!}</label>
                                                <div class="col-sm-10"><input name="matricule" type="text"  class="form-control" value="{!! $voiture->matricule !!}" required></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">{!! $date_assurance !!}</label>
                                                <div class="col-sm-10"><input name="date_prochaine_assurance" type="date"  class="form-control" required value="{!! $voiture->date_prochaine_assurance !!}"></div>
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
                    <div class="modal inmodal" id="modalTypeDeputeView{!! $voiture->id_voiture !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $voiture_var !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-2">{!! $nomTypedepute !!}</label>

                                        <div class="col-sm-7">{!! $voiture->marque !!}</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">{!! $annuler !!}</button>
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


