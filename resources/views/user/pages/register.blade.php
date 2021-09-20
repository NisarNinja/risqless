
@extends('user.layouts.app')

@section('title', 'Register')

@section('content')
 <script src="{{ asset('js/app.js') }}" defer></script>
<section  class="bg-secondss" > 
      <div class="container pt-5 pb-5">
          <div class="row justify-content-center">
              <div class="col-md-5 ">
                  <div class="card" style="box-shadow:0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%)">
                      <div class="card-body">
                          <div class="text-center">
                              <a href="{{ route('home') }}"><img src="{{ asset('images/logo1.svg')}}"  class="img-fluid mt-3 log-size"></a>
                          </div>
                        <!-- <form class="mt-5" method="post" action="{{ route('user.register') }}" id="subscribe-form"> -->

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" name="fname" form="subscribe-form" required>
                                      </div>
                                </div>
                                <div class="col-md-6 mt-md-0  mt-2">
                                    <input type="text" class="form-control input-style" id="exampleInputEmai2" aria-describedby="emailHelp" placeholder="Last Name" name="lname" form="subscribe-form" required>
                                </div>

                            </div>
                            @error('fname')
                                 <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              @error('lname')
                                 <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                            <div class="form-group mt-md-2 mt-4">
                              <input type="email" class="form-control input-style" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Email Address" name="email" form="subscribe-form" required >
                              <small id="emailHelp" class="form-text text-muted small-text">We'll never share your email with anyone else.</small>

                            </div>
                            <!-- <div class="col-md-12 mt-2"> -->
                                 <div class="alert alert-danger d-none" id="already-taken">
                                  Email already taken!
                                 </div>
                                <!-- </div> -->

                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <input type="password" class="form-control input-style" id="password" placeholder="Password" name="password" form="subscribe-form" >
                                      </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <input type="password" class="form-control input-style" id="password_confirmation" placeholder="Re-enter Password" name="password_confirmation" form="subscribe-form" required>
                                      </div>
                                </div>
                               <div class="col-md-12 mt-2">
                                 <div class="alert d-none" id="password-strength-status">
                                 </div>
                                </div>
                               
                               <div class="col-md-12 mt-2">
                                 <div class="alert d-none" id="password-confirm">
                                 </div>
                                </div>


                            </div>
                            <div class="text-center">
                            <button type="button" class="btn btn-upload w-100 mt-4 mb-3 stripe-modal" >Start 7 Day Trial</button>
                            <h6 class="size-4">Already have an account? <a href="{{ route('user.show.login') }}" class="small-text text-decoration-none"> Sign In </a></h6>
                        </div>

                          <h6 class="font-weight-bold size-4 text-center mt-4">OR <br> <br> Sign Up With</h6>
                          <div class="row justify-content-center mt-3 mb-3">
                              <div class="col-md-2 col-3">
                                <a href="{{ route('facebook.login') }}" class="btn btn-fb "><i class="fab fa-facebook-f " style="margin-top:0.4rem"></i></a>

                              </div>
                              <div class="col-md-2 col-3">
                                <a href="{{ route('google.login') }}" class="btn btn-gmail"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="third-party-join__google-icon"><g class="color-icon"><path style="fill:#E94435" d="M12.1,5.8c1.6-0.1,3.1,0.5,4.3,1.6l2.6-2.7c-1.9-1.8-4.4-2.7-6.9-2.7c-3.8,0-7.2,2-9,5.3l3,2.4C7.1,7.2,9.5,5.7,12.1,5.8z"></path><path style="fill:#F8BB15" d="M5.8,12c0-0.8,0.1-1.6,0.4-2.3l-3-2.4C2.4,8.7,2,10.4,2,12c0,1.6,0.4,3.3,1.1,4.7l3.1-2.4C5.9,13.6,5.8,12.8,5.8,12z"></path><path style="fill:#34A751" d="M15.8,17.3c-1.2,0.6-2.5,1-3.8,0.9c-2.6,0-4.9-1.5-5.8-3.9l-3.1,2.4C4.9,20,8.3,22.1,12,22c2.5,0.1,4.9-0.8,6.8-2.3L15.8,17.3z"></path><path style="fill:#547DBE" d="M22,12c0-0.7-0.1-1.3-0.2-2H12v4h6.1v0.2c-0.3,1.3-1.1,2.4-2.2,3.1l3,2.4C21,17.7,22.1,14.9,22,12z"></path></g></svg>  </a>

                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
 

 <!-- Modal -->
<div class="modal fade" id="stripe-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Card Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.register')}}" method="POST" id="subscribe-form" >
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
                <button id="card-button" data-secret="{{ ($intent !== null)? $intent->client_secret : '' }}" class="btn btn-upload w-100 mt-4 mb-3">Start 7 Day Trial</button>
            </div>
            <h6 class="font-weight-normal" style="font-size:0.8em">You are moments from accessing the secure members area and will <u ><b> not be billed </b> </u> during the 7 day trial period. <br><br>

Upload a PDF copy of your statement so Tempus can give you an instant overview. <br> <br> A detailed analysis will be emailed directly to you shortly afterwards. You may re-login and use as much as you like without additional charges.
<br><br>
The subscription of $19 / month begins after the trial. Cancel prior to that to avoid any future charges. 
</h6>
        </form>

      </div>
    </div>
  </div>
</div>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){

          @if($errors->has('subscription_error'))
            $('#stripe-modal').modal('show')
          @endif

          $('input[type="email"]').on('blur', function(e) {
            // alert('blur')
          var email = $('input[type="email"]').val();
          var csrf = $("meta[name='csrf-token']").attr('content');
              $.ajax({
                  type: "POST",
                  url: "{{url('checkemail')}}",
                  headers: {
                      'X-CSRF-Token': csrf 
                 },
                  data: {email:email},
                  dataType: "json",
                  success: function(res) {
                      if(res.exists){
                          $("#already-taken").removeClass('d-none')
                      }else{
                          $("#already-taken").addClass('d-none')
                      }
                  },
                  error: function (jqXHR, exception) {

                  }
              });
            });

          $(".stripe-modal").click(function(){

            var number = /([0-9])/;
            var lowerCase = /(?=.*[a-z])/;
            var upperCase = /(?=.*[A-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if($('#password').val().length<6) {
            $('#password-strength-status').removeClass('d-none alert-danger alert-warning');
            $('#password-strength-status').addClass('alert-danger');
            $('#password-strength-status').html("The password must be at least 6 characters.");
            } else {    
            if($('#password').val().match(number) && $('#password').val().match(lowerCase)  && $('#password').val().match(upperCase) ) {            
            $('#password-strength-status').removeClass('d-none alert-warning alert-danger');
            $('#password-strength-status').addClass('alert-success');
            $('#password-strength-status').html("Strong Password");

              var password = $("#password").val();
              var confirmPassword = $("#password_confirmation").val();
              if (password != confirmPassword){
                $('#password-confirm').removeClass('d-none alert-warning alert-success');
                $('#password-confirm').addClass('alert-danger');
                $('#password-confirm').html("Passwords does not match!");
              }
              else{
                $('#password-confirm').removeClass('d-none alert-warning alert-danger');
                $('#password-confirm').addClass('alert-success');
                $('#password-confirm').html("Passwords match.");

                var email = $('input[type="email"]').val();
                var csrf = $("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type: "POST",
                    url: "{{url('checkemail')}}",
                    headers: {
                        'X-CSRF-Token': csrf 
                   },
                    data: {email:email},
                    dataType: "json",
                    success: function(res) {
                        if(res.exists){
                            $("#already-taken").removeClass('d-none')
                        }else{
                            $("#already-taken").addClass('d-none')
                            $("#stripe-modal").modal('show');
                        }
                    },
                    error: function (jqXHR, exception) {

                    }
                });
                
              }

            } else {
            $('#password-strength-status').removeClass('d-none alert-danger alert-success');
            $('#password-strength-status').addClass('alert-warning');
            $('#password-strength-status').html("Password must contain at least one lowercase , one uppercase, one number");
            }}

          })

          $("body").on('keyup','#password' ,function(){
            var number = /([0-9])/;
            var lowerCase = /(?=.*[a-z])/;
            var upperCase = /(?=.*[A-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if($('#password').val().length<6) {
            $('#password-strength-status').removeClass('d-none alert-danger alert-warning');
            $('#password-strength-status').addClass('alert-danger');
            $('#password-strength-status').html("The password must be at least 6 characters.");
            } else {    
            if($('#password').val().match(number) && $('#password').val().match(lowerCase) && $('#password').val().match(upperCase)) {            
            $('#password-strength-status').removeClass('d-none alert-warning alert-danger');
            $('#password-strength-status').addClass('alert-success');
            $('#password-strength-status').html("Strong Password");
            } else {
            $('#password-strength-status').removeClass('d-none alert-danger alert-success');
            $('#password-strength-status').addClass('alert-warning');
            $('#password-strength-status').html("Password must contain at least one lowercase , one uppercase, one number");
            }}
          })

          $("body").on('keyup','#password_confirmation' ,function(){

            var password = $("#password").val();
              var confirmPassword = $("#password_confirmation").val();
              if (password != confirmPassword){
                $('#password-confirm').removeClass('d-none alert-warning alert-success');
                $('#password-confirm').addClass('alert-danger');
                $('#password-confirm').html("Passwords does not match!");
              }
              else{
                $('#password-confirm').removeClass('d-none alert-warning alert-danger');
                $('#password-confirm').addClass('alert-success');
                $('#password-confirm').html("Passwords match.");
              }

          })

        })
    </script>

 @endsection