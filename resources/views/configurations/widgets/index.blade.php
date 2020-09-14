@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('eng.configuration')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('eng.home')}}</a></li>
                <li>{{trans('eng.configuration')}}</li>
                <li class="active">{{trans('eng.widget')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')

            <div class="row">

                {{--@if(helperPermission()['isAdd'])--}}

                    {{--<div class="col-md-9" id="listing">--}}
                        {{--@else--}}
                            <div class="col-md-12" id="listing">
                                {{--@endif--}}
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{trans('eng.widget')}}</h3>
                                        <?php

                                        $permission =  helperPermissionLink('widget','widget');
                                        ?>
                                    </div>
                                    <div class="box-body">
                                        <table id="example1" class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px;">S.N</th>
                                                <th>{{trans('eng.widgetName')}}</th>
                                                <th>{{trans('eng.widgetDescription')}}</th>
                                                <th>{{trans('eng.widgetDefault')}}</th>
                                                <th class="text-center">{{trans('eng.widgetKey')}}</th>
                                                <th style="width: 50px;" class="text-right">{{trans('eng.status')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1;?>
                                            @forelse($widgets as $widget)
                                                <tr>
                                                    <th scope=row>{{$i}}</th>
                                                    <td>{{$widget->widget_name}}</td>
                                                    <td>{{$widget->widget_description}}</td>
                                                    <td>{{$widget->widget_default}}</td>
                                                    <td class="text-center">{{$widget->widget_key}}</td>
                                                    <td class="text-center" id="status">
                                                        @if($widget->widget_status == 'active')
                                                            <a  class="label label-success stat" href="{{url('configurations/widget/status',$widget->id)}}">
                                                                <strong class="stat"> {{trans('eng.enable')}}
                                                                </strong>
                                                            </a>

                                                        @elseif($widget->widget_status == 'inactive')
                                                            <a class="label label-danger stat" href="{{url('configurations/widget/status',$widget->id)}}">
                                                                <strong class="stat"> {{trans('eng.disable')}}
                                                                </strong>
                                                            </a>
                                                        @endif
                                                    </td>

                                                    {{--<td class="text-right">--}}
                                                        {{--@if($allowEdit)--}}
                                                            {{--<a href="{{route('widget.edit',[$widget->id])}}"  class="text-info actionIcon" data-toggle="tooltip"--}}
                                                               {{--data-placement="top" title="Edit">--}}
                                                                {{--<i class="fa fa-pencil"></i>--}}
                                                            {{--</a>&nbsp;--}}
                                                        {{--@endif--}}

                                                        {{--@if($allowDelete)--}}
                                                            {{--{!! Form::open(['method' => 'DELETE', 'route'=>['widget.destroy',--}}
                                                                {{--$widget->id],'class'=> 'inline']) !!}--}}
                                                            {{--<button type="submit"--}}
                                                                    {{--class="btn btn-default btn-xs deleteButton actionIcon"--}}
                                                                    {{--data-toggle="tooltip"--}}
                                                                    {{--data-placement="top" title="Delete"--}}
                                                                    {{--onclick="javascript:return confirm('Are you sure you want to delete?');">--}}
                                                                {{--<i class="fa fa-trash-o"></i>--}}
                                                            {{--</button>--}}

                                                            {{--{!! Form::close() !!}--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                </tr>
                                                <?php $i++; ?>
                                            @empty<h5>{{trans('eng.noRecordFound')}} </h5>
                                            @endforelse
                                            </tbody>
                                        </table>

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>

                            {{--@if($allowAdd)--}}
                                {{--<div class="col-md-3">--}}
                                    {{--@if(\Request::segment(4)=='edit')--}}
                                        {{--@include('configurations.widgets.edit')--}}
                                    {{--@else--}}
                                        {{--@include('configurations.widgets.add')--}}
                                    {{--@endif--}}

                                {{--</div>--}}
                            {{--@endif--}}
                    </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection