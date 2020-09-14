@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Folders
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Documents</a></li>
                <li class="active">Folder</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--                <div class="callout callout-info">-->
            <!---->
            <!--                </div>-->
            @include('message.flash')

            <div class="droptarget drop" ondrop="drop(event)"
                 ondragover="allowDrop(event)">

                <i class="fa fa-trash-o fa-2x" id="deleteBtn" ></i>
               
            </div>
           
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>

                    <a href="#" class="pull-right boxTopButton" id="add" title="Add New Folder"
                       data-toggle="modal" data-target="#myModal"><i
                                class="fa fa-plus-circle fa-2x"></i></a>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                    <h4 class="modal-title">Create New Folder</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="folder_name">Folder</label>
                                    {{Form::text('folder_name',null,array('class'=>'form-control','id'=>'folder_name','placeholder'=>
                         'Folder Name','list'=>'datalistItems','autocomplete'=>'off'))}}
                                    <datalist id="datalistItems">
                                    </datalist>
                                    {!! $errors->first('folder_name', '<span class="text-danger">:message</span>') !!}
                                    <label for="folder_institution_id">Institution <label
                                                class="text-danger">
                                            *</label></label>
                                    {{Form::select('folder_institution_id',$institutions->pluck('institution_name','id'),Request::get('folder_institution_id'),array('class'=>'form-control','id'=>'folder_institution_id','placeholder'=>
                                    'Select Institution', 'style'=>'width:100%'))}}
                                    {!! $errors->first('folder_institution_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="create_folder_button"
                                            class="pull-right btn btn-primary">Create Folder
                                    </button> &nbsp;
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 topFilter">
                                <form class="form-inline">
                                    {!! Form::text('name',Request::get('name'),array('class'=>'form-control filterForm','placeholder'=>'Folder Name')) !!}
                                    {{Form::select('institution_id',$institutions->pluck('institution_name','id'),Request::get('institution_id'),array('class'=>'form-control','id'=>'institution_id','placeholder'=> 'Select Institution'))}}
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filter
                                    </button>
                                    <a href="{{url('documents/folder')}}" class="btn btn-warning"><i
                                                class="fa fa-refresh"></i> Refresh
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    @foreach($folders as $key=>$folder)
                        @if($folder->count()!=0)
                            <span class="label label-primary text-12">{{$key++}}</span>

                            <hr style="margin-top: 0px">
                            <div class="row">
                                @foreach($folder as $fol)
                                    <div ondragstart="dragStart(event)" draggable="true" id="{{$fol->id}}">
                                        <div class="col-md-1">
                                            <i class="fa fa-edit pull-right edit-folder"
                                               id="edit-folder{{$fol->id}}"></i>
                                            <div class="thumbnail" style="border: 0px; height: 180px">
                                                <div class="text-center">
                                                    <a href="{{url('documents/folder/'.$fol->id)}}" draggable="false">

                                                        <span class="fa fa-folder fa-5x" style="color: orange;"></span>
                                                        <div class="caption" id="folder-caption{{$fol->id}}">
                                                            <span id="text-folder-name{{$fol->id}}">{{$fol->name}}</span>
                                                        </div>
                                                    </a>
                                                    <div class="caption" id="folder-caption{{$fol->id}}">
                                                        <input type="hidden" id="folder_institution_id{{$fol->id}}"
                                                               value="{{$fol->institution_id}}">
                                                        <textarea class="form-control" value="{{$fol->name}}"
                                                                  id="edit-folder-name{{$fol->id}}"
                                                                  style="display: none">{{$fol->name}}</textarea>
                                                        <span class="text-danger"
                                                              id="error-message-display{{$fol->id}}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="col-md-12"></div>
                        @endif

                    @endforeach
                    <span class="label label-primary text-12">Untitled Folder</span>

                    <hr style="margin-top: 0px">
                    <div class="row">


                        <a href="{{url('documents/folder/0')}}">
                            <div class="col-md-1">
                                <div class="thumbnail" style="border: 0px">
                                    <div class="text-center">
                                        <span class="fa fa-folder fa-5x" style="color: orange;"></span>
                                        <div class="caption">
                                            <p>Untitled Folder</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>

                    </div>
                    <br>
                    <div class="col-md-12"></div>
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
        function dragStart(event) {
            var id = $(this).attr('id');
            event.dataTransfer.setData("Text", event.target.id);
            // document.getElementById("demo").innerHTML = "Started to drag the p element";
        }

        function allowDrop(event) {
            event.target.style.padding = '25px';
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            var folder_id = event.target.id;

            if (folder_id != "") {
                if (confirm('Are you sure you want to delete this folder?')) {
                    var data = event.dataTransfer.getData("Text");
                }
            }
            if (data > 0) {
                $.ajax({
                    type: "get",
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{url('documents/folder-delete')}}",
                    data: "id=" + data,
                    success: function (data) {
                        console.log(data);
                        if (data) {
                            if (data == "document_exists") {
                                confirm('Folder cannot be deleted. Please delete all the documents in this folder.')
                                event.target.style.padding = '15px';

                            } else if (data == "folder_deleted") {
                                if (confirm('Folder Has been deleted. Please reload the page.')) {
                                    location.reload();

                                }
                            } else {
                                confirm('Sorry you do not have permission to delete this folder.')


                            }

                        }
                    }
                });
            }

        }
    </script>

    <script>
        $('.edit-folder').on('click', function () {
            var id = $(this).attr('id');

            var folder_id = id.match(/\d+/);
            if (folder_id != "") {
                $('#text-folder-name' + folder_id).hide();
                $('#edit-folder-name' + folder_id).show();
                $(document).on('keypress', function (e) {
                    if (e.which == 13) {
                        if (confirm('Do you really want to change the folder Name??')) {
                            var name = $('#edit-folder-name' + folder_id).val();

                            var institution = $("#folder_institution_id" + folder_id).val();
                            $.ajax({
                                type: "PUT",
                                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                                url: "{{url('folder')}}" + '/' + folder_id,
                                data: "name=" + name + "&institution_id=" + institution,
                                success: function (data) {
                                    if (data) {
                                        old_folder_id = folder_id;
                                        folder_id = data['id'];
                                        institution_id = data['institution_id'];
                                        if (data == 'folder_exists' || data == 'folder_doesnot_exists') {
                                            $('#error-message-display' + old_folder_id).html(data);
                                        } else if (confirm('Folder successfully updated.')) {

                                            location.reload();
                                        }


                                    }
                                }
                            });

                        }
                    }
                });
            }

        })
    </script>
    <script>
        $('#document_category_id').select2(
            {
                placeholder: "Category",
                allowClear: true,
            }
        );

        $('#related_institution_id').select2(
            {
                placeholder: "Institution",
                allowClear: true,
            }
        );
        $('#department_id').select2(
            {
                placeholder: "Department",
                allowClear: true,
            }
        );
    </script>
    <script>
        $('#folder_name').on('keyup', function () {

            var institution_id = $('#related_institution_id').val();
            folder_name = $('#folder_name').val();
            // $('#folder_id').remove();
            $('#datalistItems').load('/get-folder-name/' + institution_id + '/' + folder_name);

        });
        $("#create_folder_button").click(function () {
            var name = $("#folder_name").val();

            var institution = $("#folder_institution_id").val();
            $.ajax({
                type: "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{url('folder')}}",
                data: "name=" + name + "&institution_id=" + institution,
                success: function (data) {
                    if (data) {

                        folder_id = data['id'];
                        institution_id = data['institution_id'];
                        console.log(data);
                        $('#folder_id').load('/get-folder-list/' + folder_id + '/' + institution_id);
                        if (confirm('Folder-' + name + " successfully created.")) {
                            location.reload();
                        }

                    }
                }
            });


        });
    </script>

@endsection