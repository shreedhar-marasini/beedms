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
                <li class="active">{{trans('eng.designation')}}</li>
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

            <div class="row">

                @if(helperPermission()['isAdd']||\Request::segment(4)=='edit')

                    <div class="col-md-9" id="listing">
                @else
                    <div class="col-md-12" id="listing">
                @endif
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{trans('eng.designation')}}</h3>
                            <?php

                            $permission =  helperPermissionLink(url('/configurations/designation'),url('/configurations/designation'));

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];

                            ?>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">{{trans('eng.serialNumber')}}</th>
                                        <th>{{trans('eng.designationName')}}</th>
                                        <th>{{trans('eng.designationShortName')}}</th>
                                       @if($allowEdit||$allowDelete) <th style="width: 10px"; class="text-right">{{trans('eng.action')}}</th>@endif
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @forelse($designations as $designation)
                                    <tr>
                                        <th scope=row>{{$i}}</th>
                                        <td>{{$designation->designation_name}}</td>
                                        <td>{{$designation->designation_short_name}}</td>

                                        <td class="text-right">
                                            @if($allowEdit)
                                                <a href="{{route('designation.edit',[$designation->id])}}" class="text-info actionIcon" data-toggle="tooltip"
                                                   data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            @endif

                                            @if($allowDelete)
                                                {!! Form::open(['method' => 'DELETE', 'route'=>['designation.destroy',
                                                    $designation->id],'class'=> 'inline']) !!}
                                                    <button type="submit"
                                                            class="link deleteButton actionIcon"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>

                                                {!! Form::close() !!}
                                             @endif

                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty<h5>{{trans('eng.noRecordFound')}}</h5>
                                @endforelse
                                </tbody>
                            </table>

                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <div class="col-md-3">


                    @if(\Request::segment(4)=='edit')
                        @if($allowEdit)
                        @include('configurations.designations.edit')
                    @endif
                    @else
                        @if($allowAdd)
                        @include('configurations.designations.add')
                        @endif
                    @endif

                </div>


            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection
@section('js')
    <script type="text/javascript">
        $('#closeErrorBar').click(function(){
            $('.errorBar').hide();

        });
    </script>
@stop