@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Reminders
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('eng.home')}}</a></li>
                <li class="active">{{trans('eng.reminder')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            
            <div class="row">
                @if(\Request::segment(2)!='')
                    <div class="col-md-9" id="listing">
                @else
                    <div class="col-md-12" id="listing">
                @endif
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <?php

                                $permission =  helperPermissionLink(url('/reminder/create'),url('reminder'));


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
                                                  
                                                        <input type="text" name="reminder_title" class="form-control filterForm"
                                                               placeholder="Reminder Title">
                                                        <input type="text" name="document_type" class="form-control filterForm"
                                                               placeholder="Document Type">
                                                        <input type="email" name="reminder_to_email" class="form-control filterForm"
                                                               placeholder="Reminder Email">
                                                      
                                                                
                                    <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{url('/reminder')}}" type="button"
                                                           class="btn btn-warning"><i
                                                                    class="fa fa-refresh"></i> Refresh
                                                        </a>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" class="text-center">{{trans('eng.serialNumber')}}</th>
                                            <th class="text-center" scope="col" colspan="7">{{trans('eng.reminder')}}</th>
                                            <th class="text-center" scope="col" rowspan="2" width="12%">{{trans('eng.action')}}</th>
                                        </tr>
                                        <tr>
                                            <th> Reminder Title</th>

                                            <th> Date</th>

                                            <th> Email To</th>
                                            <th>Remind To All</th>
                                            <th>Document Type</th>
                                            <th> Reminder Type</th>
                                            <th>Snooze Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;?>
                                        @forelse($reminders as $reminder)
                                            <tr>
                                                <th scope=row>{{$i}}</th>
                                                <td>{{$reminder->reminder_title}}</td>
                                                <td>{{$reminder->reminder_date}}</td>
                                                <td>{{$reminder->reminder_to_email}}</td>
                                                <td>{{$reminder->remind_to_all}}</td>
                                                <td>{{$reminder->document_type}}</td>
                                                <td>{{$reminder->reminder_type}}</td>
                                                <td>{{$reminder->reminder_snooze_date}}</td>

                                                <td class="text-right">
                                                    <a href="{{route('reminder.show',[$reminder->id])}}" class="text-success " data-toggle="tooltip"
                                                       data-placement="top" title="View">
                                                        <i class="fa fa-binoculars actionIcon" ></i>
                                                    </a>&nbsp;
                                                    &nbsp;
                                                    @if($allowEdit)
                                                        <a href="{{route('reminder.edit',[$reminder->id])}}" class="text-info actionIcon" data-toggle="tooltip"
                                                           data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @endif

                                                    @if($allowDelete)
                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['reminder.destroy',
                                                            $reminder->id],'class'=> 'inline']) !!}
                                                        <button type="submit"
                                                                class="link deleteButton actionIcon"
                                                                data-toggle="tooltip"
                                                                data-placement="top" title="Delete"
                                                                onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>

                                                        {!! Form::close() !!}
                                                    @endif

                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @empty<h5>{{trans('eng.noRecordFound')}}</h5>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>

                <div class="col-md-3">
                    @if(\Request::segment(2) != '')
                        @include('reminders.show')
                    @endif
                </div>

            </div>
        </div>
            <!-- /.box -->
    </section>
        <!-- /.content -->
</div>

    <!-- /.content-wrapper -->
@endsection


@section('js')

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-ddThh:ii:ss"
        });
    </script>

@endsection