<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.add')}}&nbsp;</h3>

    </div>
    <div class="box-body">
    {!! Form::open(['method'=>'post','url'=>'configurations/widget']) !!}

    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('widget_name'))?'has-error':''}}">
            <label>{{trans('eng.widgetName')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('widget_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.widgetName').'']) !!}
        {!! $errors->first('widget_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <div class="form-group {{ ($errors->has('widget_description'))?'has-error':''}}">
            <label>{{trans('eng.widgetDescription')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('widget_description',null,['class'=>'form-control','placeholder' => ''.trans('eng.widgetDescription').'']) !!}
        {!! $errors->first('widget_description', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <div class="form-group {{ ($errors->has('widget_default'))?'has-error':''}}">
            <label>{{trans('eng.widgetDefault')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('widget_default',null,['class'=>'form-control','placeholder' => ''.trans('eng.widgetDefault').'']) !!}
        {!! $errors->first('widget_default', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <div class="form-group {{ ($errors->has('widget_key'))?'has-error':''}}">
            <label>{{trans('eng.widgetKey')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('widget_key',null,['class'=>'form-control','placeholder' => ''.trans('eng.widgetKey').'']) !!}
        {!! $errors->first('widget_key', '<span class="text-danger">:message</span>') !!}

        </div>

        <div class="form-group {{ ($errors->has('widget_status'))?'has-error':'' }}">
            <label for="widget_status">{{trans('eng.status')}} </label><br>
            {{Form::radio('widget_status', 'active','true',['class'=>'minimal-red'])}} {{trans('eng.active')}} &nbsp;&nbsp;&nbsp;
            {{Form::radio('widget_status', 'inactive',null,['class'=>'minimal-red'])}} {{trans('eng.inactive')}}
        </div>

        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('eng.save')}}</button>
            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

