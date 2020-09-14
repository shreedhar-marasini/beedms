<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Recently Added Documents</h3>

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
            @foreach ($recentlyAddedDocuments as $activity)

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


                @endif
            @endforeach


        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="javascript:void(0)" class="uppercase">View All Documents</a>
    </div>
    <!-- /.box-footer -->
</div>