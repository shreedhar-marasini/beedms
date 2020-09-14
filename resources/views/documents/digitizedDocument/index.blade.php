@extends('master.app')
@section('content')
<style>
    #related_institution_id
    {
        width: 250px;
 
    }
</style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Digitized Documents
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Documents</a></li>
                <li class="active">Digitized Documents</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--                <div class="callout callout-info">-->
            <!---->
            <!--                </div>-->
            @include('message.flash')
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <?php

                    $permission = helperPermissionLink(url('documents/digitizedDocument/create'), url('documents/digitizedDocument'));

                    $allowEdit = $permission['isEdit'];

                    $allowDelete = $permission['isDelete'];

                    $allowAdd = $permission['isAdd'];
                    ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 topFilter">
                                <form class="form-inline">
                                    {!! Form::text('document_name',Request::get('document_name'),array('class'=>'form-control filterForm','placeholder'=>'Document Name')) !!}
                                    {!! Form::select('document_category_id',$category->pluck('category_name','id'),Request::get('document_category_id'),array('class'=>'form-control','id'=>'document_category_id','placeholder'=>'Select Category'))!!}
                                    {!! Form::select('department_id',$departments->pluck('department_name','id'),Request::get('department_id'),array('class'=>'form-control','id'=>'department_id','placeholder'=>'Select Department'))!!}
                                    {!! Form::select('related_institution_id',$institutions->pluck('institution_name','id'),Request::get('related_institution_id'),array('class'=>'form-control select2','id'=>'related_institution_id','placeholder'=> 'Select Institution'))!!}
                                    {{Form::text('digitized_document_date_from',Request::get('digitized_document_date_from'),array('class'=>'form-control','id'=>'datepicker','placeholder'=>" Document Date from", 'data-date-format' => 'yyyy-mm-dd'))}}
                                    {{Form::text('digitized_document_date_to',Request::get('digitized_document_date_to'),array('class'=>'form-control datepicker','id'=>'datepicker','placeholder'=>" Document Date to", 'data-date-format' => 'yyyy-mm-dd'))}}

                           
                                    <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{url('/documents/digitizedDocument')}}" type="button"
                                                           class="btn btn-warning"><i
                                                                    class="fa fa-refresh"></i> Refresh
                                                        </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(!count($digitizedDocuments)>=0)
                        <div class="table-responsive">
                            <table id="example4" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Document Name</th>
                                    <th>Related Institution</th>
                                    <th>Department</th>
                                    <th>Category</th>
                                    <th class="text-center" style="width: 80px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($digitizedDocuments as $digitizedDocument)
                                    <tr>
                                        <th scope=row>{{$i++}}</th>
                                        <td><a href="{{route('digitizedDocument.show',[$digitizedDocument->id])}}"
                                               target="_blank">{{$digitizedDocument->digitized_document_name}}</a>
                                            <br>
                                            @if($digitizedDocument->folder!=null)
                                                <a href="{{url('documents/folder/'.$digitizedDocument->folder->id)}}" target="_blank">
                                                <i class="label label-info"><i
                                                            class="fa fa-folder"></i> {{$digitizedDocument->folder->name}}
                                                </i>
                                                </a>
                                            @else
                                                <a href="{{url('documents/folder/0')}}" target="_blank">
                                                <i class="label label-warning"><i class="fa fa-folder"></i> Untitled</i>
                                                </a>
                                            @endif
                                            <br>
                                            <b class="list-inline">{{$digitizedDocument->created_at->todatestring()}}
                                                <br>
                                                @if($digitizedDocument->digitized_document_privacy=='Confidential')
                                                    <p class=" label label-warning "
                                                       style="font-size: 8px"> {{$digitizedDocument->digitized_document_privacy}}</p>
                                                @elseif($digitizedDocument->digitized_document_privacy=='Departmental')
                                                    <p class=" label label-primary "
                                                       style="font-size: 8px"> {{$digitizedDocument->digitized_document_privacy}}</p>
                                                @else
                                                    <p class=" label label-default "
                                                       style="font-size: 8px"> {{$digitizedDocument->digitized_document_privacy}}</p>


                                                @endif
                                                <i class="pull-right help-block mark small">Uploaded
                                                    By: {{$digitizedDocument->user->name}}</i></b>&nbsp;&nbsp;&nbsp;<br>


                                        </td>
                                        <td>
                                            <a href="{{route('institution.show',[$digitizedDocument->related_institution_id])}}"
                                               target="_blank">{{$digitizedDocument->institution->institution_name}}</a><br>
                                            <i class="help-block small">{{$digitizedDocument->institution->institution_address}}</i>
                                        </td>
                                        <td>{{$digitizedDocument->department->department_name}}<br></td>
                                        <td>{{$digitizedDocument->document_category->category_name}}<br>
                                            <p>
                                                <?php $tags = \App\Models\DocumentTag::where('document_id', '=', $digitizedDocument->id)
                                                    ->where('document_tag_type', '=', 'digitized')
                                                    ->get();?>
                                                @forelse($tags as $tag)
                                                    @if($tag->tag_id % 2 == 0)

                                                        <span class="label label-danger">{{$tag->tag->tag_name}}</span>
                                                    @elseif($tag->tag_id % 3 == 0)
                                                        <span class="label label-success">{{$tag->tag->tag_name}}</span>
                                                    @elseif($tag->tag_id % 5 == 0)
                                                        <span class="label label-info">{{$tag->tag->tag_name}}</span>
                                                    @else
                                                        <span class="label label-default">{{$tag->tag->tag_name}}</span>
                                            @endif
                                            @empty<h5>No Tags</h5>
                                            @endforelse
                                            </p>


                                        </td>
                                        <td class="text-center">
                                            {!! Form::open(['method' => 'DELETE','class'=>'inline','route'=>['digitizedDocument.destroy',$digitizedDocument->id]]) !!}
                                            <a href="{{url('documents/digitizedDocument/'.$digitizedDocument->id)}}"
                                               class="actionIcon text-success" data-toggle="tooltip"
                                               data-placement="top" title="View">
                                                <i class="fa fa-binoculars"></i>
                                            </a>&nbsp;
                                            <?php
                                            if($allowEdit){
                                            ?>
                                            <a href="{{url('documents/digitizedDocument/'.$digitizedDocument->id.'/edit')}}"
                                               class="actionIcon" data-toggle="tooltip"
                                               data-placement="top" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php
                                            }
                                            if($allowDelete){
                                            ?>
                                            <button type="submit" class="actionIcon link deleteButton"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            {!! Form::close() !!}
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            <div class="pull-right">
                                {{--                                {{$digitizedDocuments->links()}}--}}

                                @include('documents.paginate',['document'=>$digitizedDocuments,'url'=>'/documents/digitizedDocument/'])

                            </div>
                        </div>

                    @else
                        No records found!!
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

@endsection