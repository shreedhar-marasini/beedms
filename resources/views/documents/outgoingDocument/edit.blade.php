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
                <li><a href="{{url('documents/outgoingDocument')}}"> Outgoing Document </a></li>
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
                    <h3 class="box-title"> Edit</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/outgoingDocument/create'), url('documents/outgoingDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>

                </div>
                <div class="box-body pad">

                    {!! Form::model($edits,['method'=>'PUT','route'=>['outgoingDocument.update',$edits->id],'enctype'=>'multipart/form-data']) !!}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">

                            <div class="form-group">
                                <div class="form-group{{ ($errors->has('template_id'))?'has-error':'' }} ">
                                    <label>Template Category <label class="text-danger"> *</label></label>
                                    <span class="label label-warning"> {{$edits->template->template_name}}</span>
                                    {!! $errors->first('template_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <p class="help-block">Date entered in this field will replace variable
                                        __DOCUMENT_DATE__.<br><b>Note:</b>__TODAY_DATE__ is replaced by today's date
                                        and
                                        __ISSUE_DATE__ is replaced by document issued date.</p>
                                </div>
                                <div class=" col-md-6">
                                    <label for="nepali_date"> Nepali Date</label>
                                    <p class="help-block">Choose Nepali Date.</p>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('nepali_date',null,array('class'=>'form-control','id'=>'nepaliDate','placeholder'=>"Nepali Date", 'data-date-format' => 'yyyy-mm-dd','autocomplete'=>'off'))}}
                                    </div>
                                    <button type="button" id="generate" class="pull-right">Generate</button>
                                    <!-- /.input group -->
                                </div>


                                <div class="col-md-6">

                                    <div class=" {{($errors->has('outgoing_document_date'))?'has-error':'' }}">
                                        <label for="outgoing_document_date"> Date </label><label class="text-danger">
                                            *</label>
                                        <p class="help-block">Choose Date.</p>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            {{Form::text('outgoing_document_date',$edits->outgoing_document_date,array('class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>" Document Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                            {!! $errors->first('outgoing_document_date', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <!-- /.form group -->
                            </div>


                            <!-- /.form group -->

                            <!-- /.form group -->
                            <div class="form-group {{($errors->has('outgoing_document_subject'))?'has-error':'' }}">
                                <label for="outgoing_document_subject">Subject<label class="text-danger">
                                        *</label></label>
                                <p class="help-block">Text in this field will replace variable __DOCUMENT_SUBJECT__.</p>
                            {{Form::text('outgoing_document_subject',null,array('class'=>'form-control','id'=>'outgoing_document_subject','placeholder'=>
                         'Subject to the letter','onkeyup'=>"sync(this)"))}}
                            {!! $errors->first('outgoing_document_subject', '<span class="text-danger">:message</span>') !!}


                            <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                            <input type="hidden" name="outgoing_document_privacy" id="outgoing_document_privacy"
                                   value="general">


                            <div class="form-group {{($errors->has('institution_id'))?'has-error':'' }}">
                                <label for="institution_id">Receiver Institution<label class="text-danger">
                                        *</label></label><br>
                                <p class="help-block">Institution entered in this field will replace variable
                                    __RECEIVER_INSTITUTION__ and the variable __RECEIVER_ADDRESS__ is replaced by the
                                    entered institution address.</p>

                                {{Form::select('institution_id',$institutionList->pluck('institution_name','id'),Request::get('institution_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'institution_id','placeholder'=>
           'Select Institution Name'])}}
                                {{--<select name="institution_id" id="institution_id" class="form-control">--}}
                                {{--<option value="">Select Institution</option>--}}
                                {{--@foreach($institutionList as $list)--}}
                                {{--@if($list->id==$edits->instituion_id)--}}
                                {{--<option value="{{$list->id}}" selected>{{$list->institution_name}}</option>--}}
                                {{--@else--}}
                                {{--<option value="{{$list->id}}">{{$list->institution_name}}</option>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                                {{--</select>--}}
                                <a href="{{url('institution')}}" target="_blank"><p
                                            class="help-block pull-right">Click here</a>to add new Institution.</p>
                                {!! $errors->first('institution_id', '<span class="text-danger">:message</span>') !!}

                            </div>
                            <div class="form-group {{($errors->has('department_name'))?'has-error':'' }}">
                                <label for="department_name">Receiver Institution Department Name<label
                                            class="text-danger"> *</label></label>
                                <p class="help-block">Receiver Institution Department Name</label><br>
                                <p class="help-block">INSTITUTION selected in this field will replace variable
                                    __RECEIVER_INSTITUTION_DEPARTMENT__</p>
                                {{Form::text('department_name',null,array('class'=>'form-control','id'=>'department_name','placeholder'=>
                              'Department Name of receiver Institution'))}}
                                {!! $errors->first('department_name', '<span class="text-danger">:message</span>') !!}


                            </div>

                            <div class="form-group {{($errors->has('signature_user_id'))?'has-error':'' }}">
                                <label for="signature_user_id">Signature</label>
                                <p class="help-block">Signature entered in this field will replace variable
                                    __SIGNATURE_CONTENT__ with the signature content and the variable
                                    __SCANNED_SIGNATURE__ with scanned image of the entered user. If this field is empty
                                    then the document is issued by own signature.</p>
                                {{Form::select('signature_user_id',$signatures->pluck('name','id'),$edits->signature_user_id!=0?$edits->signature_user_id:Auth::user()->id,['class'=>'form-control select2','style'=>'width:100%;','id'=>'signature_user_id','placeholder'=>
           'Select Signature'])}}
                                {!! $errors->first('signature_user_id', '<span class="text-danger">:message</span>') !!}


                            </div>
                            <div class="form-group {{ ($errors->has('tag_id'))?'has-error':'' }}">
                                <label for="tag_id">Document Tags</label>
                                <p class="help-block">Type to search document tag.</p>

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

                            <div class="form-group {{($errors->has('file_uploads'))?'has-error':'' }}">
                                <label for="file_uploads">File input</label>
                                <p class="help-block">Choose file related to this document(if any).Only
                                    jpg,pdf,zip,jpeg,png,xlsx,xls,csv files are supported.</p>
                                <input type="file" id="file_uploads" name="file_uploads" class="pull-left">
                                @if($edits->outgoing_file_uploads!=null)
                                    <a href="{{asset('storage/uploads/documents/outgoingDocuments/'.$edits->outgoing_file_uploads)}}"
                                       class="pull-right" target="_blank">{{$edits->outgoing_file_uploads}}</a>
                                @endif
                                {!! $errors->first('file_uploads', '<span class="text-danger">:message</span>') !!}

                            </div>


                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                            <label for="editor1">Content<label class="text-danger"> *</label></label>

                            <a href="#" id="popOver" class="pull-right" data-toggle="popover" data-placement="left"
                               data-content="__TODAY_DATE__
                               __SIGNATURE_CONTENT__
                               __SCANNED_SIGNATURE__
                               __ISSUE_DATE__<br>
                               __ISSUE_NUMBER__
                               __DEPARTMENT_NAME__
                               __RECEIVER_INSTITUTION__
                               __RECEIVER_ADDRESS__
                               __RECEIVER_INSTITUTION_DEPARTMENT__
                               __DOCUMENT_SUBJECT__
                               __DOCUMENT_DATE__
                               __SCANNED_COMPANY_STAMP__">
                                Click here to know accepted variables</a>


                            <textarea id="content" name="editor1" rows="5" cols="80" style="min-height: 200px">
                                         @if(old('editor1')!=null)
                                    {{old('editor1')}}
                                @else{{$edits->outgoing_document_content}}
                                @endif
                             </textarea>
                            <div style="padding: 15px; background-color: lightskyblue">
                            <span style="color:black; font-weight: bold"> Note: Please make a table with border-width=0 if more than one sign need to be display together. Example: If Scanned Signature and Scanned company stamp need to be displayed
                                after the signature then make table with two column and in one column place signature image and in another place scanned stamp image<br>
                            <i class="text-danger">Do not exceed table width 476px.</i>
                            </span>
                            </div>
                            {!! $errors->first('content', '<span class="text-danger">:message</span>') !!}
                            <div class="form-group {{ ($errors->has('outgoing_document_privacy'))?'has-error':'' }}">
                                <label for="outgoing_document_privacy">Outgoing Document Privacy</label><br>
                                <input type="radio" id="general" name="outgoing_document_privacy"
                                       value="general" <?php if ($edits->outgoing_document_privacy == 'General') echo 'checked=checked'?> >General
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="departmental" name="outgoing_document_privacy"
                                       value="departmental" <?php if ($edits->outgoing_document_privacy == 'Departmental') echo 'checked=checked'?> >Departmental
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="confidential" name="outgoing_document_privacy"
                                       value="confidential" <?php if ($edits->outgoing_document_privacy == 'Confidential') echo 'checked=checked'?> >Confidential
                            </div>
                            <!-- /.form group -->
                            <div id="email-search">
                                <div class="form-group">
                                    {{Form::hidden('confidential_email',null,array('class'=>'form-control','id'=>'confidential-email','placeholder'=>
                                  'Add Email'))}}
                                    <p class="help-block">Please type user name who can view this document.</p>


                                </div>
                            </div>


                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class=" send_email" id="send_email" name="send_email">
                                    Send Mail
                                    <p class="help-block">Please check Send Email to send this document through email
                                        and provide additional field to send email.</p>
                                </label>
                            </div>
                            <div id="email_options">

                                <div class="form-group">
                                    <label for="receiver_email">Send Email To<label class="text-danger">
                                            *</label></label>

                                    <p class="help-block">Enter email address(es). Use comma(,) to separate multiple
                                        email addresses. <br>
                                        <b>Eg: email1@something.com,email2@something.com</b></p>
                                    <input type="text" class="form-control receiver_email" id="receiver_email"
                                           name="receiver_email"
                                           value="{{$edits->institution->institution_email_address}}">


                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="cc_email">CC</label>
                                    <p class="help-block">Enter Additional Email Address to send email.Multiple email is
                                        supported.</p>


                                    <input type="text" class="form-control" id="cc_email" name="cc_email">

                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="letter_subject">Email Subject<label class="text-danger">
                                            *</label></label>

                                    <p class="help-block">Enter Email Subject.</p>

                                    <input type="text" class="form-control pull-right" id="letter_subject"
                                           name="letter_subject" value="{{$edits->outgoing_document_subject}}">

                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="email_content">Email Content<label class="text-danger">
                                            *</label></label>
                                    <p class="help-block">Enter Email Content.</p>

                                    <div class="form-group">
                                        <textarea class="form-control pull-right " id="email_content"
                                                  name="email_content"></textarea>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group"><label>
                                        <input type="checkbox" name="attach_outgoing_file_uploads"
                                               id="attach_outgoing_file_uploads"
                                               value="yes"> <b>Attach additional file with this email(if any).</b>
                                        <p class="help-block">Checking this field will attach the file uploaded from
                                            File Input field along with this email.</p>

                                    </label></div>
                            </div>

                            @if($edits->outgoing_issue_status=="draft")
                                <div class="additional-info-box">

                                    <div class="checkbox">
                                        <label>

                                            <input type="checkbox" name="issue_letter" id="issue_letter"
                                                   value="issue_letter_yes"> <b>Issue Letter</b><br>


                                            Please Check issue checkbox in order to send the document with issue number.
                                            <p class="help-block">Note: If this field is checked, automatically
                                                generated
                                                number will replace the variable __ISSUE_NUMBER__ in Content.</p>
                                        </label>

                                    </div>

                                </div>
                        @endif


                        <!-- /.form group -->

                            <div class="box-footer">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="save" value="save" name="save"
                                            onclick="clicked(event)">
                                        Save
                                    </button>
                                    <button type="submit" class="btn btn-default bg-green" id="saveAndAddNew"
                                            name="saveAndAddNew" value="saveAndAddNew">Save & Add New
                                    </button>
                                    <button type="submit" class="btn btn-default bg-gray" id="saveAndSendEmail"
                                            name="saveAndSendEmail" value="saveAndSendEmail">Save & Send Email
                                    </button>
                                    <a href="{{url('documents/outgoingDocument')}}" class="btn btn-default bg-red">Cancel</a>

                                </div>
                                <!-- /.box-footer -->

                            </div>
                        </div>


                    </div>
                    </form>
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
        $(document).ready(function () {
            $("#popOver").popover({
                placement: 'left',
                html: 'true',
                width: '300px',
                title: '<span class="text-info"><strong>Accepted Variables</strong></span> ' +
                    '<button type="button" id="close" class="close" onclick="$(#example&quot;).popover(&quot;hide&quot;);">&times;</button>',
                content: 'Accepted Variables'
            });
            $(document).on("click", ".popover .close", function () {
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
    <script>
        function sync(textbox) {
            document.getElementById('letter_subject').value = textbox.value;
        }

        function clicked(e) {
            if ($('#send_email').is(":checked")) {
                if (!confirm('Email will not be sent. Are you sure to save document without sending Email?')) e.preventDefault();
            }
        }

        $(document).ready(function () {
            //confidential
            if ($('#confidential').is(":checked")) {
                $('#email-search').show();


            }
            if ($('#departmental').is(":checked")) {
                $('#email-search').hide();


            }
            if ($('#general').is(":checked")) {
                $('#email-search').hide();

            }


        });


        $(document).ready(function () {


            $("#email_options").hide();
            $('#send_email').on('click', function () {
                if ($('#send_email').is(":checked")) {
                    $("#email_options").show();

                } else
                    $("#email_options").hide();

            });


            $('#institution_id').on('change', function () {
                id = $('#institution_id').val();

                $.ajax({
                    type: "get",
                    url: "/documents/outgoingDocument/getInstitutionEmail/" + id,
                    dataType: "text",
                    success: function (data) {
                        //data will hold an object with your response data, no need to parse

                        $("#receiver_email").val(data);

                    }
                });
            });


        });
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
        //document privacy
        //for document privacy
        $(document).ready(function () {
            $('input[type="radio"]').click(function () {
                if ($(this).attr('id') == 'departmental') {

                } else if ($(this).attr('id') == 'confidential') {
                    $('#confidential-email').show();
                    $('#email-search').show();


                } else {
                    $('#email-search').hide();


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