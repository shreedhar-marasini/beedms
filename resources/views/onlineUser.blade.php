<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Online Users</h3>
        <div class="box-tools pull-right">
            <span class="label label-danger"></span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i>
            </button>
            <a href="{{url('user-widget/status',$userWidget->widget_id)}}"  class="btn btn-box-tool" ><i
                        class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <ul class="users-list">
            <li style="width: 100%; text-align: left;">
                <span style="background: rgb(66, 183, 42); border-radius: 50%; display: inline-block; height: 6px; margin-left: 4px; width: 6px;"></span> &emsp;
                @if(Auth::user()->user_image!=null)

                    <img
                            src="{{asset('/storage/avatar/'.Auth::user()->user_image)}}"
                            alt="message user image" height="30px" width="30px">
                @else
                    <img
                            src="{{url('uploads/users/dummyUser.png')}}"
                            alt="message user image" height="30px" width="30px">

                    @endif
                    {{Auth::user()->name}}

            </li>

        @if(is_array($usersOnline))
                @foreach($usersOnline as $online)
                    <li style="width: 100%; text-align:left;">
                        <span style="background: rgb(66, 183, 42); border-radius: 50%; display: inline-block; height: 6px; margin-left: 4px; width: 6px;"></span> &emsp;


                    @if($online->user_image!=null)

                            <img
                                    src="{{asset('/storage/avatar/'.$online->user_image)}}"
                                    alt="message user image" height="30px" width="30px">
                        @else
                            <img
                                    src="{{url('uploads/users/dummyUser.png')}}"
                                    alt="message user image" height="30px" width="30px">

                        @endif
                            {{$online->name}}

                    </li>
                @endforeach
            @else
                {{--<h5>Not Available</h5>--}}
            @endif



        </ul>
        <!-- /.users-list -->
    </div>
    <!-- /.box-body -->
    {{--<div class="box-footer text-center">--}}
        {{--<a href="javascript:void(0)" class="uppercase">View All Users</a>--}}
    {{--</div>--}}
    <!-- /.box-footer -->
</div>