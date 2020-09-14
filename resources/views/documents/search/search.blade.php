@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Document Search
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Document Search</li>
            </ol>
        </section>




        <!-- Main content -->
        <section class="content">

            @include('message.flash')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#outgoing" data-toggle="tab">Outgoing Documents</a></li>
                    <li><a href="#incoming" data-toggle="tab">Incoming Documents</a></li>
                    <li><a href="#digitized" data-toggle="tab">Digitized Documents</a></li>
                </ul>
                <div class="tab-content" style="min-height: 500px">

@include('documents.search.outgoing')
@include('documents.search.incoming')
@include('documents.search.digitized')





                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection

@section('js')

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