<div class="card border-0 shadow-lg b-radius">
                        <div class="card-body p-0" >
                            
                            <div class="row mt-5 response justify-content-center">
                                <div class="col-md-10 col-11">
                                    <div class="alert alert-success" role="alert">
                                      Your file is successfully uploaded. We will contact you shortly.
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                      Sorry! something went wrong in uploading file. Please try again.
                                    </div>
                                </div>
                            </div>  
                            <div class="row  drag-drop justify-content-center">
                                <div class="col-md-10 col-11">
                                    <div >
                                        <form action="{{ route('dropzoneFileUpload') }}" class="dropzone" id="dropzone" enctype="multipart/form-data" style="border: 2px dotted  #6C757D;">
                                            @csrf
                                            <h6 class="text-center font-weight-bold text-uppercase text-muted mb-4" style="font-size:1em; "> <img src="{{ asset('images/upload1.png')}}"  class="img-fluid mt-5"> <br> <br>
                                        Drag & drop to upload </h6>
                                        <h5 class="text-center font-weight-bold text-uppercase text-muted" style="font-size:0.8em; margin-bottom:4rem;"> 
                                        use original PDF files or <br> <br> scan documents using genius scan app </h5>
                                        <!--Drop files here to upload-->
                                        <div class="dz-message" data-dz-message><span></span></div>
                                        </form>
                                    </div>
                                    <h5 class="font-weight-bold text-center">OR</h5>
                                    <div class="text-center">
                                        <input type="file" id="imgupload" style="display:none" name="imgupload[]" multiple="" accept=".pdf" />
                                        <button class="btn btn-upload mt-2 mb-5" id="OpenImgUpload"> Upload
                                        </button>
                                        <button class="btn btn-upload-loading mt-2 mb-5" type="">
                                            <img src="{{asset('images/loading.gif')}}" alt="" width="40px" height="40px">
                                        </button>

                                        <div id="uploadsts"></div>

                                        <p class="alert alert-danger" role="alert" id="file_error1" style="display:none; color:#B81111;font-weight: 500;">
                                            Invalid File Format! File Format Must Be Pdf.
                                            </p>

                                            <p class="alert alert-danger" role="alert" id="file_error2" style="display:none; color:#B81111;font-weight: 500;">
                                            Maximum File Size Limit is 5MB.
                                            </p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>