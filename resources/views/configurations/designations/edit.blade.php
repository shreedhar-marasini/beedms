<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.edit')}}&nbsp;</h3>

    </div>
    <div class="box-body">

        {!! Form::model($edits,['method'=>'PUT','route'=>['designation.update',$edits->id]]) !!}


        <div class="form-group {{ ($errors->has('designation_name'))?'has-error':'' }}">
            <label>{{trans('eng.designationName')}}
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('designation_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter').trans('eng.designationName').'']) !!}
            {!! $errors->first('designation_name', '<span class="text-danger">:message</span>') !!}
        </div>
        <div class="form-group {{ ($errors->has('designation_short_name'))?'has-error':'' }}">
            <label>{{trans('eng.designationShortName')}}
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('designation_short_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter').trans('eng.designationShortName').'']) !!}
            {!! $errors->first('designation_short_name', '<span class="text-danger">:message</span>') !!}
        </div>
        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('eng.update')}}</button>
                {{--<button type="submit" class="btn btn-default bg-green">Save & Add New</button>--}}

            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>