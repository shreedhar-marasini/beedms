@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('eng.reminder')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i>{{trans('eng.home')}}</a></li>
                <li class="active">{{trans('eng.reminder')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            @if (count($errors)!=null)

                <div class="errorBar">
                    <a class="pull-right" href="#" data-placement="left" title="" style="color: rgb(255, 255, 255); font-size: 20px;"
                       id="closeErrorBar">×</a>
                    <a href="" style="color: rgba(255, 255, 255, 0.901961); display: inline-block; margin-right: 10px; text-decoration: none;">
                        Please Input all the required fields.</a>

                </div>

            @endif
            <div class="box box-default">
                <div class="box-header with-border">

                    <h3 class="box-title">{{trans('eng.edit')}} {{trans('eng.reminder')}}</h3>
                    <?php

                    $permission =  helperPermissionLink(url('/reminder/create'),url('/reminder'));


                    ?>
                </div>
                <div class="box-body">
                    {!! Form::model($edits,['method'=>'PUT','route'=>['reminder.update', $edits->id]]) !!}

                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">

                            <div class="form-group {{ ($errors->has('reminder_title'))?'has-error':''}}">
                                <label>{{trans('eng.title')}}
                                    <label class="text-danger"> *</label>
                                </label>
                                {!! Form::text('reminder_title',null,['class'=>'form-control','placeholder' => ''.trans('eng.title').'']) !!}
                                {!! $errors->first('reminder_title', '<span class="text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group {{ ($errors->has('reminder_date'))?'has-error':''}}">
                                <label>{{trans('eng.date')}}
                                    <label class="text-danger"> *</label>
                                </label>
                                {!!Form::text('reminder_date',null,array('class'=>'form-control pull-right form_datetime','id'=>'datetimepicker','readonly'))!!}
                                <span class="add-on"><i class="icon-th"></i></span>
                                {!! $errors->first('reminder_date', '<span class="text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group {{ ($errors->has('reminder_content'))?'has-error':'' }} ">
                                <label for="reminder_content">{{trans('eng.reminderContent')}}
                                    <label class="text-danger"> *</label>
                                </label>
                                {!! Form::textarea('reminder_content',null,['class'=>'form-control','placeholder'=>'Content']) !!}
                                {!! $errors->first('reminder_content', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group {{ ($errors->has('reminder_to_email'))?'has-error':''}}">
                                <label>{{trans('eng.other')}} {{trans('eng.email')}}</label>
                                {!! Form::text('reminder_to_email',null,['class'=>'form-control','placeholder' => ''.trans('eng.email').'']) !!}
                                {!! $errors->first('reminder_to_email', '<span class="text-danger">:message</span>') !!}
                            </div>

                            {{--<div class="form-group {{ ($errors->has('remind_to_all'))?'has-error':'' }}">--}}
                                {{--<label for="remind_to_all">{{trans('eng.remindToAll')}} </label><br>--}}
                                {{--{{Form::radio('remind_to_all', 'no','true',['class'=>'flat-red'])}} {{trans('eng.no')}} &nbsp;&nbsp;&nbsp;--}}
                                {{--{{Form::radio('remind_to_all', 'yes',null,['class'=>'flat-red'])}} {{trans('eng.yes')}}--}}
                            {{--</div>--}}

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{trans('eng.update')}}</button>
                                <!-- /.box-footer -->
                            </div>

                        </div>

                    </div>
                    {!! Form::close() !!}


                </div>
                <!-- /.box-body -->
            </div>

@endsection

@section('js')

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-ddThh:ii:ss"
        });
    </script>
                <script type="text/javascript">
                    $('#closeErrorBar').click(function(){
                        $('.errorBar').hide();

                    });
                </script>

@endsection