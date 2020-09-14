@extends('master.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Institutions
            {{--<small>Menu</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"> Home</a></li>
            <li><a href="{{url('institution')}}">Institution</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('message.flash')
        @if (count($errors)!=null)

        <div class="errorBar">
            <a class="pull-right" href="#" data-placement="left" title=""
                style="color: rgb(255, 255, 255); font-size: 20px;" id="closeErrorBar">×</a>
            <a href=""
                style="color: rgba(255, 255, 255, 0.901961); display: inline-block; margin-right: 10px; text-decoration: none;">
                Please Input all the required fields.</a>

        </div>

        @endif
        <div class="row">
            @if(helperPermission()['isAdd']||\Request::segment(3)=='edit')
            <div class="col-md-9" id="listing">
                @else
                <div class="col-md-12" id="listing">
                    @endif
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Filter</h3>
                            <?php

                                        $permission = helperPermissionLink(url('institution'), url('/institution'));

                                        $allowEdit = $permission['isEdit'];

                                        $allowDelete = $permission['isDelete'];

                                        $allowAdd = $permission['isAdd'];
                                        ?>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="container-fluid">
                                    <div class="col-md-12 topFilter">
                                        <form class="form-inline">
                                            <input type="text" name="institution_name" class="form-control filterForm"
                                                placeholder="Institution Name">
                                            <input type="text" name="institution_address"
                                                class="form-control filterForm" placeholder="Institution address">
                                            <input type="integer" name="institution_contact_number"
                                                class="form-control filterForm"
                                                placeholder="Institution contact number">


                                            &nbsp;

                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                                Filter
                                            </button>
                                            <a href="{{url('/institution')}}" type="button" class="btn btn-warning"><i
                                                    class="fa fa-refresh"></i> Refresh
                                            </a>


                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if(count($institutions)>=0)
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Instituion Name</th>
                                            <th>Address</th>

                                            <th>Contact Information</th>
                                            @if($allowEdit||$allowDelete)<th style="width: 50px" class="text-right">
                                                Action</th>@endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($institutions as $key=>$institution)
                                        <tr>
                                            <th scope=row>{{++$key}}</th>
                                            <td><a href="{{url('institution/'.$institution->id)}}" target="_blank">
                                                    {{$institution->institution_name}} </a><br>

                                                <p class="help-block text-10">{{$institution->institution_pan_number}}
                                                </p>

                                            </td>
                                            <td>{{$institution->institution_address}}<br>
                                                {!! $institution->institution_website !!}</td>
                                            <td>
                                                {{$institution->institution_contact_number}}<br>
                                                <a href=""> {{$institution->institution_email_address}}</a>

                                            </td>
                                            <td class="text-right">
                                                @if($allowEdit)
                                                <a href="{{route('institution.edit',[$institution->id])}}"
                                                    class="text-info actionIcon" data-toggle="tooltip"
                                                    data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                @endif
                                                {!! Form::open(['method' => 'DELETE', 'class'=>'inline',
                                                'route'=>['institution.destroy',
                                                $institution->id]]) !!}
                                                @if($allowDelete)
                                                <button type="submit" class="link deleteButton actionIcon"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
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
                            <div class="col-md-12">
                                <label class="form-control label-danger">No records found</label>
                            </div>
                            @endif

                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3" id="sideForm">
                    @if(\Request::segment(3)=='edit' && $allowEdit)
                    @include('institution.edit')
                    @else
                    @if($allowAdd)

                    @include('institution.add')
                    @endif

                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->

<!-- /.content-wrapper -->
@endsection
@section('js')
<script type="text/javascript">
    $('#closeErrorBar').click(function () {
        $('.errorBar').hide();

    });
</script>
@stop