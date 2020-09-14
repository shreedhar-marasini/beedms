@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('eng.logs')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('eng.home')}}</a></li>
                <li>{{trans('eng.logs')}}</li>
                <li class="active">{{trans('eng.failLog')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')

            <div class="row">

                <div class="col-md-12" id="listing">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{trans('eng.failLog')}}</h3>

                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px;">S.N</th>
                                    <th class="text-center">{{trans('eng.user')}}</th>
                                    <th class="text-center">{{trans('eng.ipAddress')}}</th>
                                    <th class="text-center">{{trans('eng.device')}}</th>
                                    <th class="text-center">{{trans('eng.date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @forelse($failLogins as $failLogin)
                                    <tr>
                                        <th scope=row>{{$i}}</th>
                                        <td>{{$failLogin->user_name}}</td>
                                        <td>{{$failLogin->log_in_ip}}</td>
                                        <td>{{$failLogin->log_in_device}}</td>
                                        <td>{{$failLogin->created_at}}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty<h5>{{trans('eng.noRecordFound')}} </h5>
                                @endforelse
                                </tbody>
                            </table>

                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection