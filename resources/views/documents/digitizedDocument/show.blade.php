@extends('master.app')
@section('content')
<style>
.A4page{
    font-size: 13px;
  overflow-y:auto;
}
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Digitize Document
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Documents</li>
                <li><a href="{{url('documents/outgoingDocument')}}"> Digitize Document</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$document->digitized_document_name}}</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/digitizedDocument/create'), url('documents/digitizedDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];

                    $allowAdd = $permission['isAdd'];
                    ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <!-- About Me Box -->
                            <div class="box box-primary">

                                <div class="box-body">
                                    <div class="text-center">
                                        <a href="#"><i class="fa fa-file-pdf-o fa-2x "></i></a>
                                    </div>
                                    <h3 class="text-center">
                                        {{$document->digitized_document_name}}
                                        <a href="{{url('documents/digitizedDocument/'.$document->id.'/edit')}}"
                                           data-toggle="tooltip" title="Edit Institution"><i
                                                    class="fa fa-pencil"></i></a>
                                    </h3>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Uploaded By:</b> <span
                                                    class="pull-right">{{$document->user->name}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Document Category:</b><br>
                                            <span>{{$document->document_category->category_name}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Department:</b> <span
                                                    class="pull-right">{{$document->department->department_name}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Related Institution:</b><br>
                                            <span>{{$document->institution->institution_name}}

                                                <input type="hidden" name="related_institution_id"
                                                       value="{{$document->related_institution_id}}"
                                                       id="related_institution_id"/>
                                            </span>


                                        </li>

                                        <li class="list-group-item">
                                            <strong>&nbsp
                                                <i class="fa fa-folder"></i>
                                                @if($document->folder!=null)
                                                    <i class="label label-info text-14">{{$document->folder->name}}</i>
                                                @else
                                                    <i class="label label-warning">
                                                        Untitled</i>
                                                @endif
                                            </strong>
                                            <span class="help-block pull-right">Change folder? <input type="checkbox"
                                                                                                      name="change_folder"
                                                                                                      value="1"
                                                                                                      id="change_folder"
                                                                                                      class="icheckbox_minimal-blue">
                                       </span>
                                        </li>

                                        <li class="list-group-item" id="folder_element_to_change" style="display: none">
                                            <div class="form-group">

                                                <div class="form-group{{ ($errors->has('folder_id'))?'has-error':'' }} ">
                                                    <label for="folder_id">Select Folder <label class="text-danger">
                                                            *</label></label>
                                                    <select name="folder_id" id="folder_id" class="form-group"
                                                            style="width: 100%;">
                                                        <option>Select Folder Name</option>

                                                    </select>
                                                    {{--{{Form::select('folder_id',$folders->pluck('name','id'),Request::get('folder_id'),array('class'=>'form-control','id'=>'unit_id','placeholder'=>--}}
                                                    {{--'Select Folder'))}}--}}
                                                    <span class="help-block pull-right">
                                       Create New Folder <input type="checkbox" name="create_folder_check_box" value="1"
                                                                id="create_folder_check_box" checked
                                                                class="icheckbox_minimal-blue">
                                        </span>
                                                    {!! $errors->first('folder_id', '<span class="text-danger">:message</span>') !!}

                                                </div>
                                            </div>
                                            <div class="form-group" id="create_folder">
                                                <div class="col-md-12"
                                                     style="background-color: #e9f5ff; padding: 15px; border-radius: 5px">
                                                    <label for="folder_name">New Folder Name</label>
                                                    {{Form::text('folder_name',null,array('class'=>'form-control','id'=>'folder_name','placeholder'=>
                                         'Folder Name','list'=>'datalistItems','autocomplete'=>'off'))}}
                                                    <datalist id="datalistItems">

                                                    </datalist>
                                                    {!! $errors->first('folder_name', '<span class="text-danger">:message</span>') !!}
                                                    {{Form::hidden('folder_institution_id',$document->related_institution_id,array('class'=>'form-control','id'=>'folder_institution_id','placeholder'=>
                                                  'Select Institution', 'style'=>'width:100%','disabled'))}}
                                                    <div class="col-md-12">
                                                        <br>
                                                        <button type="button" id="create_folder_button"
                                                                class="pull-right">Create Folder
                                                        </button>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <br>
                                                <button type="button" id="btn_move_to_folder"
                                                        class="pull-right btn btn-success">Move To Folder
                                                </button>
                                            </div>
                                        </li>


                                    </ul>


                                    <strong><i class="fa fa-clock-o margin-r-5"></i>Reminders</strong>

                                    <ul class="list-group list-group-unbordered">
                                        @foreach($reminders as $reminder)
                                            <li class="list-group-item">
                                                {{$reminder->reminder_date}}&emsp; {{$reminder->reminder_content}}
                                            </li>

                                        @endforeach

                                    </ul>


                                    <strong><i class="fa fa-tag margin-r-5"></i>Tags</strong>

                                    <p>
                                        @forelse($tags as $tag)
                                            @if($tag->tag_id % 2 == 0)

                                                <span class="label label-danger">{{$tag->tag->tag_name}}</span>
                                            @elseif($tag->tag_id % 3 == 0)
                                                <span class="label label-success">{{$tag->tag->tag_name}}</span>
                                            @elseif($tag->tag_id % 5 == 0)
                                                <span class="label label-info">{{$tag->tag->tag_name}}</span>
                                            @else
                                                <span class="label label-warning">{{$tag->tag->tag_name}}</span>
                                    @endif
                                    @empty<h5>No Tags</h5>
                                    @endforelse
                                    </p>
                                    <hr>

                                    <div class="modal fade" id="email{{$document->id}}"
                                         role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content col-md-10">
                                                <div class="modal-header">

                                                    <button type="button"
                                                            class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">
                                                        Receiver's Email
                                                        Information</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{Form::open(array('method' => 'PUT','url'=>"documents/digitizedDocument/send/email/{$document->id}",'enctype'=>'multipart/form-data'))}}

                                                    <div class="box-body">
                                                        <input type="hidden"
                                                               name="_token"
                                                               value="{{ csrf_token() }}">

                                                        <div class="form-group">
                                                            <label for="receiver_regd_no"
                                                                   class="control-label align">
                                                                To :
                                                            </label>
                                                            {{Form::email('receiver_email',$document->institution->institution_email_address,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Receiver Email'))}}
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="receiver_regd_date"
                                                                   class="control-label align">
                                                                Cc:
                                                            </label>
                                                            {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','placeholder'=>
                                                            'Cc email'))}}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="receiver_regd_no"
                                                                   class="control-label align">
                                                                Subject </label>
                                                            {{Form::text('letter_subject',$document->outgoing_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
                                                            'Subject'))}}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_content">Email Content</label>

                                                            <div class="form-group">
                                        <textarea class="form-control pull-right " id="email_content"
                                                  name="email_content" placeholder="Enter Email Content."></textarea>
                                                            </div>

                                                            <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group {{ ($errors->has('attach_additional_file'))?'has-error':'' }}">
                                                            {{Form::checkbox('attach_additional_file','yes',true,array('class'=>'field','id'=>'attach_additional_file','placeholder'=>
                                                            'Attach Additional file if exist??'))}}
                                                            <label for="attach_additional_file"
                                                                   class="control-label align">Attach
                                                                Additional file if
                                                                Exists?</label>
                                                            {!! $errors->first('attach_additional_file', '<span class="text-danger">:message</span>') !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="optional_uploads"
                                                                   class="control-label align">
                                                                Extra Uploads
                                                            </label>


                                                            {{Form::file('optional_uploads',null,array('class'=>'form-control','id'=>'optional_image','placeholder'=>
                                                                'Choose LOGO'))}}
                                                            {!! $errors->first('optional_uploads', '<span class="text-danger">:message</span>') !!}
                                                        </div>


                                                    </div>
                                                    <div class="box-footer">

                                                        <button type="submit"
                                                                class="btn btn-success"
                                                                name="send">
                                                            Send
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
                                    <a data-toggle="modal"
                                       data-target="#email{{$document->id}}"
                                       value="{{$document->id}}"
                                       title="Send Mail" class="btn btn-block btn-social btn-linkedin">
                                        <i class="fa fa-envelope"></i>Email
                                    </a>
                                    <?php 
                                        $digitize = json_decode($document->digitized_document_path);
                                    ?>
                                    @for($i=0; $i<count($digitize); $i++)
                                    <button  class="btn btn-block btn-social btn-bitbucket" target="_blank"
                                    onclick="printDocument('{{url("storage/uploads/documents/digitizedDocuments/" . $digitize[$i])}}')">
                           
                                    <i class="fa fa-print"></i>
                                            Print Attachment
                                        </button>
                                     
                                      @endfor 
                                

                                    <a href="{{url('documents/digitizedDocumentDownload/'.$document->id)}}"
                                       class="btn btn-block btn-social btn-bitbucket">
                                        <i class="fa fa-download"></i> Download
                                    </a>


                                    <div class="clearfix"></div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class=" box-profile">
                                                                <br>
                                    @if($document->institution->institution_image!=null)
                                        <img class="profile-user-img img-responsive img-circle"
                                             src="{{url('uploads/institution/'.$document->institution->institution_image)}}"
                                             alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-responsive img-circle"
                                             src="{{url('/dist/img/institution.png')}}" alt="Institution picture">
                                    @endif

                                    <h3 class="profile-username text-center">
                                        <a href="{{url('institution/'.$document->institution->id)}}"
                                           data-toggle="tooltip" target="_blank"
                                           title="Edit Institution">{{$document->institution->institution_name}}</a>
                                    </h3>

                                    <p class="text-muted text-center">{{$document->institution->institution_address}}
                                    </p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b><i class="fa fa-envelope-o"></i></b> <a
                                                    class="pull-right">{{$document->institution->institution_email_address}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><i class="fa fa-phone"></i></b> <a
                                                    class="pull-right">{{$document->institution->institution_contact_number}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><i class="fa fa-globe"></i></b> <a class="pull-right"
                                                                                  href="{{$document->institution->institution_website}}"
                                                                                  target="_blank">{{$document->institution->institution_website}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active" id="preview_li">
                                        <a href="#preview" id="preview_tab" data-toggle="tab">Preview</a></li>
                                    <li id="attachment_li"><a href="#attachment" id="attachment_tab" data-toggle="tab">Add
                                            Another Files</a>
                                    </li>
                                    <li id="timeline_li"><a href="#timeline" id="timeline_tab" data-toggle="tab">Timeline</a>
                                    </li>
                                    <li id="settings_li"><a href="#settings" id="setting_tab" data-toggle="tab">Reminders</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="preview">
                                        <div class="row">
                                        @if($document->digitized_document_path!=null)
                                                <?php $images = json_decode($document->digitized_document_path);
                                                ?>
                                                @if($images!=null)
                                                    @foreach($images as $image)
                                                    
                                                        <?php $ext = pathinfo(asset("storage/uploads/documents/digitizedDocuments/" . $image));?>
                                                        @if($ext['extension']=='png' || $ext['extension']=='jpg' || $ext['extension']=='jpeg'|| $ext['extension']=='gif'|| $ext['extension']=='PNG' || $ext['extension']=='JPG'
                                                        || $ext['extension']=='JPEG'|| $ext['extension']=='GIF')
                                                            <img src="{{asset("storage/uploads/documents/digitizedDocuments/" . $image)}}" height="500p"  class="img-responsive">
                                                            <hr>
                                                        @else
                                                            <iframe height="1100px" class="iframe"
                                                                    src="{{asset("storage/uploads/documents/digitizedDocuments/" . $image)}}"
                                                                    style="min-height:250px; width: 100%"
                                                                    frameborder="0"></iframe>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <iframe height="1100px" class="iframe"
                                                            src="{{asset("storage/uploads/documents/digitizedDocuments/" .$document->digitized_document_path )}}"
                                                            style="min-height:250px; width: 100%"
                                                            frameborder="0"></iframe>
                                                @endif
                                            @else
                                                <div class="A4page">
                                                    {!! $document->digitized_document_content!!}
                                                </div>
                                            @endif
                                          

                                            <div class=" col-lg-12  col-md-12  col-sm-12 col-xs-12">
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
                                                                            @if($comment->user_image!=null)
                                                                                <img class="img-circle img-bordered-sm"
                                                                                     src="{{asset('/storage/avatar/'.$comment->user_image)}}"
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
                                                                                           value="digitized">

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
                                                              action="{{url('documents/incomingDocument/comment') }}"
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
                                                                               type="hidden" id="docType"
                                                                               value="digitized">

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
                                                <!-- /.Comments Section-->
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
                                                $background_colors = array('bg-red', 'bg-aqua', 'bg-blue', 'bg-yellow'
                                                , 'bg-light-blue', 'bg-green', 'bg-teal', 'bg-olive', 'bg-lime', 'bg-orange',
                                                    'bg-fuchsia', 'bg-purple', 'bg-maroon', 'bg-black', 'bg-red-active', 'bg-yellow-active', 'bg-aqua-active', 'bg-blue-active',
                                                    'bg-light-blue-active', 'bg-green-active', 'bg-navy-active', 'bg-teal-active', 'bg-olive-active', 'bg-lime-active', 'bg-orange-active',
                                                    'bg-fuchsia-active', 'bg-purple-active', 'bg-maroon-active', 'bg-black-active',);

                                                $rand_background = $background_colors[array_rand($background_colors)];


                                                ?>
                                                <li class="time-label">
                                                    <span id="<?= $date->action_date?>"
                                                          class="{{$rand_background}}  dateLabel">{{date("j M. Y", strtotime($date->action_date))}}</span>
                                                </li>

                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <?php $infos = \App\Repository\DocumentTimelineRepository::getDocumentInfo($date->action_date, $document->id, 'digitized') ?>
                                                @if(count($infos)>0)
                                                    @foreach($infos as $info)
                                                        @if($info->timelineType=="tracking")


                                                            <li class="<?= 'info' . $date->action_date ?>">
                                                                <?php $track = \App\Models\DocumentTrack::with('user')->find($info->track_id)?>
                                                                @if($track->tracks_action_type == "view")
                                                                    <i class="fa fa-folder-open-o bg-yellow"></i>
                                                                @elseif($track->tracks_action_type=='download')
                                                                    <i class="fa fa-download bg-blue"></i>
                                                                @elseif($track->tracks_action_type=='edit')
                                                                    <i class="fa fa-edit bg-red"></i>
                                                                @endif
                                                                <div class="timeline-item">
                                                                    <span class="time"><i
                                                                                class="fa fa-clock-o"></i> {{$track->created_at->diffForHumans()}}</span>

                                                                    <h3 class="timeline-header"><a
                                                                                href="#">{{$track->user->name}}</a>
                                                                        {{$track->tracks_action_type}}(ed) document</h3>

                                                                    <div class="timeline-body">
                                                                        <?php  $dig_document = \App\Models\DigitizedDocument::with('institution')->with('department')->find($info->document_id)?>
                                                                        with
                                                                        subject
                                                                        <b>{{$dig_document->digitized_document_name}}</b>
                                                                        issued
                                                                        to
                                                                        <b>{{$dig_document->institution->institution_name}}</b>
                                                                    </div>
                                                                    <!--<div class="timeline-footer">
                                                                        <a class="btn btn-primary btn-xs">Read more</a>
                                                                        <a class="btn btn-danger btn-xs">Delete</a>
                                                                    </div>-->
                                                                </div>
                                                            </li>
                                                            <!-- END timeline item -->
                                                            <!-- timeline item -->
                                                        @else
                                                            <li class="<?= 'info' . $date->action_date ?>">
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

                                                                </div>
                                                            </li>

                                                    @endif

                                                @endforeach
                                            @endif


                                        @endforeach


                                        <!-- timeline time label -->

                                        <!-- <li class="time-label">
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
                                                                href="#"><?php $user = \App\User::find($document->uploaded_by_user_id);?>{{$user->name}}</a>
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
                                    <div class="tab-pane" id="attachment">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Additional Files</h3>
                                            </div>
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                        @if($document->digitized_document_path!=null)

                                                            <?php $images = json_decode($document->digitized_document_path);
                                                            ?>
                                                            @if($images!=null)
                                                                @foreach($images as $image)
                                                                    {!! Form::open(['method' => 'DELETE','class'=>'inline','route'=>['digitizedDocument.destroy',$document->id]]) !!}
                                                                    <input type="hidden" name="additional_file"
                                                                           value="{{$image}}">

                                                                    <button type="submit"
                                                                            class="actionIcon link deleteButton pull-right btnborder"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Delete This Image"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete this image?');">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <br><br>
                                                                    {!! Form::close() !!}
                                                                    <br>

                                                                    <?php $ext = pathinfo(asset("storage/uploads/documents/digitizedDocuments/" . $image));?>

                                                                    @if($ext['extension']=='png' || $ext['extension']=='jpg' || $ext['extension']=='jpeg'|| $ext['extension']=='gif'|| $ext['extension']=='PNG' || $ext['extension']=='JPG'
                                                                    || $ext['extension']=='JPEG'|| $ext['extension']=='GIF')
                                                                        <img src="{{asset("storage/uploads/documents/digitizedDocuments/" . $image)}}"
                                                                             class="img-responsive">
                                                                        <hr>
                                                                    @else
                                                                        <iframe height="1100px" class="iframe"
                                                                                src="{{asset("storage/uploads/documents/digitizedDocuments/" . $image)}}"
                                                                                style="min-height:250px; width: 100%"
                                                                                frameborder="0"></iframe>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <iframe height="1100px" class="iframe"
                                                                        src="{{asset("storage/uploads/documents/digitizedDocuments/" .$document->digitized_document_path )}}"
                                                                        style="min-height:250px; width: 100%"
                                                                        frameborder="0"></iframe>
                                                            @endif
                                                            @else
                                            <h1>NO File Found</h1>
                                            
                                                        @endif
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    {!! Form::model($document,['method'=>'patch','route'=>['digitizedDocument.update',$document->id],'enctype'=>'multipart/form-data','files'=>true]) !!}

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


                                                        <div class="form-group {{ ($errors->has('digitized_document_path'))?'has-error':'' }} ">
                                                            <label for="digitized_document_path">{{trans('eng.addAdditionalFile')}}
                                                                <label class="text-danger"> *</label>
                                                            </label>
                                                            <input type="file" id="file_uploads"
                                                                   name="file_uploads[]" multiple>
                                                            {!! $errors->first('digitized_document_path', '<span class="text-danger">:message</span>') !!}
                                                        </div>

                                                        <button type="submit" class="btn btn-primary pull-right"
                                                                style="margin-top: 22px;" id="add_additional_file">Add
                                                        </button>
                                                    </div>
                                                    </form>

                                                </div>


                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->


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
                                                                            <td class="text-right">
                                                                                @if($allowEdit)
                                                                                    <a href="{{url('documents/digitizedDocument/'.$document->id.'/digitizedEditReminder/'.$reminder->id)}}"
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
                                                            @if(\Request::segment(4)=='digitizedEditReminder')
                                                                @include('documents.reminder.edit')
                                                            @else
                                                                @include('documents.reminder.add')
                                                            @endif
                                                        </div>

                                                    @endif
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
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
    @include('documents.createTag')
    @include('documents.movoToFolder')

    <script type="text/javascript">

        $('.edit_form').hide();
        $('.editing').bind('click', function (event) {
            var id = $(this).data('id');
            var num = $(this).data('edit');
            var user = $(this).data('user');
            $('#form' + id).show();
            $('#editBlock' + id).hide();
        });

        $('.edit_save').bind('click', function (event) {
            var id = $(this).data('id');
            $.ajax({
                type: "PUT",
                url: "comment/" + id,
                dataType: "text",
                data: $('#form' + id).serializeArray(),
                enctype: 'multipart/form-data',
                success: function (data) {
                    var obj = $.parseJSON(data);
                    var Id = obj.id;
                    var comment = obj.document_comments_description;
                    $('#form' + id).hide();
                    $('#editBlock' + id).show();
                    document.getElementById('commentText' + Id).innerHTML = comment;
                }
            });
        });

        $('.btn_delete').bind('click', function (event) {
            var id = $(this).data('id');
            if (confirm("Do you really want to delete this comment??")) {
                $.ajax({
                    type: "GET",
                    url: "comment/delete/" + id,
                    success: function (data) {
                        $('#comment' + id).hide();

                    }
                });
            }
        });

        $('.dateLabel').click(function () {
            var id = $(this).attr("id");
            $('.info' + id).toggleClass('hidden');
        })

    </script>

    <script type="text/javascript">
          function printDocument(fileUrl) {
            var w = window.open(fileUrl);

            w.print();
        }

    </script>
  

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-ddThh:ii:ss"
        });
    </script>


@endsection