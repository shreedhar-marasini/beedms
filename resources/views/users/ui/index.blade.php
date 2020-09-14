
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12">
                            <a href="{{url('user/ui/clear')}}" class="pull-right">Clear Setting</a>
                            <p class="page-header">Skins</p>
                            <ul class="list-unstyled">

                                <li style="float:left; width: 25%; padding: 5px;<?php if($skin == "skin-blue-light" && $user->_UI_SKIN_== "skin-blue-light") echo "border:#00A6C7 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-blue-light')}}"
                                       data-skin="skin-blue-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class=" full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9"></span>
                                            <span class="bg-light-blue"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Blue Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if($skin == "skin-black-light") echo "border:#a2a2a2 solid 1px";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-black-light')}}"
                                       data-skin="skin-black-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span>
                                            <span style="display:block; width: 80%; float: left; height: 21px; background: #fefefe"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Black Light</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-purple-light") echo "border:mediumpurple solid 1px; margin:0px!important";?>">
                                    <a
                                            href="{{url('user/uiChangeSkin/skin-purple-light')}}"
                                            data-skin="skin-purple-light"
                                            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                            class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-purple-active"></span>
                                            <span class="bg-purple"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 123px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 123px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Purple Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-green-light") echo "border:#2ab27b solid 1px;";?>">
                                    <a
                                            href="{{url('user/uiChangeSkin/skin-green-light')}}"
                                            data-skin="skin-green-light"
                                            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                            class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-green-active"></span>
                                            <span class="bg-green"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Green Light</p>
                                </li>


                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-red-light") echo "border:#dd4b39 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-red-light')}}"
                                       data-skin="skin-red-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-red-active"></span>
                                            <span class="bg-red"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Red Light</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px; <?php if ($skin == "skin-yellow-light") echo "border:#f39c12 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-yellow-light')}}"
                                       data-skin="skin-yellow-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-yellow-active"></span>
                                            <span class="bg-yellow"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #f9fafc"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px; <?php if ($skin == "skin-blue") echo "border:#00A6C7 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-blue')}}"
                                       data-skin="skin-blue-light"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9">
                                                  </span>
                                            <span class="bg-light-blue"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin" style="font-size: 12px">Blue</p>
                                </li>


                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-black") echo "border:#a2a2a2 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-black')}}"
                                       data-skin="skin-black"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span
                                                    style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span><span
                                                    style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Black</p>
                                </li>

                                <li style="float:left; width: 25%; padding: 5px; <?php if ($skin == "skin-purple") echo "border:mediumpurple solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-purple')}}" data-skin="skin-purple"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-purple-active"></span>
                                            <span class="bg-purple"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Purple</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-green") echo "border:#2ab27b solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-green')}}" data-skin="skin-green"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-green-active"></span>
                                            <span class="bg-green"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Green</p>
                                </li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-red") echo "border:#dd4b39 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-red')}}" data-skin="skin-red"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-red-active"></span>
                                            <span class="bg-red"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Red</p></li>
                                <li style="float:left; width: 25%; padding: 5px;<?php if ($skin == "skin-yellow") echo "border:#f39c12 solid 1px;";?>">
                                    <a href="{{url('user/uiChangeSkin/skin-yellow')}}" data-skin="skin-yellow"
                                       style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                       class="clearfix full-opacity-hover">
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 21px;"
                                                  class="bg-yellow-active"></span>
                                            <span class="bg-yellow"
                                                  style="display:block; width: 80%; float: left; height: 21px;"></span>
                                        </div>
                                        <div>
                                            <span style="display:block; width: 20%; float: left; height: 125px; background: #222d32"></span>
                                            <span style="display:block; width: 80%; float: left; height: 125px; background: #f4f5f7"></span>
                                        </div>
                                    </a>
                                    <p class="text-center no-margin">Yellow</p>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-12 col-sm -12 col-sm-12 col-xs-12">

                            <p class="page-header">Layouts</p>
                            <form>

                                @foreach($masterSetting as $setting)
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <input type="checkbox" data-toggle="toggle" data-size="mini"
                                                   data-id="<?=$setting->key_name?>"
                                                   data-layout="fixed" class="pull-right master_layouts"
                                                   name="{{$setting->key_name}}"
                                                    {{ ($user[$setting->key_name]=='1')?'checked':null }}
                                            >
                                            <strong>{{$setting->key_label}}</strong></label>
                                        <p class="help-block">{{$setting->key_description}}</p>
                                        <br>
                                    </div>

                                @endforeach


                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
