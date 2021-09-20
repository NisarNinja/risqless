<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('images/fav.svg')}}" type="image/gif" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="1ti6jj4fegtqyjf2cywihq8d02yezp" />
    <title>Risqless - Profile</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/gif" sizes="16x16">
   <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
   <!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/9406587.js"></script>
<!-- End of HubSpot Embed Code -->
   <style type="text/css" media="screen">
      .fa-download {
        color: #0be4eb !important;
      } 
   </style>

</head>

<body style="overflow-x:hidden;">

    <section class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('images/logo1.svg')}}" class="img-fluid log-size"> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white mr-3" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mr-3 text-white" href="{{ route('about-us') }}">Pricing</a>
                        </li>
                        @auth
                        <li class="nav-item menu-items">
                          <a class="nav-link text-white" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            
                            <span class="menu-icon">
                              <i class="mdi mdi-speedometer"></i>
                            </span>
                            <span class="menu-title">Logout</span>
                        </a>    
                        <form id="frm-logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </li> 
                        @endauth 
                         @guest
                        <li class="nav-item menu-items">
                          <a class="nav-link text-white" href="{{ route('user.login') }}">
                            
                            <span class="menu-icon">
                              <i class="mdi mdi-speedometer"></i>
                            </span>
                            <span class="menu-title">Login</span>
                        </a>    
                        </li> 
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if(!empty($ends_at) && $ends_at !== false)

            <div class="container">
                <div class="row justify-content-center mt-2">
                    <div class="col-md-6 col-10 text-center">
                        <div class=" mt-3 alert alert-warning border border-warning">
                            You have cancel you current subscription plan. 
                        </div>
                        <div class=" mt-3 alert alert-info border border-info">
                            <b>Note:</b> You are allowed to continue using an application for {{$ends_at}} days more.
                        </div>
                    </div>
                </div>  
            </div>
        @endif

        @if(Session::has('message'))

            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6 col-10 text-center">
                        <div class=" mt-3 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
                        </div>
                    </div>
                </div>  
            </div>
        @endif

        @if(!empty($trial_ends_at) && $trial_ends_at !== false)
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-md-6">
                    <div class="alert alert-warning text-center border border-warning" role="alert">
                        You have {{ $trial_ends_at }} days remaining of your trial version. Please use it as much as you like!
                    </div>
                    <div class="alert alert-warning text-center border border-warning" role="alert">
                        After your trial, you can take advantage of our monitoring services for less than $0.64 cents per day. 
                        Recurring billing will be on monthly basis.
                    </div>
                </div>
            </div>  
        @endif
        
        @if(!$posts->isEmpty())
        <div class="container mt-5 pt-5  pb-3 " id="data-chart">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6">
                    <canvas id="myChart-line" width="400" height="350"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="myChart-bar" width="400" height="350"></canvas>
                </div>
            </div>
        </div>
        @else
        <div id="data-chart">
            
        </div>
        @endif
        
        <div class="container mt-3 pt-3  pb-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12">
                    <div class="table-responsive" style="border-radius:20px; box-shadow:0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%) ">
                        <table class="table bg-file2 " id="statement_data" style="border-radius:20px;">
                            <thead>
                                <tr class="bg-table">
                                    <th class="text-white" scope="col">Sr No</th>
                                    <th class="text-white" scope="col">Start Date</th>
                                    <th class="text-white" scope="col">End Date</th>
                                    <th class="text-white" scope="col">Business Name</th>
                                    <th class="text-white" scope="col">Total Volume</th>
                                    <th class="text-white" scope="col">Total Fees</th>
                                    <th class="text-white" scope="col">Effective Rate</th>
                                    <th class="text-white" scope="col">Avoidable Fees</th>
                                    <th class="text-white" scope="col">Statement</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts AS $post)

                                <tr>
                                    <th scope="row bg-file" class="serial">{{$loop->iteration}}</th>
                                    <td>{{ $post->start_date }}</td>
                                    <td>{{ $post->end_date }}</td>
                                    <td>{{ $post->business_name }}</td>
                                    <td>$ {{ $post->total_volume }}</td>
                                    <td>$ {{ $post->total_fees }}</td>
                                    <td>{{ $post->effective_rate }}</td>
                                    <td>{{ $post->avoidable_fees }}</td>
                                    <td><a href="{{ asset('uploads/'.$post->statement) }}" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                </tr>

                                @empty
                                   <tr class="empty">
                                        <td colspan="9"><h4 class="text-center">No Data Available!</h4></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <br>

                </div>
            </div>
        </div>
    </section>
    <!-- =========================================File Upload card========================== -->
    <section class="bg-file">
        <div class="container ">
            <div class="row pt-5 pb-5 justify-content-center">
                <div class="col-md-7 mt-5  mb-5">
                    @if(!empty($third_party_login) && $third_party_login == true)
                        @include('user.templates.fake-upload')
                    @else
                       @include('user.templates.upload')     
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================footer==================================== -->
   <footer class="bg-foot">
        <div class="container">
            <div class="row pt-4 pb-4">
                <div class="col-md-3 pt-0 pt-md-4">
                    <img src="{{asset('images/logo-white.png')}}" class="img-fluid" width="120">
                </div>
                <div class="col-md-3 mt-4 mt-md-0">
                    <h6 class="text-white text-md-center text-left mt-4">clientsupport@risqless.ai</h6>
                </div>
                <div class="col-md-2 offset-md-1  mt-4 mt-md-0">
                    <h6 class="text-white mt-4 ">
                        <a href="https://www.risqless.ai/" class="text-white " >www.risqless.ai</a></h6>
                </div>
                <div class="col-md-3  mt-4 mt-md-0">
                        <a href="https://www.facebook.com/Risqless-101800842015793" class=" ml-0 ml-md-4 "  ><img src="{{asset('images/facebook.svg')}}" class="img-fluid mt-3" width="30"></a>
                        <a href="https://twitter.com/risqless" class=" ml-4 "  ><img src="{{asset('images/twitter.svg')}}" class="img-fluid mt-3" width="30"></a>
                        <a href="https://www.instagram.com/risqless/" class=" ml-4"   ><img src="{{asset('images/instagram.svg')}}" class="img-fluid mt-3" width="30"></a>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js" type="text/javascript" charset="utf-8"></script>

<script  type="text/javascript">

    // Rate Graph 
    var start_date = [], rate = [], volume = [];
    var created_at, effective_rate, total_volume;

    @forelse($posts AS $post)

        created_at = '{{$post->start_date}}';
        created_at = created_at.split(" ");
        start_date.push(created_at[0]);

        effective_rate = '{{$post->effective_rate}}'.replace('%','');
        rate.push(effective_rate);

        total_volume = '{{$post->total_volume}}'.replace(',','');
        volume.push(total_volume);

    @empty
        start_date = [];
        rate = [];
        volume = [];
    @endforelse

    var ctx = document.getElementById('myChart-line').getContext('2d');
    var myChartR = new Chart(ctx, {
        type: 'line',
        data: {
            labels: start_date,
            datasets: [{
                label: 'Rate Past 12 Months',
                data: rate,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
        responsive: true,
        interaction: {
          intersect: false,
          axis: 'x'
        },
        plugins: {
          title: {
            display: false,
            text: (ctx) => 'Rate Past 12 Months',
          }
        }
      }
    });

    // Volume Graph
    var ctx1 = document.getElementById('myChart-bar').getContext('2d');
    var myChartV = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: start_date,
            datasets: [{
                label: 'Volume Past 12 Months',
                data: volume,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
        responsive: true,
        interaction: {
          intersect: false,
          axis: 'x'
        },
        plugins: {
          title: {
            display: false,
            text: (ctx) => 'Volume Past 12 Months',
          }
        }
      }
    });
    // Chart END
</script>
<script  type="text/javascript">

    // DropZone
    Dropzone.options.dropzone =
         {
            maxFilesize: 5,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".pdf",
            addRemoveLinks: true,
            timeout: 50000000,
            success: function(file, response) 
            {
                if(response.status == 'true'){
                var startDate, endDate, merchantName, totalVolume, totalFees, effectiveRate, avoidableFees, uploadedFile, count;

                $.each(response.data, function(){
                    if(this.name == 'Statement Period Start'){
                        startDate = this.formattedValue;
                    }
                    if(this.name == 'Statement Period End'){
                        endDate = this.formattedValue;
                    }
                    if(this.name == 'Merchant Name'){
                        merchantName = this.formattedValue;
                    }
                    if(this.name == 'Total Volume'){
                        totalVolume = this.formattedValue;
                    }
                    if(this.name == 'Total Fees'){
                        totalFees = this.formattedValue;
                    }
                    if(this.name == 'Effective Rate'){
                        effectiveRate = this.formattedValue;
                    }
                    if(this.name == 'Avoidable Fees'){
                        if(this.formattedValue == null){
                            avoidableFees = '0.00';
                        }
                        else{
                            avoidableFees = this.formattedValue;
                        }
                        
                    }
                });

                uploadedFile = `{{ asset('uploads/`+response.file+`') }}`;
                count = $("#statement_data tbody tr").length;

                var rows = $("#statement_data tbody tr.empty").length

                if(rows === 1){
                    count = 1;
                }
                else{
                   count = 1 + count;
                }
                
                var temp = `<tr style="background-color: #d1ead1;">
                                <th scope="row bg-file" class="serial">`+count+`</th>
                                    <td>`+startDate+`</td>
                                    <td>`+endDate+`</td>
                                    <td>`+merchantName+`</td>
                                    <td>$ `+totalVolume+`</td>
                                    <td>$ `+totalFees+`</td>
                                    <td>`+effectiveRate+`</td>
                                    <td>`+avoidableFees+`</td>
                                    <td><a href="`+uploadedFile+`" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                </tr>`;

                if(rows === 1){

                        $("#statement_data tbody").html(temp);

                        let newChart = `<div class="row justify-content-center pb-5">
                                <div class="col-md-6">
                                    <canvas id="myChart-line" width="400" height="350"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="myChart-bar" width="400" height="350"></canvas>
                                </div>
                            </div>
                        </div>`;
                        $("#data-chart").html(newChart);
                        $("#data-chart").addClass('container mt-5 pt-5  pb-3');

                        effectiveRate = effectiveRate.replace('%','');
                        totalVolume = totalVolume.replace(',','');

                        start_date.push(startDate)
                        rate.push(effectiveRate)
                        volume.push(totalVolume)

                        var ctx = document.getElementById('myChart-line').getContext('2d');
                        var myChartR = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Rate Past 12 Months',
                                    data: rate,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Rate Past 12 Months',
                              }
                            }
                          }
                        });

                        // Volume Graph
                        var ctx1 = document.getElementById('myChart-bar').getContext('2d');
                        var myChartV = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Volume Past 12 Months',
                                    data: volume,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Volume Past 12 Months',
                              }
                            }
                          }
                        });
                        // Chart END
                        
                    }
                    else{

                        $("#statement_data tbody").append(temp);

                        let dataChart = `<div class="row justify-content-center pb-5">
                                <div class="col-md-6">
                                    <canvas id="myChart-line" width="400" height="350"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="myChart-bar" width="400" height="350"></canvas>
                                </div>
                            </div>`;
                        $("#data-chart").html(dataChart);

                        effectiveRate = effectiveRate.replace('%','');
                        totalVolume = totalVolume.replace(',','');

                        start_date.push(startDate)
                        rate.push(effectiveRate)
                        volume.push(totalVolume)


                        var ctx = document.getElementById('myChart-line').getContext('2d');
                        var myChartR = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Rate Past 12 Months',
                                    data: rate,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Rate Past 12 Months',
                              }
                            }
                          }
                        });

                        // Volume Graph
                        var ctx1 = document.getElementById('myChart-bar').getContext('2d');
                        var myChartV = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Volume Past 12 Months',
                                    data: volume,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Volume Past 12 Months',
                              }
                            }
                          }
                        });
                        // Chart END

                    }
                
                    $('.response .alert-danger').hide();
                    $('.response .alert-success').show();
                    $('.response .alert-success').fadeOut(5000)
                    $('.drag-drop').removeClass('mt-5').addClass('mt-2');

                    $('html, body').animate({
                        scrollTop: $("#statement_data").offset().top
                    }, 500);
                }
                if(response.status == 'false'){
                    $('.response .alert-success').hide();
                    $('.response .alert-danger').show();
                    $('.drag-drop').removeClass('mt-5').addClass('mt-2');
                }
            },
            error: function(file, response)
            {
                $('.response .alert-success').hide();
                $('.response .alert-danger').show();
                $('.drag-drop').removeClass('mt-5').addClass('mt-2');
            }
};
    
    $("input[name='imgupload']").on('input', function(e) {

        let ext = $("input[name='imgupload']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['pdf']) == -1 && e.target.files.length!= 0){

                 $('#file_error1').slideDown("slow");
                 $('#file_error2').slideUp("slow");
                 a=0;
             }
             else{
                
                 let picsize = (this.files[0].size);
                 if (picsize > 5000000){
                 $('#file_error2').slideDown("slow");
                 a=0;
                 }else{
                     a=1;
                     $('#file_error2').slideUp("slow");
                     $('#file_error3').slideUp("slow");

                    $('#OpenImgUpload').addClass('hide');
                    $('.btn-upload-loading').addClass('show');

                    var file = this.files[0];

                    setTimeout( function(){ 

                    $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('input[name="_token"]').val()
                          }
                      });

                    var formData = new FormData();
                    formData.append('file', file);

                    $.ajax({
                        url: "{{ route('dropzoneFileUpload') }}",
                        method: 'post',
                        data:formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function(response) 
                        {
                             if(response.status == 'true'){
                var startDate, endDate, merchantName, totalVolume, totalFees, effectiveRate, avoidableFees, uploadedFile, count;

                $.each(response.data, function(){
                    if(this.name == 'Statement Period Start'){
                        startDate = this.formattedValue;
                    }
                    if(this.name == 'Statement Period End'){
                        endDate = this.formattedValue;
                    }
                    if(this.name == 'Merchant Name'){
                        merchantName = this.formattedValue;
                    }
                    if(this.name == 'Total Volume'){
                        totalVolume = this.formattedValue;
                    }
                    if(this.name == 'Total Fees'){
                        totalFees = this.formattedValue;
                    }
                    if(this.name == 'Effective Rate'){
                        effectiveRate = this.formattedValue;
                    }
                    if(this.name == 'Avoidable Fees'){
                        if(this.formattedValue == null){
                            avoidableFees = '0.00';
                        }
                        else{
                            avoidableFees = this.formattedValue;
                        }
                        
                    }
                });

                uploadedFile = `{{ asset('uploads/`+response.file+`') }}`;
                count = $("#statement_data tbody tr").length;

                var rows = $("#statement_data tbody tr.empty").length

                if(rows === 1){
                    count = 1;
                }
                else{
                   count = 1 + count;
                }
                
                var temp = `<tr style="background-color: #d1ead1;">
                                <th scope="row bg-file" class="serial">`+count+`</th>
                                    <td>`+startDate+`</td>
                                    <td>`+endDate+`</td>
                                    <td>`+merchantName+`</td>
                                    <td>$ `+totalVolume+`</td>
                                    <td>$ `+totalFees+`</td>
                                    <td>`+effectiveRate+`</td>
                                    <td>`+avoidableFees+`</td>
                                    <td><a href="`+uploadedFile+`" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                </tr>`;

                if(rows === 1){

                        $("#statement_data tbody").html(temp);

                        let newChart = `<div class="row justify-content-center pb-5">
                                <div class="col-md-6">
                                    <canvas id="myChart-line" width="400" height="350"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="myChart-bar" width="400" height="350"></canvas>
                                </div>
                            </div>
                        </div>`;
                        $("#data-chart").html(newChart);
                        $("#data-chart").addClass('container mt-5 pt-5  pb-3');

                        effectiveRate = effectiveRate.replace('%','');
                        totalVolume = totalVolume.replace(',','');

                        start_date.push(startDate)
                        rate.push(effectiveRate)
                        volume.push(totalVolume)

                        var ctx = document.getElementById('myChart-line').getContext('2d');
                        var myChartR = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Rate Past 12 Months',
                                    data: rate,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Rate Past 12 Months',
                              }
                            }
                          }
                        });

                        // Volume Graph
                        var ctx1 = document.getElementById('myChart-bar').getContext('2d');
                        var myChartV = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Volume Past 12 Months',
                                    data: volume,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Volume Past 12 Months',
                              }
                            }
                          }
                        });
                        // Chart END
                        
                    }
                    else{

                        $("#statement_data tbody").append(temp);

                        let dataChart = `<div class="row justify-content-center pb-5">
                                <div class="col-md-6">
                                    <canvas id="myChart-line" width="400" height="350"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="myChart-bar" width="400" height="350"></canvas>
                                </div>
                            </div>`;
                        $("#data-chart").html(dataChart);

                        effectiveRate = effectiveRate.replace('%','');
                        totalVolume = totalVolume.replace(',','');

                        start_date.push(startDate)
                        rate.push(effectiveRate)
                        volume.push(totalVolume)


                        var ctx = document.getElementById('myChart-line').getContext('2d');
                        var myChartR = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Rate Past 12 Months',
                                    data: rate,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Rate Past 12 Months',
                              }
                            }
                          }
                        });

                        // Volume Graph
                        var ctx1 = document.getElementById('myChart-bar').getContext('2d');
                        var myChartV = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: start_date,
                                datasets: [{
                                    label: 'Volume Past 12 Months',
                                    data: volume,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                            responsive: true,
                            interaction: {
                              intersect: false,
                              axis: 'x'
                            },
                            plugins: {
                              title: {
                                display: false,
                                text: (ctx) => 'Volume Past 12 Months',
                              }
                            }
                          }
                        });
                        // Chart END

                    }
                
                    $('.response .alert-danger').hide();
                    $('.response .alert-success').show();
                    $('.response .alert-success').fadeOut(5000)
                    $('.drag-drop').removeClass('mt-5').addClass('mt-2');

                    $('html, body').animate({
                        scrollTop: $("#statement_data").offset().top
                    }, 500);
                }
                                if(response.status == 'false'){
                                    $('.response .alert-success').hide();
                                    $('.response .alert-danger').show();
                                    $('.drag-drop').removeClass('mt-5').addClass('mt-2');
                                }

                            $('.btn-upload-loading').removeClass('show');
                            $('#OpenImgUpload').removeClass('hide');
                            
                        },
                        error: function(response)
                        {
                            $('.response .alert-success').hide();
                            $('.response .alert-danger').show();
                            $('.drag-drop').removeClass('mt-5').addClass('mt-2');
                            $('.btn-upload-loading').removeClass('show');
                            $('#OpenImgUpload').removeClass('hide');
                        }
                    });
                }  , 2000 );
                 }
                 $('#file_error1').slideUp("slow");
                 if (a==1){

             }
            }
        });
    </script>
</body>

</html>