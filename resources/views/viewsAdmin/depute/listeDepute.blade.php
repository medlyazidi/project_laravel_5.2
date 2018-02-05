@extends('adminNew')
<?php
    include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $depute !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $depute !!}</strong>
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
                        <!-- data-toggle="modal" data-target="#myModal4" -->
                        <a href="{!! route('ajouterDepute') !!}"><button type="button" class="btn btn-primary btn-xs">
                            {!! $ajouteDepute !!}
                        </button></a>

                    </div>
                </div>

                <div class="ibox-content">
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="{!! $recherche !!}" dir="rtl" >

                    <table class="footable table table-stripped" data-page-size="50" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $local_var !!}</th>
                            <th>{!! $telephone !!}</th>
                            <th>{!! $email !!}</th>
                            <th>{!! $prenom !!}</th>
                            <th>{!! $nom !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deputes as $key => $depute)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDeputeView{!! $depute->id_depute !!}"><i class="fa fa-folder"></i> فحص </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDeputeEdit{!! $depute->id_depute !!}"><i class="fa fa-pencil"></i> تعديل </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myformLocal{!! $depute->id_depute !!}"><i class="fa fa-trash"></i> مسح </button>

                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalPlusTypeDepute{!! $depute->id_depute !!}"><i class="fa fa-plus"></i> زيادة مهام </button>
                                    <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#modalTypeDeputeListe{!! $depute->id_depute !!}"><i class="fa fa-folder"></i> مهام </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDeputeImgEdit{!! $depute->id_depute !!}"><i class="fa fa-pencil"></i> {!! $photo_edit !!} </button>

                                    <form id="myformLocal{!! $depute->id_depute !!}" action="{!! route('deleteDepute') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id_depute" type="hidden" class="form-control" value="{!! $depute->id_depute !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </td>
                                <td ><h4>{!! $depute->libelle_local!!}</h4></td>
                                <td ><h4>{!! $depute->telephone!!}</h4></td>
                                <td ><h4>{!! $depute->email!!}</h4></td>
                                <td ><h4>{!! $depute->prenom!!}</h4></td>
                                <td ><h4>{!! $depute->nom!!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="12">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($deputes as $depute)
                    <div class="modal inmodal" id="modalDeputeEdit{!! $depute->id_depute !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $modifierDepute !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="get" action={!! route('editDepute') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $depute->id_depute !!}" name="id_depute">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nom !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="nom" value="{!! $depute->nom !!}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $prenom !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="prenom" value="{!! $depute->prenom !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $sexe !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b" name="sexe">
                                                        <option> {!! $select !!}</option>
                                                        <option value="{!! $monsieur !!}" {!! $depute->sexe == $monsieur ? 'selected="selected"' : '' !!}>{!! $monsieur !!}</option>
                                                        <option value="{!! $madame !!}" {!! $depute->sexe == $madame ? 'selected="selected"' : '' !!}>{!! $madame !!}</option>
                                                        <option value="{!! $mademoiselle !!}" {!! $depute->sexe == $mademoiselle ? 'selected="selected"' : '' !!}>{!! $mademoiselle !!}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $email !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="email" value="{!! $depute->email !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $telephone !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="telephone" value="{!! $depute->telephone !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $dateDebutMandat !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateDebutMandat" type="date" class="form-control" value="{!! $depute->dateDebutMandat  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $dateFinMandat !!} :</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="dateFinMandat" type="date" class="form-control" value="{!! $depute->dateFinMandat  !!}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $local_var !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b" name="id_local">
                                                        @foreach($locals as $local)
                                                            @if($depute->id_local == $local->id_local)
                                                                <option value="{!! $local->id_local !!}" selected>{!! $local->libelle_local !!}</option>
                                                            @else
                                                                <option value="{!! $local->id_local !!}">{!! $local->libelle_local !!}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
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
                    <div class="modal inmodal" id="modalDeputeView{!! $depute->id_depute !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="contact-box center-version">

                                    <a href="profile.html">

                                        <img alt="image" class="img-circle" src="{!! URL::asset($depute->photo) !!}" onerror="this.src='{!! asset('admin/img/avatar.jpg') !!}'" >


                                        <h3 class="m-b-xs"><strong>{!! $depute->sexe !!} {!! $depute->nom !!} {!! $depute->prenom !!} </strong></h3>


                                        <div class="font-bold">{!! $depute->libelle_local!!}</div>
                                        <address class="m-t-md">
                                            {!! $depute->email !!}<strong> : {!! $email !!}</strong><br>
                                            <strong>{!! $telephone !!}:</strong> {!! $depute->telephone !!}<br>
                                            <strong>{!! $debut !!} {!! $mondat !!} :</strong> {!! $depute->dateDebutMandat !!}<br>
                                            <strong>{!! $fin !!} {!! $mondat !!} :</strong> {!! $depute->dateFinMandat !!}<br>

                                        </address>

                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalPlusTypeDepute{!! $depute->id_depute !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" dir="rtl">{!! $ajouteTypeDepute !!} : {!! $depute->nom !!} </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('addTypeToDepute') !!} class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $depute->id_depute !!}" name="id_depute">

                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $nomTypedepute !!} :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control m-b" name="id_typeDepute" required>
                                                        @foreach($typeDeputes as $typeDepute)
                                                            <option value="{!! $typeDepute->id_typeDepute !!}">{!! $typeDepute->libelle_typeDepute !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $date_debut !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="date_debut"  type="date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $date_fin !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="date_fin"   type="date" class="form-control">
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
                    <div class="modal inmodal" id="modalTypeDeputeListe{!! $depute->id_depute !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" dir="rtl">{!! $liste_type_depute !!} : {!! $depute->nom !!} {!! $depute->prenom !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <div class="form-horizontal">
                                            @foreach($unios as $unio)
                                                @foreach($typeDeputes as $typeDepute)
                                                    @if(($typeDepute->id_typeDepute == $unio->id_typeDepute) && ($depute->id_depute == $unio->id_depute))
                                                        <div class="form-group" dir="rtl">

                                                            <label class="col-sm-3 control-label">{!! $to !!} :{!! $unio->date_fin !!}  </label>
                                                            <label class="col-sm-3 control-label">{!! $from !!} :{!! $unio->date_debut !!}</label>
                                                            <label class="col-sm-3 control-label">{!! $typeDepute->libelle_typeDepute !!}</label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-danger btn-sm delete-demmo" value="myformUnio{!! $unio->id_union_depute_type !!}"><i class="fa fa-trash"></i> مسح </button>
                                                            </div>
                                                        </div>
                                                        <form id="myformUnio{!! $unio->id_union_depute_type !!}" action="{!! route('deleteUnion') !!}" style="display: none" >
                                                            {{ csrf_field() }}
                                                            <input name="id_union_depute_type" type="hidden" class="form-control" value="{!! $unio->id_union_depute_type !!}">
                                                            <button class="btn btn-default demoTest">Delete</button>
                                                        </form>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="modalDeputeImgEdit{!! $depute->id_depute !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $photo_edit !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editDeputeImg') !!}  class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $depute->id_depute !!}" name="id_depute">


                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $photo !!} :</label>

                                                <div class="col-sm-8">
                                                    <input name="image" type="file" class="form-control">
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

            @if(!empty($exceptionEditDep)) toastr.error("{!! $msg_attetion_edit !!}", "{!! $attention !!}"); @endif
        });
    </script>

@endsection