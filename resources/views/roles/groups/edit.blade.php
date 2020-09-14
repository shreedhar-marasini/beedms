<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Group</h3>

    </div>
    <div class="box-body">

    {!! Form::model($edits,['method'=>'PUT','route'=>['group.update',$edits->id]]) !!}
    {{--<div class="form-group" {{ ($errors->has('menu_name'))?'has-error':'' }}>--}}
    {{--<label>Username:</label>--}}
    {{--<div class="input-group">--}}
    {{--<span class="input-group-addon"><i class="fa fa-user"></i></span>--}}
    {{--{!! Form::text('menu_name',null,['class'=>'form-control']) !!}--}}
    {{--<input type="text" class="form-control" placeholder="Username">--}}
    {{--</div>--}}
    {{--<br>--}}
    {{--<!-- /.input group -->--}}
    {{--</div>--}}
    <!-- /.form group -->


        <div class="form-group {{ ($errors->has('group_name'))?'has-error':'' }}">
            <label for="group_name">Name</label>
            {!! Form::text('group_name',null,['class'=>'form-control','placeholder'=>'Enter Group Name']) !!}
            {!! $errors->first('group_name', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('group_details'))?'has-error':'' }}">
            <label for="group_details">Details</label>
            {!! Form::textarea('group_details',null,['class'=>'form-control','placeholder'=>'Enter Menu Controller']) !!}
            {!! $errors->first('group_details', '<span class="text-danger">:message</span>') !!}
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