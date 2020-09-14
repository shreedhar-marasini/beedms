
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: santosh--}}
 {{--* Date: 8/8/17--}}
 {{--* Time: 3:00 PM--}}
 {{--*/--}}

@extends('master.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bell-o"></i>
             Notifications
            <!--                <small>Sub Module</small>-->
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"> You have {{count($notifications)}} Notifications</h3>
                <a href="{{url('notification/readAll')}}" class="pull-right" data-toggle="tooltip" title="Check All"><i
                class="fa fa-check-square-o inline fa-2x"></i></a>

            </div>
            {{--<div class="box-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-12">--}}
                        <ul class="list-group">

                            @foreach($notifications as $notification)
                              @if($notification->notification_read_date!=null)
                                <li  class="list-group-item">
                            @else
                                    <li  class="list-group-item background-grey">
                                @endif
                                <a href="{{url('notification/link/'.$notification->id)}}">

                                    <div class="pull-left" style="margin-right: 10px">
                                        <?php $info=\App\Repository\NotificationRepository::getUserInformation($notification->notifier_user_id)?>
                                        @if($info->user_image != null)
                                            <img src="{{asset('/storage/avatar/'.$info->user_image)}}" alt="User Image " style="height: 42px" class="img img-responsive img-circle">
                                        @else
                                            <img class="img-circle img-bordered-sm"
                                                 src="{{url('/uploads/users/dummyUser.png')}}"
                                                 alt="User Image" height="42px"
                                                 style="float: right">
                                        @endif
                                    </div>
                                    <h4>
                                        {{$info->name}}
                                        <div class="notification-title inline">- {{$notification->notification_title}}</div>
                                        <small  class="label label-default pull-right" >
                                            <i class="fa fa-clock-o"> &nbsp;{{date("j M. Y", strtotime($notification->notification_date))}}</i>

{{--                                            {{$notification->created_at->diffForHumans()}}--}}
                                        </small>
                                    </h4>
                                </a>
                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <br>
                    <br>
                {{--message flash--}}
                <!--if-->

                {{--<div class="col-lg-12">--}}
                {{--<div class="callout callout-info">--}}
                {{--Please select the group name from above drop down menu.--}}
                {{--</div>--}}
                {{--</div>--}}


                <!--else-->



                {{--</div>--}}


            {{--</div>--}}
            {{--<!-- /.box-body -->--}}
        {{--</div>--}}
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var val=$('.notification_status').val();
        $('.need_to_be_rendered').timeago();
    });

</script>
@endsection