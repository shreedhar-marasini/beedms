<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
            @if(Auth::user()->user_image!=null)
                <img class="img-circle"
                     src="{{asset('/storage/avatar/'.Auth::user()->user_image)}}"
                     alt="User Image" height="160px">
            @else
                <img class="img-circle"
                     src="{{url('/uploads/users/dummyUser.png')}}"
                     alt="User Image" height="160px">
            @endif
            <!--<img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">-->
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

    {{--<!-- search form (Optional) -->--}}
    {{--<form action="#" method="get" class="sidebar-form">--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
    {{--<span class="input-group-btn">--}}
    {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
    {{--</button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--<!-- /.search form -->--}}

    <!-- Sidebar Menu -->
        {{--<ul class="sidebar-menu" data-widget="tree">--}}
        {{--<li class="header">HEADER</li>--}}
        {{--<!-- Optionally, you can add icons to the links -->--}}
        {{--<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>--}}
        {{--<li><a href="{{url('documents/incoming/incomingIndex')}}"><i class="fa fa-envelope"></i> <span>Incomming Documents</span></a></li>--}}
        {{--<li class="treeview">--}}
        {{--<a href="#"><i class="fa fa-envelope-o"></i> <span>Outgoing </span>--}}
        {{--<span class="pull-right-container">--}}
        {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</span>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
        {{--<li><a href="#">Link in level 2</a></li>--}}
        {{--<li><a href="#">Link in level 2</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--</ul>--}}



        <?php
        $firstLevelMenus = App\Models\Menu::getMenu($id = 0);
        $secondLevelMenus = App\Models\Menu::getMenu($id = session('menuId'));
        $menus = App\Models\Menu::getMenus();

        ?>
        @if(count($firstLevelMenus)>0)


            <ul class="sidebar-menu" data-widget="tree">

                @foreach($menus as $menu)
                    @if($menu->parent_id==0)
                        <?php $secondLevelMenus = App\Models\Menu::getMenu($menu->id);  ?>

                        @if(count($secondLevelMenus)>0)
                            <li class="treeview">
                                <a href="#" class="dropdown-toggle"
                                   data-toggle="dropdown">{!! $menu->menu_icon !!}<span>{{$menu->menu_name}}</span>
                                    <span
                                            class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>         </span></a>


                                <ul class="treeview-menu">
                                    @foreach($secondLevelMenus as $secondLevelMenu)

                                        <li>
                                            <a href="{{url("$secondLevelMenu->menu_link")}}">{!! $secondLevelMenu->menu_icon !!} {{$secondLevelMenu->menu_name}}</a>
                                        </li>

                                    @endforeach
                                </ul>
                            </li>

                        @else
                            <li>
                                <a href="{{url($menu->menu_link)}}">{!! $menu->menu_icon !!}
                                    <span>{{$menu->menu_name}}</span>

                                </a>
                            </li>
                        @endif
                    @endif

                @endforeach

            </ul>



    @endif



    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>