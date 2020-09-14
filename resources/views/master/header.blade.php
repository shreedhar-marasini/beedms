<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->

    <a href="{{url('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 20px50 pixels -->
        <span class="logo-mini">
            @if(isset($logo))
                <img height="40px" src="{{asset('storage/uploads/company_assets/'.$logo)}}">
            @else
                <b>B</b>ee
            @endif

        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
             @if(isset($logo))
                <img height="40px" src="{{asset('storage/uploads/company_assets/'.$logo)}}">
            @else
                <b>Bee</b>DMS</span>
        @endif
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>


        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <!-- search form (Optional) -->
                    <form action='{{url('documents/search')}}' method="get" class="navbar-form" style="width: 300px">
                        <div class="input-group">
                            <input type="text" name="search_field" class="form-control" placeholder="Search..." value="{{Request::get('search_field')}}"
                                   id="search_field" list="searchTagList" autocomplete="off">
                            <datalist id="searchTagList">

                            </datalist>
                            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                        </div>
                    </form>
                </li>

                <!-- /.search form -->
                <!-- Messages: style can be found in dropdown.less-->
                <!-- /.messages-menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-calendar-check-o"></i>
                        @if(count($reminders)>0)
                            <span class="label label-warning">{{count($reminders)}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{count($reminders)}} Reminders</li>
                        @if(count($reminders)>0)
                            <li>
                                @foreach($reminders as $reminder)
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="{{url('reminder/'.$reminder->id)}}">
                                                <div class="pull-left">
                                                    <i class="fa fa-clock-o fa-lg"></i>&emsp;
                                                </div>
                                                <h4 style="padding: 0; margin: 0 0 0 45px; position: relative;">
                                                    {{$reminder->document_type}}
                                                    <small style="float: right;">
                                                        {{$reminder->reminder_date}}</small>
                                                </h4>
                                                <p style="margin: 0 0 0 45px; font-size: 12px; color: #888888;">{{$reminder->reminder_title}}</p>
                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                @endforeach
                            </li>
                        @endif


                        <li class="footer"><a href="{{url('/reminder')}}">View all</a></li>
                    </ul>
                </li>

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if(count($notifications)>0)
                            <span class="label label-warning">{{count($notifications)}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{count($notifications)}} notifications</li>
                        @if(count($notifications)>0)
                            <li>
                            @foreach($notifications as $notification)
                                <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="{{url('notification/link/'.$notification->id)}}">

                                                @if($notification->notifier->user_image != null)
                                                    <img src="{{asset('/storage/avatar/'.$notification->notifier->user_image)}}"
                                                         alt="User Image " style="height: 24px">
                                                @else
                                                    <img src="{{url('/uploads/users/dummyUser.png')}}" alt="User Image"
                                                         height="24px">
                                                @endif
                                                <b>{{$notification->notifier->name}}</b>
                                                <small>{{str_limit($notification->notification_title,30)}}</small>

                                                <i class="fa fa-clock-o pull-left"
                                                   style="margin-left: 2.5em; font-size: 10px">
                                                    @if($notification->created_at==null)
                                                        {{$notification->notification_date}}
                                                    @else
                                                        {{$notification->created_at->diffForHumans()}}
                                                    @endif
                                                </i>

                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                @endforeach
                            </li>
                        @endif
                        <li class="footer"><a
                                    href="{{url('/notification/notificationControllerShowAllNotifications')}}">View
                                all</a></li>

                    </ul>
                </li>
                <!-- Tasks Menu -->
            {{--<li class="dropdown tasks-menu">--}}
            {{--<!-- Menu Toggle` Button -->--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="fa fa-flag-o"></i>--}}
            {{--<span class="label label-danger">9</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li class="header">You have 9 tasks</li>--}}
            {{--<li>--}}
            {{--<!-- Inner menu: contains the tasks -->--}}
            {{--<ul class="menu">--}}
            {{--<li><!-- Task item -->--}}
            {{--<a href="#">--}}
            {{--<!-- Task title and progress text -->--}}
            {{--<h3>--}}
            {{--Design some buttons--}}
            {{--<small class="pull-right">20%</small>--}}
            {{--</h3>--}}
            {{--<!-- The progress bar -->--}}
            {{--<div class="progress xs">--}}
            {{--<!-- Change the css width attribute to simulate progress -->--}}
            {{--<div class="progress-bar progress-bar-aqua" style="width: 20%"--}}
            {{--role="progressbar"--}}
            {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
            {{--<span class="sr-only">20% Complete</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<!-- end task item -->--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="footer">--}}
            {{--<a href="#">View all tasks</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        @if(Auth::user()->user_image!=null)
                            <img class="user-image"
                                 src="{{asset('/storage/avatar/'.Auth::user()->user_image)}}"
                                 alt="User Image" height="160px">
                        @else
                            <img class="user-image"
                                 src="{{url('/uploads/users/dummyUser.png')}}"
                                 alt="User Image" height="160px">
                    @endif
                    <!--  <img src="{{url('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            @if(Auth::user()->user_image!=null)
                                <img class="img-circle"
                                     src="{{asset('/storage/avatar/'.Auth::user()->user_image)}}"
                                     alt="User Image" height="160px">
                            @else
                                <img class="img-circle"
                                     src="{{url('/uploads/users/dummyUser.png')}}"
                                     alt="User Image" height="160px">
                            @endif

                            <p>
                                {{Auth::user()->name}}
                                <small>Member since {{date("j M. Y", strtotime(Auth::user()->created_at))}}</small>
                            </p>
                        </li>
                    {{--<!-- Menu Body -->--}}
                    {{--<li class="user-body">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Followers</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Sales</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Friends</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /.row -->--}}
                    {{--</li>--}}
                    <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>

                            <div class="pull-right">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
