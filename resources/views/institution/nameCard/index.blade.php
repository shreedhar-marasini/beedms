@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Name Cards
                {{--<small>Menu</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"> Home</a></li>
                <li><a href="{{url('name-card')}}">Name Cards</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            @if (count($errors)!=null)

                <div class="errorBar">
                    <a class="pull-right" href="#" data-placement="left" title=""
                       style="color: rgb(255, 255, 255); font-size: 20px;"
                       id="closeErrorBar">×</a>
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

                                        $permission = helperPermissionLink(url('name-card'), url('/name-card'));

                                        $allowEdit = $permission['isEdit'];

                                        $allowDelete = $permission['isDelete'];

                                        $allowAdd = $permission['isAdd'];

                                        ?>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="container-fluid">
                                                <div class="col-md-12 topFilter ">
                                                    <form class="form-inline">

                                                        {{Form::select('institution_id',$institutions->pluck('institution_name','id'),Request::get('institution_id'),['class'=>'form-control','style'=>"width: 25%",'id'=>'institution_id','placeholder'=> 'Select Institution Name'])}}
                                                        {{Form::text('name_card_person',null,[ 'class'=>"form-control filterForm ", 'placeholder'=>"Card User Name",'list'=>'names','id'=>'name','autocomplete'=>'off'])}}
                                                        <datalist id="names">

                                                        </datalist>
                                                        {{Form::text('name_card_address',null,[ 'class'=>"form-control filterForm", 'placeholder'=>"User address"])}}
                                                        {{Form::text('name_card_contact_number1',null,[ 'class'=>"form-control filterForm ", 'placeholder'=>"Contact number"])}}


                                                        <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{url('name-card')}}" type="button"
                                                           class="btn btn-warning"><i
                                                                    class="fa fa-refresh"></i> Refresh
                                                        </a>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if(count($nameCardUsers)>=0)
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-hover table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10px">S.N</th>
                                                        <th>Name</th>
                                                        <th>Institution</th>
                                                        <th>Address</th>

                                                        <th>Contact Information</th>
                                                        @if($allowEdit||$allowDelete)
                                                            <th style="width: 50px" class="text-right">Action</th>@endif
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($nameCardUsers as $key=>$cardUser)
                                                        <tr>
                                                            <th scope=row>
                                                                {{++$key}}
                                                            </th>
                                                            <td>
                                                                {{$cardUser->name_card_person}}<br>
                                                                <p class="help-block text-10">{{$cardUser->name_card_designation	}}</p>
                                                            </td>
                                                            <td>
                                                                {{$cardUser->institution->institution_name}}
                                                            </td>
                                                            <td>
                                                                {{$cardUser->name_card_address}}<br>
                                                                {!! $cardUser->institution_website !!}</td>
                                                            <td>
                                                                {{$cardUser->name_card_contact_number1}}<br>
                                                                <a href=""> {{$cardUser->name_card_email_address1}}</a>

                                                            </td>
                                                            <td class="text-right">
                                                                @if($allowEdit)
                                                                    <a href="{{route('name-card.edit',[$cardUser->id])}}"
                                                                       class="text-info actionIcon"
                                                                       data-toggle="tooltip"
                                                                       data-placement="top" title="Edit">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endif
                                                                {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['name-card.destroy',
                                                                    $cardUser->id]]) !!}
                                                                @if($allowDelete)
                                                                    <button type="submit"
                                                                            class="link deleteButton actionIcon"
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
                                    @include('institution.nameCard.edit')
                                @else
                                    @if($allowAdd)

                                        @include('institution.nameCard.add')
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
    <script>
        $(document).ready(function () {
            $("#name").keyup(function () {
                $.get('{{url('get-name')}}', {
                    name: $('#name').val(),
                    getNameFrom: 'name'
                }, function (data) {
                    if (data <= 0) {
                        //tell user that the username already exists
                        console.log('not found');


                    } else {
                        console.log(data);
                        $("#names").append(data);


                    }
                }, 'JSON');
            });
        })
    </script>
@stop