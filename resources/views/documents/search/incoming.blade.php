<div class="tab-pane" id="incoming">

    <?php

    $incomingPermission =  helperPermission();


    $incomingAllowEdit = $incomingPermission['isEdit'];

    $incomingAllowDelete = $incomingPermission['isDelete'];
    ?>
    @if(count($incomingDocuments)>0)
        <div class="table-responsive">
            <table id="example1" class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Subject</th>
                    <th>Institution/Department</th>
                    <th>Category</th>
                    <th>Registration Information</th>
                    <th style="width:100px" class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($incomingDocuments as $incomingDocument)
                    <tr ondragstart="dragStart(event)" draggable="true" id="incoming{{$incomingDocument->id}}">

                        <th scope=row>{{$i}}</th>
                        <td>
                            <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}" draggable="false"
                               target="_blank">{{$incomingDocument->incoming_document_subject}}</a>
                            <br>
                            {{--<b>{{$incomingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;--}}
                            <i class="pull-right help-block mark small">Uploaded
                                By: {{$incomingDocument->user->name}}</i>
                        </td>
                        <td>
                            <a href="{{url('institution/'.$incomingDocument->sender_institution_id)}}" draggable="false"
                               target="_blank">
                                {{$incomingDocument->institution->institution_name}}</a><br>
                            <i>{{$incomingDocument->department->department_name}}</i>
                        </td>
                        <td>
                            {{$incomingDocument->document_category->category_name}}<br>
                            <p>
                                <?php $tags = \App\Models\DocumentTag::where('document_id', '=', $incomingDocument->id)
                                    ->where('document_tag_type', '=', 'incoming')
                                    ->get();?>
                                @forelse($tags as $tag)
                                    @if($tag->tag_id % 2 == 0)

                                        <span class="label label-danger">{{$tag->tag->tag_name}}</span>
                                    @elseif($tag->tag_id % 3 == 0)
                                        <span class="label label-success">{{$tag->tag->tag_name}}</span>
                                    @elseif($tag->tag_id % 5 == 0)
                                        <span class="label label-info">{{$tag->tag->tag_name}}</span>
                                    @else
                                        <span class="label label-warning">{{$tag->tag->tag_name}}</span>
                            @endif
                            @empty<h5>No Tags</h5>
                            @endforelse
                            </p>
                        </td>
                        <td><b>{{$incomingDocument->incoming_document_registration_number}}</b><br>
                            <i>{{$incomingDocument->incoming_document_registration_date}}</i>
                        </td>
                        <td class="text-right">
                            {!! Form::open(['method' => 'DELETE','route' => ['incomingDocument.destroy', $incomingDocument->id]]) !!}
                            <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}"
                               class="text-success " data-toggle="tooltip" draggable="false"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars actionIcon"></i>
                            </a>&nbsp;
                            </a>&nbsp;

                            @if($incomingAllowEdit)
                                <a href="{{route('incomingDocument.edit',[$incomingDocument->id])}}"
                                   class="text-info actionIcon" data-toggle="tooltip" draggable="false"
                                   data-placement="top" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>&nbsp;
                            @endif

                            @if($incomingAllowDelete)

                                <button type="submit"
                                        class=" test btn btn-default btn-xs deleteButton actionIcon"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Delete"
                                        onclick="javascript:return confirm('Are you sure you want to delete?');">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                {!! Form::close() !!}
                            @endif



                        </td>

                    </tr>

                    <?php $i++; ?>
                @endforeach

                </tbody>
            </table>
        </div>
        @else
            <p class="text-danger text-center" style="font-size: large; margin-top: 150px">{{$noavailableMessage}}</p>

        @endif

</div>