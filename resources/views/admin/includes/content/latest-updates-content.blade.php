<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Latest Updates</h4>
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
                                                        {{ Form::label('updates_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('updates_h',old('updates_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'updates_h')) }}
                                                        {!! $errors->first('updates_h', '<label id="updates_h-error" class="error" for="updates_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('updates_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('updates_p',old('updates_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'updates_p')) }}
                                                        {!! $errors->first('updates_p', '<label id="updates_p-error" class="error" for="updates_p">:message</label>') !!}
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