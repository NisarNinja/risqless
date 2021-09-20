<!--    ********************************************
                About Us CONTENT 
******************************************** -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card card-collapsed ">
                                        <div class="card-header header-elements-inline p-2">
                                            <h4 class="card-title">Copyrights</h4>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            
 
                                            <div class="container pl-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{ Form::label('copyright','Paragraph') }}<span style="color:red;">*</span>
                                                        {{ Form::text('copyright',old('copyright'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Write here...', 'data-validate-field' => 'copyright')) }}
                                                        {!! $errors->first('copyright', '<label id="copyright-error" class="error" for="copyright">:message</label>') !!}
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