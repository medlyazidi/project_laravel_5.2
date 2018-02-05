<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ميزانية فريق العدالة و التنمية بمجلس النواب</title>

    <link href="{{URL::asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">



    <!-- Gritter -->
    <link href="{{URL::asset('admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{URL::asset('admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

    <link rel="icon" type="image" href="{{URL::asset('admin/img/logo-pjd.png')}}" />

    <!-- Toastr style -->
    <link href="{{URL::asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


    @yield('scripts_head')

</head>

<body >

<div id="wrapper">


    <?php
        include public_path().'\traduction.php';
    ?>



    <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>

                                <div type="button" class="" data-toggle="modal" data-target="#viewUser">
                                    <img alt="image" class="col-lg-6 img-circle " width="100px" height="65px" src="{{URL::asset(Auth::user()->photo)}}" data-target="#createUser" />
                                </div>
                                <div class="modal inmodal" id="viewUser" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="contact-box center-version">

                                                <a>

                                                    <img alt="image1" class="img-circle" src="{{URL::asset(Auth::user()->photo)}}">

                                                    <h3 class="m-b-xs"><strong>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong></h3>

                                                    <address class="m-t-md">
                                                        <strong>Email:</strong> {{ Auth::user()->email }}<br>
                                                        <strong>Date de Naissance:</strong> {{ Auth::user()->date_naissance }}<br>

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
                                <div class="modal inmodal" id="modifyUser" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated fadeIn">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Modifier le User : {!! Auth::user()->nom !!}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ibox-content">
                                                    <form method="post" action={!! route('editUser') !!} class="form-horizontal" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{!! Auth::user()->id !!}" name="id">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Nom :</label>
                                                            <div class="col-sm-8">
                                                                <input name="nom" value="{!! Auth::user()->nom  !!}" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Prenom :</label>
                                                            <div class="col-sm-8">
                                                                <input name="prenom" value="{!! Auth::user()->prenom !!}"  type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label class="col-sm-4 control-label">Email :</label>
                                                            <div class="col-sm-8">
                                                                <input name="email" value="{!! Auth::user()->email !!}"  type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Date de Naissance:</label>
                                                            <div class="col-sm-8" >
                                                                <div  class="input-group date" >
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="date_naissance" type="text" class="form-control" value="{!! Auth::user()->date_naissance!!}">
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
                                <div class="modal inmodal" id="modifyUserImg" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated fadeIn">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Modifier le User Image : {!! Auth::user()->prrenom !!}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ibox-content">
                                                    <form method="post" action={!! route('editUserImage') !!} class="form-horizontal" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{!! Auth::user()->id !!}" name="id">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Photo :</label>
                                                            <div class="col-sm-8">
                                                                <input name="image" type="file" class="form-control">
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

                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong>
                             </span> <span class="text-muted text-xs block">Détail <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a type="button" data-toggle="modal" data-target="#viewUser">Profile</a></li>
                                <li><a type="button" data-toggle="modal" data-target="#modifyUser">Modifier</a></li>
                                <li><a type="button" data-toggle="modal" data-target="#modifyUserImg">Modifier Photo</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('logout') }}">{!! $sortie !!}</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            PJD+
                        </div>
                    </li>
                    <li>
                        <a href={!! route('acc') !!}><i class="fa fa-th-large"></i> <span class="nav-label">لوحة المسير</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href={!! route('listeUser') !!}><i class="fa fa-th-large"></i> <span class="nav-label">المستخدمين</span></a></li>
                            <li><a href="{{route('listTypeDepute')}}"><i class="fa fa-th-large"></i> <span class="nav-label"> مهام النواب</span></a></li>
                            <li><a href="{{route('listLocal')}}"><i class="fa fa-th-large"></i> <span class="nav-label">الدوائر الإنتخابية</span> </a></li>
                            <li><a href="{{route('listTypeRessource')}}"><i class="fa fa-th-large"></i> <span class="nav-label">{!! $type_ressource_var !!}</span></a></li>
                            <li><a href="{{route('listCompteBancaire')}}"><i class="fa fa-th-large"></i> <span class="nav-label">الحسابات البنكية</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{!! route('listDepute') !!}"><i class="fa fa-users"></i> <span class="nav-label">{!! $depute !!}</span></a>
                    </li>
                    <li>
                        <a href="{!! route('listLigneBudgetaire') !!}"><i class="fa fa-bank"></i> <span class="nav-label">بنود الميزانية</span></a>
                    </li>
                    <li>
                        <a href={!! route('acc') !!}><i class="fa fa-bank"></i> <span class="nav-label">الحسابات</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li><a href="{{route('listeDepenses')}}">النفقات، المساهمات و الموارد</a></li>
                            <li><a href="{{route('listeModif')}}">{!! $miseAjour_Bank_titre !!}</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('liste_statistique')}}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label"><h3 style="display: inline-block">احصائيات</h3></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href={!! route('liste_statistique_search').'?date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}>{!! $sous_titre_stat_depu !!}</a>
                            </li>
                            <li>
                                <a href={!! route('list_etat_deux').'?date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}>Etat deux</a>
                            </li>
                            <li>
                                <a href={!! route('etat_depense').'?date_recherche_debut=2010-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}>Etat depense Trois</a>
                            </li>
                            <li>
                                <a href={!! route('etat_depense_ligne_budg').'?date_recherche_debut=2010-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}>Etat depense Budgetaire</a>
                            </li>
                            <li>
                                <a href={!! route('etat_ressource').'?date_recherche_debut=2010-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}>Etat depense Budgetaire</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="mailbox.html" ><i class="fa fa-envelope"></i> <span class="nav-label" id="noty">إشعارات</span><span class="label label-warning pull-right" id="noty_count">16/24</span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="mailbox.html">Inbox</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i><?php echo $sortie;?>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            @yield('head')
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Mohamed Lyazidi &copy; 2014-2015
            </div>
        </div>



    </div>


</div>



<!-- Mainly scripts -->
<script src="{{URL::asset('admin/js/jquery-2.1.1.js')}}"></script>
<script src="{{URL::asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>


<!-- FooTable -->
<script src="{{URL::asset('admin/js/plugins/footable/footable.all.min.js')}}"></script>

<!-- Sweet alert -->
<script src="{{URL::asset('admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>



<!-- Custom and plugin javascript -->
<script src="{{URL::asset('admin/js/inspinia.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/pace/pace.min.js')}}"></script>

<!-- Toastr -->
<script src="{{URL::asset('admin/js/plugins/toastr/toastr.min.js')}}"></script>

<!-- Page-Level Scripts -->
<script>

    $(document).ready(function(){

        $('.footable').footable();
        $('.footable2').footable();

        toastr.options = {
            closeButton: true
        };
        /*
        toastr.error("Noooo oo oo ooooo!!!", "Title");
        toastr.success("Noooo oo oo ooooo!!!", "Title");
        toastr.warning("Noooo oo oo ooooo!!!", "Title");
        toastr.info("Info Message", "Title");
*/
        @if(!empty($exception)) toastr.error("{!! $msg_attetion !!}", "{!! $attention !!}"); @endif

        setInterval(function() {
            url = '{{route('doDelt')}}';
            //$('#noty_count').empty();
            $.ajax({
                url: url,
                type: 'get',
                datatype: 'JSON',
                success: function (resp) {
                    //alert()
                    //$('#noty_count').text(resp.noty_count_vue+ "/" + resp.noty_count);
                    toastr.warning("Noooo oo oo ooooo!!!", "Title");
                }
            });
        }, 1000 * 10* 1000);


        setInterval(function() {
            url = '{{route('getNoty')}}';
            $('#noty_count').empty();
            $.ajax({
                url: url,
                type: 'get',
                datatype: 'JSON',
                success: function (resp) {
                    $('#noty_count').text(resp.noty_count_vue+ "/" + resp.noty_count);
                }
            });
        }, 1000 * 60 * 15);
    });

</script>
<style>/*
    #page-wrapper{
        position: absolute;
        left: -220px;
    }
*/
</style>

@yield('scripts')

</body>

</html>
