<div class="tab-pane" id="tab_4">
    @if(!count($totalDigitizedDocument)>=0)
        <div class="table-responsive">
            <table id="digitized_dashboard"
                   class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Document Name</th>
                    <th>Related Institution</th>
                    <th>Department</th>
                    <th>Category</th>
                    <th class="text-center" style="width: 70px">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                ?>
                @foreach($totalDigitizedDocument as $digitizedDocument)
                    <tr>
                        <th scope=row>{{$i++}}</th>
                        <td>
                            <a href="{{route('digitizedDocument.show',[$digitizedDocument->id])}}"
                               target="_blank">{{$digitizedDocument->digitized_document_name}}</a>
                            <br>
                            <b class="list-inline">@if($digitizedDocument->created_at!=null){{$digitizedDocument->created_at->todatestring()}}@endif
                                <i class="pull-right help-block mark small">Uploaded
                                    By: {{$digitizedDocument->user->name}}</i></b>&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>{{$digitizedDocument->institution->institution_name}}
                            <br>
                            <i class="help-block small">{{$digitizedDocument->institution->institution_address}}</i>
                        </td>
                        <td>{{$digitizedDocument->department->department_name}}<br>
                        </td>
                        <td>{{$digitizedDocument->document_category->category_name}}
                            <br></td>
                        <td class="text-center">
                            {!! Form::open(['method' => 'DELETE','class'=>'inline','route'=>['digitizedDocument.destroy',$digitizedDocument->id]]) !!}
                            <a target="_blank"
                               href="{{url('documents/digitizedDocument/'.$digitizedDocument->id)}}"
                               class="actionIcon" data-toggle="tooltip"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars"></i>
                            </a>&nbsp;


                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
            @else
                No records found!!
            @endif
            <a class="btn btn-primary pull-right">View More</a>
        </div>
</div>