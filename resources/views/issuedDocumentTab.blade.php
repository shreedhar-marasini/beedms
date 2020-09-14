<div class="tab-pane" id="tab_2">
    <div class="table-responsive">
        <table id="outgoing_issue_dashboard" class="table table-hover">
            <thead>
            <tr>
                <th style="width: 10px">S.N</th>
                <th style="width: 300px">Subject</th>
                <th>Institution</th>
                <th>Issue Information</th>
                <th class="text-center">Issued By</th>
                <th>Status</th>
                <th style="width: 70px" class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($totalIssuedDocument->take(5))>0)
                @foreach($totalIssuedDocument->take(5) as $key=>$outgoingDocument)
                    <tr>

                        <th scope=row>{{++$key}}</th>
                        <td>
                            <a href="{{url('/documents/outgoingDocument/'.$outgoingDocument->id)}}"
                               target="_blank">{{$outgoingDocument->outgoing_document_subject}}</a>
                            <br>
                            <b>{{$outgoingDocument->created_at->todatestring()}}</b>&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                            <a href="{{url('institution/'.$outgoingDocument->institution_id)}}"
                               target="_blank">{{$outgoingDocument->institution_name}}</a><br>
                            <i> {{$outgoingDocument->department_name}}</i></td>
                        <td>{{$outgoingDocument->outgoing_issue_date}}<br>
                            <i><b>{{$outgoingDocument->outgoing_issue_number}}</b></i>
                        </td>
                        <td class="text-center">
                            <table style=" width: 100%;">
                                <tr>

                                    <td style="width: 33%">
                                        @if($outgoingDocument->issued_by !=null)
                                            <?php $issue = App\User::find($outgoingDocument->issued_by)?>


                                            @if($issue->user_image!=null)
                                                <img src="{{asset('/storage/avatar/'.$issue->user_image)}}"
                                                     class="img-circle"
                                                     height="20px">


                                            @else

                                                <img src="{{url('uploads/users/dummyUser.png')}}"
                                                     class="img-circle"
                                                     height="20px">
                                            @endif

                                        @endif
                                    </td>
                                </tr>
                                <tr>


                                    <td>
                                        @if($outgoingDocument->issued_by !=null)

                                            <?php $fname = explode(" ", \App\User::find($outgoingDocument->issued_by)->name)?>{{$fname[0]}}

                                        @endif
                                    </td>

                                </tr>
                                <tr class="text-10">
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
                               class="text-success" data-toggle="tooltip"
                               data-placement="top" title="View">
                                <i class="fa fa-binoculars actionIcon"></i>
                            </a>&nbsp;
                            <a data-toggle="modal"
                               data-target="#email{{$outgoingDocument->id}}"
                               value="{{$outgoingDocument->id}}"
                               class="text-warning"
                               data-placement="top" title="Send Email">
                                <i class="fa fa-envelope actionIcon"></i>
                            </a>&nbsp;


                            {!! Form::close() !!}


                        </td>
                    </tr>
                    <div class="modal fade" id="email{{$outgoingDocument->id}}"
                         role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content col-md-10">
                                <div class="modal-header">

                                    <button type="button"
                                            class="close"
                                            data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        Receiver's Email
                                        Information</h4>
                                </div>
                                <div class="modal-body">
                                    {{Form::open(array('method' => 'PUT','url'=>"documents/outgoingDocument/send/email/{$outgoingDocument->id}",'enctype'=>'multipart/form-data'))}}

                                    <div class="box-body">
                                        <input type="hidden"
                                               name="_token"
                                               value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <label for="receiver_regd_no"
                                                   class="control-label align">
                                                To <label
                                                        class="text-danger">* </label>
                                            </label>
                                            {{Form::email('receiver_email',$outgoingDocument->institution->institution_email_address,array('class'=>'form-control','id'=>'receiver_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                            'Receiver Email'))}}
                                        </div>
                                        <div class="form-group ">
                                            <label for="receiver_regd_date"
                                                   class="control-label align">
                                                Cc
                                            </label>
                                            {{Form::email('cc_email',null,array('class'=>'form-control','id'=>'cc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                            'Cc email'))}}
                                        </div>
                                        <div class="form-group ">
                                            <label for="receiver_regd_date"
                                                   class="control-label align">
                                                Bcc
                                            </label>
                                            {{Form::email('bcc_email',null,array('class'=>'form-control','id'=>'bcc_email','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                                            'Cc email'))}}
                                        </div>
                                        <div class="form-group">
                                            <label for="receiver_regd_no"
                                                   class="control-label align">
                                                Subject </label>
                                            {{Form::text('letter_subject',$outgoingDocument->outgoing_document_subject,array('class'=>'form-control','id'=>'letter_subject','placeholder'=>
                                            'Subject'))}}
                                        </div>
                                        <div class="form-group">
                                            <label for="email_content">Email
                                                Content</label>

                                            <div class="form-group">
                                        <textarea class="form-control pull-right " id="email_content"
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
                                                Additional file if
                                                Exists?</label>
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
                                                class="btn btn-success"
                                                name="send">
                                            Send
                                        </button>

<span class="help-block additional-info-box"><b>Note</b> <br>Enter email address(es). Use comma(,) to separate multiple email addresses.
Eg: email1@something.com,email2@something.com
 <label for="panel-body">Field in <label class="text-danger">* </label> are mandatory</label></span>

                                    </div>
                                    {{Form::close()}}

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="issue{{$outgoingDocument->id}}"
                         role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content col-md-10">
                                <div class="modal-header">

                                    <button type="button"
                                            class="close"
                                            data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        Issue Document
                                        Information{{$outgoingDocument->id}}</h4>
                                </div>
                                <div class="modal-body">
                                    <form name="form_issue"
                                          id="form_issue{{$outgoingDocument->id}}">
                                        <input type="hidden"
                                               value="{{$outgoingDocument->id}}"
                                               name="outgoing_document_id"
                                               id="outgoing_document_id">
                                        <div class="box-body">
                                            <input type="hidden"
                                                   name="_token"
                                                   value="{{ csrf_token() }}">


                                            <div class="form-group {{($errors->has('outgoing_issue_date'))?'has-error':'' }}">
                                                <label for="outgoing_issue_date">
                                                    Date<label
                                                            class="text-danger">
                                                        *</label></label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{Form::text('outgoing_issue_date',date('Y-m-d'),array('class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>" Letter Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                                    {!! $errors->first('outgoing_issue_date', '<span class="text-danger">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{($errors->has('signature_user_id'))?'has-error':'' }}">
                                                    <label for="signature_user_id">Signature<label
                                                                class="text-danger">
                                                            *</label></label><br>

                                                    {{Form::select('signature_user_id',$signatures->pluck('name'),$outgoingDocument->signature_user_id!=0?$outgoingDocument->signature_user_id:Auth::user()->id,['class'=>'form-control select2','style'=>'width:100%;','id'=>'signature_user_id','placeholder'=>
'Select Signature'])}}

                                                    {!! $errors->first('signature_user_id', '<span class="text-danger">:message</span>') !!}
                                                    <p class="help-block">Signature
                                                        entered in this
                                                        field will replace variable
                                                        _SIGNATURE_</p>

                                                </div>
                                                <!-- /.input group -->
                                            </div>


                                        </div>
                                        <div class="box-footer">

                                            <button type="button"
                                                    id="btn_post_issue{{$outgoingDocument->id}}"
                                                    class="btn btn-success clickTest"
                                                    name="issue"
                                                    value="{{$outgoingDocument->id}}"
                                                    data-id="<?= $outgoingDocument->id ?>">
                                                Issue
                                            </button>
                                            <br>

                                            <label for="panel-body">Note
                                                :Field in <label
                                                        class="text-danger">
                                                    * </label> are
                                                mandatory
                                            </label>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>

                @endforeach

                <div class="modal fade" id="register"
                     role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content col-md-10">
                            <div class="modal-header">

                                <button type="button"
                                        class="close"
                                        data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    Document Registration Information</h4>
                            </div>
                            <div class="modal-body">
                                <form name="form_registration"
                                      id="form_registration">
                                    <input type="hidden" value="" name="document_id"
                                           id="document_id">
                                    <div class="box-body">
                                        <input type="hidden"
                                               name="_token"
                                               value="{{ csrf_token() }}">


                                        <div class="form-group {{($errors->has('outgoing_registration_date'))?'has-error':'' }}">
                                            <label for="outgoing_registration_date">
                                                Registration
                                                Date:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                {{Form::text('outgoing_registration_date',date('Y-m-d'),array('class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>" Letter Date", 'data-date-format' => 'yyyy-mm-dd'))}}
                                                {!! $errors->first('outgoing_registration_date', '<span class="text-danger">:message</span>') !!}
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group {{($errors->has('outgoing_registration_number'))?'has-error':'' }}">
                                            <label for="outgoing_registration_number">
                                                Registration
                                                Number:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-registered"></i>
                                                </div>
                                                {{Form::text('outgoing_registration_number',null,array('class'=>'form-control pull-right','placeholder'=>"Document Registration"))}}
                                                {!! $errors->first('outgoing_registration_number', '<span class="text-danger">:message</span>') !!}
                                            </div>

                                            <!-- /.input group -->
                                        </div>


                                    </div>
                                    <div class="box-footer">

                                        <button type="button" id="btn_register"
                                                class="btn btn-primary"
                                                name="issue">
                                            Register
                                        </button>
                                        <br/>
                                        <br/>

                                        <label for="panel-body">Note
                                            :Field in <label
                                                    class="text-danger">
                                                * </label> are
                                            mandatory
                                        </label>
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>

            @endif
            </tbody>
        </table>
        <a href="{{url('documents/outgoingDocument')}}"
           class="btn btn-primary pull-right">View More</a>
    </div>

</div>