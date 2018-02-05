<!DOCTYPE html>
<html lang="fr" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">


    <style type="text/css">
        html, body {
            font-family: 'Helvetica Neue'  !important;
        }


    </style>




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


    <link href="{{URL::asset('right_style/dest/style.css')}}" rel="stylesheet">




</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
        <?php
                include public_path().'/traduction.php';
        ?>

<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>

        </ul>
        <ul class="nav navbar-nav pull-left hidden-md-down">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="img-avatar" alt="admin@bootstrapmaster.com" src="{{URL::asset(Auth::user()->photo)}}" onerror="this.src='{!! asset('admin/img/avatar.jpg') !!}'" >
                    <span class="hidden-md-down">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-xs-center">
                        <strong>تنظیمات</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> پروفایل</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> تنظیمات</a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> خروج</a>
                </div>
            </li>
            <li class="nav-item">

            </li>

        </ul>
    </div>
</header>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Pages</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="pages-login.html" target="_top"><i class="icon-star"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>
<!-- Main content -->
<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">خانه</li>
        <li class="breadcrumb-item"><a href="#">مدیریت</a>
        </li>
        <li class="breadcrumb-item active">داشبرد</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;داشبرد</a>
                <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
            </div>
        </li>
    </ol>

@yield('content')
    <!--/.container-fluid-->
</main>



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

        <script src="{{URL::asset('right_style/js/app.js')}}"></script>
        <link href="{{URL::asset('right_style/css/font-awesome.min.css')}}" rel="stylesheet">


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

        @yield('scripts')

<!-- Plugins and scripts required by this views -->
<!-- Custom scripts required by this view -->


</body>

</html>
