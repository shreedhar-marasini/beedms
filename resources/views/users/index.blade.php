@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                {{--<small>Menu</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"> Home</a></li>
                <li class="active">User</li>
            </ol>
        </section>
    <?php
    $permission=helperPermission();

    $allowAdd = $permission['isAdd'];

    $allowEdit = $permission['isEdit'];

    $allowDelete = $permission['isDelete'];
    ?>

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
                @if($allowAdd||\Request::segment(3)=='edit')
                    <div class="col-md-9">
                        @else
                            <div class="col-md-12">
                                @endif
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">User</h3>
                                        <?php
                                        $permission = helperPermissionLink(url('user'), url('user'));
                                        ?>

                                    </div>
                                    <div class="box-body">
                                        @if(!count($users)<=0)
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">Designation</th>
                                                        <th class="text-center">Department</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Allow Access</th>
                                                        @if($allowEdit || $allowDelete)<th style="width: 70px;" class="text-right">Action</th>@endif
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                    $i = 1;
                                                    ?>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <th scope=row>{{$i++}}</th>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>{{$user->designation->designation_name}}</td>
                                                            <td>{{$user->department->department_name}}</td>
                                                            <td class="text-center">
                                                                @if($user->user_status== 'active')
                                                                    <a
                                                                            class="label label-success stat"
                                                                            href="{{url('/user/userControllerChangeStatus/'.$user->id.'/'."status")}}">
                                                                        <strong class="stat"> Active
                                                                        </strong>
                                                                    </a>

                                                                @elseif($user->user_status== 'inactive')
                                                                    <a class="label label-danger stat"
                                                                       href="{{url('/user/userControllerChangeStatus/'.$user->id.'/'."status")}}">
                                                                        <strong class="stat"> Inactive
                                                                        </strong>
                                                                    </a>
                                                                @endif
                                                            </td>

                                                            <td class="text-center">
                                                                @if($user->user_signature_allow_other== 'true')
                                                                    <a class="label label-success stat"
                                                                       href="{{url('/user/userControllerChangeStatus/'.$user->id.'/'."access")}}">
                                                                        <strong class="stat"> Enabled
                                                                        </strong>
                                                                    </a>

                                                                @elseif($user->user_signature_allow_other== 'false')
                                                                    <a
                                                                            class="label label-danger stat"
                                                                            href="{{url('/user/userControllerChangeStatus/'.$user->id.'/'."access")}}">
                                                                        <strong class="stat"> Disabled
                                                                        </strong>
                                                                    </a>
                                                                @endif
                                                            </td>


                                                            <td class="text-right">
                                                                @if($allowEdit)
                                                                    <a href="{{route('user.edit',[$user->id])}}"
                                                                       class="text-info actionIcon "
                                                                       data-toggle="tooltip"
                                                                       data-placement="top" title="Edit">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endif

                                                                @if($allowDelete)
                                                              <?php  $userId = $user->id;
                                                                   $incoming = App\Models\IncomingDocument::where('uploaded_by_user_id', $userId)->get();
                                                                   $digitized = App\Models\DigitizedDocument::where('uploaded_by_user_id', $userId)->get();
                                                                   $outgoing = App\Models\OutgoingDocument::where('created_by_user_id', $userId)->get();
                                                                   $notification = App\Models\Notification::where('notification_user_id',$userId)->get();?>
                                                                   @if(count($incoming) != null || count($digitized) != null || count($outgoing) != null || count($notification) != null)
                                                              
                                                                    <button type="submit"
                                                                            class="link deleteButton actionIcon"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="javascript:return confirm('You Have No Authorization');" readonly>
                                                                        <i class="fa fa-trash-o" hidden></i>
                                                                    </button>
                                                                    @else
                                                                    {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['user.destroy',
                                                                        $user->id]]) !!}
                                                                    <button type="submit"
                                                                            class="link deleteButton actionIcon"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                    @endif
                                                                    {!! Form::close() !!}
                                                                @endif
                                                               
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


                            <div class="col-md-3">
                                @if(\Request::segment(3)=='edit'&& $allowEdit)
                                    @include('users.edit')
                                @else
                                    @if($allowAdd)
                                        @include('users.add')
                                    @endif
                                @endif

                            </div>
                    </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
