                    <!DOCTYPE html>
                    <html lang="{{ app()->getLocale() }}">
{{--<head>--}}
{{--<meta charset="utf-8">--}}
{{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--<!-- CSRF Token -->--}}
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--<!-- Styles -->--}}
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
<?php $color = "skin-blue"; ?>
@foreach($uiComponent as $ui)
    @if(Auth::user()->_UI_SKIN_!=null)
        <?php $color = Auth::user()->_UI_SKIN_ ;?>

    @elseif($ui->key_name=="_UI_SKIN_" && $ui->key_value!=null)

        <?php $color = $ui->key_value ?>

    @endif
    @if(Auth::user()->_FIXED_LAYOUT_!='0')
        <?php $fixed_layout = Auth::user()->_FIXED_LAYOUT_ ?>

    @elseif($ui->key_name=="_FIXED_LAYOUT_")

        <?php $fixed_layout = $ui->key_value ?>

    @endif
    @if(Auth::user()->_BOXED_LAYOUT_!='0')
       @if($ui->key_name=="_FIXED_LAYOUT_")

        <?php $fixed_layout = '0' ?>

    @endif

        <?php $boxed_layout = Auth::user()->_BOXED_LAYOUT_ ?>

    @elseif($ui->key_name=="_BOXED_LAYOUT_")

        <?php $boxed_layout = $ui->key_value ?>

    @endif
    @if(Auth::user()->_TOGGLE_SIDEBAR_!='0')
        <?php $toggle_sidebar = Auth::user()->_TOGGLE_SIDEBAR_ ?>

    @elseif($ui->key_name=="_TOGGLE_SIDEBAR_")

        <?php $toggle_sidebar = $ui->key_value ?>

    @endif
    @if($ui->key_name=="_COMPANY_LICENSE_TO")

        <?php $companyLiscenceTo = $ui->key_value ?>

    @endif
    @if($ui->key_name=="_COMPANY_LOGO_" )

        <?php $logo = $ui->key_value ?>

    @endif


@endforeach
@include('master.head')


<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition
        <?php if ($color != null)
    echo $color;
else
    echo "skin-blue";
?>
<?php if ($boxed_layout == 1)
    echo " layout-boxed";
?>

    sidebar-mini

<?php if ($fixed_layout == 1)
    echo " fixed";
?>">
<div class="wrapper">
    @include('master.header')
    @include('master.sidemenu')
    <?php $a = "home";
    ?>
    @yield('content')
</div>

<!-- Scripts -->

@include('master.footer')




@yield('js')
@show
<!-- Optionally, you can add Slimscroll and FastClick plugins.
Both of these plugins are recommended to enhance the
     user experience. -->
<button onclick="topFunction()" id="scrollBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
</body>
</html>
