<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{trans('eng.add')}}&nbsp;</h3>

    </div>
    <div class="box-body">
    {!! Form::open(['method'=>'post','url'=>'configurations/documentCategory']) !!}


    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('parent_id'))?'has-error':'' }}">
            <label>{{trans('eng.parentId')}}
                <label class="text-danger"> *</label>
            </label>
            <select name="parent_id" id="receiver_department_id" class="form-control">
                <option value="">{{trans('eng.selectParent')}}</option>
                @foreach($categoryParentList as $list)
                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                @endforeach
            </select>
            {!! $errors->first('parent_id', '<span class="text-danger">:message</span>') !!}

        </div>

        <div class="form-group {{ ($errors->has('category_name'))?'has-error':'' }}">
            <label>{{trans('eng.categoryName')}}
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('category_name',null,['class'=>'form-control','placeholder' => ''.trans('eng.enter').trans('eng.categoryName').'']) !!}
            {!! $errors->first('category_name', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('category_status'))?'has-error':'' }}">
            <label for="category_status">{{trans('eng.status')}} </label><br>
            {{Form::radio('category_status', 'active','true',['class'=>'flat-red'])}} {{trans('eng.active')}} &nbsp;&nbsp;&nbsp;
            {{Form::radio('category_status', 'inactive',null,['class'=>'flat-red'])}} {{trans('eng.inactive')}}
        </div>
        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('save')}}</button>
            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

