
@extends('user.layouts.app')

@section('title', 'Login')

@section('content')

<section  class="" > 
      <div class="container pt-5 pb-5">
          <div class="row justify-content-center">
              <div class="col-md-5 mt-5 mb-5">
                  <div class="card" style="box-shadow:0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%)">
                      <div class="card-body">
                          <div class="text-center">
                              <a href="{{ route('home') }}"><img src="{{ asset('images/logo1.svg')}}"  class="img-fluid log-size mt-3"></a>
                          </div>

                          @if(Session::has('message'))
                          <p class=" mt-3 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                          @endif

                          @if(Session::has('status'))
                          <p class=" mt-3 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
                          @endif

                        <form method="post" action="{{ route('user.login') }}" class="mt-5">
                           @csrf
                            <div class="form-group">
                              <input type="email" class="form-control input-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address" name="email">
                              <small id="emailHelp" class="form-text text-muted small-text">We'll never share your email with anyone else.</small>
                            </div>
                            @error('email')
                                 <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group  mt-4">
                              <input type="password" class="form-control input-style" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            @error('password')
                                 <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="text-center">
                            <button type="submit" class="btn btn-upload w-100 mt-4 mb-3">Sign in</button>
                            <h6 class="size-4"> <a href="{{ route('password.reset') }}" class="small-text text-decoration-none"> Forgot password? </a></h6>
                            <br>

                            <h6 class="size-4">Don't have an account? <a href="{{ route('user.show.register') }}" class="small-text text-decoration-none"> Sign Up </a></h6>
                        </div>
                          </form>
                          <h6 class="font-weight-bold size-4 text-center mt-4">OR <br> <br> Sign In With</h6>
                          <div class="row mt-3 mb-3 justify-content-center">
                              <div class="col-md-2 col-3">
                                <a href="{{ route('facebook.login') }}" class="btn btn-fb"><i class="fab fa-facebook-f " style="margin-top:0.4rem"></i></a>

                              </div>
                              <div class="col-md-2 col-3 ">
                                <a href="{{ route('google.login') }}" class="btn btn-gmail"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="third-party-join__google-icon"><g class="color-icon"><path style="fill:#E94435" d="M12.1,5.8c1.6-0.1,3.1,0.5,4.3,1.6l2.6-2.7c-1.9-1.8-4.4-2.7-6.9-2.7c-3.8,0-7.2,2-9,5.3l3,2.4C7.1,7.2,9.5,5.7,12.1,5.8z"></path><path style="fill:#F8BB15" d="M5.8,12c0-0.8,0.1-1.6,0.4-2.3l-3-2.4C2.4,8.7,2,10.4,2,12c0,1.6,0.4,3.3,1.1,4.7l3.1-2.4C5.9,13.6,5.8,12.8,5.8,12z"></path><path style="fill:#34A751" d="M15.8,17.3c-1.2,0.6-2.5,1-3.8,0.9c-2.6,0-4.9-1.5-5.8-3.9l-3.1,2.4C4.9,20,8.3,22.1,12,22c2.5,0.1,4.9-0.8,6.8-2.3L15.8,17.3z"></path><path style="fill:#547DBE" d="M22,12c0-0.7-0.1-1.3-0.2-2H12v4h6.1v0.2c-0.3,1.3-1.1,2.4-2.2,3.1l3,2.4C21,17.7,22.1,14.9,22,12z"></path></g></svg> </a>

                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
 
  <!-- Modal -->
<div class="modal fade" id="wrong-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Wrong Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger border border-danger">
          Whoops! Sorry for the error. Let's try that again. 
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){

          @if(Session::has('error'))
            $('#wrong-password').modal('show')
          @endif

        })
    </script>
 @endsection