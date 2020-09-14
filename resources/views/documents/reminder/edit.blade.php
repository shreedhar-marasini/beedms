<div class="box box-default">
    <div class="box-header with-border">
        <strong><i class="fa fa-clock-o"></i> Edit
            Reminder</strong><br><br>

    </div>
    <div class="box-body">

    {!! Form::model($edits,['method'=>'PUT','route'=>['reminder.update',$edits->id]]) !!}
    {{csrf_field()}}


    <!-- Date -->
        <div class="form-group  {{ ($errors->has('reminder_date'))?'has-error':''}}">
            <label>{{trans('eng.date')}}</label>
            <div class='input-group'>
                {{Form::text('reminder_date',$edits->reminder_date, array('class'=>'form-control pull-right form_datetime','id'=>'datetimepicker','readonly'))}}

                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                {!! $errors->first('reminder_date', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /.form group -->
        <!-- time Picker -->
        <input type="hidden" name="document_id"
               value="{{$document->id}}">
        @if(\Request::segment(2) == 'incomingDocument')
            <input type="hidden" name="document_type" value="incoming">
            <input type="hidden" name="documentId" value="{{$document->id}}">
            <input type="hidden" name="reminder_title" value="{{$document->incoming_document_subject}} reminder">

        @elseif(\Request::segment(2) == 'digitizedDocument')
            <input type="hidden" name="document_type" value="digitized">
            <input type="hidden" name="documentId" value="{{$document->id}}">
            <input type="hidden" name="reminder_title" value="{{$document->digitized_document_name}} reminder">

        @else
            <input type="hidden" name="document_type" value="outgoing">
            <input type="hidden" name="documentId" value="{{$document->id}}">
            <input type="hidden" name="reminder_title" value="{{$document->outgoing_document_subject}} reminder">
        @endif


        <input type="hidden" name="reminder_to_email"
               value="{{Auth::user()->email}}">

        <div class="form-group {{ ($errors->has('reminder_content'))?'has-error':'' }} ">
            <label for="reminder_content">{{trans('eng.reminderContent')}}
                <label class="text-danger"> *</label>
            </label>
            {!! Form::textarea('reminder_content',$edits->reminder_content,['class'=>'form-control','placeholder'=>'Content']) !!}
            {!! $errors->first('reminder_content', '<span class="text-danger">:message</span>') !!}
        </div>

        <button type="submit" class="btn btn-primary pull-right"
                style="margin-top: 22px;" id="reminder_save">SAVE
        </button>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>