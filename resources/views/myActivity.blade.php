<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">My Activity</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i>
            </button>
            <a href="{{url('user-widget/status',$userWidget->widget_id)}}"  class="btn btn-box-tool"><i
                        class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @foreach ($userActivity as $activity)

                @if($activity->document_type=="incoming"&& $activity->activity_type=="incoming")
                    <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id); ?>
                    @if($incomingDocument!=null)
                        <li class="item">
                            <div class="product-img bg-red">
                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-arrow-down"
                                                        ></i></span>
                            </div>
                            <div class="product-info">

                                <a href="{{url('documents/incomingDocument/'.$incomingDocument->id)}}"
                                   target="_blank"
                                   class="product-title">{{$incomingDocument->incoming_document_subject}}
                                    <span class="label label-warning pull-right">{{$incomingDocument->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">
                         Document is related to
                                            {{$incomingDocument->department->department_name}}
                                            department  from
                                            <a
                                                    href="{{url('institution/'.$incomingDocument->sender_institution_id)}}"
                                                    target="_blank"> {{$incomingDocument->institution->institution_name}} </a> institution is uploaded.
                        </span>
                            </div>
                        </li>
                    @endif
                @elseif($activity->document_type=="outgoing"&& $activity->activity_type=="outgoing")
                    <?php $document = \App\Models\OutgoingDocument::find($activity->document_id);?>
                    @if($document!=null)
                        <li class="item">
                            <div class="product-img bg-aqua">
                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-arrow-up"
                                                                style="margin-top: -50px !important;"></i></span>
                            </div>
                            <div class="product-info">

                                <a href="{{url('documents/outgoingDocument/'.$document->id)}}"
                                   target="_blank"
                                   class="product-title">{{$document->outgoing_document_subject}}
                                    <span class="label label-warning pull-right">{{$document->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">
                                        Document is
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
                        <li class="item">
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
                                                is Uploaded by <a
                                                        href="{{url('user/userProfile/'.$digitizedDocument->uploaded_by_user_id)}}">{{$digitizedDocument->user->name}}</a>
                                            @else
                                                is created by <a
                                                        href="{{url('user/userProfile/'.$digitizedDocument->uploaded_by_user_id)}}">{{$digitizedDocument->user->name}}</a>
                                            @endif
                                            related to <a target="_blank"
                                                          href="{{url('institution/'.$digitizedDocument->related_institution_id)}}"> {{$digitizedDocument->institution->institution_name}}</a>
                                         </span>
                            </div>
                        </li>
                    @endif
                @elseif($activity->document_type=="incoming"&& $activity->activity_type=="comments")

                    <?php $comment = \App\Models\DocumentComment::where('documents_id', '=', $activity->document_id)
                            ->where('created_at', '=', $activity->created_at)
                            ->where('document_comments_type', '=', 'incoming')->first();?>
                    @if($comment!=null)


                        <li class="item">
                            <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-chatbox-working"
                                                                style="margin-top: -50px !important;"></i></span>
                            </div>
                            <div class="product-info">

                                <a href="{{url('documents/incomingDocument/'.$comment->documents_id)}}"
                                   target="_blank"
                                   class="product-title">
                                    "{{$comment->document_comments_description}}"
                                    <span class="label label-warning pull-right">{{$comment->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">

                                     comment is added in incoming document <a
                                                    href="{{url('documents/incomingDocument/'.$comment->documents_id)}}"
                                                    target="_blank">
                                                 <?php $incomingDocument = \App\Models\IncomingDocument::find($activity->document_id)?>{{$incomingDocument->incoming_document_subject}}</a>
                                        </span>
                            </div>
                        </li>



                    @endif
                @elseif($activity->document_type=="outgoing"&& $activity->activity_type=="comments")
                    <?php $outgoingDocumentComment = \App\Models\DocumentComment::where('documents_id', '=', $activity->document_id)
                            ->where('created_at', '=', $activity->created_at)
                            ->where('created_at', '=', $activity->created_at)->where('document_comments_type', '=', 'outgoing')->first();?>
                    @if($outgoingDocumentComment!=null)


                        <li class="item">
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
                                    "{{$outgoingDocumentComment->document_comments_description}}"
                                    <span class="label label-warning pull-right">{{$outgoingDocumentComment->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">

                                     comment is added in outgoing document <a
                                                    href="{{url('documents/outgoingDocument/'.$outgoingDocumentComment->documents_id)}}"
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


                        <li class="item">
                            <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-chatbox-working"
                                                                style="margin-top: -50px !important;"></i></span>
                            </div>
                            <div class="product-info">

                                <a href="{{url('documents/digitizedDocument/'.$comment->documents_id)}}"
                                   target="_blank"
                                   class="product-title">
                                    "{{$comment->document_comments_description}}"
                                    <span class="label label-warning pull-right">{{$comment->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">

                                     comment is added in digitized document <a
                                                    href="{{url('documents/digitizedDocument/'.$comment->documents_id)}}"
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
                        <li class="item">
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

                                    document is sent to
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
                        <li class="item">
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

                                    document is sent to
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
                        <li class="item">
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

                                    document is sent to
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
                        <li class="item">
                            @if($tracks->tracks_action_type=="download")
                                <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-download"
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
                                                    href="{{url('institution/'.$incomingDocument->sender_institution_id)}}">{{$incomingDocument->institution->institution_name}}</a> is {{$tracks->tracks_action_type}}
                                            ed

                                        </span>
                            </div>
                        </li>

                    @endif
                @elseif($activity->document_type=="outgoing" && $activity->activity_type=="tracks")
                    <?php $tracks = \App\Models\DocumentTrack::where('tracks_document_id', '=', $activity->document_id)
                            ->where('created_at', '=', $activity->created_at)
                            ->where('tracks_document_type', '=', 'outgoing')->first();?>
                    @if($tracks!=null)
                        <li class="item">
                            @if($tracks->tracks_action_type=="download")
                                <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-download"
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
                                                    href="{{url('institution/'.$outgoingDocument->sender_institution_id)}}">{{$outgoingDocument->institution->institution_name}}</a> is {{$tracks->tracks_action_type}}
                                            ed


                                        </span>
                            </div>
                        </li>

                    @endif

                @elseif($activity->document_type=="digitized"&& $activity->activity_type=="tracks")
                    <?php $tracks = \App\Models\DocumentTrack::where('tracks_document_id', '=', $activity->document_id)
                            ->where('created_at', '=', $activity->created_at)
                            ->where('tracks_document_type', '=', 'digitized')->first();?>
                    @if($tracks!=null)
                        <li class="item">
                            @if($tracks->tracks_action_type=="download")
                                <div class="product-img bg-blue">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-download"
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
                                                    href="{{url('institution/'.$digitizedDocument->sender_institution_id)}}">{{$digitizedDocument->institution->institution_name}}</a> is {{$tracks->tracks_action_type}}
                                            ed


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
                        <li class="item">

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
                                                    href="{{url('institution/'.$incomingDocument->sender_institution_id)}}">{{$incomingDocument->institution->institution_name}}</a> is to be reminded on {{$tracks->reminder_date}}


                                        </span>
                            </div>
                        </li>

                    @endif
                @elseif($activity->document_type=="outgoing" && $activity->activity_type=="reminder")
                    <?php $tracks = \App\Models\Reminder::where('document_id', '=', $activity->document_id)
                            ->where('created_at', '=', $activity->created_at)
                            ->where('document_type', '=', 'outgoing')->first();?>
                    @if($tracks!=null)
                        <li class="item">
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

                                            Reminder is added in  <a href="{{url('documents/outgoingDocument/'.$activity->document_id)}}"
                                                                     target="_blank"
                                                                     class="product-title">{{$outgoingDocument->outgoing_document_subject}}   </a>  <!-- with <a
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
                        <li class="item">
                            <div class="product-img bg-red">

                                                    <span class="user-activity-icon"
                                                          style="height: 50px; width: 50px"><i
                                                                class="ion ion-android-alarm-clock"
                                                                style="margin-top: -50px !important;"></i></span>
                            </div>
                            <div class="product-info">

                                <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                   target="_blank"
                                   class="product-title">
                                    <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$tracks->reminder_content}}
                                    <span class="label label-warning pull-right">{{$tracks->created_at->format('Y-m-d')}}</span></a>
                                        <span class="product-description">
                                             Reminder is added in  <a href="{{url('documents/digitized_document/'.$activity->document_id)}}"
                                                                      target="_blank"
                                                                      class="product-title">
                                                        <?php $digitizedDocument = \App\Models\DigitizedDocument::find($activity->document_id)?>{{$digitizedDocument->digitized_document_name}}


                                                        <!-- <a
                                                    href="{{url('institution/'.$digitizedDocument->sender_institution_id)}}">{{$digitizedDocument->institution->institution_name}}</a> is {{$tracks->tracks_action_type}}
                                                                e-->


                                        </span>
                            </div>
                        </li>

                    @endif

                @endif
            @endforeach


        </ul>

    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">

        <a href="{{url('profile')}}"
           class="btn btn-sm btn-default btn-flat pull-right">View All
            Activities</a>
    </div>
    <!-- /.box-footer -->
</div>



