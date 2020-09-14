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
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('img/fev/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/fev/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('img/fev/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('img/fev/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('img/fev/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('img/fev/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    @if( $color == "skin-blue")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-blue.css')}}">
    @elseif($color=="skin-blue-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-blue-light.css')}}">


    @elseif($color=="skin-black-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-black-light.min.css')}}">
    @elseif($color=="skin-black")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-black.css')}}">


    @elseif($color=="skin-green-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-green-light.min.css')}}">
    @elseif($color=="skin-green")

        <link rel="stylesheet" href="{{url('dist/css/skins/skin-green.css')}}">

    @elseif($color=="skin-purple")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-purple.css')}}">

    @elseif($color=="skin-purple-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-purple-light.css')}}">



    @elseif($color=="skin-red")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-red.css')}}">
    @elseif($color=="skin-red-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-red-light.css')}}">

    @elseif($color==="skin-yellow")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-yellow.css')}}">
    @elseif($color=="skin-yellow-light")
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-yellow-light.css')}}">
    @else
        <link rel="stylesheet" href="{{url('dist/css/skins/skin-blue.css')}}">

    @endif
    <link rel="stylesheet" href="{{url("lib/select2/dist/css/select2.min.css")}}">
    <!-- Bootstrap Toggle -->

    <link rel="stylesheet" href="{{url('plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">

    <!-- HighCharts -->
    <link rel="stylesheet" href="{{url('plugins/HighCharts/code/css/highcharts.css')}}">
    {{--token-input--}}
    <link rel="stylesheet" href="{{url('plugins/token-input/styles/token-input.css')}}">
    <link rel="stylesheet" href="{{url('plugins/token-input/styles/token-input-facebook.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('lib/owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('lib/owlcarousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/croppie/croppie.css')}}">


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