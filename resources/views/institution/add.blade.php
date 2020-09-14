<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add</h3>

    </div>
    <div class="box-body">

        {!! Form::open(['method'=>'post','url'=>'institution']) !!}
        {{csrf_field()}}


        <div class="form-group {{ ($errors->has('institution_name'))?'has-error':'' }} ">
            <label for="institution_name">Institution Name
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('institution_name',null,['class'=>'form-control','placeholder'=>'Enter Institution Name','id'=>'institution_name','list'=>'names','autocomplete'=>'off']) !!}
            <datalist id="names">

            </datalist>
            {!! $errors->first('institution_name', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('institution_address'))?'has-error':'' }} ">
            <label for="institution_address">Institution Address
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('institution_address',null,['class'=>'form-control','placeholder'=>'Enter Institution Address']) !!}
            {!! $errors->first('institution_address', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('institution_website'))?'has-error':'' }}">
            <label for="institution_website">Institution Website

            </label>
            {!! Form::text('institution_website',null,['class'=>'form-control','placeholder'=>'Enter Institution Website']) !!}
            {!! $errors->first('institution_website', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('institution_email_address'))?'has-error':'' }}">
            <label for="institution_email_address">Institution Email Address</label>
            {!! Form::text('institution_email_address',null,['class'=>'form-control','placeholder'=>'Enter Institution Email Address']) !!}
            {!! $errors->first('institution_email_address', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('institution_contact_number'))?'has-error':'' }}">
            <label for="institution_contact_number">Contact Number
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('institution_contact_number',null,['class'=>'form-control','placeholder'=>'Enter Contact Number']) !!}
            {!! $errors->first('institution_contact_number', '<span class="text-danger">:message</span>') !!}
        </div>


        <div class="form-group {{ ($errors->has('institution_pan_number'))?'has-error':'' }}">
            <label for="institution_pan_number">Institution PAN Number

            </label>
            {!! Form::number('institution_pan_number',null,['class'=>'form-control','placeholder'=>'Enter Institution PAN Number']) !!}
            {!! $errors->first('institution_pan_number', '<span class="text-danger">:message</span>') !!}
        </div>


        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary pull-right">Save</button>


            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>
@section('js')
    <script type="text/javascript">
        $('#closeErrorBar').click(function () {
            $('.errorBar').hide();

        });
    </script>
    <script>
        $(document).ready(function () {
            $("#institution_name").keyup(function () {
                $.get('{{url('get-institution-name')}}', {
                    name: $('#institution_name').val(),
                    getNameFrom: 'institution_name'
                }, function (data) {
                    console.log(data);

                    if (data <= 0) {
                        //tell user that the username already exists
                        // $('#names').hide();

                        console.log('not found');


                    } else {
                        console.log(data);

                        // $('#names').show();
                        $("#names").html(data);


                    }
                }, 'JSON');
            });
        })
    </script>
@stop