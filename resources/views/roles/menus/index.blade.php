@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Roles
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"> Home</a></li>
                <li><a href="#">Roles</a></li>
                <li class="active">Menus</li>
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
                                <h3 class="box-title">Menus</h3>
                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                                <a href="{{url('roles/menu')}}" class="pull-right boxTopButton"
                                   data-toggle="tooltip" title="View All"><i class="fa fa-list fa-2x"></i></a>
                                <a href="{{url('roles/menu')}}" class="pull-right  boxTopButton"
                                   data-toggle="tooltip" title="Go Back"><i
                                            class="fa fa-arrow-circle-left fa-2x"></i></a>
                            </div>
                            <div class="box-body">

                                @if(!count($menus)<=0)
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">S.N</th>
                                                <th>Menu</th>
                                                <th>Controller/Link</th>
                                                <th class="text-center">Icon</th>
                                                <th style="width: 30px" class="text-centered">Status</th>
                                                <th class="text-right">Order</th>
                                               @if($allowEdit||$allowDelete) <th style="width: 50px" class="text-right">Action</th>@endif
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $i = 1;
                                            ?>
                                            @foreach($menus as $menu)
                                                <tr>
                                                    <th scope=row>{{$i++}}</th>
                                                    <td>{{$menu->menu_name}}</td>
                                                    <td>{{$menu->menu_controller}}<br>{{$menu->menu_link}}</td>

                                                    <td class="text-center">{!! $menu->menu_icon !!}</td>
                                                    <td class="text-center">
                                                        @if($menu->menu_status== '1')
                                                            <a
                                                                    class="label label-success stat"
                                                                    href="{{url('/roles/menu/menuControllerChangeStatus/'.$menu->id)}}">
                                                                <strong class="stat"> Active
                                                                </strong>
                                                            </a>

                                                        @elseif($menu->menu_status== '0')
                                                            <a
                                                                    class="label label-danger stat"
                                                                    href="{{url('/roles/menu/menuControllerChangeStatus/'.$menu->id)}}">
                                                                <strong class="stat"> Inactive
                                                                </strong>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{$menu->menu_order}}
                                                    </td>
                                                    @if($allowEdit)
                                                        <td class="text-right">
                                                            <a href="{{route('menu.edit',[$menu->id])}}"
                                                               class="text-info actionIcon"
                                                               data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>&nbsp;
                                                            @endif


                                                                {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['menu.destroy',
                                                                    $menu->id]]) !!}
                                                            @if($allowDelete)
                                                                <button type="submit"
                                                                        class="btn btn-default btn-xs deleteButton actionIcon"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top" title="Delete"
                                                                        onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            @endif

                                                                {!! Form::close() !!}

                                                        </td>
                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>
                                    </div>


                                @else
                                    {{--<div class="col-md-12">--}}
                                    {{--<label class="form-control label-danger">No records found</label>--}}
                                    {{--</div>--}}
                                @endif

                            </div>

                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>



                    <div class="col-md-3" id="sideForm">
                        @if(\Request::segment(4)=='edit')
                            @if($allowEdit)
                            @include('roles.menus.edit')
                                @endif
                        @else
                            @if($allowAdd)
                            @include('roles.menus.add')
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
