@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Institution
                <!--                <small>Sub Module</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Institution</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">


            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$institution->institution_name}}</h3>
                    <?php

                    $permission =  helperPermissionLink(url('institution'),url('institution'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle"
                                         src="{{url('/dist/img/institution.png')}}" alt="User profile picture" height="128px">

                                    <h3 class="profile-username text-center">
                                        {{$institution->institution_name}}
                                        <a href="{{route('institution.edit',[$institution->id])}}"
                                           class="text-info actionIcon" data-toggle="tooltip"
                                           data-placement="top" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>&nbsp;
                                    </h3>

                                    <p class="text-muted text-center">{{$institution->institution_address}}
                                    </p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b><i class="fa fa-envelope-o"></i></b> <a
                                                    class="pull-right">{{$institution->institution_email_address}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><i class="fa fa-phone"></i></b> <a
                                                    class="pull-right">{{$institution->institution_contact_number}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><i class="fa fa-globe"></i></b> <a
                                                    class="pull-right">{{$institution->institution_website}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Documents</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="chartContainer">

                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
                                    <li><a href="#incoming" data-toggle="tab">Incoming</a></li>
                                    <li><a href="#outgoing" data-toggle="tab">Outgoing</a></li>
                                    <li><a href="#digitized" data-toggle="tab">Digitized</a></li>
                                    <li><a href="#nameCard" data-toggle="tab">Name Cards</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="incoming">
                                        <div class="table-responsive">

                                            <table id="example1" class="table table-hover table-striped ">
                                                <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Subject</th>
                                                    <th>Issue Information</th>
                                                    <th>Registration Information</th>
                                                    <th style="width:100px" class="text-right">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(count($incomingDocuments)>0)
                                                    @foreach($incomingDocuments as $key=>$incomingDocument)
                                                        <tr>
                                                            <th scope=row>{{++$key}}</th>
                                                            <td><a href="{{route('incomingDocument.show',[$incomingDocument->id])}}" target="_blank">{{$incomingDocument->incoming_document_subject}}</a>
                                                                <br>
                                                                <i class="pull-right help-block mark small">Uploaded By: {{$incomingDocument->user->name}}</i></td>
                                                            <td><b>{{$incomingDocument->issue_number}}</b><br>
                                                                <i>{{$incomingDocument->issue_date}}</i></td>
                                                            <td><b>{{$incomingDocument->incoming_document_registration_number}}</b><br>
                                                                <i>{{$incomingDocument->incoming_document_registration_date}}</i>
                                                            </td>
                                                            <td class="text-right">
                                                                {!! Form::open(['method' => 'DELETE','route' => ['incomingDocument.destroy', $incomingDocument->id]]) !!}
                                                                <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}" class="text-success " data-toggle="tooltip"
                                                                   data-placement="top" title="View">
                                                                    <i class="fa fa-binoculars actionIcon" ></i>
                                                                </a>&nbsp;

                                                                @if($allowEdit)
                                                                    <a href="{{route('incomingDocument.edit',[$incomingDocument->id])}}" class="text-info actionIcon" data-toggle="tooltip"
                                                                       data-placement="top" title="Edit">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>&nbsp;
                                                                @endif

                                                                @if($allowDelete)
                                                                <button type="submit"
                                                                            class="btn btn-default btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                @endif


                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="active tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <ul class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            @foreach($timelineDate as $date)

                                                <?php $actions = \App\Repository\Institution\InstitutionRepository::getDocumentInfo($date->created_at, $institution->id);
                                                ?>
                                                        <li class="time-label">
                                                            <?php
                                                            $background_colors = array('bg-red', 'bg-blue', 'bg-yellow'
                                                            , 'bg-green', 'bg-teal', 'bg-orange', 'bg-fuchsia', 'bg-purple', 'bg-maroon', 'bg-black', 'bg-aqua');

                                                            $rand_background = $background_colors[shuffle($background_colors)];
                                                            ?>
                                                            <span class={{$rand_background}}>{{date("j M. Y", strtotime($date->created_at))}}</span>
                                                        </li>
                                                @foreach($actions as $action)
                                                    @if($action->documentType=="incoming" && $action->timelineType=="incoming")
                                                        <?php $incomingDocument = \App\Models\IncomingDocument::find($action->document_id);
                                                        ?>
                                                        @if(count($incomingDocument)>0)
                                                            <li>
                                                                <i class="glyphicon glyphicon-copy" style="border-radius: 0%; background-color: #dd4b39; color:white; "></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i> {{$incomingDocument->created_at->diffForHumans()}}</span>

                                                                    <h3 class="timeline-header"><a
                                                                                href="#">{{$incomingDocument->user->name}}</a>
                                                                        uploaded document</h3>

                                                                    <div class="timeline-body">
                                                                        <?php  $incoming_document = \App\Models\IncomingDocument::with('institution')->with('department')->find($action->document_id)?>
                                                                        with
                                                                        subject
                                                                            <a href="{{url('documents/incomingDocument/'.$incoming_document->id)}}" ><b>{{$incoming_document->incoming_document_subject}}</b></a>
                                                                        issued
                                                                        to
                                                                        <b>{{$incoming_document->institution->institution_name}}</b>
                                                                            in <i>{{$incoming_document->issue_date}}</i>
                                                                    </div>
                                                                    {{--<div class="timeline-footer">--}}
                                                                        {{--<a class="btn btn-primary btn-xs">Read more</a>--}}
                                                                        {{--<a class="btn btn-danger btn-xs">Delete</a>--}}
                                                                    {{--</div>--}}
                                                                </div>
                                                            </li>
                                                        @endif

                                                    @elseif($action->documentType=="outgoing" && $action->timelineType=="outgoing")
                                                        <?php $document = \App\Repository\Documents\OutgoingDocumentRepository::find($action->document_id);
                                                        ?>

                                                        @if(count($document)!=0)
                                                            <li>
                                                                <i class="glyphicon glyphicon-paste bg-maroon" style="border-radius: 0%;  background-color: #00a65a; color:white"></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i> {{$document->created_at->diffForHumans()}}</span>

                                                                    <h3 class="timeline-header"><a
                                                                                href="#">{{$document->user->name}}</a>
                                                                        created document</h3>

                                                                    <div class="timeline-body">
                                                                        with
                                                                        subject
                                                                        <b>{{$document->outgoing_document_subject}}</b>
                                                                        issued
                                                                        to
                                                                        <b>{{$document->institution->institution_name}}</b>


                                                                        @if($document->outgoing_issue_number!=null)
                                                                            {{$document->outgoing_issue_date}}
                                                                            on date{{$document->outgoing_issue_date}}
                                                                            with  issued
                                                                            number
                                                                            <b>{{$document->outgoing_issue_number}}</b>
                                                                        @else
                                                                            created
                                                                            on  {{$document->created_at}}
                                                                        @endif
                                                                        {{----}}
                                                                        {{--under--}}
                                                                        {{--category{{$document->template->template_name}}--}}
                                                                    </div>
                                                                    <!--<div class="timeline-footer">
                                                                        <a class="btn btn-primary btn-xs">Read more</a>
                                                                        <a class="btn btn-danger btn-xs">Delete</a>
                                                                    </div>-->
                                                                </div>
                                                            </li>
                                                        @endif


                                                    @elseif($action->documentType=="digitized" && $action->timelineType=="digitized")

                                                        <?php $digitizedDocument = \App\Models\DigitizedDocument::find($action->document_id);?>
                                                        <li>
                                                            <i class="glyphicon glyphicon-floppy-disk bg-teal"  style="border-radius: 0%; background-color: #ff851b; color:white"></i>
                                                            <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i> {{$digitizedDocument->created_at->diffForHumans()}}</span>

                                                                <h3 class="timeline-header"><a
                                                                            href="#">{{$digitizedDocument->user->name}}</a>
                                                                    uploaded document</h3>

                                                                <div class="timeline-body">

                                                                    with
                                                                    subject
                                                                    <b><a href=""> {{$digitizedDocument->digitized_document_name}} </a></b>
                                                                    issued
                                                                    to
                                                                    <b>{{$digitizedDocument->institution->institution_name}}</b>

                                                                    @if($digitizedDocument->template_id!= 0)
                                                                        <?php $template=\App\Models\Template::find($digitizedDocument->template_id) ?>
                                                                        under
                                                                        category {{$template->template_name}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>

                                                    @elseif($action->documentType=="outgoing" && $action->timelineType=="email")
                                                        <li>
                                                            <?php $track = \App\Models\EmailLog::with('user')->with('department')->where('email_logs_document_type', '=', 'outgoing')->where('email_logs_document_id', '=', $action->document_id)->first();
                                                            $document = \App\Models\OutgoingDocument::with('template')->find($action->document_id)?>

                                                            @if(count($track)>0)
                                                                <i class="fa fa-envelope bg-green"></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($track->created_at))->diffForHumans() ?> </span>

                                                                    <h3 class="timeline-header"><a
                                                                                href="#">{{$track->user->name}}</a>
                                                                        has sent email
                                                                        to <?php $emailAddersses = unserialize($track->email_logs_address)?>
                                                                    </h3>
                                                                    <div class="timeline-body">
                                                                        @foreach($emailAddersses as $email)
                                                                            {{$email}}
                                                                        @endforeach
                                                                        with subject <a
                                                                                href="{{url('/documents/outgoingDocument/'.$document->id)}}"
                                                                                target="_blank"> {{$document->outgoing_document_subject}}</a>
                                                                        @if($document->outgoing_issue_number!=null)
                                                                            ,issue number
                                                                            <b>{{$document->outgoing_issue_number}}</b>
                                                                        @endif
                                                                        under {{$document->template->template_name}}
                                                                    </div>


                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endif


                                                @endforeach

                                            @endforeach


                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="incoming">
                                        <div class="table-responsive">

                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Subject</th>
                                                    <th>Issue Information</th>
                                                    <th>Registration Information</th>
                                                    <th style="width:100px" class="text-right">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(count($incomingDocuments)>0)
                                                    @foreach($incomingDocuments as $key=>$incomingDocument)
                                                        <tr>
                                                            <th scope=row>{{++$key}}</th>
                                                            <td><a href="{{route('incomingDocument.show',[$incomingDocument->id])}}" target="_blank">{{$incomingDocument->incoming_document_subject}}</a>
                                                                <br>
                                                                <i class="pull-right help-block mark small">Uploaded By: {{$incomingDocument->user->name}}</i></td>
                                                            <td><b>{{$incomingDocument->issue_number}}</b><br>
                                                                <i>{{$incomingDocument->issue_date}}</i></td>
                                                            <td><b>{{$incomingDocument->incoming_document_registration_number}}</b><br>
                                                                <i>{{$incomingDocument->incoming_document_registration_date}}</i>
                                                            </td>
                                                            <td class="text-right">
                                                                {!! Form::open(['method' => 'DELETE','route' => ['incomingDocument.destroy', $incomingDocument->id]]) !!}
                                                                <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}" class="text-success " data-toggle="tooltip"
                                                                   data-placement="top" title="View">
                                                                    <i class="fa fa-binoculars actionIcon" ></i>
                                                                </a>&nbsp;

                                                                @if($allowEdit)
                                                                    <a href="{{route('incomingDocument.edit',[$incomingDocument->id])}}" class="text-info actionIcon" data-toggle="tooltip"
                                                                       data-placement="top" title="Edit">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>&nbsp;
                                                                @endif

                                                                @if($allowDelete)
                                                                    <button type="submit"
                                                                            class="btn btn-default btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                @endif


                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="outgoing">
                                        <div class="table-responsive">

                                            <table id="example2" class="table hover table-striped">
                                                <thead>


                                                <tr>
                                                    <th style="width: 10px">S.N</th>
                                                    <th style="width: 190px">Subject</th>
                                                    <th>Issue Information</th>
                                                    <th class="text-center"> Created / Signed /Issued</th>

                                                    <th style="width: 30px" class="text-center">Status</th>
                                                    <th style="width: 60px" class="text-right">Action</th>
                                                </tr>


                                                </thead>
                                                <tbody>
                                                @if(count($outgoingDocuments)>0)

                                                    @foreach($outgoingDocuments as $outgoingDocument)
                                                        <tr>

                                                            <th scope=row>1</th>
                                                            <td>
                                                                <a href="{{url('/documents/outgoingDocument/'.$outgoingDocument->id)}}"
                                                                   target="_blank">{{$outgoingDocument->outgoing_document_subject}}</a>
                                                                <br>
                                                                <b>{{$outgoingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;
                                                            </td>
                                                            <td>{{$outgoingDocument->outgoing_issue_date}}<br>
                                                                <i><b>{{$outgoingDocument->outgoing_issue_number}}</b></i>
                                                                <i> {{$outgoingDocument->department_name}}</i>
                                                            </td>
                                                            <td class="text-center">
                                                                <table style=" width: 100%;">
                                                                    <tr>
                                                                        <td style="width: 33%">
                                                                            @if($outgoingDocument->user_image!=null)
                                                                                <img src="{{url('uploads/users/'.$outgoingDocument->user_image)}}"
                                                                                     class="img-circle" height="20px">
                                                                            @else
                                                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                                     class="img-circle" height="20px">

                                                                            @endif

                                                                        </td>
                                                                        @if($outgoingDocument->signature_user_id !=null)
                                                                            <td style="width: 34%">
                                                                                <?php $signature = App\User::find($outgoingDocument->signature_user_id)?>

                                                                                @if($signature->user_image!=null)
                                                                                    <img src="{{url('uploads/users/'.$outgoingDocument->user_image)}}"
                                                                                         class="img-circle"
                                                                                         height="20px">
                                                                                @else
                                                                                    <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                                         class="img-circle"
                                                                                         height="20px">
                                                                                @endif
                                                                            </td>
                                                                        @endif
                                                                        @if($outgoingDocument->issued_by !=null)
                                                                            <?php $issue = App\User::find($outgoingDocument->issued_by)?>

                                                                            @if($issue->user_image!=null)
                                                                                <td style="width: 33%">
                                                                                    <img src="{{url('uploads/users/'.$outgoingDocument->user_image)}}"
                                                                                         class="img-circle"
                                                                                         height="20px">

                                                                                </td>
                                                                            @else
                                                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                                     class="img-circle" height="20px">
                                                                            @endif
                                                                        @endif
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <?php $fname = explode(" ", $outgoingDocument->name)?>{{$fname[0]}}


                                                                        </td>
                                                                        <td>
                                                                            @if($outgoingDocument->signature_user_id !=null)
                                                                                <?php $fname = explode(" ", $outgoingDocument->name)?>{{$fname[0]}}
                                                                            @endif


                                                                        </td>
                                                                        <td>
                                                                            @if($outgoingDocument->issued_by !=null)
                                                                                <?php $fname = explode(" ", $outgoingDocument->name)?>{{$fname[0]}}
                                                                            @endif


                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-10">
                                                                        <td>
                                                                            2017-1-1
                                                                        </td>
                                                                        <td>
                                                                            @if($outgoingDocument->signature_user_id !=null)
                                                                                2017-1-1
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($outgoingDocument->issued_by !=null)
                                                                                2017-1-1
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </table>


                                                            </td>


                                                            <td class="text-center">
                                                                <a href="javascript:void(0)"
                                                                   class="label label-success">
                                                                    <strong> Issue
                                                                    </strong>
                                                                </a>
                                                            </td>
                                                            <td class="text-right">

                                                                <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id)}}"
                                                                   class="text-success" data-toggle="tooltip"
                                                                   data-placement="top" title="View">
                                                                    <i class="fa fa-binoculars actionIcon"></i>
                                                                </a>&nbsp;
                                                                <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id.'/edit')}}"
                                                                   class="text-info actionIcon" data-toggle="tooltip"
                                                                   data-placement="top" title="Edit">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>&nbsp;


                                                                {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['outgoingDocument.destroy',
                                                                           $outgoingDocument->id]]) !!}
                                                                <button type="submit"
                                                                        class="btn btn-default btn-xs deleteButton actionIcon"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top" title="Delete"
                                                                        onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>

                                                                {!! Form::close() !!}


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="digitized">
                                        @if(!count($digitizedDocuments)>=0)
                                            <div class="table-responsive">
                                                <table id="example3" class="table table-hover table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>Document Name</th>
                                                        <th>Department</th>
                                                        <th>Category</th>
                                                        <th class="text-center" style="width: 100px">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i=1;
                                                    ?>
                                                    @foreach($digitizedDocuments as $digitizedDocument)
                                                        <tr>
                                                            <th scope=row>{{$i++}}</th>
                                                            <td><a href="{{route('digitizedDocument.show',[$digitizedDocument->id])}}" target="_blank">{{$digitizedDocument->digitized_document_name}}</a>
                                                                <br>
                                                                <b class="list-inline">{{$digitizedDocument->created_at->todatestring()}} <i class="pull-right help-block mark small">Uploaded By: {{$digitizedDocument->user->name}}</i></b>&nbsp;&nbsp;&nbsp;
                                                            </td>
                                                            <td>{{$digitizedDocument->department->department_name}}<br></td>
                                                            <td>{{$digitizedDocument->document_category->category_name}}<br></td>
                                                            <td class="text-right">
                                                                {!! Form::open(['method' => 'DELETE','route' => ['digitizedDocument.destroy', $digitizedDocument->id]]) !!}
                                                                <a href="{{route('digitizedDocument.show',[$digitizedDocument->id])}}" class="text-success " data-toggle="tooltip"
                                                                   data-placement="top" title="View">
                                                                    <i class="fa fa-binoculars actionIcon" ></i>
                                                                </a>&nbsp;

                                                                    <a href="{{route('digitizedDocument.edit',[$digitizedDocument->id])}}" class="text-info actionIcon" data-toggle="tooltip"
                                                                       data-placement="top" title="Edit">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>&nbsp;

                                                                    <button type="submit"
                                                                            class="btn btn-default btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                            </td>
                                                        </tr>


                                                    @endforeach


                                                    </tbody>
                                                </table>
                                            </div>

                                        @else
                                        @endif
                                    </div>

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="nameCard">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                </div>
                                                <br>
                                            </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <!-- Name Card -->
                                                <div class="box" style="min-height: 250px; padding-top: 20px">
                                                    <div class="box-body box-profile text-center">

                                                        <a><i class="fa fa-plus-circle fa-3x text-center" data-style="text-shadow: 2px 2px;" data-toggle="modal" data-target="#institution{{$institution->id}}" data-toggle="tooltip" title="Add new name card" style="font-size:150px"></i></a>

                                                        {{--<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#institution{{$institution->id}}">Add New</button>--}}

                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                                @foreach($nameCards as $key=>$nameCard)
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        <!-- Name Card -->
                                                        <div class="box box-primary" style="min-height: 250px;">
                                                            <div class="box-body box-profile">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                                        <img class="profile-user-img img-responsive"
                                                                             src="{{url('/uploads/users/dummyUser.png')}}"
                                                                             alt="Photo">
                                                                    </div>

                                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                                        <h3 class="profile-username"
                                                                            id="name_card_person">
                                                                            {{$nameCard->name_card_person}}
                                                                            <a><i class="fa fa-pencil pull-right" data-style="text-shadow: 2px 2px;" data-toggle="modal" data-target="#card{{$nameCard->id}}" data-toggle="tooltip" title="Add new name card"></i></a>

                                                                        </h3>
                                                                        <p class="text-muted">
                                                                            <span class="text-center">{{$nameCard->name_card_designation}}</span>
                                                                        </p>


                                                                    </div>

                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                    <p class="text-muted">
                                                                        <b><i class="fa fa-home"></i></b> <span
                                                                                class="text-center "> {{$nameCard->name_card_address}}</span>
                                                                    </p>
                                                                    <p class="text-muted">
                                                                        <b><i class="fa fa-envelope"></i></b> <span
                                                                                class="text-center "> {{$nameCard->name_card_email_address1}} &emsp;{{$nameCard->name_card_email_address2}} </span>
                                                                    </p>

                                                                    <p class="text-muted">
                                                                        <b><i class="fa fa-phone-square"></i></b> <span
                                                                                class="text-center"> {{$nameCard->name_card_contact_number1}} &emsp; {{$nameCard->name_card_contact_number2}}</span>
                                                                    </p>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.box -->
                                                    </div>


                                                <div class="modal fade" id="card{{$nameCard->id}}"
                                                     role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content col-md-10">
                                                            <div class="modal-header">

                                                                <button type="button"
                                                                        class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">
                                                                    Name Card Details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::model($nameCard,['method'=>'put','url'=>['institution/nameCard/update/'.$nameCard->id],'enctype'=>'multipart/form-data','files'=>true]) !!}

                                                                <div class="box-body">
                                                                    <input type="hidden"
                                                                           name="_token"
                                                                           value="{{ csrf_token() }}">



                                                                    <div class="form-group">
                                                                        <label for="name_card_person" class="control-label align">
                                                                            Name
                                                                        </label><label class="text-danger">*</label>
                                                                        {{Form::text('name_card_person',$nameCard->name_card_person,array('class'=>'form-control','id'=>'name_card_person','placeholder'=>'Name'))}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name_card_address" class="control-label align">
                                                                            Address
                                                                        </label><label class="text-danger">*</label>
                                                                        {{Form::text('name_card_address',$nameCard->name_card_address,array('class'=>'form-control','id'=>'name_card_address','placeholder'=>'Address'))}}
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name_card_designation" class="control-label align">
                                                                            Designation
                                                                        </label>
                                                                        {{Form::text('name_card_designation',$nameCard->name_card_designation,array('class'=>'form-control','id'=>'name_card_designation','placeholder'=>'Designation'))}}
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="name_card_email_address1"
                                                                               class="control-label align">
                                                                            Primary Email :
                                                                        </label><label class="text-danger">*</label>
                                                                        {{Form::email('name_card_email_address1',$nameCard->name_card_email_address1,array('class'=>'form-control','id'=>'name_card_email_address1','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                                        'Primary Email'))}}
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name_card_email_address2"
                                                                               class="control-label align">
                                                                            Secondary Email:
                                                                        </label>
                                                                        {{Form::email('name_card_email_address2',$nameCard->name_card_email_address2,array('class'=>'form-control','id'=>'name_card_email_address2','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                                        'Secondary Email'))}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name_card_contact_number1" class="control-label align">
                                                                            Primary Contact No :
                                                                        </label><label class="text-danger">*</label>
                                                                        {{Form::text('name_card_contact_number1',$nameCard->name_card_contact_number1,array('class'=>'form-control','id'=>'name_card_contact_number1','placeholder'=>'Primary Contact No'))}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name_card_contact_number2" class="control-label align">
                                                                            Secondary Contact No :
                                                                        </label>
                                                                        {{Form::text('name_card_contact_number2',$nameCard->name_card_contact_number2,array('class'=>'form-control','id'=>'name_card_contact_number2','placeholder'=>'Secondary Contact No'))}}
                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="box-footer">

                                                                <button type="submit"
                                                                        class="btn btn-primary pull-right"
                                                                        name="">
                                                                    Update
                                                                </button>
                                                                <br/>
                                                                <br/>

                                                                <label for="panel-body">Note
                                                                    :Field in <label
                                                                            class="text-danger">
                                                                        * </label> are
                                                                    mandatory
                                                                </label>
                                                            </div>
                                                            {{Form::close()}}

                                                        </div>

                                                    </div>

                                                </div>
                                                @endforeach
                                        </div>
                                        <div class="modal fade" id="institution{{$institution->id}}"
                                             role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content col-md-10">
                                                    <div class="modal-header">

                                                        <button type="button"
                                                                class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">
                                                            Name Card Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{Form::open(array('method' => 'POST','url'=>"/institution/nameCard/store",'enctype'=>'multipart/form-data'))}}

                                                        <div class="box-body">
                                                            <input type="hidden"
                                                                   name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                {{Form::hidden('institution_id',$institution->id)}}
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name_card_person" class="control-label align">
                                                                    Name
                                                                </label><label class="text-danger">*</label>
                                                                {{Form::text('name_card_person',null,array('class'=>'form-control','id'=>'name_card_person','placeholder'=>'Name'))}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name_card_address" class="control-label align">
                                                                    Address
                                                                </label><label class="text-danger">*</label>
                                                                {{Form::text('name_card_address',null,array('class'=>'form-control','id'=>'name_card_address','placeholder'=>'Address'))}}
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name_card_designation" class="control-label align">
                                                                    Designation
                                                                </label>
                                                                {{Form::text('name_card_designation',null,array('class'=>'form-control','id'=>'name_card_designation','placeholder'=>'Designation'))}}
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="name_card_email_address1"
                                                                       class="control-label align">
                                                                    Primary Email :
                                                                </label><label class="text-danger">*</label>
                                                                {{Form::email('name_card_email_address1',null,array('class'=>'form-control','id'=>'name_card_email_address1','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                                'Primary Email'))}}
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name_card_email_address2"
                                                                       class="control-label align">
                                                                    Secondary Email:
                                                                </label>
                                                                {{Form::email('name_card_email_address2',null,array('class'=>'form-control','id'=>'name_card_email_address2','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                                'Secondary Email'))}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name_card_contact_number1" class="control-label align">
                                                                    Primary Contact No :
                                                                </label><label class="text-danger">*</label>
                                                                {{Form::text('name_card_contact_number1',null,array('class'=>'form-control','id'=>'name_card_contact_number1','placeholder'=>'Primary Contact No'))}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name_card_contact_number2" class="control-label align">
                                                                    Secondary Contact No :
                                                                </label>
                                                                {{Form::text('name_card_contact_number2',null,array('class'=>'form-control','id'=>'name_card_contact_number2','placeholder'=>'Secondary Contact No'))}}
                                                            </div>





                                                        </div>


                                                    </div>
                                                    <div class="box-footer">

                                                        <button type="submit"
                                                                class="btn btn-primary pull-right"
                                                                name="">
                                                            Save
                                                        </button>
                                                        <br/>
                                                        <br/>

                                                        <label for="panel-body">Note
                                                            :Field in <label
                                                                    class="text-danger">
                                                                * </label> are
                                                            mandatory
                                                        </label>
                                                    </div>
                                                    {{Form::close()}}

                                                </div>

                                            </div>

                                        </div>



                                        </div>


                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        $(document).ready(function (e) {
            $('#buttonEdit').on('click', function () {
                var editableText = $("<input type='text' />");
                $('#name_card_person').replaceWith(editableText);

            })

        })
    </script>

    <script>
        $(document).ready(function () {

            // Build the chart
            Highcharts.chart('chartContainer', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:1f}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Letters',
                    colorByPoint: true,
                    data: [{
                        name: 'Incoming',
                        y: <?php echo count($incomingDocuments)?>,
                    }, {
                        name: 'Outgoing',
                        y: <?php echo count($outgoingDocuments)?>,
                    },
                    {
                        name: 'Digitized',
                        y: <?php echo count($digitizedDocuments)?>,

                    }
                    ]
                }]
            });
        });
    </script>
@endsection