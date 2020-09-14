@extends('master.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Outgoing Document
            <!--                <small>Sub Module</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Documents</li>
            <li><a href="{{url('documents/outgoingDocument')}}"> Outgoing Document</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('message.flash')

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{$document->outgoing_document_subject}}</h3>
                <?php

                    $permission = helperPermissionLink(url('documents/outgoingDocument/create'), url('documents/outgoingDocument'));

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
                                    {{$document->outgoing_document_subject}}
                                    @if($document->outgoing_issue_status=="draft")
                                    <a href="{{url('documents/outgoingDocument/'.$document->id.'/edit')}}"
                                        data-toggle="tooltip" title="Edit Institution"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </h3>


                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Sender Institution:</b><br>
                                        <span>{{$document->institution->institution_name}}

                                            <input type="hidden" name="related_institution_id"
                                                value="{{$document->institution_id}}" id="related_institution_id" />
                                        </span>


                                    </li>
                                    <li class="list-group-item">
                                        <b>Issue Number:</b>
                                        @if($document->outgoing_issue_number!=null)
                                        <span class="pull-right"> {{$document->outgoing_issue_number}}</span>
                                    <li class="list-group-item">
                                        <b>Issue Date:</b> <span
                                            class="pull-right">{{$document->outgoing_issue_date}}</span>
                                    </li>
                                    @else
                                    <span><button class="btn btn-warning btn-xs pull-right" data-toggle="modal"
                                            data-target="#issue_modal">Not issued</button>
                                    </span>
                                    </li>

                                    @endif
                                    <li class="list-group-item">
                                        <b>Uploaded By:</b> <span class="pull-right">{{$document->user->name}}</span>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Document Privacy:</b> <span
                                            class="pull-right">@if($document->outgoing_document_privacy=="General")
                                            <label
                                                class="label label-primary">{{$document->outgoing_document_privacy}}</label>
                                            @elseif($document->outgoing_document_privacy=="Departmental")
                                            <label
                                                class="label label-success">{{$document->outgoing_document_privacy}}</label>
                                            @else
                                            <label
                                                class="label label-danger">{{$document->outgoing_document_privacy}}</label>
                                            @endif
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
                                                name="change_folder" value="1" id="change_folder"
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
                                                <span class="help-block pull-right">Create New Folder
                                                    <input type="checkbox" name="create_folder_check_box" value="1"
                                                        id="create_folder_check_box" checked
                                                        class="icheckbox_minimal-blue">
                                                </span>
                                                {!! $errors->first('folder_id', '<span
                                                    class="text-danger">:message</span>') !!}

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
                                                {!! $errors->first('folder_name', '<span
                                                    class="text-danger">:message</span>') !!}
                                                {{Form::hidden('folder_institution_id',$document->institution_id,array('class'=>'form-control','id'=>'folder_institution_id','placeholder'=>
                                                  'Select Institution', 'style'=>'width:100%','disabled'))}}
                                                <div class="col-md-12">
                                                    <br>
                                                    <button type="button" id="create_folder_button"
                                                        class="pull-right">Create Folder </button>
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
                                <div class="modal fade" id="issue_modal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content col-md-10">
                                            <div class="modal-header">

                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                    Issue Document Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" name="form_issue" id="form_issue"
                                                    href="{{url('documents/outgoingDocument/issue')}}">
                                                    <input type="hidden" value="{{$document->id}}"
                                                        name="outgoing_document_id" id="outgoing_document_id">
                                                    <div class="box-body">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                                        <div
                                                            class="form-group {{($errors->has('outgoing_issue_date'))?'has-error':'' }}">
                                                            <label for="outgoing_issue_date"> Date:<label
                                                                    class="text-danger"> *</label></label>

                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                {{Form::text('outgoing_issue_date',date('Y-m-d'),array('class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>" Letter Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                                                {!! $errors->first('outgoing_issue_date', '<span
                                                                    class="text-danger">:message</span>') !!}
                                                            </div>
                                                            <div
                                                                class="form-group {{($errors->has('signature_user_id'))?'has-error':'' }}">
                                                                <label for="signature_user_id">Signature<label
                                                                        class="text-danger">
                                                                        *</label></label><br>
                                                                {{Form::select('signature_user_id',$signatures->pluck('name','id'),$document->signature_user_id!=0?$document->signature_user_id:Auth::user()->id,['class'=>'form-control select2','style'=>'width:100%;','id'=>'signature_user_id','placeholder'=>'Select Signature'])}}
                                                                {!! $errors->first('signature_user_id', '<span
                                                                    class="text-danger">:message</span>') !!}
                                                                <p class="help-block">Signature entered in this
                                                                    field will replace variable
                                                                    __SCANNED_SIGNATURE__</p>

                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>


                                                    </div>
                                                    <div class="box-footer">

                                                        <button type="button" id="btn_issue" class="btn btn-success"
                                                            name="issue">
                                                            Issue
                                                        </button>
                                                        <br />
                                                        <br />

                                                        <label for="panel-body">Note
                                                            :Field in <label class="text-danger">
                                                                * </label> are
                                                            mandatory
                                                        </label>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <strong><i class="fa fa-clock-o margin-r-5"></i>Reminders</strong>

                                <ul class="list-group list-group-unbordered">
                                    @if(count($reminders)>0)
                                    @foreach($reminders as $reminder)
                                    <li class="list-group-item">
                                        {{$reminder->created_at->format("F j, Y, g:i a")}}
                                        &nbsp; {{$reminder->reminder_content}}
                                    </li>
                                    @endforeach
                                    @else
                                    No Reminder
                                    @endif

                                </ul>


                                <strong><i class="fa fa-tag margin-r-5"></i>Tags</strong>

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
                                <hr>

                                <div class="modal fade" id="email{{$document->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content col-md-10">
                                            <div class="modal-header">

                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                    Receiver's Email
                                                    Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('method' => 'PUT','url'=>"documents/outgoingDocument/send/email/{$document->id}",'enctype'=>'multipart/form-data'))}}

                                                <div class="box-body">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                    <div class="form-group">
                                                        <label for="receiver_regd_no" class="control-label align">
                                                            To :
                                                        </label>
                                                        {{Form::email('receiver_email',$document->institution->institution_email_address,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Receiver Email'))}}
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="receiver_regd_date" class="control-label align">
                                                            Cc:
                                                        </label>
                                                        {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Cc email'))}}
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="receiver_regd_date" class="control-label align">
                                                            Bcc:
                                                        </label>
                                                        {{Form::email('bcc_email',null,array('class'=>'form-control','id'=>'bcc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Cc email'))}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="receiver_regd_no" class="control-label align">
                                                            Subject </label>
                                                        {{Form::text('letter_subject',$document->outgoing_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
                                                            'Subject'))}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email_content">Email Content</label>

                                                        <div class="form-group">
                                                            <textarea class="form-control pull-right "
                                                                id="email_content" name="email_content"
                                                                placeholder="Enter Email Content."></textarea>

                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                    <div
                                                        class="form-group {{ ($errors->has('attach_additional_file'))?'has-error':'' }}">
                                                        {{Form::checkbox('attach_additional_file','yes',true,array('class'=>'field','id'=>'attach_additional_file','placeholder'=>
                                                            'Attach Additional file if exist??'))}}
                                                        <label for="attach_additional_file"
                                                            class="control-label align">Attach
                                                            Additional file if
                                                            Exists?</label>
                                                        {!! $errors->first('attach_additional_file', '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="optional_uploads" class="control-label align">
                                                            Extra Uploads
                                                        </label>


                                                        {{Form::file('optional_uploads',null,array('class'=>'form-control','id'=>'optional_image','placeholder'=>
                                                                'Choose LOGO'))}}
                                                        {!! $errors->first('optional_uploads', '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </div>


                                                </div>
                                                <div class="box-footer">

                                                    <button type="submit" class="btn btn-success" name="send">
                                                        Send
                                                    </button>
                                                    <br />
                                                    <br />

                                                    <label for="panel-body">Note
                                                        :Field in <label class="text-danger">
                                                            * </label> are
                                                        mandatory
                                                    </label>
                                                </div>
                                                {{Form::close()}}

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <a data-toggle="modal" data-target="#email{{$document->id}}" value="{{$document->id}}"
                                    title="Send Mail" class="btn btn-block btn-social btn-linkedin">
                                    <i class="fa fa-envelope"></i>Email
                                </a>
                                <a href="{{url('documents/outgoingDocumentPrint/'.$document->id)}}"
                                    class="btn btn-block btn-social btn-bitbucket" target="_blank">
                                    <i class="fa fa-print"></i> Print with Header
                                </a>
                                <a href="{{url('documents/outgoingDocumentPrint/no/'.$document->id)}}"
                                    class="btn btn-block btn-social btn-bitbucket" target="_blank">
                                    <i class="fa fa-print"></i> Print without Header
                                </a>
                                <a href="{{url('documents/outgoingDocumentDownload/'.$document->id)}}"
                                    class="btn btn-block btn-social btn-bitbucket">
                                    <i class="fa fa-download"></i> Download with Header
                                </a>
                                <a href="{{url('documents/outgoingDocumentDownload/no/'.$document->id)}}"
                                    class="btn btn-block btn-social btn-bitbucket">
                                    <i class="fa fa-download"></i> Download without Header
                                </a>


                                <div class="clearfix"></div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

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
                                    <a href="{{url('institution/'.$document->institution->id)}}" data-toggle="tooltip"
                                        target="_blank"
                                        title="Edit Institution">{{$document->institution->institution_name}}</a>
                                </h3>

                                <p class="text-muted text-center">{{$document->institution->institution_address}}
                                </p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b><i class="fa fa-envelope-o"></i></b> <a
                                            class="pull-right">{{$document->institution->institution_address}}</a>
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
                        @include('documents.outgoingDocument.previewDocument')
                        <!-- /.tab-content -->

                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


        </div>
        <!-- /.box-body -->


        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->
@endsection
@section('js')
@include('documents.movoToFolder')
@include('documents.createTag')

<script type="text/javascript">
    //place the scroll position where it was left before
    $(window).scroll(function () {
        sessionStorage.scrollTop = $(this).scrollTop();
    });


    $(document).ready(function () {
        //edit comment
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
        //issue letter
        $('#btn_issue').click(function () {
            if (confirm(
                    'This Document cannot edit after issue. Are you Sure you want to issue this document?'
                    )) {
                $.ajax({
                    type: "POST",
                    url: "issue",
                    dataType: "text",
                    data: $('#form_issue').serializeArray(),
                    success: function (data) {
                        var obj = $.parseJSON(data);
                        var Id = obj.id;
                        location.reload();


                    }
                });
            } else {
                $('#issue_modal').modal('hide');

            }
        })


    });
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-ddThh:ii:ss"
    });
</script>
@endsection