@extends('adminNew')
<?php
    include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $liste_users_var !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $liste_users_var !!}</strong>
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

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createUser1">
                            {!! $ajouter_user !!}
                        </button>


                        <div class="modal inmodal" id="createUser1" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $ajouter_user !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('addUser') !!} class="form-horizontal" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $nom !!} :</label>
                                                    <div class="col-sm-8"><input name="nom" type="text" class="form-control" required></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $prenom !!} :</label>
                                                    <div class="col-sm-8"><input name="prenom" type="text" class="form-control" required></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $email !!} :</label>
                                                    <div class="col-sm-8"><input name="email" type="email" class="form-control" required></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $role_var !!} :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control m-b" name="id_role" required>
                                                            <option   value="{!! null !!}">{!! $select !!}</option>
                                                            @foreach($roles as $role)
                                                                <option value={!! $role->id_role !!}>{!! $role->nom_role !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $photo !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="image" type="file" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!! $password !!} :</label>
                                                    <div class="col-sm-8"><input name="password" id="pwd-user-add" type="password" class="form-control" required></div>
                                                </div>
                                                <div class="col-sm-offset-4">
                                                    <input type="checkbox" id="show-hide-user-add" name="show-hide" value="" />
                                                    <label for="show-hide">{!! $show_password !!}</label>
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

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $role_var !!}</th>
                            <th>{!! $email !!}</th>
                            <th>{!! $prenom !!}</th>
                            <th>{!! $nom !!}</th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($users as $key => $user)
                            <tr class="gradeX">
                                <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUserView{!! $user->id !!}"><i class="fa fa-folder"></i> فحص </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUserEdit{!! $user->id  !!}"><i class="fa fa-pencil"></i> تعديل </button>
                                    <button class="btn btn-danger btn-sm delete-demmo" value="myformLocal{!! $user->id  !!}"><i class="fa fa-trash"></i> مسح </button>
                                    <form id="myformLocal{!! $user->id  !!}" action="{!! route('deleteUser') !!}" style="display: none" >
                                        {{ csrf_field() }}
                                        <input name="id" type="hidden" class="form-control" value="{!! $user->id  !!}">
                                        <button class="btn btn-default demoTest"  id="btn-submit" >Delete</button>
                                    </form>
                                </td>
                                <td ><h4>{!! $user->nom_role!!}</h4></td>
                                <td ><h4>{!! $user->email!!}</h4></td>
                                <td ><h4>{!! $user->prenom!!}</h4></td>
                                <td ><h4>{!! $user->nom!!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="20">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @foreach($users as $user)
                    <div class="modal inmodal" id="modalUserEdit{!! $user->id !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">{!! $user->nom !!} : {!! $modifier_user !!} </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post"  action={!! route('editUser') !!} class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $user->id !!}" name="id_depute">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $nom !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="nom" value="{!! $user->nom !!}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $prenom !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="prenom" value="{!! $user->prenom !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">{!! $email !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="email" value="{!! $user->email !!}"  type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">{!! $password !!} :</label>
                                                <div class="col-sm-8">
                                                    <input name="password" id="pwd-user"  type="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-offset-4">
                                                <input type="checkbox" id="show-hide-user" name="show-hide" value="" />
                                                <label for="show-hide">{!! $show_password !!}</label>
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
                    <div class="modal inmodal" id="modalUserView{!! $user->id !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="contact-box center-version">

                                    <a>
                                        <img alt="image" class="img-circle" src="{!! URL::asset($user->photo) !!}  ">


                                        <h3 class="m-b-xs"><strong>{!! $user->nom !!} {!! $user->prenom !!}</strong></h3>

                                        <div class="font-bold">{!! $user->nom_role !!}</div>
                                        <address class="m-t-md">
                                            <strong>Email:</strong> {!! $user->email !!}<br>
                                        </address>

                                    </a>
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



