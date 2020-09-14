<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add</h3>

    </div>
    <div class="box-body">

        <div class="box-body">
            {!! Form::model($edits,['method'=>'put','url'=>['institution/nameCard/update/'.$edits->id],'enctype'=>'multipart/form-data','files'=>true]) !!}


            <input type="hidden"
                   name="_token"
                   value="{{ csrf_token() }}">

            <div class="form-group {{($errors->has('institution_id'))?'has-error':'' }}">
                <label for="institution_id">Receiver Institution</label><label class="text-danger">*</label>

                {{Form::select('institution_id',$institutions->pluck('institution_name','id'),Request::get('institution_id'),['class'=>'form-control','style'=>'width:100%;','id'=>'institution_id','placeholder'=>
                    'Select Institution Name'])}}
                <a href="{{url('institution')}}" target="_blank"><p
                            class="help-block pull-right">Click here</a>to add new Institution.</p>
                {!! $errors->first('institution_id', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group {{($errors->has('name_card_person'))?'has-error':'' }}">
                <label for="name_card_person" class="control-label align">
                    Name
                </label><label class="text-danger">*</label>
                {{Form::text('name_card_person',null,array('class'=>'form-control','id'=>'name_card_person','placeholder'=>'Name'))}}
                {!! $errors->first('name_card_person', '<span class="text-danger">:message</span>') !!}

            </div>
            <div class="form-group {{($errors->has('name_card_address'))?'has-error':'' }}">
                <label for="name_card_address" class="control-label align">
                    Address
                </label>
                {{Form::text('name_card_address',null,array('class'=>'form-control','id'=>'name_card_address','placeholder'=>'Address'))}}
                {!! $errors->first('name_card_address', '<span class="text-danger">:message</span>') !!}

            </div>

            <div class="form-group {{($errors->has('name_card_designation'))?'has-error':'' }}">
                <label for="name_card_designation" class="control-label align">
                    Designation
                </label>
                {{Form::text('name_card_designation',null,array('class'=>'form-control','id'=>'name_card_designation','placeholder'=>'Designation'))}}
                {!! $errors->first('name_card_designation', '<span class="text-danger">:message</span>') !!}

            </div>


            <div class="form-group {{($errors->has('name_card_email_address1'))?'has-error':'' }}">
                <label for="name_card_email_address1"
                       class="control-label align">
                    Primary Email :
                </label>
                {{Form::email('name_card_email_address1',null,array('class'=>'form-control','id'=>'name_card_email_address1','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                'Primary Email'))}}
                {!! $errors->first('name_card_email_address1', '<span class="text-danger">:message</span>') !!}

            </div>

            <div class="form-group {{($errors->has('name_card_email_address2'))?'has-error':'' }}">
                <label for="name_card_email_address2"
                       class="control-label align">
                    Secondary Email:
                </label>
                {{Form::email('name_card_email_address2',null,array('class'=>'form-control','id'=>'name_card_email_address2','multiple pattern'=>"^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$",'placeholder'=>
                'Secondary Email'))}}
                {!! $errors->first('name_card_email_address2', '<span class="text-danger">:message</span>') !!}

            </div>
            <div class="form-group {{($errors->has('name_card_contact_number1'))?'has-error':'' }}">
                <label for="name_card_contact_number1" class="control-label align">
                    Primary Contact No :
                </label>
                {{Form::text('name_card_contact_number1',null,array('class'=>'form-control','id'=>'name_card_contact_number1','placeholder'=>'Primary Contact No'))}}
                {!! $errors->first('name_card_contact_number1', '<span class="text-danger">:message</span>') !!}

            </div>
            <div class="form-group {{($errors->has('name_card_contact_number2'))?'has-error':'' }}">
                <label for="name_card_contact_number2" class="control-label align">
                    Secondary Contact No :
                </label>
                {{Form::text('name_card_contact_number2',null,array('class'=>'form-control','id'=>'name_card_contact_number2','placeholder'=>'Secondary Contact No'))}}
                {!! $errors->first('name_card_contact_number2', '<span class="text-danger">:message</span>') !!}

            </div>
            <button type="submit"
                    class="btn btn-primary pull-right"
                    name="">
                Save
            </button>
            <br/>
            <br/>

            <label for="panel-body">Note
                :Field in <label
                        class="text-danger">
                    * </label> are
                mandatory
            </label>
            {{Form::close()}}


        </div>
    </div>
</div>
