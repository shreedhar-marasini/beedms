<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.edit')}}</h3>

    </div>
    <div class="box-body">

        {!! Form::model($edits,['method'=>'PUT','route'=>['documentCategory.update',$edits->id]]) !!}


        <div class="form-group {{ ($errors->has('parent_id'))?'has-error':'' }}">
            <label>{{trans('eng.parentId')}}
                <label class="text-danger"> *</label>
            </label>
            {{Form::select('parent_id',$categoryParentList->pluck('category_name','id'),Request::get('parent_id'),['class'=>'form-control'])}}
        </div>

        <div class="form-group {{ ($errors->has('category_name'))?'has-error':'' }}">
            <label>{{trans('eng.categoryName')}}
                <label class="text-danger"> *</label>
            </label>
        {!! Form::text('category_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter') .trans('eng.categoryName').'']) !!}
        <!-- /.input group -->
        </div>
        <div class="form-group {{ ($errors->has('category_status'))?'has-error':'' }}">
            <label>{{trans('eng.status')}} </label><br>
            {{Form::radio('category_status', 'active','true',['class'=>'flat-red'])}} {{trans('eng.active')}} &nbsp;&nbsp;&nbsp;
            {{Form::radio('category_status', 'inactive',null,['class'=>'flat-red'])}} {{trans('eng.inactive')}}
        </div>
        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('eng.update')}}</button>

            </div>
            <!-- /.box-footer -->
        </div>

        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>