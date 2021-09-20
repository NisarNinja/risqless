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
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/gif" sizes="16x16">
   <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
 
   <style type="text/css" media="screen">
      .fa-download {
        color: #0be4eb !important;
      } 
   </style>

</head>

<body style="overflow-x:hidden;">

    <section class="">
         
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
        <div class="container" id="data-chart">
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
        
        <div class="container mt-3 pt-3">
            <div class="row justify-content-center">
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
 
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
 
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
 
</body>

</html>