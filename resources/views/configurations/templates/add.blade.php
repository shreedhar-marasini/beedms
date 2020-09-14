@extends('master.app')
@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Configuration
                <small>Template</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Configuration</li>
                <li><a href="{{url('configurations/template')}}">Template</a></li>
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
                    <h3 class="box-title">Add</h3>
                    <a href="{{url('configurations/template')}}" class="pull-right" data-toggle="tooltip"
                       title="Go Back"><i
                                class="fa fa-arrow-circle-left fa-2x"></i></a>

                </div>
                <div class="box-body">
                    <div class="row">

                        <form action="{{url('configurations/template')}}" method="POST">
                            {{csrf_field()}}


                            <div class="col-md-4">
                                <div class="form-group  {{ ($errors->has('document_category_id'))?'has-error':'' }} ">
                                    <label>Template Category <label class="text-danger"> *</label></label>
                                    <select name="document_category_id" id="document_category_id" class="form-control">
                                        <option value="0">Select Template Category</option>
                                        {{ $documentCategoryRepo->getDocumentCategoryList(old('document_category_id')) }}
                                    </select>
                                    {!! $errors->first('document_category_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group col-md-4 {{ ($errors->has('template_name'))?'has-error':'' }}">
                                <label for="template_name">Template Name <label class="text-danger">
                                        *</label></label>
                                <input type="text" class="form-control" id="template_name" name="template_name"
                                       placeholder="Enter Template Name" value="{{old('template_name')}}">
                                {!! $errors->first('template_name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ ($errors->has('template_short_name'))?'has-error':'' }}">
                                <label for="template_short_name">Template Short Name <label class="text-danger">
                                        *</label></label>
                                <input type="text" class="form-control" id="template_short_name"
                                       name="template_short_name"
                                       placeholder="Enter Template Short Name" value="{{old('template_short_name')}}">
                                {!! $errors->first('template_short_name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ ($errors->has('template_subject'))?'has-error':'' }}">
                                <label for="template_subject">Template Subject <label class="text-danger">
                                        *</label></label>
                                <input type="text" class="form-control" id="template_subject" name="template_subject"
                                       placeholder="Enter Template Subject" value="{{old('template_subject')}}">
                                {!! $errors->first('template_subject', '<span class="text-danger">:message</span>') !!}
                            </div>

                                <div class="col-md-9">
                                <div class="form-group {{ ($errors->has('editor1'))?'has-error':'' }}">
                                    <label for="template_content">Template Content <label class="text-danger">
                                            *</label></label>
                                    <textarea id="template_content" name="editor1" rows="10" cols="80"
                                              style="min-height: 200px"
                                              placeholder="Enter Template Content">
{{old('editor1')}}
                                        </textarea>
                                    {!! $errors->first('editor1', '<span class="text-danger">:message</span>') !!}
                                </div>
                                    </div>

                            <div class="col-md-3">
                                <div style="height:30px"></div>
                                <div class="callout callout-info">
                                    <h4>Supported Variables</h4>

                                    <p style="font-size: 11px">__TODAY_DATE__<br>
                                        __SIGNATURE_CONTENT__<br>
                                        __SCANNED_SIGNATURE__<br>
                                        __ISSUE_DATE__<br>
                                        __ISSUE_NUMBER__<br>
                                        __DEPARTMENT_NAME__<br>
                                        __RECEIVER_INSTITUTION__<br>
                                        __RECEIVER_ADDRESS__<br>
                                        __RECEIVER_INSTITUTION_DEPARTMENT__<br>
                                        __DOCUMENT_SUBJECT__<br>
                                        __DOCUMENT_DATE__<br>
                                        __SCANNED_COMPANY_STAMP__<br>
                                    </p>

                                </div>

                            </div>
                                <div class="form-group col-md-6 {{ ($errors->has('include_header'))?'has-error':'' }}">
                                    <label for="include_header">Include Header
                                        <label class="text-danger"> *</label>
                                    </label><br>
                                    {{--<label for="item_type" class="control-label align">Item Type<label class="text-danger"> *</label></label><br>--}}
                                    {{Form::radio('include_header', 'yes','true',['class'=>'flat-red'])}}&nbsp;&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;
                                    {{Form::radio('include_header', 'no',null,['class'=>'flat-red'])}}&nbsp;&nbsp;No
                                    {!! $errors->first('include_header', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('include_footer'))?'has-error':'' }}">
                                    <label for="include_footer">Include Footer
                                        <label class="text-danger"> *</label>
                                    </label><br>
                                    {{--<label for="item_type" class="control-label align">Item Type<label class="text-danger"> *</label></label><br>--}}
                                    {{Form::radio('include_footer', 'yes','true',['class'=>'flat-red'])}}&nbsp;&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;
                                    {{Form::radio('include_footer', 'no',null,['class'=>'flat-red'])}}&nbsp;&nbsp;No
                                    {!! $errors->first('include_footer', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="box-footer col-md-12">

                                    <button type="submit" class="btn btn-primary" id="save" name="save"
                                            value="save">Save
                                    </button>
                                    <button type="submit" class="btn btn-default bg-green" id="saveAndAddNew"
                                            name="saveAndAddNew" value="saveAndAddNew">Save & Add New
                                    </button>
                                    <a href="{{url('configurations/template')}}" class="btn btn-default bg-red"
                                       id="cancel" name="cancel" value="cancel">Cancel</a>
                                </div>
                                <!-- /.box-footer -->



                        </form>
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
        $('#closeErrorBar').click(function () {
            $('.errorBar').hide();

        });
    </script>
@stop