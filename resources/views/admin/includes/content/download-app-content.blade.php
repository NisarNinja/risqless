<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Download App</h4>
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
                                                        <h6 class="text-muted">Instructions<span style="color:red;">*</span></h6>
                                                        {{ Form::label('download_app_bg_image','Background Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="download_app_bg_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-100" src="{{(!empty($content->download_app_bg_image)) ? $content->download_app_bg_image : asset('images/1920 _ 422px.png')}}">
                                                        </label>
                                                        {{ Form::file('download_app_bg_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->download_app_bg_image)) ? '' : 'download_app_bg_image','id' => 'download_app_bg_image')) }}
                                                        {!! $errors->first('download_app_bg_image', '<label id="download_app_bg_image-error" class="error" for="download_app_bg_image">:message</label>') !!}
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
                                                        {{ Form::label('download_app_r1_image','First Right Image') }}<span style="color:red;">*</span>
                                                        <br>
                                                        <label for="download_app_r1_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-50" src="{{(!empty($content->download_app_r1_image)) ? $content->download_app_r1_image : asset('images/229 _ 456px.png')}}" height="400px">
                                                        </label>
                                                        {{ Form::file('download_app_r1_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->download_app_r1_image)) ? '' : 'download_app_r1_image','id' => 'download_app_r1_image')) }}
                                                        {!! $errors->first('download_app_r1_image', '<label id="download_app_r1_image-error" class="error" for="download_app_r1_image">:message</label>') !!}
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
                                                        {{ Form::label('download_app_r2_image','Second Right Image') }}<span style="color:red;">*</span>

                                                        <br>
                                                        <label for="download_app_r2_image" style="cursor: pointer;width: 100%">
                                                            <img class="modal-img output w-50" src="{{(!empty($content->download_app_r2_image)) ? $content->download_app_r2_image : asset('images/229 _ 456px.png')}}" height="400px">
                                                        </label>
                                                        {{ Form::file('download_app_r2_image',array('class'=>'form-control image d-none', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image', 'data-validate-field' => (!empty($content->download_app_r2_image)) ? '' : 'download_app_r2_image','id' => 'download_app_r2_image')) }}
                                                        {!! $errors->first('download_app_r2_image', '<label id="download_app_r2_image-error" class="error" for="download_app_r2_image">:message</label>') !!}
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
                                                        {{ Form::label('download_app_h','Heading') }}<span style="color:red;">*</span>
                                                        {{ Form::text('download_app_h',old('download_app_h'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'download_app_h')) }}
                                                        {!! $errors->first('download_app_h', '<label id="download_app_h-error" class="error" for="download_app_h">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('download_app_p','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::textarea('download_app_p',old('download_app_p'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'download_app_p')) }}
                                                        {!! $errors->first('download_app_p', '<label id="download_app_p-error" class="error" for="download_app_p">:message</label>') !!}
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