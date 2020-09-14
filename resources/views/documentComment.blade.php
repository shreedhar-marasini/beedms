<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Document comment</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i>
            </button>
            <a href="{{url('user-widget/status',$userWidget->widget_id)}}"  class="btn btn-box-tool" ><i
                        class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="direct-chat-messages" style="height: 406px">
    <!-- Message. Default to the left -->
    @foreach($documentComments as $documentComment)
        @if($documentComment->document_comments_type=='incoming')
            <?php $document = \App\Models\IncomingDocument::find($documentComment->documents_id);  ?>
            @if(count($document)!=0)
                <div class="direct-chat-msg" >
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">{{$documentComment->user->name}}</span>
                        <span class="direct-chat-timestamp pull-right">{{date("j M, Y H:i a", strtotime($documentComment->created_at))}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    @if($documentComment->user->user_image!=null)

                        <img class="direct-chat-img"
                             src="{{asset('/storage/avatar/'.$documentComment->user->user_image)}}"
                             alt="message user image">
                    @else
                        <img class="direct-chat-img"
                             src="{{url('uploads/users/dummyUser.png')}}"
                             alt="message user image">

                @endif
                <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        "{{$documentComment->document_comments_description}}" in
                        incoming document <a target="_blank"
                                             href="{{url('documents/incomingDocument/'.$document->id)}}">{{$document->incoming_document_subject}}</a>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

            @endif


        @elseif($documentComment->document_comments_type=='outgoing')
            <?php $document = \App\Models\OutgoingDocument::find($documentComment->documents_id) ?>
            @if($document!=null)
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">{{$documentComment->user->name}}</span>
                        <span class="direct-chat-timestamp pull-right">{{date("j M, Y H:i a", strtotime($documentComment->created_at))}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    @if($documentComment->user->user_image!=null)

                        <img class="direct-chat-img"
                             src="{{asset('/storage/avatar/'.$documentComment->user->user_image)}}"
                             alt="message user image">
                    @else
                        <img class="direct-chat-img"
                             src="{{url('uploads/users/dummyUser.png')}}"
                             alt="message user image">

                @endif
                <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        "{{$documentComment->document_comments_description}}" in
                        incoming document <a target="_blank"
                                             href="{{url('documents/outgoingDocument/'.$document->id)}}">{{$document->outgoing_document_subject}}</a>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->


            @endif


        @else
            <?php $document = \App\Models\DigitizedDocument::find($documentComment->documents_id) ?>
            @if($document!=null)
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">{{$documentComment->user->name}}</span>
                        <span class="direct-chat-timestamp pull-right">{{date("j M, Y H:i a", strtotime($documentComment->created_at))}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    @if($documentComment->user->user_image!=null)

                        <img class="direct-chat-img"
                             src="{{asset('/storage/avatar/'.$documentComment->user->user_image)}}"
                             alt="message user image">
                    @else
                        <img class="direct-chat-img"
                             src="{{url('uploads/users/dummyUser.png')}}"
                             alt="message user image">

                @endif
                <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        "{{$documentComment->document_comments_description}}" in
                        incoming document <a target="_blank"
                                             href="{{url('documents/outgoingDocument/'.$document->id)}}">{{$document->outgoing_document_subject}}</a>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->


            @endif

        @endif




    @endforeach


</div>
</div>
</div>