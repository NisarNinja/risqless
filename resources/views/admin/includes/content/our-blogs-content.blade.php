<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Our Blogs</h4>
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

                                                        {{ Form::label('our_blogs_bg_image','Backgroung Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="our_blogs_bg_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->our_blogs_bg_image)) ? $content->our_blogs_bg_image : asset('images/920 _ 986px.png')}}">
                                                        </label>
                                                        {{ Form::file('our_blogs_bg_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->our_blogs_bg_image)) ? '' : 'our_blogs_bg_image','id' => 'our_blogs_bg_image')) }}
                                                        {!! $errors->first('our_blogs_bg_image', '<label id="our_blogs_bg_image-error" class="error" for="our_blogs_bg_image">:message</label>') !!}
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
                                                        {{ Form::label('our_blogs_rt_image','Top Right Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="our_blogs_rt_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->our_blogs_rt_image)) ? $content->our_blogs_rt_image : asset('images/270 _ 280px.png')}}">
                                                        </label>
                                                        {{ Form::file('our_blogs_rt_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->our_blogs_rt_image)) ? '' : 'our_blogs_rt_image','id' => 'our_blogs_rt_image')) }}
                                                        {!! $errors->first('our_blogs_rt_image', '<label id="our_blogs_rt_image-error" class="error" for="our_blogs_rt_image">:message</label>') !!}
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
                                                        {{ Form::label('our_blogs_bl_image','Bottom Left Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="our_blogs_bl_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->our_blogs_bl_image)) ? $content->our_blogs_bl_image : asset('images/272 _ 153px.png')}}">
                                                        </label>
                                                        {{ Form::file('our_blogs_bl_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->our_blogs_bl_image)) ? '' : 'our_blogs_bl_image','id' => 'our_blogs_bl_image')) }}
                                                        {!! $errors->first('our_blogs_bl_image', '<label id="our_blogs_bl_image-error" class="error" for="our_blogs_bl_image">:message</label>') !!}
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
                                                        {{ Form::label('our_blogs_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('our_blogs_h',old('our_blogs_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'our_blogs_h')) }}
                                                        {!! $errors->first('our_blogs_h', '<label id="our_blogs_h-error" class="error" for="our_blogs_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('our_blogs_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('our_blogs_p',old('our_blogs_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'our_blogs_p')) }}
                                                        {!! $errors->first('our_blogs_p', '<label id="our_blogs_p-error" class="error" for="our_blogs_p">:message</label>') !!}
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