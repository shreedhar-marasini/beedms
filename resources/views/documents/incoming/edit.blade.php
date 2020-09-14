@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Incoming Document
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Documents</a></li>
                <li class="active">Incoming Document</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            @if (count($errors)!=null)

                <div class="errorBar">
                    <a class="pull-right" href="#" data-placement="left" title=""
                       style="color: rgb(255, 255, 255); font-size: 20px;"
                       id="closeErrorBar">×</a>
                    <a href=""
                       style="color: rgba(255, 255, 255, 0.901961); display: inline-block; margin-right: 10px; text-decoration: none;">
                        Please Input all the required fields.</a>

                </div>

            @endif

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('eng.edit')}}</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/incomingDocument/create'),
                        url('documents/incomingDocument'));

                    ?>
                </div>

                <div class="box-body pad">
                    <strong class="help-block">Document Category: {{$edits->document_category->category_name}}</strong>
                    <strong class="help-block">Registration
                        Number: {{$edits->incoming_document_registration_number}}</strong>
                    <hr>
                    {!! Form::model($edits,
                    ['method'=>'PUT','route'=>['incomingDocument.update',$edits->id],'enctype'=>'multipart/form-data','files'=>true,'id'=>'editIncoming'])
                    !!}

                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group {{($errors->has('sender_institution_id'))?'has-error':'' }}">
                                <label for="sender_institution_id">Sender Institution</label><br>

                                {{Form::select('sender_institution_id',$institutionList->pluck('institution_name','id'),Request::get('sender_institution_id'),['class'=>'form-control'])}}

                                {!! $errors->first('sender_institution_id', '<span class="text-danger">:message</span>')
                                !!}
                            </div>
                            <!-- /.form group -->


                            <div class="form-group {{($errors->has('sender_department_name'))?'has-error':'' }}">
                                <label for="sender_department_name">Sender Department Name</label><br>
                                {{Form::text('sender_department_name',null,array('class'=>'form-control','id'=>'sender_department_name','placeholder'=>
                              'Sender Department Name'))}}
                                {!! $errors->first('sender_department_name', '<span class="text-danger">:message</span>')
                                !!}

                            </div>
                            <!-- /.form group -->

                            <div class="form-group {{($errors->has('issue_number'))?'has-error':'' }}">
                                <label for="issue_number">Issue Number</label><br>

                                <p class="help-block">Issue Number Of Sender Institution</p>

                                {{Form::text('issue_number',null,array('class'=>'form-control','id'=>'issue_number','placeholder'=>
                              'Issue Number'))}}
                                {!! $errors->first('issue_number', '<span class="text-danger">:message</span>') !!}

                            </div>
                            <!-- /.form group -->

                            <div class="row form-group">
                                <div class=" col-md-6">
                                    <label for="nepali_date"> Nepali Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('nepali_date',null,array('class'=>'form-control','id'=>'nepaliDate','placeholder'=>"Nepali Date", 'data-date-format' => 'yyyy-mm-dd','autocomplete'=>'off'))}}
                                    </div>
                                    <button type="button" id="generate" class="pull-right">Generate</button>
                                    <!-- /.input group -->
                                </div>


                                <!-- /.form group -->
                                <div class=" {{($errors->has('issue_date'))?'has-error':'' }} col-md-6">
                                    <label for="issue_date">Issue Date:<label class="text-danger"> *</label></label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('issue_date',null,array('class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>"Issue Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                        {!! $errors->first('issue_date', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                            <div class="form-group {{ ($errors->has('tag_id'))?'has-error':'' }}">
                                <label for="tag_id">Document Tags</label>
                                {{Form::text('tag_id',null,array('class'=>'form-control','id'=>'my-text-input','placeholder'=>'Search tags here'))}}
                                {!! $errors->first('tag_id', '<span class="text-danger">:message</span>') !!}
                                <span class="help-block pull-right">
                                        <input type="checkbox" name="create_tag_check_box" value="1"
                                               id="create_tag_check_box" checked>
                                        Create New Tag</span>
                            </div>
                            <div class="form-group" id="create_tag">
                                <div class="col-md-offset-1 col-md-10 col-md-offset-1"
                                     style="background-color: #e9f5ff; padding: 10px; border-radius: 5px">

                                    <div class="col-md-8">

                                        {{Form::text('tag_name',null,array('class'=>'form-control','id'=>'tag_name','placeholder'=>
                             'Tag Name','list'=>'datalistItems','autocomplete'=>'off'))}}
                                        <datalist id="datalistItems">

                                        </datalist>
                                        {!! $errors->first('tag_name', '<span class="text-danger">:message</span>') !!}

                                    </div>

                                    <div class="col-md-4">

                                        <button type="button" id="create_tag_button">Create Tag
                                        </button>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group {{($errors->has('receiver_department_id'))?'has-error':'' }}">
                                <label for="receiver_department_id">Receiver Department<label class="text-danger">
                                        *</label></label><br>

                                {{Form::select('receiver_department_id',$departmentList->pluck('department_name','id'),Request::get('receiver_department_id'),['class'=>'form-control'])}}

                                {!! $errors->first('receiver_department_id', '<span class="text-danger">:message</span>')
                                !!}
                            </div>
                            <div class="form-group {{($errors->has('incoming_document_subject'))?'has-error':'' }}">
                                <label for="incoming_document_subject">Incoming Document Subject<label
                                            class="text-danger"> *</label></label><br>
                                {{Form::text('incoming_document_subject',null,array('class'=>'form-control','id'=>'incoming_document_subject','placeholder'=>
                              'Incoming Document Subject'))}}
                                {!! $errors->first('incoming_document_subject', '<span
                                        class="text-danger">:message</span>') !!}

                            </div>
                            <!-- /.form group -->

                            <div class="row form-group">
                                <div class=" col-md-6">
                                    <label for="nepali_date"> Nepali Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('nepali_date',null,array('class'=>'form-control','id'=>'documentReceivedNepaliDate','placeholder'=>"Nepali Date", 'data-date-format' => 'yyyy-mm-dd','autocomplete'=>'off'))}}
                                    </div>
                                    <button type="button" id="generateDocumentReceivedDate" class="pull-right">
                                        Generate
                                    </button>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group {{($errors->has('document_received_date'))?'has-error':'' }} col-md-6">
                                    <label for="document_received_date">Document Received Date<label
                                                class="text-danger">
                                            *</label></label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('document_received_date',null,array('class'=>'form-control pull-right datepicker','id'=>'documentReceivedDate','placeholder'=>" Document Received Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                        {!! $errors->first('document_received_date', '<span
                                                class="text-danger">:message</span>') !!}
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>


                            <div class="row form-group">
                                <div class=" col-md-6">
                                    <label for="nepali_date"> Nepali Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('nepali_date',null,array('class'=>'form-control','id'=>'documentRegistrationNepaliDate','placeholder'=>"Nepali Date", 'data-date-format' => 'yyyy-mm-dd','autocomplete'=>'off'))}}
                                    </div>
                                    <button type="button" id="generateDocumentRegistrationDate" class="pull-right">
                                        Generate
                                    </button>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-md-6 {{($errors->has('incoming_document_registration_date'))?'has-error':'' }}">
                                    <label for="incoming_document_registration_date">Incoming Document Registration
                                        Date<label class="text-danger"> *</label></label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('incoming_document_registration_date',null,array('class'=>'form-control pull-right datepicker','id'=>'documentRegistrationDate','placeholder'=>" Incoming Document Registration Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                        {!! $errors->first('incoming_document_registration_date', '<span
                                                class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <!-- /.form group -->
                        </div>

                        <div class="col-md-6">


                            <div class="form-group {{($errors->has('file_upload'))?'has-error':'' }}">
                                <label for="file_upload">File<label class="text-danger"> *</label></label>

                                <p class="help-block">Only jpg,pdf,jpeg,png are supported</p>

                                <input type="file" id="file_upload" name="file_upload" class="pull-left">
                                @if($edits->incoming_document_upload!=null)
                                    <a href="{{asset("storage/uploads/documents/incomingDocuments/".$edits->incoming_document_upload)}}"
                                       target="_blank" class="pull-right">{{$edits->incoming_document_upload}}</a>
                                @endif
                                {!! $errors->first('file_uploads', '<span class="text-danger">:message</span>') !!}

                            </div>
                            <br>

                            <div class="form-group {{($errors->has('incoming_document_add_uploads'))?'has-error':'' }}">
                                <label for="incoming_document_add_uploads">Additional File</label>

                                <p class="help-block">Additional File(if any).Only jpg,pdf,zip,jpeg,png,xlsx,xls are
                                    supported</p>

                                <input type="file" id="incoming_document_add_uploads"
                                       name="incoming_document_add_uploads" class="pull-left">
                                @if($edits->incoming_document_additional_uploads!=null)
                                    <a href="{{asset("storage/uploads/documents/incomingDocuments/".$edits->incoming_document_additional_uploads)}}"
                                       target="_blank" class="pull-right">{{$edits->incoming_document_upload}}</a>
                                @endif
                                {!! $errors->first('file_uploads', '<span class="text-danger">:message</span>') !!}

                            </div>
                            <br>

                            <div class="form-group {{ ($errors->has('incoming_document_privacy'))?'has-error':'' }}">
                                <label for="incoming_document_privacy">Incoming Document Privacy</label><br>
                                {{--{{Form::radio('incoming_document_privacy', 'general','true', $edits->digitized_document_privacy=='General')}} General &nbsp;&nbsp;&nbsp;--}}
                                {{--{{Form::radio('incoming_document_privacy', 'departmental',null,['id' => 'departmental'],$edits->digitized_document_privacy=='Departmental')}}--}}
                                {{--Departmental &nbsp;&nbsp;&nbsp;--}}
                                {{--{{Form::radio('incoming_document_privacy', 'confidential',null,['id' => 'confidential'],$edits->digitized_document_privacy=='Confidential')}}--}}
                                {{--Confidential--}}

                                <input type="radio" id="general" name="incoming_document_privacy"
                                       value="general" <?php if ($edits->incoming_document_privacy == 'General') echo 'checked=checked'?> >General
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="departmental" name="incoming_document_privacy"
                                       value="departmental" <?php if ($edits->incoming_document_privacy == 'Departmental') echo 'checked=checked'?> >Departmental
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="confidential" name="incoming_document_privacy"
                                       value="confidential" <?php if ($edits->incoming_document_privacy == 'Confidential') echo 'checked=checked'?> >Confidential

                            </div>

                            <div id="email-search">
                                <div class="form-group">
                                <label for="confidential-email">Confidential Email <label class="text-danger"> *</label></label>
                                    {{Form::hidden('confidential_email',null,array('class'=>'form-control','id'=>'confidential-email','placeholder'=>
                                  'Add Email'))}}

                                </div>
                            </div>


                            <div class="box-footer">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="update" value="update"
                                            name="update"
                                            onclick="clicked(event)">
                                        Update
                                    </button>
                                    <button type="submit" class="btn btn-default bg-gray" id="saveAndSendEmail"
                                            name="saveAndSendEmail" value="saveAndSendEmail" style="display: none;">
                                        Update & Send Email
                                    </button>
                                    <a href="{{url('documents/incomingDocument')}}"
                                       onclick="return confirm('Do you Want To Cancel Changes?');"
                                       class="btn btn-default bg-red">Cancel</a>

                                </div>
                                <!-- /.box-footer -->

                            </div>
                        </div>


                    </div>

                    {!! Form::close() !!}
                </div>


            </div>
            <!-- /.box-body -->
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection

@section('js')

    @include('documents.createTag')

    <script>
        $('#generate').on('click', function () {
            var nepaliDate = $('#nepaliDate').val();
//               document.getElementById('englishDate').innerHTML = 'adf';
            if (nepaliDate) {
                $("#datepicker").load("/get-english-date" + '/' + nepaliDate, function (data) {
                    document.getElementById('datepicker').value = data;
                });
            } else {
                document.getElementById('datepicker').innerHTML = 'Enter the valid Date in Date of Birth (B.S.)';
            }
        });
    </script>

    <script>
        $('#generateDocumentRegistrationDate').on('click', function () {
            var nepaliDate = $('#documentRegistrationNepaliDate').val();
//               document.getElementById('englishDate').innerHTML = 'adf';
            if (nepaliDate) {
                $("#documentRegistrationDate").load("/get-english-date" + '/' + nepaliDate, function (data) {
                    document.getElementById('documentRegistrationDate').value = data;
                });
            } else {
                document.getElementById('documentRegistrationDate').innerHTML = 'Enter the valid Date in Date of Birth (B.S.)';
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#documentRegistrationNepaliDate').nepaliDatePicker({
                npdMonth: true,
                npdYear: true
            });
        });
    </script>
    <script>
        $('#generateDocumentReceivedDate').on('click', function () {
            var nepaliDate = $('#documentReceivedNepaliDate').val();
//               document.getElementById('englishDate').innerHTML = 'adf';
            if (nepaliDate) {
                $("#documentReceivedDate").load("/get-english-date" + '/' + nepaliDate, function (data) {
                    document.getElementById('documentReceivedDate').value = data;
                });
            } else {
                document.getElementById('documentReceivedDate').innerHTML = 'Enter the valid Date in Date of Birth (B.S.)';
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#documentReceivedNepaliDate').nepaliDatePicker({
                npdMonth: true,
                npdYear: true
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.token-input-list-facebook').remove();
            $("#confidential-email").tokenInput("{{url('user/searchList')}}", {
                theme: "facebook",
                noResultsText: 'User not Found',
                preventDuplicates: true,
                tokenValue: "id",
                propertyToSearch: "name",
                <?php if($users != ''){?>
                prePopulate:<?php echo $users ?>
                <?php } ?>

            });
            $("#my-text-input").tokenInput("{{url('configurations/tag/search')}}", {
                theme: "facebook",
                noResultsText: 'Tags not Found',
                preventDuplicates: true,
                tokenValue: "id",
                propertyToSearch: "tag_name",
                prePopulate:<?php echo $tagIds ?>
            });
        });


        $(document).ready(function () {


            if ($('#confidential').is(":checked")) {
                $('#email-search').show();
                $('#saveAndSendEmail').show();


            }
            if ($('#departmental').is(":checked")) {
                $('#email-search').hide();
                $('#saveAndSendEmail').show();

            }
            if ($('#general').is(":checked")) {
                $('#email-search').hide();
                $('#saveAndSendEmail').hide();
            }


            $('input[type="radio"]').click(function () {
                if ($(this).attr('id') == 'departmental') {
                    $('#saveAndSendEmail').show();
                    $('#email-search').hide();
                } else if ($(this).attr('id') == 'confidential') {
                    $('#saveAndSendEmail').show();
                    $('#email-search').show();

                } else {
                    $('#email-search').hide();
                    $('#saveAndSendEmail').hide();

                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#closeErrorBar').click(function () {
            $('.errorBar').hide();

        });
    </script>


@endsection
