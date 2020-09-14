@extends('master.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                Dashboard

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('documents/incomingDocument')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-arrow-down"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Incoming</span>
                                <span class="info-box-number">{{count($totalIncoming)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('documents/outgoingDocument')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-arrow-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Outgoing</span>
                                <span class="info-box-number">{{count($totalOutgoing)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('documents/outgoingDocument')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-location-arrow"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Issued</span>
                                <span class="info-box-number">{{count($totalIssued)}}</span>
                            </div>
                            <!-- /.info-box-content -->

                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>


                <!-- /.col -->
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('documents/digitizedDocument')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange"><i class="fa fa-file-text"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Documents</span>
                                <span class="info-box-number">{{count($totalDigitize)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('institution')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-hourglass-half"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Institution</span>
                                <span class="info-box-number">{{count($totalInstitution)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-md-4 col-lg-2 col-sm-4 col-xs-12">
                    <a href="{{url('user')}}" target="_blank" style="color:Black">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number">{{count($totalUser)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php $userWidgets = \App\Models\UserWidget::
            join('widgets', 'widgets.id', 'user_widget.widget_id')
                ->where('user_id', Auth::user()->id)
                ->orderBy('widgets.widget_key', 'asc')
                ->get();

            ?>
            <div class="row">
                @foreach($userWidgets as $userWidget)
                    @if($userWidget->widget_id==3)
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Document Information</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                        <a href="{{url('user-widget/status',$userWidget->widget_id)}}" class="btn btn-box-tool" ><i
                                                    class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div id="document_status"></div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Document Accessibility</strong>
                                            </p>

                                            <div class="progress-group">
                                                <span class="progress-text">Incoming Document</span>
                                                <?php $totalDocumentInSystem = \App\Models\IncomingDocument::all();
                                                if (count($totalIncomingDocument) > 0) {
                                                    $width = (count($totalIncomingDocument) / count($totalDocumentInSystem)) * 100;
                                                } else {
                                                    $width = 100;
                                                }
                                                ?>
                                                <span class="progress-number"><b>{{count($totalIncomingDocument)}}</b>/{{count($totalDocumentInSystem)}}</span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-aqua"
                                                         style="width: <?php echo $width;?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Outgoing Document</span>
                                                <?php $totalDocumentInSystem = \App\Models\OutgoingDocument::all();
                                                if (count($totalOutgoingDocument) > 0) {
                                                    $width = (count($totalOutgoingDocument) / count($totalDocumentInSystem)) * 100;
                                                } else {
                                                    $width = 100;
                                                }
                                                ?>

                                                <span class="progress-number"><b>{{count($totalOutgoingDocument)}}</b>/{{count($totalDocumentInSystem)}}</span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red"
                                                         style="width: <?php echo $width;?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Digitized Document</span>
                                                <?php $totalDocumentInSystem = \App\Models\DigitizedDocument::all();
                                                if (count($totalDigitizedDocument) > 0) {
                                                    $width = (count($totalDigitizedDocument) / count($totalDocumentInSystem)) * 100;
                                                } else {
                                                    $width = 100;
                                                }
                                                ?>
                                                <span class="progress-number"><b>{{count($totalDigitizedDocument)}}</b>/{{count($totalDocumentInSystem)}}</span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-green"
                                                         style="width: <?php echo $width;?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Issued Document</span>
                                                <?php $totalDocumentInSystem = \App\Models\OutgoingDocument::where('outgoing_issue_status', '=', 'issued')->orwhere('outgoing_issue_status', '=', 'registered')->get();
                                                if (count($totalDocumentInSystem) != null && count($totalIssuedDocument) != null) {
                                                    $width = (count($totalIssuedDocument) / count($totalDocumentInSystem)) * 100;
                                                } else {
                                                    $width = 0;
                                                }?>
                                                <span class="progress-number"><b>{{count($totalIssuedDocument)}}</b>/{{count($totalDocumentInSystem)}}</span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow"
                                                         style="width: <?php echo $width; ?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                    @elseif($userWidget->widget_id==2)
                    <!-- Left col -->
                        <div class="col-md-8">
                            <!-- /.row -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Documents</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>

                                        <a href="{{url('user-widget/status',$userWidget->widget_id)}}"  class="btn btn-box-tool" ><i
                                                    class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Incoming Documents</a>
                                            </li>
                                            <li><a href="#tab_2" data-toggle="tab">Issued Documents</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Outgoing Document (Draft)</a></li>
                                            <li><a href="#tab_4" data-toggle="tab">Digitalized Documents</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        @include('incomingDocumentTab')
                                        <!-- /.tab-pane -->
                                        @include('issuedDocumentTab')
                                        <!-- /.tab-pane -->
                                        @include('outgoingDraftDocumentTab')
                                        <!-- /.tab-pane -->
                                        @include('digitizedDocumentTab')
                                        <!-- /.tab-pane -->


                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>
                            </div>


                        </div>
                        <!-- /.row -->
                    @elseif($userWidget->widget_id==4)
                        <div class="col-md-8">

                            @include('myActivity')
                        </div>
                    @elseif($userWidget->widget_id==1)
                        @if(count($calender->key_value)==1)
                            <div class="col-md-8">

                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Calender</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>

                                            <a href="{{url('user-widget/status',$userWidget->widget_id)}}" class="btn btn-box-tool" ><i
                                                        class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-md-12 embed-responsive embed-responsive-16by9 small0"
                                                 style="margin: 5px 5px 5px 5px !important;">
                                                <?php
                                                echo $calender->key_value;
                                                ?>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    <!-- /.col -->

                    @elseif($userWidget->widget_id==8)
                        <div class="col-md-4">

                            @include('onlineUser')
                        </div>
                    @elseif($userWidget->widget_id==6)
                        <div class="col-md-4">

                            @include('recentlyLoggedInUsers')
                        </div>

                    @elseif($userWidget->widget_id==9)
                        <div class="col-md-4">

                            <!-- Info Boxes Style 2 -->
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="ion ion-android-arrow-down"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Incoming Document</span>
                                    <span class="info-box-number">{{count($totalIncomingDocument)}}</span>

                                    <div class="progress">
                                        <?php $totalDocumentInSystem = \App\Models\IncomingDocument::all();
                                        if (count($totalIncomingDocument) > 0) {
                                            $width = (count($totalIncomingDocument) / count($totalDocumentInSystem)) * 100;
                                        } else {
                                            $width = 100;
                                        }
                                        ?>
                                        <div class="progress-bar" style="width: <?php echo $width;?>%"></div>
                                    </div>
                                    <span class="progress-description">
                    {{$width}}% of Incoming Document are accessible
                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="ion ion-android-arrow-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Outgoing Document</span>
                                    <span class="info-box-number">{{count($totalOutgoingDocument)}}</span>

                                    <div class="progress">
                                        <?php $totalDocumentInSystem = \App\Models\OutgoingDocument::all();
                                        if (count($totalOutgoingDocument) > 0) {
                                            $width = (count($totalOutgoingDocument) / count($totalDocumentInSystem)) * 100;
                                        } else {
                                            $width = 100;
                                        }
                                        ?>
                                        <div class="progress-bar" style="width: <?php echo $width;?>%"></div>
                                    </div>
                                    <span class="progress-description">
                   {{$width}}% of Outgoing Document are accessible
                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="ion ion-calculator"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Digitized Document</span>
                                    <span class="info-box-number">{{count($totalDigitizedDocument)}}</span>

                                    <div class="progress">
                                        <?php $totalDocumentInSystem = \App\Models\DigitizedDocument::all();
                                        if (count($totalDigitizedDocument) > 0) {
                                            $width = (count($totalDigitizedDocument) / count($totalDocumentInSystem)) * 100;
                                        } else {
                                            $width = 100;
                                        }
                                        ?>
                                        <div class="progress-bar" style="width: <?php echo $width;?>%"></div>
                                    </div>
                                    <span class="progress-description">
                    {{$width}}% of Digitized Document are accessible
                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>
                    @elseif($userWidget->widget_id==7)

                        @if(count($documentComments)>0)
                            <div class="col-md-4">

                                @include('documentComment')
                            </div>
                        @endif
                    @elseif($userWidget->widget_id==5)
                        <div class="col-md-4">

                            @include('recentlyAddedDocuments')
                        </div>
                        <!-- /.box -->
                    @endif

                @endforeach
            </div>

            <!-- /.col -->

            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection

@section('js')
    <script>
        Highcharts.chart('document_status', {

            title: {
                text: ''
            },

            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    @for($i=11;$i>=0;$i--)
                        ' {{date('M-y',$monthList[$i])}}',
                    @endfor
                ],
            },


            yAxis: {
                title: {
                    text: 'Number of Letters'
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            },

            plotOptions: {
                series: {
                    pointStart: 0
                }
            },

            series: [{
                name: 'Incoming Document',
                data: [
                    @for($i=11;$i>=0;$i--)
                    {{$incomingGraph[$i]}},
                    @endfor
                ],

            }, {
                name: 'OutgoingDocument',
                data: [
                    @for($i=11;$i>=0;$i--)
                    {{$outgoingGraph[$i]}},
                    @endfor
                ],

            }, {
                name: 'Digitized Document',
                data: [
                    @for($i=11;$i>=0;$i--)
                    {{$digitizedGraph[$i]}},
                    @endfor
                ],

            },
                {
                    name: 'Issued Document',
                    data: [
                        @for($i=11;$i>=0;$i--)
                        {{$issueDocumentGraph[$i]}},
                        @endfor
                    ],

                }]

        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {
//get issue modal
//            $(document).on("click", ".detail", function () {
//                var id = $(this).data('id');
//                $("#issue"+id).modal('show');
//
////
//            });
            //get register modal
            $(document).on("click", ".getRegisterModal", function () {
                var id = $(this).data('id');
                $('#document_id').val(id);
                $("#register").modal('show');

//
            });
//            to issue letter

            $('.clickTest').click(function () {
                var issue_id = $(this).val();


                if (confirm('This Document cannot edit after issue. Are you Sure you want to issue this document?')) {
                    $.ajax({
                        type: "POST",
                        url: "/documents/outgoingDocument/issue",
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
                    url: "/documents/outgoingDocument/register",
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
    <script>
        function updateCurrentActivity() {
            //fetch new data using AJAX and update tables
        }

        setInterval(updateCurrentActivity, 5000);
    </script>

@endsection
