<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BeeDMS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{url('lib/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('lib/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('lib/Ionicons/css/ionicons.min.css')}}">
    <!-- Jquery Confirm -->
    <link rel="stylesheet" href="{{url('plugins/Jquery-confirm/css/jquery-fallr-2.0.1.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{url('lib/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- bootstrap datetimepicker -->
    <link rel="stylesheet" href="{{url('lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('lib/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- HighChart -->
    <link rel="stylesheet" href="{{url('lib/HighCharts/code/css/highcharts.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{url('plugins/iCheck/all.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('img/fev/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('img/fev/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('img/fev/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{url('img/fev/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/fev/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('img/fev/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('img/fev/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('img/fev/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('img/fev/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

        <link rel="stylesheet" href="{{url('dist/css/skins/skin-blue.css')}}">

    <link rel="stylesheet" href="{{url("lib/select2/dist/css/select2.min.css")}}">
    <!-- Bootstrap Toggle -->

    <link rel="stylesheet" href="{{url('plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">

    <!-- HighCharts -->
    <link rel="stylesheet" href="{{url('plugins/HighCharts/code/css/highcharts.css')}}">
    {{--token-input--}}
    <link rel="stylesheet" href="{{url('plugins/token-input/styles/token-input.css')}}">
    <link rel="stylesheet" href="{{url('plugins/token-input/styles/token-input-facebook.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2/dist/css/select2.min.css')}}">


    <!--    Custom Style-->
    <link rel="stylesheet" href="{{url('style.css')}}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition
         skin-blue


        sidebar-mini
    ">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->

        <a href="{{url('dashboard')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
            @if(isset($logo))
                    <img height="57px" src="{{asset('storage/uploads/company_assets/'.$logo)}}">
                @else
                    <b>B</b>ee
                @endif

        </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
             @if(isset($logo))
                    <img height="57px" src="{{asset('storage/uploads/company_assets/'.$logo)}}">
                @else
                    <b>Bee</b>DMS</span>
            @endif
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->

            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>


            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <!-- search form (Optional) -->
                        <form action='{{url('documents/search')}}' method="get" class="navbar-form"
                              style="width: 300px">
                            <div class="input-group">
                                <input type="text" name="search_field" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                            </div>
                        </form>
                    </li>



                </ul>
            </div>
        </nav>
    </header>

<?php $a = "home";
?>


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                404 Error Page
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">404 error</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="{{url('/')}}">return to dashboard</a> or try using the search
                        form.
                    </p>

                    <form action='{{url('documents/search')}}' method="get" class="search-form">

                        <div class="input-group">
                            <input type="text" name="search_field" class="form-control" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i
                                            class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.input-group -->
                    </form>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Licenced to: <a href="#">@if(isset($companyLiscenceTo))
                    {{$companyLiscenceTo}}@else Youngminds @endif</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2017 <a href="#">Youngminds</a>.</strong> All rights reserved.
        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 3 -->
        <script src={{url("lib/jquery/dist/jquery.js")}}></script>
        <!-- Bootstrap 3.3.7 -->

        {{--Time Ago for determing the time difference--}}
        <script src="{{url("lib/timeago/timeago.js")}}"></script>
        <!-- Jquery-confirm -->
        <script src={{url("plugins/Jquery-confirm/js/jquery-fallr-2.0.1.js")}}></script>


        <script>
            $(function () {
                $('#example1').DataTable()
                $('#example2').DataTable()
                $('#example3').DataTable()
                $('#example4').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    'searching': true,
                    'autoWidth': true

                })
            })
        </script>


        <script>
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
            $('#email_date').datepicker({
                autoclose: true
            })
        </script>


    </footer>
    <button onclick="topFunction()" id="scrollBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
</body>
</html>
