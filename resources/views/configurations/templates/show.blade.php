@extends('master.app')
@section('content')
<style>
.A4page{
    font-size: 13px;
  overflow-y:auto;
}
</style>


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


            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$template->document_categories->category_name}}</h3>
                    <a href="{{url('configurations/template')}}" class="pull-right" data-toggle="tooltip"
                       title="Go Back"><i
                                class="fa fa-arrow-circle-left fa-2x"></i></a>

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">

                            <div class="A4page">
                                
                                {!! $template->template_content !!}


                            </div>


                        </div>


                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection