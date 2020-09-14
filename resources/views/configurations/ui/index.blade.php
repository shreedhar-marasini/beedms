@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Theme Options
                <!--                <small>Sub Module</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Configurations</li>
                <li class="active">UI</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <!--                <div class="box-header with-border">-->
                <!--                    <h3 class="box-title">Theme Options</h3>-->
                <!--                    <a href="#" class="pull-right" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" ></i></a>-->
                <!---->
                <!--                </div>-->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-sm-8 col-xs-12">
                            <p class="page-header">Skins</p>
                            <ul class="list-unstyled">

                                <li style="float:left; width: 25%; padding: 5px;<?php if($ui->key_value == "skin-blue-light") echo "border:#00A6C7 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-blue-light')}}"
                                       data-skin="skin-blue-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class=" full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9"></span>
                                            <span class="bg-light-blue"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Blue Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if($ui->key_value == "skin-black-light") echo "border:#a2a2a2 solid 1px";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-black-light')}}"
                                       data-skin="skin-black-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span>
                                            <span style="display:block; width: 80%; float: left; height: 21px; background: #fefefe"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Black Light</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-purple-light") echo "border:mediumpurple solid 1px; margin:0px!important";?>">
                                    <a
                                            href="{{url('configurations/uiChangeSkin/skin-purple-light')}}"
                                            data-skin="skin-purple-light"
                                            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                            class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-purple-active"></span>
                                            <span class="bg-purple"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Purple Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-green-light") echo "border:#2ab27b solid 1px;";?>">
                                    <a
                                            href="{{url('configurations/uiChangeSkin/skin-green-light')}}"
                                            data-skin="skin-green-light"
                                            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                            class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-green-active"></span>
                                            <span class="bg-green"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Green Light</p>
                                </li>


                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-red-light") echo "border:#dd4b39 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-red-light')}}"
                                       data-skin="skin-red-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-red-active"></span>
                                            <span class="bg-red"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Red Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px; <?php if ($ui->key_value == "skin-yellow-light") echo "border:#f39c12 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-yellow-light')}}"
                                       data-skin="skin-yellow-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-yellow-active"></span>
                                            <span class="bg-yellow"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px; <?php if ($ui->key_value == "skin-blue") echo "border:#00A6C7 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-blue')}}"
                                       data-skin="skin-blue-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9">
                                                  </span>
                                            <span class="bg-light-blue"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Blue</p>
                                </li>


                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-black") echo "border:#a2a2a2 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-black')}}"
                                       data-skin="skin-black"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span
                                                    style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span><span
                                                    style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Black</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px; <?php if ($ui->key_value == "skin-purple") echo "border:mediumpurple solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-purple')}}" data-skin="skin-purple"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-purple-active"></span>
                                            <span class="bg-purple"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Purple</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-green") echo "border:#2ab27b solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-green')}}" data-skin="skin-green"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-green-active"></span>
                                            <span class="bg-green"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Green</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-red") echo "border:#dd4b39 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-red')}}" data-skin="skin-red"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-red-active"></span>
                                            <span class="bg-red"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Red</p></li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($ui->key_value == "skin-yellow") echo "border:#f39c12 solid 1px;";?>">
                                    <a href="{{url('configurations/uiChangeSkin/skin-yellow')}}" data-skin="skin-yellow"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-yellow-active"></span>
                                            <span class="bg-yellow"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Yellow</p>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-4 col-sm -4 col-sm-4 col-xs-12">
                            <p class="page-header">Layouts</p>
                            <form>

                                @foreach($masterSetting as $setting)
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <input type="checkbox" data-toggle="toggle" data-size="mini"
                                                   data-id="<?=$setting->key_name?>"
                                                   data-layout="fixed" class="pull-right master_layouts"
                                                   name="{{$setting->key_name}}"
                                                    {{ ($setting->key_value == 1)?'checked':null }}
                                            >
                                            <strong>{{$setting->key_label}}</strong></label>
                                        <p class="help-block">{{$setting->key_description}}</p>
                                        <br>
                                    </div>

                                @endforeach


                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.master_layouts').on('change', function () {
                getValue = $(this).val();
                var key_name = $(this).data('id');
                $.ajax({
                    url: "uiChangeLayout/" + key_name + "/" + getValue,
                    type: "GET",
                    success: function (data) {


                    }
                });
            });

        })
    </script>
@endsection