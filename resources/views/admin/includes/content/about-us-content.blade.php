<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">About Us</h4>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            
 
                                            <div class="container pl-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('about_us_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('about_us_h',old('about_us_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'about_us_h')) }}
                                                        {!! $errors->first('about_us_h', '<label id="about_us_h-error" class="error" for="about_us_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('about_us_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('about_us_p',old('about_us_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'about_us_p')) }}
                                                        {!! $errors->first('about_us_p', '<label id="about_us_p-error" class="error" for="about_us_p">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>