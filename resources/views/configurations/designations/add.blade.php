<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.add')}}&nbsp;</h3>

    </div>
    <div class="box-body">
    {!! Form::open(['method'=>'post','url'=>'configurations/designation']) !!}


    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('designation_name'))?'has-error':'' }}">
            <label>{{trans('eng.designationName')}}
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('designation_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter').trans('eng.designationName').'']) !!}
            {!! $errors->first('designation_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
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
                <button type="submit" class="btn btn-primary">{{trans('eng.save')}}&nbsp;</button>
            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

