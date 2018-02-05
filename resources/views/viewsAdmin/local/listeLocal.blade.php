@extends('adminNew')
<?php
    include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $local_var !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $titre !!}</strong>
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
                              <?php echo $ajouteLocal; ?>
                        </button>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>

                        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title"><?php echo $ajouteLocal; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action="ajouter" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo $nomLocal; ?></label>

                                                    <div class="col-sm-10"><input name="libelle_local" dir="rtl" type="text" class="form-control"></div>
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
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="{!! $recherche !!}" dir="rtl" >

                    <table class="footable table table-stripped" data-page-size="50" data-filter=#filter >
                        <thead>
                        <tr>
                            <th>العمل المطلوب</th>
                            <th>تاريخ الإضافة</th>
                            <th>لائحة الإقتراع</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locals as $key => $local)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalLocalView{!! $local->id_local !!}"><i class="fa fa-folder"></i> فحص </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalLocalEdit{!! $local->id_local !!}"><i class="fa fa-pencil"></i> تعديل </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myformLocal{!! $local->id_local !!}"><i class="fa fa-trash"></i> مسح </button>
                                    <form id="myformLocal{!! $local->id_local !!}" action="{!! route('deleteLocal') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_local" type="hidden" class="form-control" value="{!! $local->id_local !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </td>
                                <td>{!! $local->created_at !!}</td>
                                <td ><h4>{!! $local->libelle_local!!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="15">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($locals as $local)
                    <div class="modal inmodal" id="modalLocalEdit{!! $local->id_local !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierLocal !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="get" action={!! route('editLocal') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group"><label class="col-sm-2 control-label">{!! $nomLocal !!}</label>
                                                <input name="id_local" value="{!! $local->id_local !!}" type="hidden">
                                                <div class="col-sm-10"><input name="libelle_local" dir="rtl" type="text" class="form-control" value="{!! $local->libelle_local !!}"></div>
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
                    <div class="modal inmodal" id="modalLocalView{!! $local->id_local !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title"><?php echo $afficherLocal; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label class="col-sm-2"><?php echo $nomLocal;?></label>

                                        <div class="col-sm-7" dir="rtl">{!! $local->libelle_local !!}</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $annuler;?></button>
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
        });
    </script>

@endsection


