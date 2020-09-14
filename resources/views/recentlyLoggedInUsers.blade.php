<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Recently Logged In Users</h3>
        <div class="box-tools pull-right">
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
        <ul class="users-list clearfix">
            @foreach($currentlyLoggedInUser as $currentUser)
                <li>

                    @if($currentUser->user_image!=null)

                        <img
                                src="{{asset('/storage/avatar/'.$currentUser->user_image)}}"
                                alt="message user image" height="128px">
                    @else
                        <img
                                src="{{url('uploads/users/dummyUser.png')}}"
                                alt="message user image" height="128px">

                    @endif
                    <a class="users-list-name" href="">{{$currentUser->name}}</a>
                    <span class="users-list-date">{{$currentUser->created_at}}</span>
                </li>
            @endforeach
        </ul>
        <!-- /.users-list -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{url('logs/loginLog')}}" target="_blank" class="uppercase">View All Users</a>
    </div>
    <!-- /.box-footer -->
</div>