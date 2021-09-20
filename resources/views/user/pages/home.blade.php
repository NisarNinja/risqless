
@extends('user.layouts.app')

@section('title', 'Home')

@section('content')
<script src="{{ asset('js/app.js') }}" defer></script>
    <section class="main-section">
        
        <nav class="navbar navbar-expand-lg navbar-light  p-0res bg-nav">
            <div class="container-fluid padding-col padding-col2">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo1.svg') }}" class="img-fluid log-size" > </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link mr-3 text-white" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mr-3  text-white" href="{{ route('about-us') }}">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mr-3  text-white" href="{{ route('about-us') }}#faq">FAQs</a>
                        </li>
                        @auth
                        <li class="nav-item menu-items">
                          <a class="nav-link text-white " href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            
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
                          <a class="nav-link  text-white" href="{{ route('user.login') }}">
                            
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
        <div class="container-fluid">
            <div class="row pb-5">
                <div class="col-md-9 padding-col">
                    <h1 class="font-weight-bold size-1 text-white">Reduce the fees for accepting <br> credit cards <u><i>without switching</i></u><br> your processor.</h1>
                    <p class="size-2 text-white font-weight-bold mt-4">Fee Monitoring Powered by Artificial Intelligence</p>
                    <p class="size-2 text-white ">Gain more. Risk less.</p>
<!--<h1 class="font-weight-bold size-1 text-white">UPLOAD</h1>-->
<!--                    <p class="size-2 text-white font-weight-bold ">Your latest processing statement</p>-->
<!--                    <h1 class="font-weight-bold size-5 text-white">AUDIT</h1>-->
<!--                    <p class="size-2 text-white font-weight-bold ">Our AI program will identify fees that can be lowered</p>-->
<!--                    <h1 class="font-weight-bold size-5 text-white">MONITOR</h1>-->
<!--                    <p class="size-2 text-white font-weight-bold ">We will alert you of avoidable price increases</p>-->
                    @auth
                    <a href="{{ route('file') }}" class="btn btn-upload2 mt-4 mb-5 " > Free 7 Day Trial</a>
                    @endauth

                    @guest
                    <a href="#register-section" class="btn btn-upload2 mt-4 mb-5 " > Free 7 Day Trial</a>
                    @endguest
                </div>
                <div class="col-md-7 pr-0 mt-5 pt-0 pt-md-5">
                    <!--<div class="text-right">-->
                    <!--    <img src="{{ asset('images/computer.png') }}" class="img-fluid"  >-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </section>
     <!-- =========================video============ -->
  <section class="pt-5 mt-5 " >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <iframe width="100%" height="415" src="https://www.youtube.com/embed/NORbf8Y-HSU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    </section>
  
    <!-- =======================================Section2============================ -->
    <section class="pt-5 ">
        <div class="container pt-5 pb-2">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="text-capitalize color-1 size-3 text-center">Analysis you can trust</h1>
                    <p class="size-2 text-muted  mt-5">
                        Risqless is an independent analysis company that provides businesses with a fast and easy way to know how much they are paying for credit card processing. 
 <br><br>
We help make smarter financial decisions for your business with the assistance of an artificial intelligence program nicknamed ‘Tempus’ to analyze your credit card processing statements. 
 <br><br>
Tempus provides you with actionable insights on how to reduce 10% - 30% in fees. Use our data to renegotiate with your current provider and reduce fees for accepting credit cards without changing processors.
 <br>


                    </p>
                </div>
            </div>
            <div class="row mt-5 mb-5 ">
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{asset('images/audit.png')}}" class="img-fluid mt-3">
                                <h5 class="font-weight-bold mt-4">Audit</h5>
                            </div>
                            <p class="size-2 text-muted mt-3 mb-5 text-center">We analyze every fee on your merchant processing statement. <br> <br></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{asset('images/start.png')}}" class="img-fluid mt-3">
                                <h5 class="font-weight-bold mt-4">Strategy</h5>
                            </div>
                            <p class="size-2 text-muted mt-3 mb-5 text-center">Identify potential re-classifications, hidden discounts, and unnecessary fees.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{asset('images/imp.png')}}" class="img-fluid mt-3" width="53">
                                <h5 class="font-weight-bold mt-4">Implementation</h5>
                            </div>
                            <p class="size-2 text-muted mt-3 mb-5 text-center">Use the data to restructure your current plan.<br> <br></p>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Register Template -->
            @include('user.templates.register')


            <!--<div class="row">-->
            <!--    <div class="col-md-12">-->
            <!--        <div class="text-center">-->
            <!--            @auth-->
            <!--            <a href="{{ route('file') }}" class="btn btn-upload"> Start 7 Days Trail</a>-->
            <!--            @endauth-->
            <!--            @guest-->
            <!--            <a href="{{ route('user.show.register') }}" class="btn btn-upload"> Start 7 Days Trail</a>-->
            <!--            @endguest-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- ===================================Why part drag drop done====================== -->
            <!--<div class="row pt-5">-->
            <!--    <div class="col-md-12">-->
            <!--        <h1 class="text-capitalize color-1 size-3 text-center">Why?</h1>-->
            <!--        <p class="size-2 text-muted text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.-->
            <!--        </p>-->

            <!--    </div>-->
            <!--</div>-->
            
            <!--<div class="row mt-5 pb-5 justify-content-center">-->
            <!--    <div class="col-md-1 col-4 mt-4 mt-md-0 ">-->
            <!--        <div class="card custom-card2">-->
            <!--            <div class="card-body p-3">-->
            <!--                <h4 class="text-white text-center font-weight-bold pt-3">Drag </h4>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
                
            <!--    <div class="col-md-1 col-4 mt-4 mt-md-0 offset-md-2">-->
            <!--        <div class="card custom-card2">-->
            <!--            <div class="card-body p-3">-->
            <!--                <h4 class="text-white text-center font-weight-bold pt-3">Drop </h4>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-1 col-4 mt-4 mt-md-0 offset-md-2">-->
            <!--        <div class="card custom-card2">-->
            <!--            <div class="card-body p-3">-->
            <!--                <h4 class="text-white text-center font-weight-bold pt-3">Done </h4>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </section>
    <!-- ====================================Section3==================================== -->
    <section>
        <div class="container ">
            <!-- ====================================Why bottom robort image============================= -->
            <div class="row  justify-content-center">
                <div class="col-md-5">
                    <div class="text-center">
                        <script
                            src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_4vmhlbaq.json"
                            background="transparent" speed="1" class="img-fluid" loop autoplay>
                        </lottie-player>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <div class="text-center">
                        @auth
                        <a href="{{ route('file') }}" class="btn btn-upload mt-5"> Free 7 Day Trial</a>
                        @endauth
                        @guest
                        <a href="#register-section" class="btn btn-upload mt-5"> Free 7 Day Trial</a>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- =======================================How it works====================================== -->
            <div class="row pt-5 justify-content-center pb-5">
                <div class="col-md-8 pt-0 pt-md-5">
                    <h1 class="text-capitalize color-1 size-3 text-center">How It works</h1>
                    <!--<h5 class="font-weight-normal mt-2 text-center">Try it out for 7 days</h5>-->


                </div>
            </div>
        </div>
    </section>
    <!-- =================================Section4====================================== -->
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center pt-5 pb-5">
                <div class="col-md-4 col-4 pt-5" >
                    <h5 class="font-weight-bold">CONNECT</h5>
                    <p class="size-2 text-muted mt-3">
                        Create your account and upload your statement  to begin a
                        <span class="color-2 font-weight-bold">7 day</span> free trial.
                    </p>
                    <div class="text-center">
                        <img src="{{asset('images/mob1.png')}}" class="img-fluid mt-4">
                    </div>
                    <br>
                    <h5 class="font-weight-bold mt-3">LOGIN & DOWNLOAD</h5>
                    <p class="size-2 text-muted mt-3">You will receive an email when your analysis is complete. Simply login and download your report.
</p>
                    <div class="text-center">
                        <img src="{{asset('images/mob2.png')}}" class="img-fluid mt-4">
                    </div>
                    <br>
                    <h5 class="font-weight-bold mt-3">WE WILL KEEP AN EYE ON THINGS</h5>
                    <p class="size-2 text-muted mt-3">For less than $0.64 per day, our monthly reporting will let you know if you are getting the pricing you had enrolled in.</p>
                </div>
                <div class="col-md-2 col-2 pt-5" >
                    <div class="text-center">
                        <img src="{{asset('images/file.png')}}" class="img-fluid" width="90">
                        <br>
                        <img src="{{asset('images/Line 1.png')}}" class="img-fluid h-line" >
                        <br>
                        <img src="{{asset('images/stop.png')}}" class="img-fluid" width="90">
                        <br>
                        <img src="{{asset('images/Line 1.png')}}" class="img-fluid h-line" >
                        <br>
                        <img src="{{asset('images/lock.png')}}" class="img-fluid" width="90">
                        <br>
                        <img src="{{asset('images/Line 1.png')}}" class="img-fluid h-line" >
                        <br>
                        <img src="{{asset('images/shake.png')}}" class="img-fluid" width="90">
                        <br>
                        <img src="{{asset('images/Line 1.png')}}" class="img-fluid h-line" >
                        <br>
                        <img src="{{asset('images/search.png')}}" class="img-fluid" width="90">
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="text-center">
                        <img src="{{asset('images/mob3.png')}}" class="img-fluid">
                    </div>
                    <h5 class="font-weight-bold mt-3">AI GOES TO WORK</h5>
                    <p class="size-2 text-muted mt-3">Tempus uses algorithms to uncover hidden fees as well as margins that have room for reduction.</p>
                    <div class="text-center">
                        <img src="{{asset('images/mob4.png')}}" class="img-fluid mt-4">
                    </div>
                    <br>
                    <h5 class="font-weight-bold mt-3">USE YOUR REPORT TO NEGOTIATE</h5>
                    <p class="size-2 text-muted mt-3">Use the report to negotiate your current plan or to shop around for a new provider.</p>
                    <div class="text-center">
                        <img src="{{asset('images/mob5.png')}}" class="img-fluid mt-4">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        @auth
                        <a href="{{ route('file') }}" class="btn btn-upload mb-5"> Free 7 Day Trial</a>
                        @endauth
                        @guest
                        <a href="#register-section" class="btn btn-upload mb-5"> Free 7 Day Trial</a>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================================Section==================================== -->
    <section class="mt-5 ">
        <div class="container">
            <div class="row pt-0 pt-md-5 justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-capitalize color-1 size-3 text-center">Trained by thousand of data points</h1>
                </div>
            </div>
            <div class="row mt-5 mb-5 pb-5 justify-content-center">
                <div class="col-md-7 pt-0 pt-md-5">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_g5zb8vto.json"
                        background="transparent" speed="1" class="img-fluid" loop autoplay></lottie-player>
                </div>
                <div class="col-md-4  offset-md-1">
                    <p class="size-2 text-muted mt-5 pt-0 pt-md-2">Our machine learning ingests data from every layer of the financial stack and cross-checks in real-time whether the current wholesale interchange rates you are paying are in-line with market rate for card networks and banks.
<br><br>
What have we discovered? No two statements are the same but the underlying data is. 
<br><br>
So no matter which provider you use we can sift through the pricing noise to find out where we can optimize fees and eliminate junk billing. 

                    </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="text-center">
                        @auth
                        <a href="{{ route('file') }}" class="btn btn-upload"> Free 7 Day Trial</a>
                        @endauth
                        @guest
                        <a href="#register-section" class="btn btn-upload"> Free 7 Day Trial</a>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================================animated section=-=========================== -->
    <section class="mt-5 mb-5">
        <div class="container pt-5 pb-5">
            <div class="row pt-5 justify-content-center">
                <div class="col-md-8">
                     <h1 class=" color-1 size-3 text-center">We Can Analyze Statements From Thousands of Providers</h1>
                </div>
            </div>
            <div class="row pt-5 justify-content-center">
                <div class="col-md-2 col-6">
                    <div class="text-center">
                        <img src="{{asset('images/chart1.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2s">
                    </div>
                </div>
                <div class="col-md-2 col-6 offset-md-1">
                    <div class="text-center">
                        <img src="{{asset('images/chart2.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2.3s">
                    </div>
                </div>
                <div class="col-md-2 col-6 offset-md-1">
                    <div class="text-center">
                        <img src="{{asset('images/chart3.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img "  data-wow-duration="2.5s">
                    </div>
                </div>
                <div class="col-md-2 col-6 offset-md-1">
                    <div class="text-center">
                        <img src="{{asset('images/chart4.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2.7s">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-md-2 col-6 offset-md-2">
                    <div class="text-center">
                        <img src="{{asset('images/chart5.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2s">
                    </div>
                </div>
                <div class="col-md-2 col-6 offset-md-1">
                    <div class="text-center">
                        <img src="{{asset('images/chart6.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2.3s">
                    </div>
                </div>
                <div class="col-md-2 col-6 offset-md-1">
                    <div class="text-center">
                        <img src="{{asset('images/chart7.png')}}" class="img-fluid mt-3 wow fadeInUp shad-img" data-wow-duration="2.5s">
                    </div>
                </div>
                <div class="col-md-2 col-6 ">
                    
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
                        <a href="{{ route('about-us') }}#faq" class="text-white " >FAQs</a></h6>
                </div>
                <div class="col-md-3  mt-4 mt-md-0">
                        <a href="https://www.facebook.com/Risqless-101800842015793" class=" ml-0 ml-md-4 "  ><img src="{{asset('images/facebook.svg')}}" class="img-fluid mt-3" width="30"></a>
                        <a href="https://twitter.com/risqless" class=" ml-4 "  ><img src="{{asset('images/twitter.svg')}}" class="img-fluid mt-3" width="30"></a>
                        <a href="https://www.instagram.com/risqless/" class=" ml-4"   ><img src="{{asset('images/instagram.svg')}}" class="img-fluid mt-3" width="30"></a>

                </div>
            </div>
        </div>
    </footer>



<!-- Unauth Modal -->
<div class="modal fade" id="unauth" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Unauthorized!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
           
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Trail Exired/ Subscription Cancelled Modal -->
<div class="modal fade" id="trail_expire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Expired!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger border border-danger" role="alert">
           You don't have permission to access profile page.Your trail is expired or you have cancel your subscribtion.
           <br>Please <a href="{{url('about-us/#plan')}}">Click Here</a> to Subscribe.
        </div>
      </div>
    </div>
  </div>
</div>
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

        <!-- Scripts -->

    
    <script type="text/javascript" charset="utf-8" async defer>
        new WOW().init();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
           @if(Session::has('unauth'))
            var unauth = "{{ Session::get('unauth') }}";
            $('#unauth .alert-danger').text(unauth);
            $('#unauth').modal('show')
           @endif 

           @if(Session::has('trail_expire'))
            $('#trail_expire').modal('show')
           @endif
        })
    </script>
@endsection