@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Profile
                <!--                <small>Sub Module</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Layout</a></li>
                <li class="active">Top Navigation</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            <div class="box box-default">
                <div class="box-header with-border">
                    <a href="{{url('dashboard')}}" class="pull-right" data-toggle="tooltip" title="Go Back"><i
                                class="fa fa-arrow-circle-left fa-2x"></i></a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <a data-toggle="modal" data-target="#myModal">
                                        @if($user->user_image!=null)
                                            <img class="profile-user-img img-responsive img-circle"
                                                 src="{{asset('/storage/avatar/'.$user->user_image)}}"
                                                 alt="User Image">
                                        @else
                                            <img class="profile-user-img img-responsive img-circle"
                                                 src="{{url('/uploads/users/dummyUser.png')}}"
                                                 alt="User Image">
                                        @endif
                                    </a>

                                    <div class="modal" id="myModal" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">Profile Picture</h4>
                                                </div>
                                                {{--<form action="{{url('/profile/profilePic')}}" method="post"--}}
                                                {{--enctype="multipart/form-data">--}}
                                                <div class="modal-body">


                                                    <div id="upload-demo"></div>


                                                    <div class="col-md-4" style="padding:5%;">

                                                        <strong>Select image:</strong>

                                                        <input type="file" id="image">



                                                    </div>


                                                    {{csrf_field()}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary upload-image">Save
                                                    </button>
                                                </div>
                                                {{--</form>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                                    <p class="text-muted text-center">{{$user->designation->designation_name}}</p>

                                </div>
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">About Me</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-building margin-r-5"></i> Department</strong>
                                    <p class="text-muted" style="float:right">
                                        {{$user->department->department_name}}
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                                    <p class="text-muted">
                                        {{$user->email}}
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-sign-in margin-r-5"></i> Last Logged in</strong>
                                    <p class="text-muted" style="float:right">
                                        <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($lastLogin))->diffForHumans() ?>
                                    </p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active" id="activity_li">
                                        <a href="#activity" data-toggle="tab" id="activity_tab">Activity</a>
                                    </li>
                                    <li id="settings_li">
                                        <a href="#settings" data-toggle="tab" id="setting_tab">Account Settings</a>
                                    </li>
                                    <li id="ui_li">
                                        <a href="#uiConfiguration" data-toggle="tab" id="ui_tab">User UI Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post infinite-scroll">
                                            <ul class="products-list product-list-in-box" id="clearfix">

                                                @if(count($userActivity)>0)
                                                    @foreach ($userActivity as $activity)

                                                        @if($activity->document_type=="incoming" && $activity->activity_type=="incoming")
                                                            <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id); ?>
                                                            @if($incomingDocument!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-red">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px">
                                                                        <i class="fa fa-upload"></i>
                                                                    </span>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <a href="{{url('documents/incomingDocument/'.$incomingDocument->id)}}"
                                                                           target="_blank"
                                                                           class="product-title">{{$incomingDocument->incoming_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$incomingDocument->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                            Document was related to
                                                                        {{$incomingDocument->department->department_name}}
                                                                        department  from

                                                                     <a href="{{url('institution/'.$incomingDocument->sender_institution_id)}}"
                                                                        target="_blank"> {{$incomingDocument->institution->institution_name}} </a> institution was uploaded.
                                                                    </span>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @elseif($activity->document_type=="outgoing"&& $activity->activity_type=="outgoing")
                                                            <?php $document = \App\Models\OutgoingDocument::find($activity->document_id);?>
                                                            @if($document!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-aqua">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px">
                                                                       <i class="ion ion-android-arrow-up"
                                                                          style="margin-top: -50px !important;"></i>
                                                                    </span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/outgoingDocument/'.$document->id)}}"
                                                                           target="_blank"
                                                                           class="product-title">{{$document->outgoing_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$document->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        Document was
                                                                        @if($document->created_by_user_id==Auth::user()->id && ( $document->outgoing_issue_status=="issued" ||  $document->outgoing_issue_status=="registered"))

                                                                            created by
                                                                            <a target="_blank"
                                                                               href="{{url('user/userProfile/'.$document->created_by_user_id)}}">{{$document->user->name}}</a>
                                                                            issued to
                                                                            <a
                                                                                    href="{{url('institution/'.$document->institution_id)}}"
                                                                                    target="_blank">{{$document->institution->institution_name}} </a>
                                                                            institution
                                                                            with {{$document->outgoing_issue_number}}
                                                                            on {{$document->outgoing_issue_date}}
                                                                            <?php $user = \App\User::find($document->signature_user_id)?>
                                                                            @if($user!=null)
                                                                                and signed
                                                                                by
                                                                                <a target="_blank"
                                                                                   href="{{url('user/userProfile/'.$user->id)}}">{{ $user->name}} </a>
                                                                                signature.
                                                                            @endif


                                                                        @elseif($document->created_by_user_id!=Auth::user()->id && ( $document->outgoing_issue_status=="issued" ||  $document->outgoing_issue_status=="registered"))
                                                                            created by
                                                                            <a target="_blank"
                                                                               href="{{url('user/userProfile/'.$document->created_by_user_id)}}">{{$document->user->name}}</a>

                                                                            , issued to  <a
                                                                                    href="{{url('institution/'.$document->institution_id)}}"
                                                                                    target="_blank"> {{$document->institution->institution_name}} </a>
                                                                            institution
                                                                            with {{$document->outgoing_issue_number}}
                                                                            on {{$document->outgoing_issue_date}}
                                                                            <?php $user = \App\User::find($document->signature_user_id)?>
                                                                            @if($user!=null)
                                                                                and signed
                                                                                by
                                                                                <a target="_blank"
                                                                                   href="{{url('user/userProfile/'.$user->id)}}"> {{ $user->name}} </a>
                                                                                signature.
                                                                            @endif
                                                                        @else
                                                                            created by  <a
                                                                                    target="_blank"
                                                                                    href="{{url('user/userProfile/'.$document->created_by_user_id)}}">{{$document->user->name}}</a>
                                                                            <?php $user = \App\User::find($document->signature_user_id)?>
                                                                            @if($user!=null)
                                                                                and signed
                                                                                by
                                                                                <a target="_blank"
                                                                                   href="{{url('user/userProfile/'.$user->id)}}"> {{ $user->name}} </a>
                                                                                signature.
                                                                            @endif

                                                                        @endif

                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @elseif($activity->document_type=="digitized"&& $activity->activity_type=="digitized")

                                                            <?php $digitizedDocument = \App\Models\DigitizedDocument::where('created_at', '=', $activity->created_at)
                                                                    ->find($activity->document_id);?>
                                                            @if($digitizedDocument!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-orange">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px"><i
                                                                                class="ion ion-filing"
                                                                                style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/digitizedDocument/'.$digitizedDocument->id)}}"
                                                                           target="_blank"
                                                                           class="product-title">{{$digitizedDocument->digitized_document_name}}
                                                                            <span class="label label-warning pull-right">{{$digitizedDocument->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">

                                                                        @if($digitizedDocument->template_id!=null)
                                                                            was Uploaded by <a
                                                                                    href="{{url('user/userProfile/'.$digitizedDocument->uploaded_by_user_id)}}">{{$digitizedDocument->user->name}}</a>
                                                                        @else
                                                                            was created by <a
                                                                                    href="{{url('user/userProfile/'.$digitizedDocument->uploaded_by_user_id)}}">{{$digitizedDocument->user->name}}</a>
                                                                        @endif
                                                                        related to <a target="_blank"
                                                                                      href="{{url('institution/'.$digitizedDocument->related_institution_id)}}"> {{$digitizedDocument->institution->institution_name}}</a>
                                                                    </span>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @elseif($activity->document_type=="incoming" && $activity->activity_type=="comments")

                                                            <?php $comment = \App\Models\DocumentComment::where('documents_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_comments_type', '=', 'incoming')->first();?>
                                                            @if($comment!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-blue">

                                                            <span class="user-activity-icon"
                                                                  style="height: 50px; width: 50px">
                                                                <i class="ion ion-chatbox-working"
                                                                   style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/incomingDocument/'.$comment->documents_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            "{{$comment->document_comments_description}}
                                                                            "
                                                                            <span class="label label-warning pull-right">{{$comment->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        comment was added in incoming document
                                                                               <a href="{{url('documents/incomingDocument/'.$comment->documents_id)}}"
                                                                                  target="_blank">
                                                 <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id)?>{{$incomingDocument->incoming_document_subject}}</a>
                                                                    </span>
                                                                    </div>
                                                                </li>
                                                            @endif

                                                        @elseif($activity->document_type=="outgoing"&& $activity->activity_type=="comments")
                                                            <?php $outgoingDocumentComment = \App\Models\DocumentComment::where('documents_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_comments_type', '=', 'outgoing')->first();?>
                                                            @if($outgoingDocumentComment!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-blue">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px"><i
                                                                                class="ion ion-chatbox-working"
                                                                                style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/outgoingDocument/'.$outgoingDocumentComment->documents_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            "{{$outgoingDocumentComment->document_comments_description}}
                                                                            "
                                                                            <span class="label label-warning pull-right">{{$outgoingDocumentComment->created_at->format('Y-m-d')}}</span></a>
                                                                                    <span class="product-description">
                                                                                        comment was added in outgoing document
                                                                                               <a href="{{url('documents/outgoingDocument/'.$outgoingDocumentComment->documents_id)}}"
                                                                                                  target="_blank">
                                                                 <?php $outgoingDocument = \App\Models\OutgoingDocument::find($activity->document_id)?>{{$outgoingDocument->outgoing_document_subject}}</a>
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif

                                                        @elseif($activity->document_type=="digitized"&& $activity->activity_type=="comments")
                                                            <?php $comment = \App\Models\DocumentComment::where('documents_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_comments_type', '=', 'digitized')
                                                                    ->first();?>
                                                            @if($comment!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-blue">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px">
                                                                        <i class="ion ion-chatbox-working"
                                                                           style="margin-top: -50px !important;"></i>
                                                                    </span>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <a href="{{url('documents/digitizedDocument/'.$comment->documents_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            "{{$comment->document_comments_description}}
                                                                            "
                                                                            <span class="label label-warning pull-right">{{$comment->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        comment was added in digitized document
                                                                             <a href="{{url('documents/digitizedDocument/'.$comment->documents_id)}}"
                                                                                target="_blank">
                                                                <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$digitizedDocument->digitized_document_name}}</a>
                                                                    </span>
                                                                    </div>
                                                                </li>
                                                            @endif


                                                        @elseif($activity->document_type=="incoming"&& $activity->activity_type=="email")
                                                            <?php $email = \App\Models\EmailLog::where('email_logs_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('email_logs_document_type', '=', 'incoming')->first();?>
                                                            @if($email!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-green">
                                                                    <span class="user-activity-icon"
                                                                          style="height: 50px; width: 50px"><i
                                                                                class="ion ion-android-mail"
                                                                                style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/incomingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id)?>{{$incomingDocument->incoming_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$email->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        document was sent to
                                                                        <?php $emails = unserialize($email->email_logs_address)?>
                                                                        @foreach($emails as $email)
                                                                            <b>{{$email}}</b>
                                                                        @endforeach
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif
                                                        @elseif($activity->document_type=="outgoing" && $activity->activity_type=="email")
                                                            <?php $email = \App\Models\EmailLog::where('email_logs_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('email_logs_document_type', '=', 'outgoing')->first();?>
                                                            @if($email!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-green">

                                                                <span class="user-activity-icon"
                                                                      style="height: 50px; width: 50px"><i
                                                                            class="ion ion-android-mail"
                                                                            style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/outgoingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $outgoingDocument = \App\Models\OutgoingDocument::find($activity->document_id)?>{{$outgoingDocument->outgoing_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$email->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        document was sent to
                                                                        <?php $emails = unserialize($email->email_logs_address)?>
                                                                        @foreach($emails as $email)
                                                                            <b>{{$email}}</b>
                                                                        @endforeach
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif
                                                        @elseif($activity->document_type=="digitized"&& $activity->activity_type=="email")
                                                            <?php $email = \App\Models\EmailLog::where('email_logs_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('email_logs_document_type', '=', 'digitized')->first();?>
                                                            @if($email!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-green">

                                                            <span class="user-activity-icon"
                                                                  style="height: 50px; width: 50px"><i
                                                                        class="ion ion-android-mail"
                                                                        style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$digitizedDocument->digitized_document_name}}
                                                                            <span class="label label-warning pull-right">{{$email->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                        document was sent to
                                                                        <?php $emails = unserialize($email->email_logs_address)?>
                                                                        @foreach($emails as $email)
                                                                            <b>{{$email}}</b>
                                                                        @endforeach
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif

                                                        <!--document track document-->
                                                        @elseif($activity->document_type=="incoming"&& $activity->activity_type=="tracks")
                                                            <?php $tracks = \App\Models\DocumentTrack::where('tracks_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('tracks_document_type', '=', 'incoming')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">
                                                                    @if($tracks->tracks_action_type=="download")
                                                                        <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"><i
                                                                class="fa fa-download"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @elseif($tracks->tracks_action_type=="edit")
                                                                        <div class="product-img bg-maroon">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-edit"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-img bg-teal">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-eye"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>

                                                                    @endif
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/incomingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id)?>{{$incomingDocument->incoming_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">

                                                                                                        Document from <a
                                                                                href="{{url('institution/'.$incomingDocument->sender_institution_id)}}">{{$incomingDocument->institution->institution_name}}</a> was {{$tracks->tracks_action_type}}ed

                                        </span>
                                                                    </div>
                                                                </li>

                                                            @endif
                                                        @elseif($activity->document_type=="outgoing" && $activity->activity_type=="tracks")
                                                            <?php $tracks = \App\Models\DocumentTrack::where('tracks_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('tracks_document_type', '=', 'outgoing')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">
                                                                    @if($tracks->tracks_action_type=="download")
                                                                        <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="fa fa-download"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @elseif($tracks->tracks_action_type=="edit")
                                                                        <div class="product-img bg-maroon">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-edit"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-img bg-teal">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-eye"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>

                                                                    @endif
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/outgoingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $outgoingDocument = \App\Models\OutgoingDocument::find($activity->document_id)?>{{$outgoingDocument->outgoing_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">

                                                                      Document with <a
                                                                                href="{{url('institution/'.$outgoingDocument->sender_institution_id)}}">{{$outgoingDocument->institution->institution_name}}</a> was {{$tracks->tracks_action_type}}ed


                                        </span>
                                                                    </div>
                                                                </li>

                                                            @endif

                                                        @elseif($activity->document_type=="digitized"&& $activity->activity_type=="tracks")
                                                            <?php $tracks = \App\Models\DocumentTrack::where('tracks_document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('tracks_document_type', '=', 'digitized')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">
                                                                    @if($tracks->tracks_action_type=="download")
                                                                        <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="fa fa-download"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @elseif($tracks->tracks_action_type=="edit")
                                                                        <div class="product-img bg-maroon">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-edit"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-img bg-teal">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-eye"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                        </div>

                                                                    @endif
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$digitizedDocument->digitized_document_name}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                            Document with <a
                                                                                href="{{url('institution/'.$digitizedDocument->sender_institution_id)}}">{{$digitizedDocument->institution->institution_name}}</a> was {{$tracks->tracks_action_type}}ed


                                        </span>
                                                                    </div>
                                                                </li>

                                                            @endif
                                                        <!--Reminder to the document-->

                                                        @elseif($activity->document_type=="incoming"&& $activity->activity_type=="reminder")
                                                            <?php $tracks = \App\Models\Reminder::where('document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_type', '=', 'incoming')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">

                                                                    <div class="product-img bg-red">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-alarm-clock"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/incomingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id)?>{{$incomingDocument->incoming_document_subject}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                                                       Document from <a
                                                                                href="{{url('institution/'.$incomingDocument->sender_institution_id)}}">{{$incomingDocument->institution->institution_name}}</a> was to be reminded on {{$tracks->reminder_date}}
                                                                    </span>


                                                                    </div>
                                                                </li>

                                                            @endif
                                                        @elseif($activity->document_type=="outgoing" && $activity->activity_type=="reminder")
                                                            <?php $tracks = \App\Models\Reminder::where('document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_type', '=', 'outgoing')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-red">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-alarm-clock"
                                                                style="margin-top: -50px !important;"></i></span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/outgoingDocument/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $outgoingDocument = \App\Models\OutgoingDocument::find($activity->document_id)?>{{$tracks->reminder_content}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">

                                                                        Reminder was added in  <a
                                                                                href="{{url('documents/outgoingDocument/'.$activity->document_id)}}"
                                                                                target="_blank"
                                                                                class="product-title">{{$outgoingDocument->outgoing_document_subject}}   </a> <!-- with <a
                                                                                href="{{url('institution/'.$outgoingDocument->institution_id)}}">{{$outgoingDocument->institution->institution_name}}</a> -->
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif

                                                        @elseif($activity->document_type=="digitized"&& $activity->activity_type=="reminder")
                                                            <?php $tracks = \App\Models\Reminder::where('document_id', '=', $activity->document_id)
                                                                    ->where('created_at', '=', $activity->created_at)
                                                                    ->where('document_type', '=', 'digitized')->first();?>
                                                            @if($tracks!=null)
                                                                <li class="attachment-block clearfix">
                                                                    <div class="product-img bg-red">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-alarm-clock"
                                                                style="margin-top: -50px !important;"></i>
                                                    </span>
                                                                    </div>
                                                                    <div class="product-info">

                                                                        <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                                                           target="_blank"
                                                                           class="product-title">
                                                                            <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$tracks->reminder_content}}
                                                                            <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                                                    <span class="product-description">
                                             Reminder was added in <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                                                     target="_blank"
                                                                     class="product-title">
                                                                        <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>
                                                                        {{$digitizedDocument->digitized_document_name}}
                                                                        {{--<a href="{{url('institution/'.$digitizedDocument->sender_institution_id)}}">{{$digitizedDocument->institution->institution_name}}</a> was {{$tracks->tracks_action_type}}--}}
                                                                    </span>
                                                                    </div>
                                                                </li>

                                                            @endif

                                                        @endif
                                                    @endforeach

                                                @endif
                                                {{ $userActivity->links() }}

                                            </ul>
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="settings">
                                        <form id="myform" class="form-horizontal" action="{{url('/profile/password')}}"
                                              method="post">
                                            <div class="form-group {{ ($errors->has('old'))?'has-error':''}}">

                                                <label for="old" class="col-sm-3 control-label">Old password</label>
                                                <div class="col-sm-6">
                                                    <input type="password" name="old" class="form-control" id="old"
                                                           placeholder="Enter old password">
                                                    {!! $errors->first('old', '<span class="text-danger">:message</span>') !!}

                                                </div>
                                            </div>
                                            <div class="form-group {{ ($errors->has('password'))?'has-error':''}}">
                                                <label for="new" class="col-sm-3 control-label">New password</label>

                                                <div class="col-sm-6">
                                                    <input name="password" type="password" class="form-control" id="new"
                                                           placeholder="Enter new Password">
                                                    {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm" class="col-sm-3 control-label">Confirm
                                                    password</label>

                                                <div class="col-sm-6">
                                                    <input name="password_confirmation" type="password"
                                                           class="form-control" id="confirm"
                                                           placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            {{csrf_field()}}

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="uiConfiguration">
                                        @include('users.ui.index')
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
    <script src="{{asset('lib/croppie/croppie.js')}}"></script>


    <script type="text/javascript">

        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });


        var resize = $('#upload-demo').croppie({

            enableExif: true,

            enableOrientation: true,

            viewport: {

                width: 150,

                height: 150,

                type: 'circle'

            },

            boundary: {

                width: 250,

                height: 250

            }

        });


        $('#image').on('change', function () {

            var reader = new FileReader();

            reader.onload = function (e) {

                resize.croppie('bind', {

                    url: e.target.result

                }).then(function () {

                    console.log('jQuery bind complete');

                });

            }

            reader.readAsDataURL(this.files[0]);

        });


        $('.upload-image').on('click', function (ev) {

            resize.croppie('result', {

                type: 'canvas',

                size: 'viewport'

            }).then(function (img) {

                $.ajax({

                    url: "user/image",
                    type: "post",
                    data: { "_token": "{{ csrf_token() }}","image": img},
                    success: function (data) {
                        html = '<img src="' + img + '" />';
                        $("#preview-crop-image").html(html);
                        if (data) {
                            location.reload();
                        }

                    }

                });

            });

        });


    </script>

    <script>

        $(document).ready(function () {
            //navigation bar
            $(".nav li a").click(function () {
                var id = $(this).attr("id");

                localStorage.setItem("selectedolditem", id);
            });
            var selectedolditem = localStorage.getItem('selectedolditem');

            if (selectedolditem != null) {
                if (selectedolditem === 'setting_tab') {
                    $('#activity').removeClass("active selected");
                    $('#activity_li').removeClass("active selected");
                    $('#settings_li').addClass('active selected ');
                    $('#settings').addClass('active selected ');
                }


            }

        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function () {
            readURL(this);
        });
    </script>

    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function () {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img src="http://demo.itsolutionstuff.com/plugin/loader.gif" alt="loading">',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function () {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.master_layouts').on('change', function () {
                getValue = $(this).val();
                var key_name = $(this).data('id');
                $.ajax({
                    url: "/user/uiChangeLayout/" + key_name + "/" + getValue,
                    type: "GET",
                    success: function (data) {


                    }
                });
            });

        })
    </script>

@endsection
