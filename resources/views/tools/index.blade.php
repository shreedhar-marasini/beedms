@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Tools</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('eng.home')}}</a></li>
                <li class="active">Tools</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('message.flash')
        <div class="box box-default">
            <div class="box-header with-border">Tools</div>

            <div class="box-body pad">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Import Institution</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p>To download sample format<a href="{{asset("storage/sampleExcel/institution.xlsx")}}"> Click here</a></p>
                                <div class="col-md-6">
                                    {!! Form::open(['method'=>'post','url'=>'tools/institutionStore','enctype'=>'multipart/form-data','files'=>true]) !!}

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        {{--<label for="institution">Import Institution</label>--}}
                                        <p class="help-block">Only .xlsx is supported/Check Sample</p>
                                        <input type="file" id="institution" name="institution">
                                    </div>
                                
                                    <button type="submit" class="btn btn-default" id="upload" name="upload" value="upload">
                                        Import
                                    </button>
                                  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Import NameCard</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p>To download sample format<a href="{{asset("storage/sampleExcel/namecard.xlsx")}}"> Click here</a></p>
                                <div class="col-md-8">
                                    {!! Form::open(['method'=>'post','url'=>'tools/namecardStore','enctype'=>'multipart/form-data','files'=>true]) !!}

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <select name="institution_id" id="institution_id" class="form-control">
                                            <option value="">Select Institution</option>
                                            @foreach($institutionList as $list)
                                                <option value="{{$list->id}}">{{$list->institution_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        {{--<label for="namecard">Import NameCard</label>--}}
                                        <p class="help-block">Only .xlsx is supported/Check Sample</p>
                                        <input type="file" id="namecard" name="namecard">
                                    </div>
                                    <p class="help-block"><i class="fa fa-exclamation-triangle" style="color: red" aria-hidden="true"></i> Please select institution to import name cards</p>
                                    <button type="submit" class="btn btn-default" id="namecardUpload" name="upload" value="upload">
                                        Import
                                    </button>
                                   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Import Department</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p>To download sample format<a href="{{asset("storage/sampleExcel/department.xlsx")}}"> Click here</a></p>
                                <div class="col-md-6">
                                    {!! Form::open(['method'=>'post','url'=>'tools/departmentStore','enctype'=>'multipart/form-data','files'=>true]) !!}

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        {{--<label for="department">Import Department</label>--}}
                                        <p class="help-block">Only .xlsx is supported/Check Sample</p>
                                        <input type="file" id="department" name="department">
                                    </div>
                                    <button type="submit" class="btn btn-default" id="upload" name="upload" value="upload">
                                        Import
                                    </button>
                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Import Designation</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p>To download sample format<a href="{{asset("storage/sampleExcel/designation.xlsx")}}"> Click here</a></p>
                                <div class="col-md-6">
                                    {!! Form::open(['method'=>'post','url'=>'tools/designationStore','enctype'=>'multipart/form-data','files'=>true]) !!}

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        {{--<label for="designation">Import Designation</label>--}}
                                        <p class="help-block">Only .xlsx is supported/Check Sample</p>
                                        <input type="file" id="designation" name="designation">
                                    </div>
                                    <button type="submit" class="btn btn-default" id="upload" name="upload" value="upload">
                                        Import
                                    </button>
                                    <!-- <a href="{{url('/dashboard')}}" onclick="return confirm('Do you want to cancel?');"
                                       class="btn btn-default bg-red">Cancel</a> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#namecardUpload').prop('disabled',true);

            $('#institution_id').change(function () {
                var institution = $('#institution_id').val();
                if(institution != '')
                {
//                    alert(institution);
                    $('#namecardUpload').prop('disabled',false);
                }
                else {
                    $('#namecardUpload').prop('disabled',true);
                }
            });

            $('INPUT[type="file"]').change(function () {
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'xlsx':
                    case 'xml':
                    case 'xls':
                    case 'csv':
                        $('#uploadButton').attr('disabled', false);
                        break;
                    default:
                        alert('This is not an allowed file type.');
                        this.value = '';
                }
            });
        });
    </script>
    @endsection