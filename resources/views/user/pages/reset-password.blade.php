
@extends('user.layouts.app')

@section('title', 'Password Reset')

@section('content')

<section  class="bg-secondd" > 
      <div class="container pt-5 pb-5">
          <div class="row justify-content-center">
              <div class="col-md-5 mt-5 mb-5">
                  <div class="card" style="box-shadow:0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%)">
                      <div class="card-body">
                          <div class="text-center">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png')}}"  class="img-fluid mt-3"></a>
                          </div>

                        <form method="post" action="{{ route('password.update') }}" class="mt-5" id="reset-form">
                           @csrf

                           <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                              <!--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->

                              <div class="col-md-12">
                                  <input id="email" type="email" class=" input-style form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" >

                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                            <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->

                            <div class="col-md-12">
                                <input id="password" type="password" class="input-style form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password"   >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>-->

                            <div class="col-md-12">
                                <input id="password_confirmation" type="password" class="form-control input-style" name="password_confirmation"  placeholder="Confirm Password" >
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                          <div class="col-md-8 mt-2">
                            <div class="alert d-none" id="password-strength-status">
                            </div>
                          </div>
                        </div>

                        <div class="form-group row justify-content-center">
                          <div class="col-md-8 mt-2">
                            <div class="alert d-none" id="password-confirm">
                                 </div>
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <div class="text-center">
                                <button  class="btn btn-primary btn-upload">
                                    {{ __('Reset Password') }}
                                </button>
                                </div>
                            </div>
                        </div>

                          </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){


      $(".btn-upload").click(function(e){

            e.preventDefault();

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
                
                console.log('ok')
                $("#reset-form").submit();
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
