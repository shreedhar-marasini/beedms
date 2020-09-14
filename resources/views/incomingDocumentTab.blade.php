<div class="tab-pane active" id="tab_1">
    <div class="table-responsive">
        @if(!count($totalIncomingDocument->take(5))>=0)
            <table id="incoming_dashboard"
                   class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Subject</th>
                    <th>Institution/Department</th>
                    <th>Issue Information</th>
                    <th>Registration Information</th>
                    <th style="width:100px" class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($totalIncomingDocument->take(5) as $incomingDocument)
                    <tr>
                        <th scope=row>{{$i}}</th>
                        <td>
                            <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}"
                               target="_blank">{{$incomingDocument->incoming_document_subject}}</a>
                            <br>
                            <b>@if($incomingDocument->created_at!=null){{$incomingDocument->created_at->todatestring()}} @endif</b>&nbsp;&nbsp;&nbsp;
                            <i class="pull-right help-block mark small">Uploaded
                                By: {{$incomingDocument->user->name}}</i>
                        </td>
                        <td>
                            <a href="{{url('institution/'.$incomingDocument->sender_institution_id)}}"
                               target="_blank">
                                {{$incomingDocument->institution->institution_name}}</a><br>
                            <i>{{$incomingDocument->department->department_name}}</i>
                        </td>
                        <td><b>{{$incomingDocument->issue_number}}</b><br>
                            <i>{{$incomingDocument->issue_date}}</i>
                        </td>
                        <td>
                            <b>{{$incomingDocument->incoming_document_registration_number}}</b><br>
                            <i>{{$incomingDocument->incoming_document_registration_date}}</i>
                        </td>
                        <td class="text-right">
                            {!! Form::open(['method' => 'DELETE','route' => ['incomingDocument.destroy', $incomingDocument->id]]) !!}
                            <a href="{{route('incomingDocument.show',[$incomingDocument->id])}}"
                               class="text-success " data-toggle="tooltip"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars actionIcon"></i>
                            </a>&nbsp;
                            </a>&nbsp;
                            <a data-toggle="modal"
                               data-target="#email{{$incomingDocument->id}}"
                               value="{{$incomingDocument->id}}"
                               class="text-warning"
                               data-placement="top" title="Send Email">
                                <i class="fa fa-envelope actionIcon"></i>
                            </a>&nbsp;
                        </td>
                    </tr>
                    <div class="modal fade" id="email{{$incomingDocument->id}}"
                         role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content col-md-10">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Receiver's Email
                                        Information</h4>
                                </div>

                                <div class="modal-body">
                                    {{Form::open(array('method' => 'PUT','url'=>"documents/incomingDocument/send/email/{$incomingDocument->id}",'enctype'=>'multipart/form-data'))}}
                                    <div class="box-body">
                                        <input type="hidden" name="_token"
                                               value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <label for="receiver_regd_no"
                                                   class="control-label align">
                                                To :
                                            </label>
                                            {{Form::email('receiver_email',null,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                                            'Receiver Email', 'required'))}}
                                        </div>

                                        <div class="form-group ">
                                            <label for="receiver_regd_date"
                                                   class="control-label align">
                                                Cc:
                                            </label>
                                            {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','placeholder'=>
                                            'Cc email'))}}
                                        </div>

                                        <div class="form-group">
                                            <label for="receiver_regd_no"
                                                   class="control-label align">
                                                Subject </label>
                                            {{Form::text('incoming_document_subject',$incomingDocument->incoming_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
                                            'Subject'))}}
                                        </div>

                                        <div class="form-group">
                                            <label for="email_content">Email
                                                Content</label>
                                            <div class="form-group">
                                                                                    <textarea
                                                                                            class="form-control pull-right "
                                                                                            id="email_content"
                                                                                            name="email_content"></textarea>
                                            </div>
                                            <p class="help-block">Enter Email
                                                Content.</p>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group {{ ($errors->has('attach_additional_file'))?'has-error':'' }}">
                                            {{Form::checkbox('attach_additional_file','yes',true,array('class'=>'field','id'=>'attach_additional_file','placeholder'=>
                                            'Attach Additional file if exist??'))}}
                                            <label for="attach_additional_file"
                                                   class="control-label align">Attach
                                                Additional file if Exists?</label>
                                            {!! $errors->first('attach_additional_file', '<span class="text-danger">:message</span>') !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="optional_uploads"
                                                   class="control-label align">
                                                Extra Uploads
                                            </label>

                                            {{Form::file('optional_uploads',null,array('class'=>'form-control','id'=>'optional_image','placeholder'=>
                                                'Choose LOGO'))}}
                                            {!! $errors->first('optional_uploads', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit"
                                                class="btn btn-success" name="send">
                                            Send
                                        </button>
                                        <br/>
                                        <br/>

                                        <label for="panel-body">Note :Field in
                                            <label class="text-danger">* </label>
                                            are mandatory
                                        </label>
                                    </div>

                                    {{Form::close()}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
                @else
                @endif

                </tbody>
            </table>
            <a href="{{url('documents/incomingDocument')}}"
               class="btn btn-primary pull-right">View More</a>

    </div>
</div>