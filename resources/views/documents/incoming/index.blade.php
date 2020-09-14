@extends('master.app')
@section('content')
<style>
    #incoming_institution_id
    {
        width: 280px;
 
    }
</style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Incoming Documents
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Documents</a></li>
                <li class="active">Incoming Documents</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @include('message.flash')
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <?php

use App\Models\IncomingDocument;

$permission = helperPermissionLink(url('documents/incomingDocument/create'),
                            url('documents/incomingDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 topFilter">
                                <form class="form-inline">
                                    <input type="text" name="incoming_document_subject" class="form-control filterForm"
                                           placeholder="Document Subject">
                                    {{Form::select('sender_institution_id',$institutions->pluck('institution_name','id'),Request::get('incoming_institution_id'),array('class'=>'form-control','id'=>'incoming_institution_id','placeholder'=> 'Select Institution'))}}
                                    {{Form::select('receiver_department_id',$departments->pluck('department_name','id'),Request::get('receiver_department_id'),array('class'=>'form-control','id'=>'receiver_department_id','placeholder'=>'Select Department'))}}
                                    {{Form::select('document_category_id',$category->pluck('category_name','id'),Request::get('document_category_id'),array('class'=>'form-control','id'=>'document_category_id','placeholder'=>'Select Category'))}}
                                    {{Form::text('incoming_document_date_from',Request::get('incoming_document_date_from'),array('class'=>'form-control','id'=>'datepicker','placeholder'=>" Document Date from", 'data-date-format' => 'yyyy-mm-dd'))}}
                                    {{Form::text('incoming_document_date_to',Request::get('incoming_document_date_to'),array('class'=>'form-control','id'=>'calendar','placeholder'=>" Document Date to", 'data-date-format' => 'yyyy-mm-dd'))}}

                                   
                                    &nbsp;

                            
                                    <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{url('/documents/incomingDocument')}}" type="button"
                                                           class="btn btn-warning"><i
                                                                    class="fa fa-refresh"></i> Refresh
                                                        </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(!count($incomingDocuments)>=0)
                        <table id="example4" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Subject</th>
                                <th>Institution/Department</th>
                                <th>Category</th>
                                <th>Issue Information</th>
                                <th>Registration Information</th>
                                <th style="width:120px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($incomingDocuments as $incomingDocument)
                  
                                <tr>
                                    <th scope=row>{{$i}}</th>
                                    <td>
                                        <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}"
                                           target="_blank">{{$incomingDocument->incoming_document_subject}}</a>
                                        <br>
                                        <b>{{$incomingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;<br>
                                        <i class="pull-right help-block mark small">Uploaded
                                            By: {{$incomingDocument->user->name}}</i>
                                        @if($incomingDocument->incoming_document_privacy=='Confidential')
                                            <p class=" label label-warning "
                                               style="font-size: 8px"> {{$incomingDocument->incoming_document_privacy}}</p>
                                        @elseif($incomingDocument->incoming_document_privacy=='Departmental')
                                            <p class=" label label-primary "
                                               style="font-size: 8px"> {{$incomingDocument->incoming_document_privacy}}</p>
                                        @else
                                            <p class=" label label-default "
                                               style="font-size: 8px"> {{$incomingDocument->incoming_document_privacy}}</p>


                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('institution/'.$incomingDocument->sender_institution_id)}}"
                                           target="_blank">
                                            {{$incomingDocument->institution->institution_name}}</a><br>
                                        <i>{{$incomingDocument->sender_department_name}}</i>
                                    </td>
                                    <td>
                                        {{$incomingDocument->document_category->category_name}}<br>
                                        <p>
                                            <?php $tags = \App\Models\DocumentTag::where('document_id', '=', $incomingDocument->id)
                                                ->where('document_tag_type', '=', 'incoming')
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
                                    <td><b>{{$incomingDocument->issue_number}}</b><br>
                                        <i>{{$incomingDocument->issue_date}}</i>
                                    </td>
                                    <td><b>{{$incomingDocument->incoming_document_registration_number}}</b><br>
                                        <i>{{$incomingDocument->incoming_document_registration_date}}</i>
                                    </td>
                                    <td class="text-right">
                                        {!! Form::open(['method' => 'DELETE','route' => ['incomingDocument.destroy',
                                        $incomingDocument->id]]) !!}
                                        <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}"
                                           class="text-success " data-toggle="tooltip"
                                           data-placement="top" title="View">
                                            <i class="fa fa-binoculars actionIcon"></i>
                                        </a>&nbsp;
                                        <a data-toggle="modal"
                                           data-target="#email{{$incomingDocument->id}}"
                                           value="{{$incomingDocument->id}}"
                                           class="text-warning"
                                           data-placement="top" title="Send Email">
                                            <i class="fa fa-envelope actionIcon"></i>
                                        </a>&nbsp;
                                        @if($allowEdit)
                                            <a href="{{route('incomingDocument.edit',[$incomingDocument->id])}}"
                                               class="text-info actionIcon" data-toggle="tooltip"
                                               data-placement="top" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endif

                                        @if($allowDelete)

                                            <button type="submit"
                                                    class=" test link deleteButton actionIcon"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endif


                                    </td>
                                </tr>
                                <div class="modal fade" id="email{{$incomingDocument->id}}"
                                     role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content col-md-10">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Receiver's Email Information</h4>
                                            </div>

                                            <div class="modal-body">
                                                {{Form::open(array('method' => 'PUT','url'=>"documents/incomingDocument/send/email/{$incomingDocument->id}",'enctype'=>'multipart/form-data'))}}
                                                <div class="box-body">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                    <div class="form-group">
                                                        <label for="receiver_regd_no" class="control-label align">
                                                            To
                                                        </label>
                                                        {{Form::email('receiver_email',null,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                                        'Receiver Email', 'required'))}}
                                                    </div>

                                                    <div class="form-group ">
                                                        <label for="receiver_regd_date"
                                                               class="control-label align">
                                                            Cc
                                                        </label>
                                                        {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','placeholder'=>
                                                        'Cc email'))}}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="receiver_regd_no"
                                                               class="control-label align">
                                                            Subject </label>
                                                        {{Form::text('incoming_document_subject',$incomingDocument->incoming_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
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

                                                    <div class="form-group {{ ($errors->has('attach_additional_file'))?'has-error':'' }}">
                                                        {{Form::checkbox('attach_additional_file','yes',true,array('class'=>'field','id'=>'attach_additional_file','placeholder'=>
                                                        'Attach Additional file if exist??'))}}
                                                        <label for="attach_additional_file" class="control-label align">Attach
                                                            Additional file if Exists?</label>
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
                                                    <br/>
                                                    <br/>

                                                    <label for="panel-body">Note :Field in
                                                        <label class="text-danger">* </label>
                                                        are mandatory
                                                    </label>
                                                </div>

                                                {{Form::close()}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
                            @else
                            @endif

                            </tbody>
                        </table>
                        <div class="pull-right">
                            @include('documents.paginate',['document'=>$incomingDocuments,'url'=>'/documents/incomingDocument/'])
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

    <script>
        $("#calendar").datepicker({});

        $('#receiver_department_id').select2(
                {
                    placeholder: "Department",
                    allowClear: true,
                }
        );
        $('#incoming_institution_id').select2(
                {
                    placeholder: "Institution",
                    allowClear: true,
                }
        );
        $('#document_category_id').select2(
                {
                    placeholder: "Document Category",
                    allowClear: true,
                }
        );
    </script>

@endsection