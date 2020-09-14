<div class="tab-pane" id="digitized">
    <?php

    $permission = helperPermission();

    $allowEdit = $permission['isEdit'];

    $allowDelete = $permission['isDelete'];

    $allowAdd = $permission['isAdd'];
    ?>

    @if(count($digitizedDocuments)>0)
        <div class="table-responsive">
            <table id="example2" class="table table-hover table-striped">
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
                @foreach($digitizedDocuments as $digitizedDocument)
                    <tr ondragstart="dragStart(event)" draggable="true" id="digitized{{$digitizedDocument->id}}">

                        <th scope=row>{{$i++}}</th>
                        <td><a href="{{route('digitizedDocument.show',[$digitizedDocument->id])}}" draggable="false"
                               target="_blank">{{$digitizedDocument->digitized_document_name}}</a>
                            <br>
                            {{--<b class="list-inline">{{$digitizedDocument->created_at->todatestring()}} <i class="pull-right help-block mark small">Uploaded By: {{$digitizedDocument->user->name}}</i></b>&nbsp;&nbsp;&nbsp;--}}
                            <i class="pull-right help-block mark small">UploadedBy: {{$digitizedDocument->user->name}}</i>
                        </td>
                        <td>
                            <a href="{{route('institution.show',[$digitizedDocument->related_institution_id])}}" draggable="false"
                               target="_blank">{{$digitizedDocument->institution->institution_name}}</a><br>
                            <i class="help-block small">{{$digitizedDocument->institution->institution_address}}</i>
                        </td>
                        <td>{{$digitizedDocument->department->department_name}}<br></td>
                        <td>
                            {{$digitizedDocument->document_category->category_name}}<br>
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
                                        <span class="label label-warning">{{$tag->tag->tag_name}}</span>
                            @endif
                            @empty<h5>No Tags</h5>
                            @endforelse
                            </p>


                        </td>
                        <td class="text-center">
                            {!! Form::open(['method' => 'DELETE','class'=>'inline','route'=>['digitizedDocument.destroy',$digitizedDocument->id]]) !!}
                            <a href="{{url('documents/digitizedDocument/'.$digitizedDocument->id)}}" draggable="false"
                               class="actionIcon text-success" data-toggle="tooltip"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars"></i>
                            </a>&nbsp;
                            <?php
                            if($allowEdit){
                            ?>
                            <a href="{{url('documents/digitizedDocument/'.$digitizedDocument->id.'/edit')}}" draggable="false"
                               class="actionIcon" data-toggle="tooltip"
                               data-placement="top" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;
                            <?php
                            }
                            if($allowDelete){
                            ?>
                            <button type="submit" class="actionIcon deleteButton" data-toggle="tooltip"
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
        </div>

    @else
        <p class="text-danger text-center" style="font-size: large; margin-top: 150px">{{$noavailableMessage}}</p>

    @endif
</div>