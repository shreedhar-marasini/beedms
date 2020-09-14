@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Configuration
                <!--                <small>Sub Module</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Configurations</li>
                <li>Branding Configuration</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')


            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Branding</h3>
                    <?php

                    $permission = helperPermissionLink('branding', 'branding');

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                            {{--<form href='{{url('/configurations/branding')}}' method="POST" enctype="multipart/form-data">--}}
                            {{--{{csrf_field()}}--}}
                            {!! Form::open(['method'=>'POST','url'=>'/configurations/branding','enctype'=>"multipart/form-data"]) !!}

                            <form action="{{url('configurations/branding')}}" method="POST"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                @foreach($masterSetting as $setting)
                                    <div class="form-group">
                                        <label>{{$setting->key_label}}</label>
                                        @if($setting->key_type=="input")
                                            {{Form::text($setting->key_name,$setting->key_value,['class'=>'form-control'])}}
                                        @elseif($setting->key_type=="textarea")
                                            <textarea rows="2" cols="200" class="form-control"
                                                      name="{{$setting->key_name}}">{{htmlentities($setting->key_value!=null?$setting->key_value:'',ENT_QUOTES, "UTF-8")}}</textarea>
                                        @elseif($setting->key_type=="file")
                                            <input type="file" class="form-control"
                                                   placeholder="{{$setting->key_value!=null?$setting->key_value:''}}"
                                                   value="{{$setting->key_value!=null?$setting->key_value:''}}"
                                                   name="{{$setting->key_name}}">

                                        @elseif($setting->key_type=="password")
                                            <input type="password" class="form-control"
                                                   placeholder="{{$setting->key_value!=null?$setting->key_value:''}}"
                                                   value="{{$setting->key_value!=null?$setting->key_value:''}}"
                                                   name="{{$setting->key_name}}">

                                        @elseif($setting->key_type=="dropdown")
                                            @if($setting->key_name=="_DEFAULT_FONT_")



                                                <select name="{{$setting->key_name}}"
                                                        class="form-control">
                                                    <option value="courier"{{$setting->key_value=='Courier'?'selected':'' }}>Courier</option>
                                                    <option value="CourierB" {{$setting->key_value=='CourierB'?'selected':'' }}>Courier Bold</option>
                                                    <option value="CourierBI" {{$setting->key_value=='CourierBI'?'selected':'' }}>Courier Bold Italic</option>
                                                    <option value="courierI" {{$setting->key_value=='courierI'?'selected':'' }}>Courier Italic</option>
                                                    <option value="helvetica" {{$setting->key_value=='Helvetica'?'selected':'' }}>Helvetica</option>
                                                    <option value="helveticaB" {{$setting->key_value=='helveticaB'?'selected':'' }}>Helvetica Bold</option>
                                                    <option value="helveticaBI" {{$setting->key_value=='helveticaBI'?'selected':'' }}>Helvetica Bold Italic</option>
                                                    <option value="helveticaI" {{$setting->key_value=='helveticaI'?'selected':'' }}>Helvetica Italic</option>
                                                    <option value="symbol" {{$setting->key_value=='symbol'?'selected':'' }}>Symbol</option>
                                                    <option value="times" {{$setting->key_value=='times'?'selected':'' }}>Times New Roman</option>
                                                    <option value="timesB" {{$setting->key_value=='timesB'?'selected':'' }}>Times New Roman Bold</option>
                                                    <option value="timesBI" {{$setting->key_value=='timesBI'?'selected':'' }}>Times New Roman Bold Italic</option>
                                                    <option value="timesI" {{$setting->key_value=='timesI'?'selected':'' }}>Times New Roman Italic</option>
                                                    <option value="zapfdingbats" {{$setting->key_value=='zapfdingbats'?'selected':'' }}>Zapf Dingbats</option>
                                                    <option value="Freeserif" {{$setting->key_value=='Freeserif'?'selected':'' }} {{$setting->key_value==NULL?'selected':'' }}>Freeserif</option>

                                                </select>

                                                @endif
                                            @elseif($setting->key_type=="radio")
                                            <br>

                                            {{Form::radio($setting->key_name, 'yes',$setting->key_value=='yes'?true:null,[])}} Yes &nbsp;&nbsp;&nbsp;
                                            {{Form::radio($setting->key_name, 'no',$setting->key_value=='no'?true:null,[])}}No

                                        @endif
                                        <p class="help-block">{{$setting->key_description}}</p>
                                        @if($setting->key_value!=null && $setting->key_type=="file")
                                            @if($setting->key_name=="_LETTER_STAMP_IMAGE_")
                                                <img class="img-responsive"
                                                     src="{{asset('storage/uploads/company_assets/'.$setting->key_value)}}"
                                                     style="width: 82px" alt="No Image">
                                                @else
                                            <img class="img-responsive"
                                                 src="{{asset('storage/uploads/company_assets/'.$setting->key_value)}}"
                                                 style="width:250px;" alt="No Image">
                                                @endif
                                        @endif

                                        <br>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary pull-right">Save</button>

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
@endsection