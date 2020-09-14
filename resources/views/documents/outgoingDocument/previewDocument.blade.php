<style>
.A4page{
    font-size: 13px;
  overflow-y:auto;
}
</style>
<div class="nav-tabs-custom tabs" id="Tabs">
    <ul class="nav nav-tabs">
        <li class="active" id="preview_li">
            <a href="#preview" data-toggle="tab" id="preview_tab">Preview</a></li>
        {{--@if($document->outgoing_file_uploads!=null)--}}
        <li id="attachment_li"><a href="#attachment" data-toggle="tab"
                                  id="attachment_tab">Attachment</a></li>
        {{--@endif--}}
        <li id="timeline_li"><a href="#timeline" data-toggle="tab" id="timeline_tab">Timeline</a>
        </li>
        <li id="settings_li"><a href="#settings" data-toggle="tab"
                                id="setting_tab">Settings</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="preview">
            <div class="row">

              <!--                                                <img class="img-responsive col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12"-->
                <!--                                                     src="http://143.95.253.111/~onkarkul/files/final-document-will-web09.jpg"/>-->
               <!-- <div class="A4page">
                            {!! $document->outgoing_document_content!!}--}}
                        </div> -->
 <iframe class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 iframe"
                        src="{{asset($filePath)}}"
                        height="1000px" frameborder="0"></iframe>
             <!-- {!!$documentContentNew  !!} -->
               <!-- </div>                       <img class="img-responsive col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12"--> -->
          

                <div class=" col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <!-- Comments Section -->
                    <hr>
                    <div class="box box-widget">
                        <!-- /.box-body -->
                        @if(count($documentComments)>0)
                            <div class="box-footer box-comments">
                                @foreach($documentComments as $comment)
                                    <div class="box-comment"
                                         id="<?='comment' . $comment->id?>">
                                        <!-- User image -->
                                        @if(\Auth::user()->id == $comment->commented_by_user_id)
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-right">{{$comment->user->name}}</span>
                                                    <span class="direct-chat-timestamp pull-left">{{$comment->created_at->diffForHumans()}}</span>
                                                </div><!-- /.direct-chat-info -->

                                                @if($comment->user_image!=null)
                                                    <img class="img-circle img-bordered-sm"
                                                         src="{{asset('/storage/avatar/'.$comment->user_image)}}"
                                                         alt="User Image" height="128px"
                                                         style="float: right">
                                                @else
                                                    <img class="img-circle img-bordered-sm"
                                                         src="{{url('/uploads/users/dummyUser.png')}}"
                                                         alt="User Image" height="128px"
                                                         style="float: right">
                                                @endif
                                                <div class="direct-chat-text">
                                                                                <span class="text-justify"
                                                                                      id="<?='commentText' . $comment->id?>">{{$comment->document_comments_description}}</span>
                                                    <br>
                                                    @if($comment->document_comments_upload !=null)
                                                        <i class="fa fa-paperclip">
                                                            <a href="{{url('/documents/documentCommentDownload/'.$comment->id)}}"
                                                               type="button"
                                                               class="btn btn-link download_comment_file"
                                                               id="download_comment_file"
                                                               data-id="<?= $comment->id ?>">
                                                                {{$comment->document_comments_upload}}
                                                            </a>
                                                        </i>
                                                    @endif
                                                </div><!-- /.direct-chat-text -->
                                            </div>
                                        @else
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">{{$comment->user->name}}</span>
                                                    <span class="direct-chat-timestamp pull-right">{{$comment->created_at->diffForHumans()}}</span>
                                                </div><!-- /.direct-chat-info -->
                                                @if($comment->user->user_image!=null)
                                                    <img class="img-circle img-bordered-sm"
                                                         src="{{asset('/storage/avatar/'.$comment->user->user_image)}}"
                                                         alt="User Image" height="128px">
                                                @else
                                                    <img class="img-circle img-bordered-sm "
                                                         src="{{url('/uploads/users/dummyUser.png')}}"
                                                         alt="User Image" height="128px">
                                                @endif
                                                <div class="direct-chat-text">
                                                                               <span class="text-justify"
                                                                                     id="<?='commentText' . $comment->id?>">{{$comment->document_comments_description}}</span>
                                                    <br>
                                                    @if($comment->document_comments_upload !=null)
                                                        <i class="fa fa-paperclip">
                                                            <a href="{{url('/documents/documentCommentDownload/'.$comment->id)}}"
                                                               type="button"
                                                               class="btn btn-link download_comment_file"
                                                               id="download_comment_file"
                                                               data-id="<?= $comment->id ?>">
                                                                {{$comment->document_comments_upload}}
                                                            </a>
                                                        </i>
                                                    @endif
                                                </div><!-- /.direct-chat-text -->
                                            </div>

                                        @endif


                                        <div class="comment-text">

                                            <!-- /.box-header -->
                                            <div class="box-body pull-right">
                                                @if(\Auth::user()->id == $comment->commented_by_user_id)
                                                    <button class="btn btn-default btn-xs editing"
                                                            data-id="<?=$comment->id ?>"
                                                            data-user="<?php echo($comment->user->id); ?>"
                                                            data-edit="<?php echo $comment->document_comments_description; ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-default btn-xs btn_delete deleteButton actionIcon"
                                                            data-id="<?=$comment->id ?>"><i
                                                                class="fa fa-trash-o"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            <form class="edit_form"
                                                  id="<?= 'form' . $comment->id ?>"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group margin-bottom-none">
                                                    <div class="row">
                                                        <div class="col-sm-10 pull-left">
                                                                                        <textarea class="form-control"
                                                                                                  name="document_comments_description"
                                                                                                  placeholder="Comment">{{$comment->document_comments_description}}</textarea>
                                                        </div>


                                                        <input name="document_comments_type"
                                                               type="hidden"
                                                               value="outgoing">

                                                        <input name="documents_id"
                                                               type="hidden"
                                                               value="{{$document->id}}">
                                                        <br>


                                                        <div class="pull-right col-sm-2">

                                                            <button type="button"
                                                                    class="btn btn-primary pull-right btn-block btn-sm edit_save"
                                                                    data-id="<?= $comment->id?>">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>

                                @endforeach
                            </div>

                    @endif
                    <!-- /.box-footer -->
                        <div class="box-footer">
                            <form class="form-horizontal"
                                  action="{{url('documents/outgoingDocument/comment') }}"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if(Auth::user()->user_image!=null)
                                    <img class="img-responsive img-circle img-bordered img-sm"
                                         src="{{asset('/storage/avatar/'.Auth::user()->user_image)}}"
                                         alt="User Image" height="128px">
                                @else
                                    <img class="img-responsive img-circle img-bordered img-sm"
                                         src="{{url('/uploads/users/dummyUser.png')}}"
                                         alt="User Image" height="128px">
                            @endif

                            <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <div class="form-group margin-bottom-none  {{ ($errors->has('document_comments_description'))?'has-error':'' }}">
                                        <div class="row">
                                            <div class="col-sm-8 pull-left">
                                                                            <textarea class="form-control "
                                                                                      name="document_comments_description"
                                                                                      placeholder="Comment"></textarea>
                                                {!! $errors->first('document_comments_description', '<span class="text-danger">:message</span>') !!}
                                            </div>

                                            <div class="btn btn-app btn-file col-sm-2"
                                                 style="margin: 0px -11px!important;">
                                                <i class="fa fa-paperclip"></i>
                                                Attachment
                                                <input type="file"
                                                       name="comment_file_uploads">
                                            </div>


                                            <input name="document_comments_type"
                                                   type="hidden"
                                                   value="outgoing" id="docType">

                                            <input name="documents_id" type="hidden"
                                                   value="{{$document->id}}">
                                            <br>


                                            <div class="pull-right col-sm-2">

                                                <button type="submit"
                                                        class="btn btn-primary pull-right btn-block btn-sm btn_comment">
                                                    Comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <!-- /.box-footer -->
                    </div>


                </div>
            </div>


        </div>

        <div class="tab-pane" id="attachment">
            <div class="row">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Additional Files</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
         
                                @if($document->outgoing_file_uploads!=null)
                                    <?php $images = json_decode($document->outgoing_file_uploads);
                                    ?>
                                    @if($images!=null)
                                        @foreach($images as $image)
                                            {!! Form::open(['method' => 'DELETE','class'=>'inline','route'=>['outgoingDocument.destroy',$document->id]]) !!}
                                            <input type="hidden" name="additional_file" value="{{$image}}">

                                            <button type="submit"
                                                    class="actionIcon link deleteButton pull-right btnborder"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Delete This Image"
                                                    onclick="javascript:return confirm('Are you sure you want to delete this image?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <br><br>
                                            {!! Form::close() !!}
                                            <br>

                                            <?php $ext = pathinfo(asset("storage/uploads/documents/outgoingDocuments/" . $image));?>

                                            @if($ext['extension']=='png' || $ext['extension']=='jpg' || $ext['extension']=='jpeg'|| $ext['extension']=='gif'|| $ext['extension']=='PNG' || $ext['extension']=='JPG'
                                                || $ext['extension']=='JPEG'|| $ext['extension']=='GIF')
                                                <img height="500p" src="{{asset("storage/uploads/documents/outgoingDocuments/" . $image)}}"
                                                     class="img-responsive">
                                                <hr>
                                                @else
                                                <iframe height="500px" class="iframe"
                                                        src="{{asset("storage/uploads/documents/outgoingDocuments/" . $image)}}"
                                                        style="min-height:250px; width: 100%"
                                                        frameborder="0"></iframe>
                                            @endif
                                        @endforeach
                                     @else
                                     <?php $ext = pathinfo(asset("storage/uploads/documents/outgoingDocuments/" . $document->outgoing_file_uploads));?>
                                   
                                     @if($ext['extension']=='png' || $ext['extension']=='jpg' || $ext['extension']=='jpeg'|| $ext['extension']=='gif'|| $ext['extension']=='PNG' || $ext['extension']=='JPG'
                                                || $ext['extension']=='JPEG'|| $ext['extension']=='GIF')
                                                <img height="500p" src="{{asset("storage/uploads/documents/outgoingDocuments/" .$document->outgoing_file_uploads )}}"
                                                     class="img-responsive">                                               <hr>
                                                @else
                                                 <iframe height="1500px"  class="iframe"
                                                            src="{{asset("storage/uploads/documents/outgoingDocuments/" .$document->outgoing_file_uploads )}}"
                                                            style="min-height:250px; width: 100%"
                                                            frameborder="0"></iframe>
                                            @endif
                                    
                                              
                                      
                                    @endif
                                 @else
                                 <h1>No Document Found</h1>
                                                
                                @endif
                                
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            {!! Form::model($document,['method'=>'patch','route'=>['outgoingDocument.update',$document->id],'enctype'=>'multipart/form-data','files'=>true]) !!}

                            {{csrf_field()}}

                            <!-- Date -->
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <strong><i class="fa fa-clock-o"></i> New
                                            File</strong><br><br>
                                    </div>

                                </div>
                                <!-- /.form group -->
                                <!-- time Picker -->
                                <input type="hidden" name="document_id"
                                       value="{{$document->id}}">
                                <input type="hidden" name="saveAdditionalFile"
                                       value="saveAdditionalFile">
                                     


                                <div class="form-group {{ ($errors->has('outgoing_file_uploads'))?'has-error':'' }} ">
                                    <label for="outgoing_file_uploads">{{trans('eng.addAdditionalFile')}}
                                        <label class="text-danger"> *</label>
                                    </label>
                                    <input type="file" id="file_uploads"
                                           name="file_upload[]" multiple>
                                    {!! $errors->first('outgoing_file_uploads', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary pull-right"
                                        style="margin-top: 22px;" id="add_additional_file">Add
                                </button>
                            </div>
                            </form>

                        </div>


                    </div>
                </div>


            </div>
        </div>


        <!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">

            @foreach($timelineDate as $date)
                <!-- timeline time label -->
                    <?php
                    $background_colors = array('bg-red', 'bg-blue', 'bg-yellow'
                    , 'bg-green', 'bg-teal', 'bg-orange', 'bg-fuchsia', 'bg-purple', 'bg-maroon', 'bg-black', 'bg-aqua');

                    $rand_background = $background_colors[shuffle($background_colors)];


                    ?>


                    <li class="time-label">
                        <span class="{{$rand_background}}">{{date("j M. Y", strtotime($date->action_date))}}</span>
                    </li>

                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <?php $infos = \App\Repository\DocumentTimelineRepository::getDocumentInfo($date->action_date, $document->id, 'outgoing') ?>
                    @if(count($infos)>0)
                        @foreach($infos as $info)
                            @if($info->timelineType=="tracking")

                                <li>
                                    <?php $track = \App\Models\DocumentTrack::with('user')->find($info->track_id)?>
                                    @if($track->tracks_action_type == "view")
                                        <i class="fa fa-folder-open-o bg-yellow"></i>
                                    @elseif($track->tracks_action_type=='download')
                                        <i class="fa fa-download bg-blue"></i>
                                    @elseif($track->tracks_action_type=='edit')
                                        <i class="fa fa-edit bg-red"></i>
                                    @endif
                                    @if($track->tracks_action_type=='view'||$track->tracks_action_type=='edit'||$track->tracks_action_type=='download')

                                        <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i> {{$track->created_at->diffForHumans()}}</span>

                                            <h3 class="timeline-header"><a
                                                        href="#">{{$track->user->name}}</a>
                                                {{$track->tracks_action_type}}ed document</h3>

                                            <div class="timeline-body">
                                                <?php  $document = \App\Models\OutgoingDocument::with('institution')->with('template')->find($info->document_id)?>
                                                with
                                                subject
                                                <b>{{$document->outgoing_document_subject}}</b>
                                                issued
                                                to
                                                <b>{{$document->institution->institution_name}}</b>


                                                @if($document->outgoing_issue_number!=null)
                                                    on date {{$document->outgoing_issue_date}}
                                                    with  issued
                                                    number
                                                    <b>{{$document->outgoing_issue_number}}</b>
                                                @else
                                                    created
                                                    on  {{$document->created_at->format('Y-m-d')}}
                                                @endif
                                                under
                                                category {{$document->template->template_name}}
                                            </div>
                                            <!--<div class="timeline-footer">
                                                <a class="btn btn-primary btn-xs">Read more</a>
                                                <a class="btn btn-danger btn-xs">Delete</a>
                                            </div>-->
                                        </div>
                                    @endif
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                            @else
                                <li>
                                    <?php $track = \App\Models\EmailLog::with('user')->with('department')->find($info->track_id)?>

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

                                        </div>
                                        <!--<div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>-->
                                    </div>
                                </li>

                        @endif

                    @endforeach
                @endif


            @endforeach


            <!-- timeline time label -->

            <!--  <li class="time-label">
                        <span class="bg-green">
                        {{$document->created_at->format("j M. Y")}}
                    </span>

                                        </li>-->
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-file-o bg-orange"></i>

                    <div class="timeline-item">
                                                    <span class="time "><i
                                                                class="fa fa-clock-o"></i><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($document->created_at))->diffForHumans() ?> </span>

                        <h3 class="timeline-header"><a
                                    href="#"><?php $user = \App\User::find($document->created_by_user_id);?>{{$user->name}}</a>
                            has Created
                            {{$document->outgoing_document_subject}} Document</h3>

                        <div class="timeline-body">

                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="settings">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Reminder Setting</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table id="example1"
                                       class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Message</th>
                                        <th style="width: 30px" class="text-center">Status
                                        </th>
                                        <th style="width:60px" class="text-right">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($reminders)>0)
                                        @foreach($reminders as $key=>$reminder)
                                            <tr>
                                                <th scope=row>{{++$key}}</th>
                                                <td>{{$reminder->reminder_date}}</td>
                                                <td>{{$reminder->reminder_content}}</td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                       class="label label-success">
                                                        <strong> Active
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    @if($allowEdit)
                                                        <a href="{{url('documents/outgoingDocument/'.$document->id.'/outgoingEditReminder/'.$reminder->id)}}"
                                                           class="btn btn-link text-info actionIcon btnEditReminder"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>&nbsp;
                                                    @endif

                                                    @if($allowDelete)
                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['reminder.destroy',
                                                            $reminder->id],'class'=> 'inline']) !!}
                                                        <button type="submit"
                                                                class="btn btn-default btn-xs deleteButton actionIcon"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Delete"
                                                                onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>

                                                        {!! Form::close() !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($allowAdd)
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <strong><i class="fa fa-clock-o"></i> New
                                    Reminder</strong><br><br>

                                @if(\Request::segment(4)=='outgoingEditReminder')
                                    @include('documents.reminder.edit')
                                @else
                                    @include('documents.reminder.add')
                                @endif
                            </div>

                        @endif

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.tab-pane -->
</div>