<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Risqless - File Upload</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>

    <script>
        var dropzone = new Dropzone('#file-upload', {
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            parallelUploads: 3,
            thumbnailHeight: 150,
            thumbnailWidth: 150,
            maxFilesize: 5,
            filesizeBase: 1500,
            acceptedFiles: ".pdf",
            thumbnail: function (file, dataUrl) {

                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }
                    setTimeout(function () {
                        file.previewElement.classList.add("dz-image-preview");
                    }, 1);
                }
            }
        });
        
        var minSteps = 6,
            maxSteps = 60,
            timeBetweenSteps = 100,
            bytesPerStep = 100000;

        dropzone.uploadFiles = function (files) {
            var self = this;

            for (var i = 0; i < files.length; i++) {

                var file = files[i];
                totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                for (var step = 0; step < totalSteps; step++) {
                    var duration = timeBetweenSteps * (step + 1);
                    setTimeout(function (file, totalSteps, step) {
                        return function () {
                            file.upload = {
                                progress: 100 * (step + 1) / totalSteps,
                                total: file.size,
                                bytesSent: (step + 1) * file.size / totalSteps
                            };

                            self.emit('uploadprogress', file, file.upload.progress, file.upload
                                .bytesSent);
                            if (file.upload.progress == 100) {
                                file.status = Dropzone.SUCCESS;
                                self.emit("success", file, 'success', null);
                                self.emit("complete", file);
                                self.processQueue();
                            }
                        };
                    }(file, totalSteps, step), duration);
                }
            }
        }

    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/gif" sizes="16x16">
</head>

<body>

    <section class="main-section">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('images/logo1.svg')}}" class="img-fluid log-size"> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link mr-3" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about-us') }}">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5 pt-5  pb-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table shadow bg-file2 ">
                            <thead>
                                <tr class="bg-table">
                                    <th class="text-white" scope="col">Sr No</th>
                                    <th class="text-white" scope="col">Month</th>
                                    <th class="text-white" scope="col">Business Name</th>
                                    <th class="text-white" scope="col">Total Sales</th>
                                    <th class="text-white" scope="col">Total Fees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row bg-file">1</th>
                                    <td>January</td>
                                    <td>Mark</td>
                                    <td>10000</td>
                                    <td>122222</td>
                                </tr>
                                <tr>
                                    <th scope="row bg-file">2</th>
                                    <td>February</td>
                                    <td>Mark</td>
                                    <td>12000</td>
                                    <td>12223</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>March</td>
                                    <td>Mark</td>
                                    <td>140000</td>
                                    <td>12222</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>April</td>
                                    <td>Mark</td>
                                    <td>100000</td>
                                    <td>10000</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>May</td>
                                    <td>Mark</td>
                                    <td>12000</td>
                                    <td>1200</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>June</td>
                                    <td>Mark</td>
                                    <td>12000</td>
                                    <td>1200</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>July</td>
                                    <td>Mark</td>
                                    <td>12000</td>
                                    <td>1200</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =========================================File Upload card========================== -->
    <section class="bg-file">
        <div class="container ">
            <div class="row pt-5 pb-5 justify-content-center">
                <div class="col-md-7 mt-5 mb-5">
                    <div class="card border-0 shadow-lg b-radius">
                        <div class="card-body p-0" style="padding-left: 0.9rem !important;">
                            <div class="row">
                                <div class="col-6 bg-file b-radius1">
                                    <h5 class="text-white text-center font-weight-bold mt-4 mb-4">Instant Saving
                                        Calulator</h5>
                                </div>
                                <div class="col-6">
                                    <div class="ribbon">
                                        <span class="ribbon4">100% Free</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row pt-4 pb-4">
                                <div class="col-md-12">

                                	<div id="dropzone">
								        <form action="{{ route('dropzoneFileUpload') }}" class="dropzone" id="file-upload" enctype="multipart/form-data">
								            @csrf
								            <h5 class="text-center font-weight-normal"> Drag and Drop Your Pdf Merchant
                                        Statement Here </h5>
								        </form>
								    </div>
                                    



                                    <h5 class="font-weight-bold text-center">OR</h5>
                                    <div class="text-center">
                                        <input type="file" id="imgupload" style="display:none" accept=".pdf" />
                                        <button class="btn btn-upload mt-2 mb-5" id="OpenImgUpload"> Start Now</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


     <!-- ============================================footer==================================== -->
    <footer class="bg-foot">
        <div class="container">
            <div class="row pt-5 pb-3">
                <div class="col-md-4 pt-0 pt-md-4">
                    <img src="{{ asset('images/logo-white.png') }}" class="img-fluid" width="120">
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <h6 class="text-white text-md-center text-left mt-4"><a href="mailto:clientsupport@risqless.ai">clientsupport@risqless.ai</a></h6>
                </div>
                <div class="col-md-3 offset-md-1 mt-4 mt-md-0">
                    <h6 class="text-white ">555 SE MLK Junior Boulevard <br>
                        Suite 105<br>
                        Portland, Or 97214</h6>
                </div>
            </div>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script>
        $('#OpenImgUpload').click(function () { $('#imgupload').trigger('click'); });

    </script>
</body>

</html>