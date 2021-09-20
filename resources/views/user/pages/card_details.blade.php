<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Risqless - Card Details</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{asset('images/fav.svg')}}" type="image/gif" sizes="16x16">
   <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
   <style type="text/css" media="screen">
      .fa-download {
        color: #0be4eb !important;
      } 
   </style>

</head>

<body style="overflow-x:hidden;">

    <section class="main-sections">
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
                            <a class="nav-link text-white mr-3" href="{{ route('about-us') }}">Pricing</a>
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

        
        <div class="container mt-5 pt-5  pb-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6">
                    <form action="{{ route('processSubscription')}}" method="POST" id="subscribe-form" >
          @csrf
            <div class="form-group">
                <div class="row">
                    @foreach($plans as $plan)
                    <div class="col-md-4 d-none">
                        <div class="subscription-option">
                            <input type="radio" id="plan-silver" name="plan" value="{{$plan->id}}" checked  />
                            <label for="plan-silver">
                                <span class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                                <span class="plan-name">{{$plan->product->name}}</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="card-holder-name">Card Holder Name</label>
                <input id="card-holder-name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Name" >
            </div>

            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" class="form-control"></div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="stripe-errors"></div>
            @if ($errors->has('subscription_error'))
            <div class="alert alert-danger">
                {{ $errors->first('subscription_error') }}
            </div>
            @endif
            <div class="form-group text-center">
                <button id="card-button" data-secret="{{ ($intent !== null)? $intent->client_secret : '' }}" class="btn btn-upload w-100 mt-4 mb-2">Free 7 Day Trial</button>
            </div>
 <h6 class="font-weight-normal" style="font-size:0.8em">You are moments from accessing the secure members area and will <u ><b> not be billed </b> </u> during the 7 day trial period. <br><br>

Upload a PDF copy of your statement so Tempus can give you an instant overview. <br> <br>  A detailed analysis will be emailed directly to you shortly afterwards. You may re-login and use as much as you like without additional charges.
<br><br>
The subscription of $19 / month begins after the trial. Cancel prior to that to avoid any future charges. 
</h6>        </form>

                    <script src="https://js.stripe.com/v3/"></script>
<script>


    var stripe = Stripe(`{{ \config('services.stripe.key') }}`);
    var elements = stripe.elements();


    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    

    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    

    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async(e) => {
        e.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {

            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================footer==================================== -->
   <!--<footer class="bg-foot">-->
   <!--     <div class="container">-->
   <!--         <div class="row pt-4 pb-4">-->
   <!--             <div class="col-md-4 pt-0 pt-md-4">-->
   <!--                 <img src="{{asset('images/logo-white.png')}}" class="img-fluid" width="120">-->
   <!--             </div>-->
   <!--             <div class="col-md-4 mt-4 mt-md-0">-->
   <!--                 <h6 class="text-white text-md-center text-left mt-4">clientsupport@risqless.ai</h6>-->
   <!--             </div>-->
   <!--             <div class="col-md-3 offset-md-1 mt-4 mt-md-0">-->
   <!--                 <h6 class="text-white mt-4 ">-->
   <!--                     <a href="https://www.risqless.ai/" class="text-white " >www.risqless.ai</a></h6>-->
   <!--             </div>-->
   <!--         </div>-->
   <!--     </div>-->
   <!-- </footer>-->
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

</body>

</html>