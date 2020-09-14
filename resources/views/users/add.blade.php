<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add User</h3>

    </div>
    <div class="box-body">

        {!! Form::open(['method'=>'post','url'=>'user','enctype'=>'multipart/form-data']) !!}

        <div class="form-group {{ ($errors->has('designation_id'))?'has-error':'' }}">
            <label>Designation</label>
            {{Form::select('designation_id',$designationList->pluck('designation_name','id'),Request::get('designation_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'designation_id','placeholder'=>
            'Select Designation Name'])}}
            {{--{{Form::select('designation_id',['1'=>'Designation'],Request::get('designation_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'designation_id','placeholder'=>--}}
            {{--'Select Designation Name'])}}--}}
            {!! $errors->first('designation_id', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('department_id'))?'has-error':'' }}">
            <label>Department</label>
            {{Form::select('department_id',$departmentList->pluck('department_name','id'),Request::get('department_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'department_id','placeholder'=>
            'Select Department Name'])}}
            {{--{{Form::select('department_id',['1'=>'Department'],Request::get('department_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'department_id','placeholder'=>--}}
            {{--'Select Department Name'])}}--}}
            {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('user_group_id'))?'has-error':'' }}">
            <label>Group</label>
            {{Form::select('user_group_id',$groupList->pluck('group_name','id'),Request::get('user_group_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'group_id','placeholder'=>
            'Select Group'])}}
            {!! $errors->first('user_group_id', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
            <label>Username</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'User Name','onkeyup'=>"sync(this)"]) !!}
            </div>
        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="form-group {{ ($errors->has('email'))?'has-error':'' }}">
            <label>Email</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'email@example.com']) !!}
            </div>
        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
            <!-- /.input group -->
        </div>


        <div class="form-group {{ ($errors->has('avatar_image'))?'has-error':'' }}">
            <label for="avatar_image" class="control-label align">User Image </label>
            <p class="help-block ">Upload Type: JPG, JPEG, PNG</p>

            {{Form::file('avatar_image',null,array('class'=>'form-control','id'=>'avatar_image','placeholder'=>
            'Choose File'))}}
            {!! $errors->first('avatar_image', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('signature_image'))?'has-error':'' }}">
            <label for="signature_image" class="control-label align">User Signature </label>
            <p class="help-block">Upload Type: JPG, JPEG, PNG</p>
            {{Form::file('signature_image',null,array('class'=>'form-control','id'=>'signature_image','placeholder'=>
            'Choose File'))}}

            {!! $errors->first('signature_image', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('user_signature_allow_other'))?'has-error':'' }}">
            <label for="user_signature_allow_other">Allow Signature </label><br>
            <p class="help-block inline">Enable to allow other users to use the signature</p><br>
            {{--<label for="item_type" class="control-label align">Item Type<label class="text-danger"> *</label></label><br>--}}
            {{Form::radio('user_signature_allow_other', 'true',null,['class'=>'flat-red'])}} Enable&nbsp;&nbsp;
            {{Form::radio('user_signature_allow_other', 'false',true,['class'=>'flat-red'])}} Disable
            {!! $errors->first('user_signature_allow_other', '<span class="text-danger">:message</span>') !!}

        </div>

        <div class="form-group {{ ($errors->has('user_signature_content'))?'has-error':'' }} ">
            <label for="user_signature_content">Signature Content</label>
            {!! Form::textarea('user_signature_content',null,['class'=>'form-control','placeholder'=>'Enter Signature Content','id'=>'user_signature_content']) !!}
            {!! $errors->first('user_signature_content', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('user_status'))?'has-error':'' }}">
            <label for="user_status">Status </label><br>
            {{--<label for="item_type" class="control-label align">Item Type<label class="text-danger"> *</label></label><br>--}}
            {{Form::radio('user_status', 'active',null,['class'=>'flat-red'])}} Active &nbsp;&nbsp;&nbsp;
            {{Form::radio('user_status', 'inactive',true,['class'=>'flat-red'])}} Inactive
            {!! $errors->first('user_status', '<span class="text-danger">:message</span>') !!}
        </div>

    <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Save</button>


            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>
@section('js')
    <script>
        function sync(textbox) {
            document.getElementById('user_signature_content').value = textbox.value;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#closeErrorBar').click(function(){
                $('.errorBar').hide();

            });
        });

    </script>
    @endsection