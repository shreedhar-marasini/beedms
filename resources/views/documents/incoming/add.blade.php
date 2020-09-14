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
                    <h3 class="box-title">{{trans('eng.add')}}</h3>
                    <?php
                    $permission = helperPermissionLink(url('documents/incomingDocument/create'),
                        url('documents/incomingDocument'));

                    ?>
                </div>
                <div class="box-body pad">
                    {!!
                    Form::open(['method'=>'post','url'=>'documents/incomingDocument','enctype'=>'multipart/form-data','files'=>true])
                    !!}

                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                        <input type="hidden" name="folder_id" value="0" > 
                            <div class="form-group {{($errors->has('sender_institution_id'))?'has-error':'' }}">
                                <label for="sender_institution_id">Sender Institution<label class="text-danger">
                                        *</label></label>
                                        {{Form::select('sender_institution_id',$institutionList->pluck('institution_name','id'),old( 'sender_institution_id')?old('sender_institution_id'):Request::get('sender_institution_id'),['class'=>'form-control select2','id'=>'sender_institution_id',
                                            'placeholder'=> 'Select Sender Institution '])}}
         
                                {!! $errors->first('sender_institution_id', '<span class="text-danger">:message</span>')
                                !!}
                                <a href="/institution" target="_blank"><p class="help-block pull-right">Click here</a>
                                to add more Institution</p>
                            </div>
                            <!-- /.form group -->
                            <div class="form-group {{($errors->has('sender_department_name'))?'has-error':'' }}">
                                <label for="sender_department_name">Sender Department Name</label><br>
                                {{ Form::text('sender_department_name',old('sender_department_name')?old('sender_department_name'):null,['placeholder'=>'Sender Department Name','class' => 'form-control','id'=>'sender_department_name']) }}
                                
                                {!! $errors->first('sender_department_name', '<span class="text-danger">:message</span>')
                                !!}

                            </div>
                            <!-- /.form group -->

                            <div class="form-group {{($errors->has('issue_number'))?'has-error':'' }}">
                                <label for="issue_number">Issue Number<label class="text-danger"> *</label></label><br>
                                {{Form::text('issue_number',old('sender_department_name')?old('sender_department_name'):null,['class'=>'form-control','id'=>'issue_number','placeholder'=> 'Please enter the number in the Document'])}}
                                {!! $errors->first('issue_number', '<span class="text-danger">:message</span>') !!}
                            </div>

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
                                        {!! Form::text('issue_date',date('Y-m-d'),['class'=>'form-control datepicker pull-right','id'=>'datepicker','placeholder' => 'Issue Date','autocomplete' => 'off', 'data-date-format' => 'yyyy-mm-dd']) !!}

                                            {!! $errors->first('issue_date', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <!-- /.form group -->
                            <div class="form-group {{ ($errors->has('tag_id'))?'has-error':'' }}">
                                <label for="tag_id">Document Tags</label>

                                <p class="help-block">Type to search document tag.</p>
                                {{Form::text('tag_id',old('tag_id'),array('class'=>'form-control','id'=>'my-text-input','placeholder'=>'Search tags here'))}}
                                <!-- {{Form::text('tag_id',old('tag_id'),array('class'=>'form-control','id'=>'my-text-input','placeholder'=>'Search tags here'))}} -->
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
                                        {{Form::select('receiver_department_id',$departmentList->pluck('department_name','id'),old( 'receiver_department_id')?old('receiver_department_id'):Request::get('receiver_department_id'),['class'=>'form-control select2','id'=>'receiver_department_id',
                                            'placeholder'=> 'Select Receiver Department '])}}
                                {!! $errors->first('receiver_department_id', '<span class="text-danger">:message</span>')
                                !!}
                                <a href="/configurations/department" target="_blank"><p class="help-block pull-right">
                                        Click here</a> to add more department
                                </p>
                            </div>
                            <!-- /.form group -->

                            <div class="form-group {{($errors->has('document_category_id'))?'has-error':'' }}">
                                <label for="document_category_id">Document Category<label class="text-danger"> *</label></label><br>
                                <select name="document_category_id" id="document_category_id" class="form-control">
                                    <option value="">Select Document Category</option>
                                    {{ $documentCategoryRepo->getDocumentCategoryList(old('document_category_id')) }}
                                </select>
                                {!! $errors->first('document_category_id', '<span class="text-danger">:message</span>')
                                !!}
                                <a href="/configurations/documentCategory"><p class="help-block pull-right">Click here
                                </a> to add more document category</p>

                            </div>
                            <!-- /.form group -->
                            <div class="form-group {{($errors->has('incoming_document_subject'))?'has-error':'' }}">
                                <label for="incoming_document_subject">Incoming Document Subject<label
                                            class="text-danger"> *</label></label><br>
                                            {{Form::text('incoming_document_subject',old('incoming_document_subject')?old('incoming_document_subject'):null,['class'=>'form-control','id'=>'incoming_document_subject','placeholder'=> 'Incoming Document Subject'])}}
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
                                        {{Form::text('document_received_date',date('Y-m-d'),array('class'=>'form-control pull-right datepicker','id'=>'documentReceivedDate','placeholder'=>" Document Received Date", 'data-date-format' => 'yyyy-mm-dd'))}}
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
                                        {{Form::text('incoming_document_registration_date',date('Y-m-d'),array('class'=>'form-control pull-right datepicker','id'=>'documentRegistrationDate','placeholder'=>" Incoming Document Registration Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                        {!! $errors->first('incoming_document_registration_date', '<span
                                                class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{($errors->has('file_upload'))?'has-error':'' }}">
                                
                                <label for="file_upload">File<label class="text-danger"> *</label></label>

                                <p class="help-block">Only jpg,pdf,jpeg,png are supported</p>

                                <input type="file" id="file_upload" name="file_upload">
                               
                                {!! $errors->first('file_upload', '<span class="text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group {{($errors->has('incoming_document_add_uploads'))?'has-error':'' }}">
                                <label for="incoming_document_add_uploads">Additional File</label>

                                <p class="help-block">Additional File(if any).Only jpg,pdf,zip,jpeg,png,xlsx,xls are
                                    supported</p>

                                <input type="file" id="incoming_document_add_uploads"
                                       name="incoming_document_add_uploads">
                                {!! $errors->first('incoming_document_add_uploads', '<span
                                        class="text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group {{ ($errors->has('incoming_document_privacy'))?'has-error':'' }}">
                                <label for="incoming_document_privacy">Incoming Document Privacy</label><br>
                                {{Form::radio('incoming_document_privacy', 'general','true',[])}} General &nbsp;&nbsp;&nbsp;
                                {{Form::radio('incoming_document_privacy', 'departmental',null,['id' => 'departmental'])}}
                                Departmental &nbsp;&nbsp;&nbsp;
                                {{Form::radio('incoming_document_privacy', 'confidential',null,['id' => 'confidential'])}}
                                Confidential
                            </div>
                            <!-- /.form group -->
                            <div id="email-search" style="display: none">
                            <div class="form-group {{($errors->has('confidential_email'))?'has-error':'' }}">
                                      <label for="confidential-email">Confidential Email <label class="text-danger"> *</label></label>
                                    {{Form::hidden('confidential_email',null,array('class'=>'form-control','id'=>'confidential-email','placeholder'=> 'Add Email'))}}
                                    <p class="help-block">Type Username or Email to search.</p>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="save" value="save" name="save"
                                            onclick="clicked(event)">
                                        Save
                                    </button>
                                    <button type="submit" class="btn btn-default bg-green" id="saveAndAddNew"
                                            name="saveAndAddNew" value="saveAndAddNew">Save & Add New
                                    </button>
                                    <button style="display: none" type="submit" class="btn btn-default bg-gray"
                                            id="saveAndSendEmail"
                                            name="saveAndSendEmail" onclick="return confirm('Are you sure??')"
                                            value="saveAndSendEmail">Save & Send Email
                                    </button>
                                    <a href="{{url('documents/incomingDocument')}}"
                                       onclick="return confirm('Do you want to cancel?');"
                                       class="btn btn-default bg-red">Cancel</a>

                                </div>
                                <!-- /.box-footer -->

                            </div>
                        </div>


                    </div>

                    </form>
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
    <script>
        $(".datepicker").datepicker({});

        $(document).ready(function () {
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

        $(document).ready(function () {
            $("#confidential-email").tokenInput("{{url('user/searchList')}}", {
                theme: "facebook",
                noResultsText: 'User not Found',
                preventDuplicates: true,
                tokenValue: "id",
                propertyToSearch: "name"
            });
        });


        $('#receiver_department_id').on('change', function () {
            id = $('#receiver_department_id').val();
            $.ajax({
                type: "get",
                url: "getDepartmentEmail/" + id,
                dataType: "text",
                success: function (data) {
                    //data will hold an object with your response data, no need to parse
                    $("#receiver_email").val(data);

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