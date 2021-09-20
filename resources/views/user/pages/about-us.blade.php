@extends('user.layouts.app')

@section('title', 'About Us')

@section('content')
    <section class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo1.svg') }}" class="img-fluid log-size"> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <a class="nav-link mr-3 text-white" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link mr-3 text-white" href="#">Pricing</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link  mr-3  text-white" href="{{ route('about-us') }}#faq">FAQs</a>
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

        
        <div class="container">


        @if(Session::has('resume'))

                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <div class=" mt-3 alert alert-success border border-success">{{ Session::get('resume') }}
                        </div>
                    </div>
                </div>  
        @endif

        @if(!empty($trail_expired) && $trail_expired !== false)
            <div class="row justify-content-center ">
                <div class="col-6">
                    <div class="alert alert-danger text-center border border-danger" role="alert">
                        Your trail is expired or you have cancel your subscribtion.
                        <br>Please <a href="#plan">Click Here</a> to Subscribe.
                    </div>
                </div>
            </div>  
        @endif

        @if(!empty($trial_ends_at) && $trial_ends_at !== false)
            <div class="row justify-content-center mt-5">
                <div class="col-6">
                    <div class="alert alert-warning text-center border border-warning" role="alert">
                        You have {{ $trial_ends_at }} days remaining of your trail version. 
                    </div>
                    <div class="alert alert-warning text-center border border-warning" role="alert">
                        If you don not cancel the subscription before the trial ending date you will be charged as soon as the trial expires 
                    </div>
                    <div class="alert alert-info text-center border border-info" role="alert">
                        <a href="{{url('/about-us/#plan')}}">Click here</a> to cancel subscription.
                    </div>
                </div>
            </div>  
        @endif

        @if(!empty($ends_at) && $ends_at !== false)

                <div class="row justify-content-center mt-5">
                    <div class="col-6 text-center">
                        <div class=" mt-3 alert alert-warning border border-warning">
                            You have cancel you current subscription plan. 
                        </div>
                        <div class=" mt-3 alert alert-info border border-info">
                            <b>Note:</b> You are allowed to continue using an application for {{$ends_at}} days more.
                        </div>
                    </div>
                </div>  
        @endif


            <div class="row justify-content-center mt-5">
                <div class="col-md-7">
                    <h1 class="text-capitalize color-1 size-3 text-center">Try it out for 7 days</h1>
                    <p class="mt-5 text-muted  ">
                        We do not collect referral fees, sell leads, or take a commission from your savings. <br><br>

Tempus AI will monitor your statements and make sure your business can avoid the hidden fees and headaches merchant processing is known for.
<br><br>
If we don’t bring money back to your bottom line, cancel anytime.
 <br><br>
No questions asked.


                    </p>
                </div>
            </div>
            <div class="row justify-content-center pb-5 pt-5 ">
<!--                <div class="col-md-10">-->
<!--                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>-->
<!--<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_anzmy9qh.json"  background="transparent"  speed="1"  class="img-fluid"  loop  autoplay></lottie-player>-->
<!--                </div>-->
                <div class="col-md-10">                    
                    <div class="text-center">
                        @auth
                        <a href="{{ route('file') }}" class="btn btn-upload mt-5" > Start Now</a>
                        @endauth
                        
                        @guest
                        <a href="{{ route('user.show.register') }}" class="btn btn-upload mt-5" > Start Now</a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pb-5" >
                <div class="col-md-4">
                    <div class="card border-0" style="box-shadow:0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%)">
                        <div class="card-body">
                            <div class="text-center">
                                <script
                            src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_4vmhlbaq.json"
                            background="transparent" speed="1" class="img-fluid" loop autoplay>
                        </lottie-player>
                                <!--<img src="{{asset('images/rob.png')}}" class="img-fluid mt-3" width="100">-->
                                <p class="text-muted mt-1">
                                    Get a straightforward solution without any hidden catches or tricks.
                                    <br><br>

No data entry.
<br><br>
Drag. Drop. Done.
<br><br>
Track your history 24-7

                                </p>
                                <h1 class="font-weight-bold color-3" id="plan">$19 / Month</h1>
                                @auth

                                @if( $user->subscription('default') !==null && empty($ends_at) && $ends_at == false)
                                <a  class="btn btn-upload mt-4 mb-4"   data-toggle="modal" data-target="#cancel_subscription" > Cancel Subscription</a>

                                @elseif(!empty($ends_at) && $ends_at !== false)
                                <a class="btn btn-upload mt-4 mb-4"   data-toggle="modal" data-target="#resume_subscription"> Resume Subscription</a>

                                @else
                                <a class="btn btn-upload mt-4 mb-4"   data-toggle="modal" data-target="#stripe-modal"> Subscribe</a>
                                @endif
                                @endauth
                                
                                @guest
                                <a href="{{ route('user.show.register') }}" class="btn btn-upload mt-4 mb-4" > Subscribe Today</a>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

<!-- Resume Subscription Modal -->
<div class="modal fade" id="resume_subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="alert alert-warning border border-warning" role="alert">
           Do you want to resume your subscription plan?
        </p>
        <div class="alert alert-info border border-info">
            @if(!empty($ends_at) && $ends_at !== false)
                <b>Note:</b> You will not be billed immediately. Instead, your subscription will be re-activated and they will be billed on the original billing cycle after {{$ends_at}} days.
            @endif
        </div>
      </div>
      <div class="modal-footer">

        <a type="submit" class="btn btn-dark text-white"  onclick="event.preventDefault(); document.getElementById('frm-resume-subscribe').submit();">Resume Subscription</a>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <form id="frm-resume-subscribe" action="{{ route('resumeSubscription') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
      </div>
    </div>
  </div>
</div>

<!-- Trail Exired/ Subscription Cancelled Modal -->
<div class="modal fade" id="cancel_subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="alert alert-warning border border-warning" role="alert">
           Do you want to cancel you current subscription plan?
        </p>
        <div class="alert alert-info border border-info">
            <b>Note:</b> You are allowed to continue using an application until the end of your billing cycle.
        </div>
      </div>
      <div class="modal-footer">

        <a type="submit" class="btn btn-dark text-white"  onclick="event.preventDefault(); document.getElementById('frm-cancel-subscribe').submit();">Cancel Subscription</a>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <form id="frm-cancel-subscribe" action="{{ route('cancelSubscription') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
      </div>
    </div>
  </div>
</div>

            </div>
        </div>
    </section>
   <!-- ==================================================Section2========================== -->
   <section class="about-s2">
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-9">
                <h1 class="text-capitalize color-1 size-3 text-center">Wholesale Interchange Rates Are Confusing</h1>
                <p class="mt-5 text-muted ">
                    We feel you. 
<br><br>
What’s worse?
 <br><br>
There are tons of them and they vary by credit card.
<br><br>

Tempus is trained to compare interchange rates published by the major card brands against what you are being billed so you can finally have 100% transparency.
<br><br>
Below is just a fraction of the many wholesale fees in circulation that we monitor.
                </p>
            </div>
        </div>
        <div class="row justify-content-center mt-5 pt-0 pt-md-5 pb-5">
            <div class="col-md-11 laptop-section2">
                                   <img src="{{asset('images/ggif.gif')}}" class="img-fluid gif-animation" style="border-radius: 50px;">

            
        </div>
    </div>
</section>
<!-- =========================================================Faq============================= -->
   <section class="mb-5" id="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="text-capitalize color-1 size-3 text-center">Frequently Asked Questions</h1>
                </div>
                <div class="col-md-10 mt-5">
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> Tempus cannot read my statement.</h6>
                    <p> <span class="font-weight-bold">A:</span> For best results use an unlocked PDF version of your
                        statement <b><u> OR</u> </b>scan <b> ALL</b> pages of your processing statement using the free
                        app Genius Scan.
                        <br>
                        All pages are required so Tempus can find any potential hidden fees.
                    </p>
                    <br> <br>
                    <!-- ==================================q2================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> Is this going to be an easy process?
                        Please explain?</h6>
                    <p> <span class="font-weight-bold">A:</span> Simply create an account using your email, Gmail, or
                        Facebook profile. Start your 7 day trial. Upload a PDF version of your
                        merchant statement and use the service as much as you like during that time.
                        <br>
                        You will not be billed during the trial period. Cancel anytime prior to the 7 day expiration
                        time to avoid fees. After 7 days you may continue to use our services for only $19 per month and
                        cancel anytime.
                    </p>
                    <br> <br>
                    <!-- ==================================q3================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How do I take the information provided
                        by Risqless and send that to my processor to negotiate better pricing? </h6>
                    <p> <span class="font-weight-bold">A:</span> Your member’s area dashboard will provide you with a
                        basic overview of account pricing.
                        <br>
                        A detailed pricing breakdown will be sent to you and will show you the “true wholesale cost”
                        versus what you are paying to your provider as profit.
                        <br>
                        From there, you can determine whether the profit margins you are paying to your current provider
                        are acceptable.
                    </p>
                    <br> <br>
                    <!-- ==================================q4================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How long is the contract? </h6>
                    <p> <span class="font-weight-bold">A:</span> This is a month-to-month service agreement and you may
                        cancel any time. </p>
                    <br> <br>
                    <!-- ==================================q5================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How do I cancel this agreement? </h6>
                    <p> <span class="font-weight-bold">A:</span> We’re sorry to see you go, but send us a message from
                        the email account you had registered with to <a href="#"> clientsupport@risqless.ai </a> with
                        “unsubscribe” in the subject line and we will complete your request. </p>
                    <br> <br>
                    <!-- ==================================q6================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> What if I need help negotiating with
                        my current processor? Is there an additional fee? </h6>
                    <p> <span class="font-weight-bold">A:</span> For additional services, please contact <a href="#">
                            Info@risqless.ai </a> and a representative will contact you directly. </p>
                    <br> <br>
                    <!-- ==================================q7================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How often should I upload my
                        statement? </h6>
                    <p> <span class="font-weight-bold">A:</span> Statements should be uploaded at the beginning of every
                        month. Doing so will ensure that Tempus AI captures the information on time, so that you may
                        make the necessary adjustments with your Merchant Service Provider. </p>
                    <br> <br>
                    <!-- ==================================q8================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How secure is my information? </h6>
                    <p> <span class="font-weight-bold">A:</span> We host our solution on Amazon Web Services (AWS) in
                        North America. Merchant statements are stored on Amazon S3.
                        <br>
                        Our databases and servers are 256-bit AES encrypted. Encrypted backups are taken nightly and
                        stored in separate geographic locations.
                    </p>
                    <br> <br>
                    <!-- ==================================q9================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> How much customer service am I going
                        to be able to access? </h6>
                    <p> <span class="font-weight-bold">A:</span> Tempus AI does all the analysis work, but you may have
                        more questions. Feel free to email us at <a href="#"> clientsupport@risqless.ai </a> or chat
                        online with us LIVE Monday through Friday, 8 AM - 6PM Pacific.. </p>
                    <br> <br>
                    <!-- ==================================q10================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> If I want to terminate my service
                        early (with my current processor ) who helps me and what happens to the cancellation fee? </h6>
                    <p> <span class="font-weight-bold">A:</span> Our job is to provide you only the facts. This will be
                        handled with either your current or prospective provider. </p>
                    <br> <br>
                    <!-- ==================================q11================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> If there are overcharges and rate
                        errors found, who helps me with these discrepancies? </h6>
                    <p> <span class="font-weight-bold">A:</span> Contact <a href="#"> clientsupport@risqless.ai </a> so we can get our people on it! </p>
                    <br> <br>
                    <!-- ==================================q12================== -->
                    <h6 class="color-1"> <span class="font-weight-bold">Q:</span> Am I able to speak with a live agent?
                    </h6>
                    <p> <span class="font-weight-bold">A:</span> Client Support is operated by humans! Live chat support
                        is available Monday through Friday, 8 AM - 6 PM Pacific. </p>

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
@endsection