<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Contact Us</h4>
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
                                                        {{ Form::label('contact_us_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('contact_us_h',old('contact_us_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'contact_us_h')) }}
                                                        {!! $errors->first('contact_us_h', '<label id="contact_us_h-error" class="error" for="contact_us_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        
                                                        {{ Form::label('location_image','Location Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="location_image" style="cursor: pointer;width: 75%">
                                                            <img class="modal-img output" src="{{(!empty($content->location_image)) ? $content->location_image : asset('images/48 _ 48px.png')}}" height="110px" width="110px">
                                                        </label>
                                                        {{ Form::file('location_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->location_image)) ? '' : 'location_image','id' => 'location_image')) }}
                                                        {!! $errors->first('location_image', '<label id="location_image-error" class="error" for="location_image">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-3">
                                                        {{ Form::label('location','Location') }}<span style="color:red;">*</span>
                                                        {{ Form::text('location',old('location'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'location')) }}
                                                        {!! $errors->first('location', '<label id="location-error" class="error" for="location">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        
                                                        {{ Form::label('phone_image','Phone Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="phone_image" style="cursor: pointer;width: 75%">
                                                            <img class="modal-img output" src="{{(!empty($content->phone_image)) ? $content->phone_image : asset('images/48 _ 48px.png')}}" height="110px" width="110px">
                                                        </label>
                                                        {{ Form::file('phone_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->phone_image)) ? '' : 'phone_image','id' => 'phone_image')) }}
                                                        {!! $errors->first('phone_image', '<label id="phone_image-error" class="error" for="phone_image">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-3">
                                                        {{ Form::label('phone','Phone') }}<span style="color:red;">*</span>
                                                        {{ Form::text('phone',old('phone'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'phone')) }}
                                                        {!! $errors->first('phone', '<label id="phone-error" class="error" for="phone">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        
                                                        {{ Form::label('email_image','Email Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="email_image" style="cursor: pointer;width: 75%">
                                                            <img class="modal-img output" src="{{(!empty($content->email_image)) ? $content->email_image : asset('images/48 _ 48px.png')}}" height="110px" width="110px">
                                                        </label>
                                                        {{ Form::file('email_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->email_image)) ? '' : 'email_image','id' => 'email_image')) }}
                                                        {!! $errors->first('email_image', '<label id="email_image-error" class="error" for="email_image">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-3">
                                                        {{ Form::label('email','Email') }}<span style="color:red;">*</span>
                                                        {{ Form::text('email',old('email'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'email')) }}
                                                        {!! $errors->first('email', '<label id="email-error" class="error" for="email">:message</label>') !!}
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