<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Footer</h4>
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
                                                        {{ Form::label('footer_logo','Logo') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="footer_logo" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->footer_logo)) ? $content->footer_logo : asset('images/203 _ 48px.png')}}">
                                                        </label>

                                                        {{ Form::file('footer_logo',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->footer_logo)) ? '' : 'footer_logo','id' => 'footer_logo' )) }}
                                                        {!! $errors->first('footer_logo', '<label id="footer_logo-error" class="error" for="footer_logo">:message</label>') !!}
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
                                                        {{ Form::label('footer_bg_image','Background Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="footer_bg_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->footer_bg_image)) ? $content->footer_bg_image : asset('images/1920 _ 520px.png')}}">
                                                        </label>

                                                        {{ Form::file('footer_bg_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->footer_bg_image)) ? '' : 'footer_bg_image','id' => 'footer_bg_image' )) }}
                                                        {!! $errors->first('footer_bg_image', '<label id="footer_bg_image-error" class="error" for="footer_bg_image">:message</label>') !!}
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
                                                        {{ Form::label('footer_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('footer_p',old('footer_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'footer_p')) }}
                                                        {!! $errors->first('footer_p', '<label id="footer_p-error" class="error" for="footer_p">:message</label>') !!}
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