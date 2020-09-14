
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Title: {{$rem->reminder_title}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong>Date</strong>
                    <p class="text-muted" style="float:right">
                        {{$rem->reminder_date}}
                    </p>
                    <hr>


                    <strong>Document Type</strong>
                    <p class="text-muted" style="float:right">
                        {{$rem->document_type}}
                    </p>
                    <hr>

                    <strong>Content</strong>
                    <p class="text-muted"></p>

                        {{$rem->reminder_content}}
                    <hr>
                    <strong>Reminder Type</strong>
                    <p class="text-muted" style="float:right">
                        {{$rem->reminder_type}}
                    </p>
                    <hr>
                    <strong>Snooze date</strong>
                    <p class="text-muted" style="float:right">
                        <form action="{{url('reminder/snooze', $rem->id)}}" method="post">
                        {!!Form::text('reminder_snooze_date',$rem->reminder_snooze_date,array('class'=>'form_datetime','id'=>'datetimepicker','readonly'))!!}
                        <span class="add-on"><i class="icon-th"></i></span>
                        <button type="submit" class="">
                                <i class="fa fa-save"></i>
                            </button>
                            {{csrf_field()}}

                        </form>
                    </p>
                    <hr>
                    <strong>Email</strong>
                    <p class="text-muted">
                        {{$rem->reminder_to_email}}
                    </p>
                    <hr>
                    <strong>Remind to all</strong>
                    <p class="text-muted" style="float:right">
                        {{$rem->remind_to_all}}
                    </p>
                    <hr>
                    <strong>Reminder stack holder</strong>
                    <p class="text-muted" style="float:right">
                        {{$rem->reminder_stack_holder}}
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
