<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.add')}}&nbsp;</h3>

    </div>
    <div class="box-body">
    {!! Form::open(['method'=>'post','url'=>'configurations/tag']) !!}


    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('tag_name'))?'has-error':'' }}">
            <label>{{trans('eng.tagName')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('tag_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter') .trans('eng.tagName').'']) !!}
        {!! $errors->first('tag_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
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

