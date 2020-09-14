@extends('master.app')
@section('content')
<style>
    #institution_id
    {
        width: 280px;
 
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Outgoing Documents
                {{--<small>Sub Module</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Documents</li>
                <li class="active">Outgoing Documents</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/outgoingDocument/create'), url('documents/outgoingDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 topFilter">
                                <form class="form-inline">
                                    {{Form::text('document_subject',Request::get('document_subject'),array('class'=>'form-control','id'=>'document_subject','placeholder'=> 'Document Subject'))}}

                                    {{Form::select('institution_id',$institutions->pluck('institution_name','id'),Request::get('institution_id'),array('class'=>'form-control','id'=>'institution_id','placeholder'=> 'Select Institution'))}}
                                    {{Form::select('outgoing_document_status',['draft'=>'Draft','issued'=>'Issued','registered'=>'Registered'],Request::get('outgoing_document_status'),array('class'=>'form-control','id'=>'outgoing_document_status','placeholder'=> 'Select Document Status'))}}

                                    {{Form::select('signed_user_id',$signatures->pluck('name','id'),Request::get('signed_user_id'),array('class'=>'form-control','id'=>'signed_user_id','placeholder'=> 'Select Signed By'))}}
                                    {{Form::text('issue_number',Request::get('issue_number'),array('class'=>'form-control','id'=>'issue_number','placeholder'=> 'Document Issue Number'))}}
                                    {{Form::text('outgoing_registration_number',Request::get('outgoing_registration_number'),array('class'=>'form-control','id'=>'outgoing_registration_number','placeholder'=> 'Registration Number'))}}
                                    {{Form::text('outgoing_document_date_from',Request::get('outgoing_document_date_from'),array('class'=>'form-control datepicker','id'=>'','placeholder'=>" Document Date from", 'data-date-format' => 'yyyy-mm-dd'))}}
                                    {{Form::text('outgoing_document_date_to',Request::get('outgoing_document_date_to'),array('class'=>'form-control','id'=>'datepicker','placeholder'=>" Document Date to", 'data-date-format' => 'yyyy-mm-dd'))}}

                         
                                    &nbsp;

                                    <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{url('/documents/outgoingDocument')}}" type="button"
                                                           class="btn btn-warning"><i
                                                                    class="fa fa-refresh"></i> Refresh
                                                        </a>

                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="table-responsive">
                        <table id="example4" class="table table-hover table-striped lazy">
                            <thead>
                            <tr>
                                <th style="width: 10px">S.N</th>
                                <th style="width: 300px">Subject</th>
                                <th>Institution</th>
                                <th>Issue Information</th>
                                <th>Category</th>
                                <th class="text-center"> Created / Signed /Issued</th>

                                <th style="width: 30px" class="text-center">Status</th>
                                <th style="width: 120px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($outgoingDocuments)>0)
                                @foreach($outgoingDocuments as $key=>$outgoingDocument)



                                    <tr>

                                        <th scope=row>{{++$key}}</th>
                                        <td> <a href="{{url('/documents/outgoingDocument/'.$outgoingDocument->id)}}"
                                               target="_blank">{{$outgoingDocument->outgoing_document_subject}}</a>
                                            <br>
                                            <span>Created at-</span>
                                            <b>{{$outgoingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;
                                            @if($outgoingDocument->outgoing_document_privacy=='Confidential')
                                                <p class="pull-right label label-warning "
                                                   style="font-size: 8px"> {{$outgoingDocument->outgoing_document_privacy}}</p>
                                            @elseif($outgoingDocument->outgoing_document_privacy=='Departmental')
                                                <p class="pull-right label label-primary "
                                                   style="font-size: 8px"> {{$outgoingDocument->outgoing_document_privacy}}</p>
                                            @else
                                                <p class="pull-right label label-default "
                                                   style="font-size: 8px"> {{$outgoingDocument->outgoing_document_privacy}}</p>


                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('institution/'.$outgoingDocument->institution_id)}}"
                                               target="_blank">{{$outgoingDocument->institution_name}}</a><br>
                                            <i> {{$outgoingDocument->department_name}}</i>
                                            <br>
                                            @if($outgoingDocument->outgoing_registration_number!=null)
                                                <i> Regd. No:{{$outgoingDocument->outgoing_registration_number}}
                                                | {{$outgoingDocument->outgoing_registration_date}}</i><br>
                                            @endif

                                        </td>
                                        <td>
                                            {{$outgoingDocument->template_name}}<br>
                                            <p>
                                                <?php $tags = \App\Models\DocumentTag::where('document_id', '=', $outgoingDocument->id)
                                                    ->where('document_tag_type', '=', 'outgoing')
                                                    ->get();?>
                                                @forelse($tags as $tag)
                                                    @if($tag->tag_id % 2 == 0)

                                                        <span class="label label-danger">{{$tag->tag->tag_name}}</span>
                                                    @elseif($tag->tag_id % 3 == 0)
                                                        <span class="label label-success">{{$tag->tag->tag_name}}</span>
                                                    @elseif($tag->tag_id % 5 == 0)
                                                        <span class="label label-info">{{$tag->tag->tag_name}}</span>
                                                    @else
                                                        <span class="label label-default">{{$tag->tag->tag_name}}</span>
                                            @endif
                                            @empty<h5>No Tags</h5>
                                            @endforelse
                                            </p>
                                        </td>
                                        <td>{{$outgoingDocument->outgoing_issue_date}}<br>
                                            <i><b>{{$outgoingDocument->outgoing_issue_number}}</b></i>
                                        </td>
                                        <td class="text-center">
                                            <table style=" width: 100%;">
                                                <tr>
                                                    <td style="width: 33%">
         
                                                        @if($outgoingDocument->user_image!=null )
                                                            <img src="{{asset('/storage/avatar/'.$outgoingDocument->user_image)}}"
                                                                 class="img-circle" height="20px">
                                                        @else
                                                            <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                 class="img-circle" height="20px">

                                                        @endif

                                                    </td>
                                                    <td style="width: 34%">
                                                        @if($outgoingDocument->signature_user_id !=null)

                                                            <?php $signature = App\User::find($outgoingDocument->signature_user_id)?>

                                                            @if($signature!=null && $signature->user_image!=null)
                                                                <img src="{{asset('/storage/avatar/'.$signature->user_image)}}"
                                                                     class="img-circle" height="20px">
                                                            @else
                                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                     class="img-circle" height="20px">
                                                            @endif

                                                        @endif
                                                    </td>
                                                    <td style="width: 33%">
                                                        @if($outgoingDocument->issued_by !=null)
                                                            <?php $issue = App\User::find($outgoingDocument->issued_by)?>


                                                            @if($issue->user_image!=null )
                                                                <img src="{{asset('/storage/avatar/'.$issue->user_image)}}"
                                                                     class="img-circle" height="20px">
                                                            @else

                                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                                     class="img-circle" height="20px">
                                                            @endif

                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php $fname = explode(" ", $outgoingDocument->name)?>{{$fname[0]}}
                                                    </td>

                                                    <td>
                                                        @if($outgoingDocument->signature_user_id !=0)

                                                            <?php $fname = explode(" ", \App\User::find($outgoingDocument->signature_user_id)->name)?>{{$fname[0]}}

                                                        @endif
                                                    </td>


                                                    <td>
                                                        @if($outgoingDocument->issued_by !=null)

                                                            <?php $fname = explode(" ", \App\User::find($outgoingDocument->issued_by)->name)?>{{$fname[0]}}

                                                        @endif
                                                    </td>

                                                </tr>
                                                <tr class="text-10">
                                                    <td>
                                                        {{$outgoingDocument->created_at->format('Y-m-d')}}
                                                    </td>
                                                    <td>
                                                        @if($outgoingDocument->signature_user_id !=0)

                                                            {{$outgoingDocument->created_at->format('Y-m-d')}}

                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($outgoingDocument->issued_by !=null)

                                                            {{$outgoingDocument->outgoing_issue_date}}

                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            @if($outgoingDocument->outgoing_issue_status=="issued" && $outgoingDocument->outgoing_issue_number!=null)
                                                <button
                                                        class="btn btn-block btn-success btn-xs getRegisterModal"
                                                        id="btn_issue_{{$outgoingDocument->id}}"
                                                        data-id="<?= $outgoingDocument->id ?>"
                                                        value="{{$outgoingDocument->id}}">
                                                    <strong> Issued
                                                    </strong>
                                                </button>
                                            @elseif($outgoingDocument->outgoing_issue_status=="registered"&&$outgoingDocument->outgoing_registration_number!=null && $outgoingDocument->outgoing_registration_date!=null)

                                                <label
                                                        class="btn btn-block btn-primary btn-xs">
                                                    <strong> Registered
                                                    </strong>
                                                </label>
                                            @else

                                                <button class="btn btn-block btn-warning btn-xs detail"
                                                        data-toggle="modal"
                                                        data-target="#issue{{$outgoingDocument->id}}"
                                                        data-id="<?= $outgoingDocument->id ?>"
                                                        id="btn_draft_{{$outgoingDocument->id}}">
                                                    Draft
                                                </button>

                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['outgoingDocument.destroy',
                                                                                                  $outgoingDocument->id]]) !!}
                                            <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id)}}"
                                               class="text-success" data-toggle="tooltip"
                                               data-placement="top" title="View">
                                                <i class="fa fa-binoculars actionIcon"></i>
                                            </a>&nbsp;
                                            <a data-toggle="modal"
                                               data-target="#email{{$outgoingDocument->id}}"
                                               value="{{$outgoingDocument->id}}"
                                               class="text-warning"
                                               data-placement="top" title="Send Email">
                                                <i class="fa fa-envelope actionIcon"></i>
                                            </a>&nbsp;
                                            @if($outgoingDocument->outgoing_issue_status!="issued" && $outgoingDocument->outgoing_issue_status!="registered" && $allowEdit)

                                                <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id.'/edit')}}"
                                                   class="text-info actionIcon" data-toggle="tooltip"
                                                   data-placement="top" title="Edit"
                                                   id="edit_{{$outgoingDocument->id}}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            @endif

                                            @if($outgoingDocument->outgoing_issue_status!="issued" && $outgoingDocument->outgoing_issue_status!="registered" && $allowDelete)
                                                <button type="submit"
                                                        class="link deleteButton actionIcon"
                                                        data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            @endif

                                            {!! Form::close() !!}


                                        </td>
                                    </tr>
                                    <div class="modal fade" id="email{{$outgoingDocument->id}}"
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
                                                    {{Form::open(array('method' => 'PUT','url'=>"documents/outgoingDocument/send/email/{$outgoingDocument->id}",'enctype'=>'multipart/form-data'))}}

                                                    <div class="box-body">
                                                        <input type="hidden"
                                                               name="_token"
                                                               value="{{ csrf_token() }}">

                                                        <div class="form-group">
                                                            <label for="receiver_regd_no"
                                                                   class="control-label align">
                                                                To <label class="text-danger">* </label>
                                                            </label>
                                                            {{Form::email('receiver_email',$outgoingDocument->institution->institution_email_address,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Receiver Email'))}}
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="receiver_regd_date"
                                                                   class="control-label align">
                                                                Cc
                                                            </label>
                                                            {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Cc email'))}}
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="receiver_regd_date"
                                                                   class="control-label align">
                                                                Bcc
                                                            </label>
                                                            {{Form::email('bcc_email',null,array('class'=>'form-control','id'=>'bcc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Cc email'))}}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="receiver_regd_no"
                                                                   class="control-label align">
                                                                Subject </label>
                                                            {{Form::text('letter_subject',$outgoingDocument->outgoing_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
                                                            'Subject'))}}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_content">Email
                                                                Content</label>

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

                                                        <span class="help-block additional-info-box"><b>Note</b> <br>Enter email address(es). Use comma(,) to separate multiple email addresses.
                                                        Eg: email1@something.com,email2@something.com
                                                         <label for="panel-body">Field in <label
                                                                     class="text-danger">* </label> are mandatory</label></span>
                                                    </div>
                                                    {{Form::close()}}

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal fade" id="issue{{$outgoingDocument->id}}"
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
                                                        Issue Document Information</h4>
                                                </div>
                                       
                                                <div class="modal-body">
                                                    <form name="form_issue" id="form_issue{{$outgoingDocument->id}}">
                                                        <input type="hidden"  value="{{$outgoingDocument->id}}" name="outgoing_document_id" id="outgoing_document_id">
                                                        <div class="box-body">
                                                            <input type="hidden" name="_token"  value="{{ csrf_token() }}">


                                                            <div class="form-group {{($errors->has('outgoing_issue_date'))?'has-error':'' }}">
                                                                <label for="outgoing_issue_date">
                                                                    Date<label
                                                                            class="text-danger">
                                                                        *</label></label>

                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    {{Form::text('outgoing_issue_date',date('Y-m-d'),array('class'=>'form-control pull-right datepicker','id'=>'datepicker','placeholder'=>" Letter Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                                                    {!! $errors->first('outgoing_issue_date', '<span class="text-danger">:message</span>') !!}
                                                                </div>

                                                                <div class="form-group {{($errors->has('signature_user_id'))?'has-error':'' }}">
                                                                    <label for="signature_user_id">Signature<label
                                                                                class="text-danger">
                                                                            *</label></label><br>
                                                                    <p class="help-block">Signature
                                                                        entered
                                                                        in
                                                                        this
                                                                        field will replace variable
                                                                        _SIGNATURE_</p>
                                                                    {{Form::select('signature_user_id',$signatures->pluck('name','id'),$outgoingDocument->signature_user_id!=0?$outgoingDocument->signature_user_id:Auth::user()->id,['class'=>'form-control select2','style'=>'width:100%;','id'=>'signature_user_id','placeholder'=>
                                                                        'Select Signature'])}}

                                                                    {!! $errors->first('signature_user_id', '<span class="text-danger">:message</span>') !!}


                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>


                                                        </div>
                                                        <div class="box-footer">

                                                            <button type="button" id="btn_post_issue{{$outgoingDocument->id}}" class="btn btn-success issueDocument"
                                                                    name="issue" value="{{$outgoingDocument->id}}"
                                                                    data-id="<?= $outgoingDocument->id ?>">
                                                                Issue
                                                            </button>
                                                            <br>

                                                            <label for="panel-body">Note
                                                                :Field in <label
                                                                        class="text-danger">
                                                                    * </label> are
                                                                mandatory
                                                            </label>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div id="confirmModal" class="modal fade" role="dialog">


                                            </div>

                                        </div>
                                    </div>

                                @endforeach


                                <div class="modal fade" id="register"
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
                                                    Document Registration Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form name="form_registration" id="form_registration">
                                                    <input type="hidden" value="" name="document_id"
                                                           id="document_id">
                                                    <div class="box-body">
                                                        <input type="hidden"
                                                               name="_token"
                                                               value="{{ csrf_token() }}">


                                                        <div class="form-group {{($errors->has('outgoing_registration_date'))?'has-error':'' }}">
                                                            <label for="outgoing_registration_date"> Registration
                                                                Date:</label>

                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                {{Form::text('outgoing_registration_date',date('Y-m-d'),array('class'=>'form-control pull-right datepicker','id'=>'datepicker','placeholder'=>" Letter Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                                                {!! $errors->first('outgoing_registration_date', '<span class="text-danger">:message</span>') !!}
                                                            </div>

                                                            <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group {{($errors->has('outgoing_registration_number'))?'has-error':'' }}">
                                                            <label for="outgoing_registration_number"> Registration
                                                                Number:</label>

                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-registered"></i>
                                                                </div>
                                                                {{Form::text('outgoing_registration_number',null,array('class'=>'form-control pull-right','placeholder'=>"Document Registration"))}}
                                                                {!! $errors->first('outgoing_registration_number', '<span class="text-danger">:message</span>') !!}
                                                            </div>

                                                            <!-- /.input group -->
                                                        </div>


                                                    </div>
                                                    <div class="box-footer">

                                                        <button type="button" id="btn_register"
                                                                class="btn btn-primary"
                                                                name="issue">
                                                            Register
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
                                                </form>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            @endif

                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php
                            use Illuminate\Support\Facades\Input;

                            ?>
                            @include('documents.paginate',['document'=>$outgoingDocuments,'url'=>'documents/outgoingDocument'])
                        </div>

                    </div>
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
    <script type="text/javascript">

        $(document).ready(function () {
//get issue modal
//            $(document).on("click", ".detail", function () {
//                var id = $(this).data('id');
//                $("#issue"+id).modal('show');
//
////
//            });
//            get register modal
            $(document).on("click", ".getRegisterModal", function () {
                var id = $(this).data('id');
                $('#document_id').val(id);
                $("#register").modal('show');

//
            });
//            to issue letter

            $('.issueDocument').click(function () {
                var issue_id = $(this).val();
             
             
                if (confirm('This Document cannot edit after issue. Are you Sure you want to issue this document?')) {
                    $.ajax({
                        type: "POST",
                        url: "outgoingDocument/issue",
                        dataType: "text",
                        data: $('#form_issue' + issue_id).serializeArray(),
                        success: function (data) {
                            var obj = $.parseJSON(data);
                            var Id = obj.id;
                            alert('Document Successfully issued');
                            $('#issue' + issue_id).modal('hide');

                            $('#btn_draft_' + Id).removeClass('btn btn-warning detail');
                            $('#btn_draft_' + Id).addClass('btn btn-success getRegisterModal');
                            $('#edit_' + Id).hide();
                            document.getElementById('btn_draft_' + Id).innerHTML = '<strong> Issued </strong>';


                        }
                    });
                } else {
                    $('#issue' + issue_id).modal('hide');
                }

            });


            //to add registration number in letter
            $('#btn_register').click(function () {


                $.ajax({
                    type: "POST",
                    url: "outgoingDocument/register",
                    dataType: "text",
                    data: $('#form_registration').serializeArray(),
                    success: function (data) {
                        var obj = $.parseJSON(data);
                        var Id = obj.id;
                        alert('Registration Number Successfully added');
                        $('#register').modal('hide');

                        $('#btn_issue_' + Id).removeClass('btn btn-success getRegisterModal');
                        $('#btn_issue_' + Id).addClass('btn btn-primary');
                        $('#edit_' + Id).hide();
                        document.getElementById('btn_issue_' + Id).innerHTML = '<strong> Registered </strong>';


                    }
                });
            })

        });
        //filter js
        $('#signed_user_id').select2(
            {
                placeholder: "Select Signed By",
                allowClear: true,
            }
        );
        $('#institution_id').select2(
            {
                placeholder: "Select Institution",
                allowClear: true,
            }
        );
        $('#outgoing_document_status').select2(
            {
                placeholder: "Select Document Status",
                allowClear: true,
            }
        );


    </script>
@endsection