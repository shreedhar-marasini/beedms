@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Digitized Document
                <!--                <small>Sub Module</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Documents</a></li>
                <li><a href="{{url('documents/outgoingDocument')}}"> Digitized Document</a></li>
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
                    <h3 class="box-title">Edit</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/digitizedDocument/create'), url('documents/digitizedDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];

                    $allowAdd = $permission['isAdd'];
                    ?>
                </div>
                <div class="box-body pad">
                    {!! Form::model($edits,['method'=>'put','route'=>['digitizedDocument.update',$edits->id],'enctype'=>'multipart/form-data','files'=>true]) !!}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                            {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ ($errors->has('document_category_id'))?'has-error':'' }} ">--}}
                            {{--<label for="document_category_id">Document Category <label class="text-danger"> *</label></label>--}}
                            {{--<select name="document_category_id" id="document_category_id"--}}
                            {{--class="form-control">--}}
                            {{--<option value="0">Select Document Category</option>--}}
                            {{--{{ $categoryRepo->getDocumentCategoryList($edits->id) }}--}}
                            {{--</select>--}}
                            {{--{!! $errors->first('document_category_id', '<span class="text-danger">:message</span>') !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="form-group{{ ($errors->has('department_id'))?'has-error':'' }} ">
                                    <label for="department_id">Department<label class="text-danger"> *</label></label>
                                    {{Form::select('department_id',$departments->pluck('department_name','id'),Request::get('department_id'),array('class'=>'form-control','id'=>'department_id','placeholder'=>
                                    'Select Department'))}}
                                    {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
                                    <a href={{url('configurations/department')}} target="_blank"><p
                                                class="help-text pull-right">Click here</a> to add new department.</p>

                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ ($errors->has('template_id'))?'has-error':'' }} ">--}}
                            {{--<label for="template_id">Template Category <label class="text-danger"> *</label></label>--}}
                            {{--{{Form::select('template_id',$templateRepo->getTemplateCategoryList->pluck('template_name','id'),Request::get('template_id'),array('class'=>'form-control','id'=>'template_id','placeholder'=>--}}
                            {{--'Select Template'))}}--}}
                            {{--<select name="template_id" id="template_id"--}}
                            {{--class="form-control">--}}
                            {{--<option value="0">Select Template Category</option>--}}
                            {{--{{ $templateRepo->getTemplateCategoryList($edits->id) }}--}}
                            {{--</select>--}}
                            {{--{!! $errors->first('template_id', '<span class="text-danger">:message</span>') !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="form-group{{ ($errors->has('related_institution_id'))?'has-error':'' }} ">
                                    <label for="related_institution_id">Related Institution <label class="text-danger">
                                            *</label></label>
                                    {{Form::select('related_institution_id',$institutions->pluck('institution_name','id'),Request::get('related_institution_id'),array('class'=>'form-control','id'=>'related_institution_id','placeholder'=>
                                   'Select Institution'))}}
                                    {!! $errors->first('related_institution_id', '<span class="text-danger">:message</span>') !!}
                                    <a href={{url('institution')}} target="_blank"><p class="help-text pull-right">Click
                                            here</a> to add new institution.</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-group{{ ($errors->has('folder_id'))?'has-error':'' }} ">
                                    <label for="folder_id">Select Folder <label class="text-danger">
                                            *</label></label>
                                    <select name="folder_id" id="folder_id" class="form-group" style="width: 100%;">
                                        <option>Select Folder Name</option>

                                    </select>
                                    <span class="help-block pull-right">
                                        <input type="checkbox" name="create_folder_check_box" value="1"
                                               id="create_folder_check_box" checked>
                                        Create New Folder</span>
                                    {!! $errors->first('folder_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                            </div>
                            <div class="form-group" id="create_folder">
                                <div class="col-md-12"
                                     style="background-color: #e9f5ff; padding: 15px; border-radius: 5px">

                                    <div class="col-md-6">
                                        <label for="folder_name">New Folder Name</label>
                                        {{Form::text('folder_name',null,array('class'=>'form-control','id'=>'folder_name','placeholder'=>
                             'Folder Name','list'=>'datalistItems','autocomplete'=>'off'))}}
                                        <datalist id="datalistItems">

                                        </datalist>
                                        {!! $errors->first('folder_name', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                    <div class="col-md-6">
                                        <label for="folder_institution_id">Institution <label
                                                    class="text-danger">
                                                *</label></label>
                                        {{Form::select('folder_institution_id',$institutions->pluck('institution_name','id'),$edits->related_institution_id,array('class'=>'form-control','id'=>'folder_institution_id','placeholder'=>
                                        'Select Institution', 'style'=>'width:100%','disabled'))}}
                                        {!! $errors->first('folder_institution_id', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <button type="button" id="create_folder_button" class="pull-right">Create Folder
                                        </button>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group {{ ($errors->has('tag_id'))?'has-error':'' }}">
                                <label for="tag_id">Document Tags</label>
                                <p class="help-block">Type tag name to search.</p>
                                {{Form::text('tag_id',null,array('class'=>'form-control','id'=>'my-text-input','placeholder'=>'Search tags here'))}}
                                {!! $errors->first('tag_id', '<span class="text-danger">:message</span>') !!}
                                {{--<a href={{url('configurations/tag')}} target="_blank"><p class="help-text pull-right">--}}
                                        {{--Click here</a> to add new document tag.</p>--}}
                                <span class="help-block pull-right">
                                        <input type="checkbox" name="create_tag_check_box" value="1"
                                               id="create_tag_check_box" checked>
                                        Create New Tag</span>

                            </div>
                            <br>
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
                            <div class="form-group row {{($errors->has('digitized_document_date'))?'has-error':'' }}">
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
                                    <label for="digitized_document_date"> Date <label class="text-danger">
                                            *</label></label>
                                    <p class="help-block">Choose document created date.</p>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('digitized_document_date',Request::get('digitized_document_date'),array('class'=>'form-control pull-right','id'=>'englishDate','placeholder'=>" Document Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                        {!! $errors->first('digitized_document_date', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>

                            <!-- /.form group -->

                            <!-- /.form group -->
                            <div class="form-group {{($errors->has('digitized_document_name'))?'has-error':'' }}">
                                <label for="digitized_document_name">Document Name</label>
                                <p class="help-block">Enter document name.</p>
                            {{Form::text('digitized_document_name',null,array('class'=>'form-control','id'=>'digitized_document_name','placeholder'=>'Subject to the letter','onkeyup'=>"sync(this)"))}}
                            {!! $errors->first('digitized_document_name', '<span class="text-danger">:message</span>') !!}
                            <!-- /.input group -->
                            </div>
                            <!-- /.form group -->


                            <!-- /.form group -->
                            <div class="form-group {{($errors->has('digitized_document_description'))?'has-error':'' }}">
                                <label for="digitized_document_description">Document Description</label>
                                <p class="help-block">Enter description of document (Optional).</p>
                            {{Form::textarea('digitized_document_description',null,array('class'=>'form-control','rows'=>2,'cols'=>200,'id'=>'digitized_document_description','placeholder'=>
                            'Description to document','onkeyup'=>"sync(this)"))}}
                            {!! $errors->first('digitized_document_description', '<span class="text-danger">:message</span>') !!}
                            <!-- /.input group -->
                            </div>
                            <!-- /.form group -->


                            <div class="form-group {{($errors->has('file_uploads'))?'has-error':'' }}">
                                <label for="file_uploads">File input<label class="text-danger"> *</label></label>
                                <input type="file" id="file_uploads" name="file_uploads[]" multiple>
                                {!! $errors->first('file_uploads', '<span class="text-danger">:message</span>') !!}
                                <p class="help-block">Choose document file to upload.Only jpg, pdf,zip, jpeg, png, xlsx,
                                    xls, csv, doc, docx, ppt, pptx,gif,rar files are supported.</p>

                            </div>

                            <label for="digitized_document_privacy">Document Privacy</label>
                            <div class="form-group">
                                <input type="radio" id="general" name="digitized_document_privacy"
                                       value="general" <?php if ($edits->digitized_document_privacy == 'General') echo 'checked=checked'?> >
                                General
                                &nbsp;&nbsp;
                                <input type="radio" id="departmental" name="digitized_document_privacy"
                                       value="departmental" <?php if ($edits->digitized_document_privacy == 'Departmental') echo 'checked=checked'?>>
                                Departmental &nbsp;&nbsp;
                                <input type="radio" id="confidential" name="digitized_document_privacy"
                                       value="confidential" <?php if ($edits->digitized_document_privacy == 'Confidential') echo 'checked=checked'?>>
                                Confidential &nbsp;&nbsp;
                            </div>

                            <div id="email-search">
                                <div class="form-group ">
                                <label for="confidential-email">Confidential Email <label class="text-danger"> *</label></label>
                                    {{Form::hidden('confidential_email',null,array('class'=>'form-control','id'=>'confidential-email','placeholder'=>
                                  'Add Email'))}}
                                </div>
                            </div>


                            <!-- /.form group -->

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
                                    <a href="{{url('documents/digitizedDocument')}}" class="btn btn-default bg-red">Cancel</a>

                                </div>
                                <!-- /.box-footer -->

                            </div>


                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">


                            <label for="editor1">Content</label>

                            @if($edits->digitized_document_path!=null)

                                <?php $images = json_decode($edits->digitized_document_path);
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
                                    <iframe height="1100px" class=""
                                            src="{{asset("storage/uploads/documents/digitizedDocuments/" . $edits->digitized_document_path)}}"
                                            style="min-height:250px; width: 100%" frameborder="0"></iframe>
                                @endif

                            @else

                                <textarea id="digitized_document_content" name="editor1" rows="5" cols="80"
                                          style="min-height: 200px">
                                          {{$edits->digitized_document_content}}
                             </textarea>
                            @endif
                            {{--{{Form::textarea('editor1',Request::get('digitized_document_content'),array('class'=>'form-control','id'=>'digitized_document_content','placeholder'=>--}}
                            {{--'Select Template Category to load document Content Here'))}}--}}
                            {{--{!! $errors->first('digitized_document_content', '<span class="text-danger">:message</span>') !!}--}}

                            <br>

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
    {{--create tag--}}

        @include('documents.createTag')




    <script>

        $('#reminderNepaliDate').nepaliDatePicker({
            npdMonth: true,
            npdYear: true
        });
    </script>
    <script>
        $('#generate').on('click', function () {
            var nepaliDate = $('#nepaliDate').val();
//               document.getElementById('englishDate').innerHTML = 'adf';
            if (nepaliDate) {
                $("#englishDate").load("/get-english-date" + '/' + nepaliDate, function (data) {
                    document.getElementById('englishDate').value = data;
                });
            } else {
                document.getElementById('englishDate').innerHTML = 'Enter the valid Date in Date of Birth (B.S.)';
            }
        });
    </script>
    <script>
        $('#generateReminderDate').on('click', function () {
            var nepaliDate = $('#reminderNepaliDate').val();
//               document.getElementById('englishDate').innerHTML = 'adf';
            if (nepaliDate) {
                $("#reminderDate").load("/get-english-date" + '/' + nepaliDate, function (data) {
                    document.getElementById('reminderDate').value = data;
                });
            } else {
                document.getElementById('reminderDate').innerHTML = 'Enter the valid Date in Date of Birth (B.S.)';
            }
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


            $('#template_id').on('change', function () {
                id = $('#template_id').val();
                $("#content").load("getContent/" + id, function () {
                    var content = $("#content").val();

                    if (CKEDITOR.instances['content']) {
//
                        CKEDITOR.instances.content.setData(content);
                    }
                    CKEDITOR.replace('content', {

                        height: '452px'
                    });

                });


//
            });

            $("#email_options").hide();
            $('#send_email').on('click', function () {
                if ($('#send_email').is(":checked")) {
                    $("#email_options").show();

                } else
                    $("#email_options").hide();

            });


//            $('#institution_id').on('change', function () {
//                id = $('#institution_id').val();
//                $("#receiver_email").load("getInstitutionEmail/" + id, function () {
//
//
//                });
//
//
////
//            });
            $('#institution_id').on('change', function () {
                id = $('#institution_id').val();
                $.ajax({
                    type: "get",
                    url: "getInstitutionEmail/" + id,
                    dataType: "text",
                    success: function (data) {
                        //data will hold an object with your response data, no need to parse
                        $("#receiver_email").val(data);

                    }
                });
            });


            $('#documentDate').datepicker({
                autoclose: true
            })
            $('#reminderDate').datepicker({
                autoclose: true
            })


        });


    </script>

    <script type="text/javascript">

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


        $(document).ready(function () {
            $('.token-input-list-facebook').remove();
            $("#my-text-input").tokenInput("{{url('configurations/tag/search')}}", {
                theme: "facebook",
                noResultsText: 'Tags not Found',
                preventDuplicates: true,
                tokenValue: "id",
                propertyToSearch: "tag_name",
                prePopulate:<?php echo $tagIds ?>

            });

            $("#confidential-email").tokenInput("{{url('user/searchList')}}", {
                theme: "facebook",
                noResultsText: 'Tags not Found',
                preventDuplicates: true,
                tokenValue: "id",
                propertyToSearch: "name",
                <?php if($users != ''){?>
                prePopulate:<?php echo $users ?>
                <?php } ?>

            });
        });


    </script>
    <script type="text/javascript">
        $('#closeErrorBar').click(function () {
            $('.errorBar').hide();

        });
    </script>
@endsection