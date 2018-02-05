@extends('adminTwo')

@section('head')
    <div class="col-sm-4">
        <h2>Gestion des utilisateurs</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Acceuil </a>
            </li>
            <li class="active">
                <strong>Ajouter un utilisateur</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All projects assigned to this account</h5>
                    <div class="ibox-tools">

                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createUser1">
                            Creer un nouveau users
                        </button>


                        <div class="modal inmodal" id="createUser1" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Ajouter Utilisauer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('addUser') !!} class="form-horizontal" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="form-group"><label class="col-sm-4 control-label">Nom :</label>
                                                    <div class="col-sm-8"><input name="nom" type="text" class="form-control"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">Prenom :</label>
                                                    <div class="col-sm-8"><input name="prenom" type="text" class="form-control"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">Email :</label>
                                                    <div class="col-sm-8"><input name="email" type="email" class="form-control"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">Password :</label>
                                                    <div class="col-sm-8"><input name="password" type="password" class="form-control"></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">Role :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control m-b" name="id_role">
                                                            @foreach($roles as $role)
                                                                <option value={!! $role->id_role !!}>{!! $role->nom_role !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Photo :</label>
                                                    <div class="col-sm-8">
                                                        <input name="image" type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Date de Naissance :</label>
                                                    <div class="col-sm-8" >
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" name="date_naissance" class="form-control" value="10/11/2013">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-4">
                                                        <button class="btn btn-primary" type="submit">Save</button>
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
                           placeholder="Search in table">

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Date Naissance</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr class="gradeX">
                                <td>{!! $key+1 !!}</td>
                                <td ><h4>{!! $user->nom!!}</h4></td>
                                <td ><h4>{!! $user->prenom!!}</h4></td>
                                <td ><h4>{!! $user->email!!}</h4></td>
                                <td ><h4>{!! $user->date_naissance!!}</h4></td>
                                <td ><h4>{!! $user->nom_role!!}</h4></td>
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

                @foreach($users as $user)
                    <div class="modal inmodal" id="modalUserEdit{!! $user->id !!}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Modifier le User : {!! $user->nom !!}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <form method="post" action={!! route('editUser') !!} class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{!! $user->id !!}" name="id_depute">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Nom :</label>
                                                <div class="col-sm-8">
                                                    <input name="nom" value="{!! $user->nom !!}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Prenom :</label>
                                                <div class="col-sm-8">
                                                    <input name="prenom" value="{!! $user->prenom !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label">Email :</label>
                                                <div class="col-sm-8">
                                                    <input name="email" value="{!! $user->email !!}"  type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Date de Naissance:</label>
                                                <div class="col-sm-8" >
                                                    <div  class="input-group date" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="date_naissance" type="text" class="form-control" value="{!! $user->date_naissance!!}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Mot de passe :</label>
                                                <div class="col-sm-8">
                                                    <input name="password"  type="password" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-primary" type="submit">Save changes</button>
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

                                    <a href="profile.html">

                                        <img alt="image" class="img-circle" src="{!! URL::asset($user->photo) !!}  ">


                                        <h3 class="m-b-xs"><strong>{!! $user->nom !!} {!! $user->prenom !!}</strong></h3>

                                        <div class="font-bold">{!! $user->nom_role !!}</div>
                                        <address class="m-t-md">
                                            <strong>Email:</strong> {!! $user->email !!}<br>
                                            <strong>Date de Naissance:</strong> {!! $user->date_naissance !!}<br>

                                        </address>

                                    </a>
                                    <div class="contact-box-footer">
                                        <div class="m-t-xs btn-group">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                                            <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                                            <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                                        </div>
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
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            $(idForm).submit();
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });


            });
        });
    </script>

@endsection



