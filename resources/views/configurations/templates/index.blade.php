@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Configuration
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Documents</li>
                <li class="active">Incoming Documents</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('message.flash')
            @if (count($errors)!=null)

                <div class="errorBar">
                    <a class="pull-right" href="#" data-placement="left" title="" style="color: rgb(255, 255, 255); font-size: 20px;"
                       id="closeErrorBar">×</a>
                    <a href="" style="color: rgba(255, 255, 255, 0.901961); display: inline-block; margin-right: 10px; text-decoration: none;">
                        Please Input all the required fields.</a>

                </div>

            @endif
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Templates</h3>
                    <?php

                    $permission = helperPermissionLink('template/create', 'template');

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];
                    ?>
                </div>
                <div class="box-body">
                    @if(count($templates)>0)
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Template Category</th>
                                <th>Template Name</th>
                                <th>Template Short Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                @foreach($templates as $key=>$template)
                                    <th scope=row>{{++$key}}</th>
                                <td>
                                    {{$template->category_name}}
                                </td>

                                           <td> {{$template->template_name}}</td>

                                    <td>{{$template->template_short_name}}

                                    </td>
                                    <td class="text-right">

                                        <a href="{{url('/configurations/template/'.$template->id)}}" class="text-success actionIcon" data-toggle="tooltip"
                                           data-placement="top" title="View">
                                            <i class="fa fa-binoculars"></i>
                                        </a>&nbsp;
                                       
                                        @if($allowEdit)
                                       
                                        <a href="{{url('/configurations/template/'.$template->id.'/edit')}}" class="text-info actionIcon" data-toggle="tooltip"
                                           data-placement="top" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @endif
                
                                     
                                        @if($allowDelete)
                                       

                                        <?php 
                                            $id = $template->id;
                                        $useTemplate = App\Models\OutgoingDocument::where('template_id', $id)->get();
                                                  $digitizeduseTemplate=App\Models\DigitizedDocument::where('template_id',$id)->get();
                                                        ?>
                                    @if (count($useTemplate) > 0 ||  count($digitizeduseTemplate)> 0) 
                                        {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['template.destroy',
                                                                        $template->id]]) !!}

                                        <button type="submit" class="link text-info actionIcon deleteButton"
                                                data-toggle="tooltip"
                                                data-placement="top" title="Delete"
                                                onclick="javascript:return confirm('Are you sure you want to delete?'); "hidden>
                                            <i class="fa fa-trash-o"></i>
                                        </button>

                                    {!! Form::close() !!}
                                    @else
                                    {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['template.destroy',
                                                                        $template->id]]) !!}

                                        <button type="submit" class="link text-info actionIcon deleteButton"
                                                data-toggle="tooltip"
                                                data-placement="top" title="Delete"
                                                onclick="javascript:return confirm('Are you sure you want to delete?');"  >
                                            <i class="fa fa-trash-o"></i>
                                        </button>

                                    {!! Form::close() !!}
                                    @endif
                                       @endif
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>

                    @else
                        <div class="col-md-12">
                            <label class="form-control ">No records found</label>
                        </div>
                    @endif

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
        $('#closeErrorBar').click(function(){
            $('.errorBar').hide();

        });
    </script>
@stop