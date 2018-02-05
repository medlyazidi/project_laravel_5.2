<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ميزانية فريق العدالة و التنمية بمجلس النواب</title>

    <link href="{{URL::asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{URL::asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{URL::asset('admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/bootstrap-select.css')}}" rel="stylesheet">


    <link href="{{URL::asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{URL::asset('admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

    <link rel="icon" type="image" href="{{URL::asset('admin/img/logo-pjd.png')}}" />

    <!-- Toastr style -->
    <link href="{{URL::asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


    <!--new style menu-->

    <!-- Default Theme css file -->
    <link href="{{URL::asset('style_new/css/themes/default-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('style_new/css/style_new.css')}}" rel="stylesheet">

    <style>
        .modal-header{
            background-color: #FFFFFF;
        }
    </style>



</head>

<body>

<div>


    <?php
    include public_path().'/traduction.php';
    ?>



    <header id="header">
        <!-- BEGIN MENU -->
        <div class="menu_area">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header col-sm-8" style="margin-left: -26%">
                        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                        <!-- LOGO -->
                        <!-- TEXT BASED LOGO -->

                        <div id="navbar" class="navbar-collapse collapse">
                            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                                        <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li><a type="button" data-toggle="modal" data-target="#viewUser"><h3>{!! $profil_user !!}</h3></a></li>
                                        <li><a type="button" data-toggle="modal" data-target="#modifyUser"><h3>{!! $profil_edit_user !!}</h3></a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('logout') }}"><h3>{!! $sortie !!}</h3></a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h3><span class="fa fa-angle-down"></span>احصائيات</h3></a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li>
                                            <a href={!! route('liste_depute_montant') !!}><h3>{!! $sous_titre_stat_depu !!}</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('list_etat_deux').'?date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}><h3> خلاصة الموارد و النفقات</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('etat_depense').'?date_recherche_debut=2017-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}><h3>{!! $titre_stat_two !!}</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('etat_depense_ligne_budg').'?date_recherche_debut=2017-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}><h3>{!! $liste_depense !!}</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('etat_ressource').'?date_recherche_debut=2017-01-01&date_recherche_fin='.Carbon\Carbon::today()->toDateString() !!}><h3>{!! $liste_ressource !!}</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('list_deputes_mois')!!}><h3>{!! $cotisations_var !!}</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('list_deputes_sans_credit')!!}><h3>النواب الذين ليس عليهم دين</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('list_deputes_avec_credit')!!}><h3>النواب الذين بذمتهم دين</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('list_deputes_annee')!!}><h3>وضعية مساهمات النواب في 5 سنوات</h3></a>
                                        </li>
                                        <li>
                                            <a href={!! route('liste_depute_montant_local')!!}><h3>وضعية مساهمات حسب اللوائح</h3></a>
                                        </li>
                                    </ul>
                                </li>
                                @if(Auth::user()->id_role <= 2)
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h3><span class="fa fa-angle-down"></span>الحسابات</h3></a>
                                        <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                                            <li><a href="{{route('listeDepenses')}}"><h3>النفقات، المساهمات و الموارد</h3></a></li>
                                            <li><a href="{{route('listeModif')}}"><h3>{!! $miseAjour_Bank_titre !!}</h3></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->id_role == 1)
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" ><h3><span class="fa fa-angle-down"></span>لوحة المسير</h3></a>
                                        <ul class="dropdown-menu animated fadeInRight m-t-xs" dir="rtl">
                                            <li><a href={!! route('listVoiture') !!}> <span class="nav-label"><h3>السيارة</h3></span></a></li>
                                            <li><a href={!! route('listeUser') !!}> <span class="nav-label"><h3>المستخدمون</h3></span></a></li>
                                            <li><a href="{{route('listTypeDepute')}}"> <span class="nav-label"><h3>مهام النواب</h3> </span></a></li>
                                            <li><a href="{{route('listLocal')}}"> <span class="nav-label"><h3>لائحة الإقتراع</h3></span> </a></li>
                                            <li><a href="{{route('listTypeRessource')}}"> <span class="nav-label"><h3>{!! $type_ressource_var !!}</h3></span></a></li>
                                            <li><a href="{{route('listCompteBancaire')}}"> <span class="nav-label"><h3>الحسابات البنكية</h3></span></a></li>
                                            <li><a href="{{route('listDepute')}}"> <span class="nav-label"><h3>{!! $depute !!}</h3></span></a></li>
                                            <li><a href="{{route('listLigneBudgetaire')}}"> <span class="nav-label"><h3>بنود النفقات</h3></span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                <li>
                                    <a href="{!! route('notification') !!}"><span class="label label-warning pull-right" id="noty_count" style="display: none">6</span></a>
                                </li>

                            </ul>
                        </div><!--/.nav-collapse -->
                        <div class="modal inmodal" id="viewUser" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="contact-box center-version">

                                        <a>
                                            <h3 class="m-b-xs"><strong>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong></h3>

                                            <address class="m-t-md">
                                                <strong>Email:</strong> {{ Auth::user()->email }}<br>

                                            </address>

                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="modifyUser" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $profil_edit_user !!} : {!! Auth::user()->nom !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('editUserMe') !!} id="login" class="form-horizontal" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{!! Auth::user()->id !!}" name="id">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $nom !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="nom" value="{!! Auth::user()->nom  !!}" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $prenom !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="prenom" value="{!! Auth::user()->prenom !!}"  type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label">{!!  $email!!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="email" value="{!! Auth::user()->email !!}"  type="text" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $password !!} :</label>
                                                    <div class="col-sm-8">
                                                        <input name="password" id="pwd"  type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-4">
                                                    <input type="checkbox" id="show-hide" name="show-hide" value="" />
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
                        <div class="modal inmodal" id="modifyUserImg" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">{!! $photo_edit !!} : {!! Auth::user()->prenom !!}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="post" action={!! route('editUserImage') !!} class="form-horizontal" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{!! Auth::user()->id !!}" name="id">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">{!! $photo !!} :</label>
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

                        <!-- IMG BASED LOGO  -->
                        <!--  <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>   -->
                    </div>
                    <div class="col-sm-3" style="margin-left: 26%">
                        <a class="navbar-brand"  href="{!! route('menu_img') !!}" dir="rtl"><span>ميزانية فريق العدالة و التنمية بمجلس النواب</span></a>
                    </div>
                    <div class="col-sm-1" >
                        <a  href="{!! route('menu_img') !!}"><img height="60px"  src="{{URL::asset('admin/img/logo-pjd.png')}}"></a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- END MENU -->
    </header>

        <div class="gray-bg">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i><?php echo $sortie;?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading" style="margin-top: 60px;">
            @yield('head')
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                by <strong>TEQUALITY</strong>.
            </div>
            <div>
                <strong>Copyright</strong> PJG Groupe &copy; {!! Carbon\Carbon::today()->year !!}
            </div>
        </div>



    </div>


</div>

<script>
    (function() {

        var PasswordToggler = function( element, field ) {
            this.element = element;
            this.field = field;

            this.toggle();
        };

        PasswordToggler.prototype = {
            toggle: function() {
                var self = this;
                self.element.addEventListener( "change", function() {
                    if( self.element.checked ) {
                        self.field.setAttribute( "type", "text" );
                    } else {
                        self.field.setAttribute( "type", "password" );
                    }
                }, false);
            }
        };

        document.addEventListener( "DOMContentLoaded", function() {
            var checkbox = document.querySelector( "#show-hide" ),
                pwd = document.querySelector( "#pwd" );


            var toggler = new PasswordToggler( checkbox, pwd );

            var checkbox_user = document.querySelector( "#show-hide-user" ),
                pwd_user = document.querySelector( "#pwd-user" );


            var toggler_user = new PasswordToggler( checkbox_user, pwd_user );

            var checkbox_user_add = document.querySelector( "#show-hide-user-add" ),
                pwd_user_add = document.querySelector( "#pwd-user-add" );

            var toggler_user_add = new PasswordToggler( checkbox_user_add, pwd_user_add );

        });

    })();

</script>


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

<!-- js style new  -->
    <!-- slick slider -->
    <script src="{{URL::asset('style_new/js/slick.min.js')}}"></script>
    <!-- counter -->
    <script src="{{URL::asset('style_new/js/jquery.counterup.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{URL::asset('style_new/js/custom.js')}}"></script>


    <script src="{{URL::asset('admin/js/bootstrap-select.min.js')}}"></script>


<!-- Page-Level Scripts -->
<script>

    $(document).ready(function(){

        $('.footable').footable();
        $('.footable2').footable();

        toastr.options = {
            closeButton: true
        };

    @if(!empty($exception)) toastr.error("{!! $msg_attetion !!}", "{!! $attention !!}"); @endif

        // alert test
        setTimeout(function(){
            url = '{{route('getNotification')}}';
            $('#noty_count').show();
            $('#noty_count').empty();
            $.ajax({
                url: url,
                type: 'get',
                datatype: 'JSON',
                success: function (resp) {
                    $('#noty_count').text(resp.count_noty);
                }
            });
        },1000*1);

        //alert fin
    });

</script>

@yield('scripts')

</body>

</html>
