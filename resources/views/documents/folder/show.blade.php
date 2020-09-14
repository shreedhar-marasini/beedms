@extends('master.app')
@section('content')
    <style>

    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if($folder!=null)
                    {{ucfirst($folder->name)}}
                @else
                    Untitled Folder
                @endif
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="{{url('documents/folder')}}"> Folder</a></li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            @include('message.flash')


            <div class="box box-primary">

                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-centered">
                                Other Existing Folders
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

                                <div class="owl-carousel owl-theme">
                                    <div class="item">

                                        <div class="block img-responsive">
                                            <a href="{{url('documents/folder')}}">
                                                <div class="thumbnail" style="border: 0px">
                                                    <div class="text-center">
                                                                    <span class="fa fa-folder-open-o fa-4x"
                                                                          style="color: orange;"></span>

                                                        <div class="caption">
                                                            <p>All Folders</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>

                                    </div>

                                    @foreach($folders as $key=>$folder)
                                        @if($folder->count()!=0)
                                            @foreach($folder as $fol)
                                                <?php $first_key = key($folders);?>
                                                <div class="item droptarget" ondrop="drop(event)"
                                                     ondragover="allowDrop(event)">

                                                    <div class="block img-responsive" id="{{$fol->id}}">
                                                        <a href="{{url('documents/folder/'.$fol->id)}}">
                                                            <div class="thumbnail" style="border: 0px">
                                                                <div class="text-center">
                                                                    <span class="fa fa-folder fa-4x"
                                                                          style="color: orange;"
                                                                          id="{{$fol->id}}"></span>

                                                                    <div class="caption">
                                                                        <p>{{$fol->name}}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif
                                        <?php $key++;?>
                                    @endforeach

                                </div>
                                <div id="calendar"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box box-default">

                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 col-xs-12">
                                <hr>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#outgoing" data-toggle="tab">Outgoing Documents</a>
                                        </li>
                                        <li><a href="#incoming" data-toggle="tab">Incoming Documents</a></li>
                                        <li><a href="#digitized" data-toggle="tab">Digitized Documents</a></li>
                                    </ul>
                                    <div class="tab-content" style="min-height: 500px">

                                        @include('documents.search.outgoing')
                                        @include('documents.search.incoming')
                                        @include('documents.search.digitized')


                                    </div>
                                </div>
                            </div>
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







    <!-- /.content-wrapper -->
@endsection

@section('js')
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
    <script>
        function dragStart(event) {
            var id = $(this).attr('id');
            event.dataTransfer.setData("Text", event.target.id);
            document.getElementById("demo").innerHTML = "Started to drag the p element";
        }

        function allowDrop(event) {
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            var folder_id = event.target.id;
            if (folder_id != "") {
                if (confirm('Are you sure you want to move this document in this folder?')) {
                    var data = event.dataTransfer.getData("Text");
                }
            }
            // data is the param thrown from drag its <tr> id for this
            if (data != null) {
                var outgoing = /outgoing/;
                var incoming = /incoming/;
                var digitized = /digitized/;

//returns true or false...
                var outgoingExists = outgoing.test(data);
                var incomingExists = incoming.test(data);
                var digitizedExists = digitized.test(data);

                if (outgoingExists) {
                    var document_id = data.match(/\d+/);
                    var docType = "outgoing";

                } else if (incomingExists) {
                    var document_id = data.match(/\d+/);
                    var docType = "incoming";

                } else if (digitizedExists) {
                    var document_id = data.match(/\d+/);
                    var docType = "digitized";
                } else {
                    var document_id = null;
                    var docType = null;
                }

                if (folder_id != null) {
                    $.ajax({
                        type: "POST",
                        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{url('documents/folderchange')}}",
                        data: "docType=" + docType + "&document_id=" + document_id + "&folder_id=" + folder_id,
                        success: function (data) {
                            console.log(data);
                            if (data) {
                                if (confirm('Document has been moved. Please reload the page.')) {
                                    location.reload();

                                }

                            }
                        }
                    });
                }
            }
        }
    </script>




    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoHeight: true,
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 6
                },
                1000: {
                    items: 8
                }
            }
        })
    </script>
    <script>

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