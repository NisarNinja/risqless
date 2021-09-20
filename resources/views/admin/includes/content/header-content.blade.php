
                        <!--    ********************************************
                                            HEADER CONTENT 
                                ******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Header</h4>
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
                                                        {{ Form::label('header_logo','Logo') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="header_logo" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{ (!empty($content->header_logo)) ? $content->header_logo : asset('images/203 _ 48px.png')}}">
                                                        </label>

                                                        {{ Form::file('header_logo',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->header_logo)) ? '' : 'header_logo','id' => 'header_logo' )) }}
                                                        {!! $errors->first('header_logo', '<label id="header_logo-error" class="error" for="header_logo">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('header_bg_image','Backgroung Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="header_bg_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->header_bg_image)) ? $content->header_bg_image : asset('images/1920 _ 1172px.png')}}">
                                                        </label>
                                                        {{ Form::file('header_bg_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->header_bg_image)) ? '' : 'header_bg_image','id' => 'header_bg_image')) }}
                                                        {!! $errors->first('header_bg_image', '<label id="header_bg_image-error" class="error" for="header_bg_image">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('header_f_image','Front Image (Display on right side)') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="header_f_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->header_f_image)) ? $content->header_f_image : asset('images/982 _ 853px.png')}}">
                                                        </label>
                                                        {{ Form::file('header_f_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->header_f_image)) ? '' : 'header_f_image','id' => 'header_f_image')) }}
                                                        {!! $errors->first('header_f_image', '<label id="header_f_image-error" class="error" for="header_f_image">:message</label>') !!}
                                                        <p class="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p class="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('header_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('header_h',old('header_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'header_h')) }}
                                                        {!! $errors->first('header_h', '<label id="header_h-error" class="error" for="header_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('header_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('header_p',old('header_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'header_p')) }}
                                                        {!! $errors->first('header_p', '<label id="header_p-error" class="error" for="header_p">:message</label>') !!}
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