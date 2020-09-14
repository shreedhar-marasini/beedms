<div class="active tab-pane" id="outgoing">
    <?php

    $outgoingPermission =  helperPermission();


    $outgoingAllowEdit = $outgoingPermission['isEdit'];

    $outgoingAllowDelete = $outgoingPermission['isDelete'];
    ?>
        @if(count($outgoingDocuments)>0)
    <div class="table-responsive">
        <table id="example3" class="table table-hover table-striped">
            <thead>
            <tr>
                <th style="width: 10px">S.N</th>
                <th style="width: 300px">Subject</th>
                <th>Institution</th>
                <th>Category</th>
                {{--<th>Issue Information</th>--}}
                <th class="text-center"> Created / Signed /Issued</th>

                <th style="width: 30px" class="text-center">Status</th>
                <th style="width: 120px" class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($outgoingDocuments)>0)
                @foreach($outgoingDocuments as $key=>$outgoingDocument)

                    <tr ondragstart="dragStart(event)" draggable="true" id="outgoing{{$outgoingDocument->id}}">

                        <th scope=row>{{++$key}}</th>
                        <td><a href="{{url('/documents/outgoingDocument/'.$outgoingDocument->id)}}" draggable="false"
                               target="_blank">{{$outgoingDocument->outgoing_document_subject}}</a>
                            <br>
                            <b>{{$outgoingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                            <a href="{{url('institution/'.$outgoingDocument->institution_id)}}" draggable="false"
                               target="_blank">{{$outgoingDocument->institution_name}}</a><br>
                            <i> {{$outgoingDocument->department_name}}</i></td>
                        <td>
                            {{$outgoingDocument->template_name}}<br>
                            <p>
                                <?php $tags = \App\Models\DocumentTag::where('document_id', '=', $outgoingDocument->id)
                                    ->where('document_tag_type', '=', 'outgoing')
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
                        {{--<td>{{$outgoingDocument->outgoing_issue_date}}<br>--}}
                            {{--<i><b>{{$outgoingDocument->outgoing_issue_number}}</b></i>--}}
                        {{--</td>--}}
                        <td class="text-center">
                            <table style=" width: 100%;">
                                <tr>
                                    <td style="width: 33%">
                                        @if($outgoingDocument->user_image!=null)
                                            <img src="{{asset('/storage/avatar/'.$outgoingDocument->user_image)}}"
                                                 class="img-circle" height="20px">
                                        @else
                                            <img src="{{url('uploads/users/dummyUser.png')}}"
                                                 class="img-circle" height="20px">

                                        @endif

                                    </td>
                                    <td style="width: 34%">
                                        @if($outgoingDocument->signature_user_id !=null)

                                            <?php $signature = App\User::find($outgoingDocument->signature_user_id)?>

                                            @if($signature->user_image!=null)
                                                <img src="{{asset('/storage/avatar/'.$signature->user_image)}}"
                                                     class="img-circle" height="20px">
                                            @else
                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                     class="img-circle" height="20px">
                                            @endif

                                        @endif
                                    </td>
                                    <td style="width: 33%">
                                        @if($outgoingDocument->issued_by !=null)
                                            <?php $issue = App\User::find($outgoingDocument->issued_by)?>


                                            @if($issue->user_image!=null)
                                                <img src="{{asset('/storage/avatar/'.$issue->user_image)}}"
                                                     class="img-circle" height="20px">


                                            @else

                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                     class="img-circle" height="20px">
                                            @endif

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php $fname = explode(" ", $outgoingDocument->name)?>{{$fname[0]}}


                                    </td>

                                    <td>
                                        @if($outgoingDocument->signature_user_id !=0)

                                            <?php $fname = explode(" ", \App\User::find($outgoingDocument->signature_user_id)->name)?>{{$fname[0]}}

                                        @endif
                                    </td>


                                    <td>
                                        @if($outgoingDocument->issued_by !=null)

                                            <?php $fname = explode(" ", \App\User::find($outgoingDocument->issued_by)->name)?>{{$fname[0]}}

                                        @endif
                                    </td>

                                </tr>
                                <tr class="text-10">
                                    <td>
                                        {{$outgoingDocument->created_at->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        @if($outgoingDocument->signature_user_id !=0)

                                            2017-1-1

                                        @endif
                                    </td>
                                    <td>
                                        @if($outgoingDocument->issued_by !=null)

                                            {{$outgoingDocument->outgoing_issue_date}}

                                        @endif
                                    </td>
                                </tr>
                            </table>


                        </td>


                        <td class="text-center">
                            @if($outgoingDocument->outgoing_issue_status=="issued" && $outgoingDocument->outgoing_issue_number!=null)
                                <button
                                        class="btn btn-block btn-success btn-xs getRegisterModal"
                                        id="btn_issue_{{$outgoingDocument->id}}"
                                        data-id="<?= $outgoingDocument->id ?>"
                                        value="{{$outgoingDocument->id}}">
                                    <strong> Issued
                                    </strong>
                                </button>
                            @elseif($outgoingDocument->outgoing_issue_status=="registered"&&$outgoingDocument->outgoing_registration_number!=null && $outgoingDocument->outgoing_registration_date!=null)

                                <label
                                        class="btn btn-block btn-primary btn-xs">
                                    <strong> Registered
                                    </strong>

                                </label>
                            @else

                                <button class="btn btn-block btn-warning btn-xs detail"
                                        data-toggle="modal"
                                        data-target="#issue{{$outgoingDocument->id}}"
                                        data-id="<?= $outgoingDocument->id ?>"
                                        id="btn_draft_{{$outgoingDocument->id}}">
                                    Draft
                                </button>

                            @endif
                        </td>
                        <td class="text-right">
                            {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['outgoingDocument.destroy',
                                                                                  $outgoingDocument->id]]) !!}
                            <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id)}}"
                               class="text-success" data-toggle="tooltip" draggable="false"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars actionIcon"></i>
                            </a>&nbsp;
                            @if($outgoingAllowEdit)
                            @if($outgoingDocument->outgoing_issue_status!="issued" && $outgoingDocument->outgoing_issue_status!="registered" )
                                <a href="{{url('documents/outgoingDocument/'.$outgoingDocument->id.'/edit')}}" draggable="false"
                                   class="text-info actionIcon" data-toggle="tooltip"
                                   data-placement="top" title="Edit"
                                   id="edit_{{$outgoingDocument->id}}">
                                    <i class="fa fa-pencil"></i>
                                </a>&nbsp;
                            @endif
                            @endif
                            @if($outgoingAllowDelete)
                            @if($outgoingDocument->outgoing_issue_status!="issued" && $outgoingDocument->outgoing_issue_status!="registered" )
                                <button type="submit"
                                        class="btn btn-default btn-xs deleteButton actionIcon"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Delete"
                                        onclick="javascript:return confirm('Are you sure you want to delete?');">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            @endif
                            @endif

                            {!! Form::close() !!}


                        </td>
                    </tr>

                @endforeach



            @endif

            </tbody>
        </table>
    </div>
        @else
            <p class="text-danger text-center" style="font-size: large; margin-top: 150px">{{$noavailableMessage}}</p>


        @endif
</div>