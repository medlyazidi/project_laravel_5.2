<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>INSPINIA | Dashboard</title>


    <link href="{{URL::asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{URL::asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{URL::asset('admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin/css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('admin/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="admin/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="index.html">Dashboard v.1</a></li>
                        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('listLocal')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Locaux</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="{{route('listLocal')}}">Liste des Locaux </a></li>
                        <li><a href="{{route('addLocal')}}">Ajouter un Loacl</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Flot Charts</a></li>
                        <li><a href="graph_morris.html">Morris.js Charts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="mailbox.html">Inbox</a></li>
                        <li><a href="mail_detail.html">Email view</a></li>
                    </ul>
                </li>
                <li>
                    <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">Metrics</span>  </a>
                </li>
                <li>
                    <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="form_basic.html">Basic form</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                    </li>



                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    <li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row  border-bottom white-bg dashboard-header">
            @yield('head')
        </div>
        <div class="row">
            @yield('content')
        </div>

        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>

    </div>



</div>



<!-- Mainly scripts -->
<script src="{{URL::asset('admin/js/jquery-2.1.1.js')}}"></script>
<script src="{{URL::asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Flot -->
<script src="{{URL::asset('admin/js/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/flot/jquery.flot.spline.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/flot/jquery.flot.pie.js')}}"></script>

<!-- Peity -->
<script src="{{URL::asset('admin/js/plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{URL::asset('admin/js/demo/peity-demo.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{URL::asset('admin/js/inspinia.js')}}"></script>
<script src="{{URL::asset('admin/js/plugins/pace/pace.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{URL::asset('admin/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- GITTER -->
<script src="{{URL::asset('admin/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

<!-- Sparkline -->
<script src="{{URL::asset('admin/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Sparkline demo data  -->
<script src="{{URL::asset('admin/js/demo/sparkline-demo.js')}}"></script>

<!-- ChartJS-->
<script src="{{URL::asset('admin/js/plugins/chartJs/Chart.min.js')}}"></script>

<!-- Toastr -->
<script src="{{URL::asset('admin/js/plugins/toastr/toastr.min.js')}}"></script>


<script type="text/javascript" src="{{URL::asset('admin/js/bootstrap-filestyle.js')}}"> </script>

<script src="{{URL::asset('admin/js/verifier.js')}}"></script>
<script src="{{URL::asset('admin/js/checkbox.js')}}"></script>

<!-- FooTable -->
<script src="{{URL::asset('admin/js/plugins/footable/footable.all.min.js')}}"></script>



<script>
    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

        }, 1300);


        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

        var doughnutData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };

        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 140,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 200,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };
        var ctx = document.getElementById("polarChart").getContext("2d");
        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

    });
</script>


<script>
    $(document).ready(function() {
        $('.footable').footable();
        $('.footable2').footable();
    });

</script>
</body>
</html>
