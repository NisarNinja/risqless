
@extends('user.layouts.app')

@section('title', 'Home')

@section('content')
  <section class="main-section" 
  style="background-image: url( '{{ (!empty($content->header_bg_image)) ? $content->header_bg_image : '../images/bg1.png' }}' )">
    <div class="container-fluid"> 
      <div class="row">
        <div class="col-lg-6 p-0 m-0">
          <div class="empty"></div>
          <div class="intro-text">
            <h1 class="text-white mb-4">
              @php
              echo wordwrap($content->header_h,16,"<br>\n");
              @endphp
            </h1>
            <p class="text-white mb-4">
              @php
              echo wordwrap($content->header_p,35,"<br>\n");
              @endphp
          </p>
            <div class="row container">
             <img class="app-img-1" src="{{asset('images/google.png')}}">
             <img class="app-img-2" src="{{asset('images/apple.png')}}">
           </div>
         </div>
       </div>
       <div class="col-lg-6 p-0 m-0  ">
        <div class="top-img">
          <img class="w-100 img-fluid" src="{{ (!empty($content->header_f_image)) ? $content->header_f_image : asset('images/banner phones.png') }}">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="about-us" id="about">
  <div class="margin-1"></div>
  <div class="container">
    <h3 class=" text-center text-capitalize mt-5 mb-3" style="color: #c2236c">
      <span style="color: #003470;">

        @php
            $about_us = explode(' ', $content->about_us_h);
            echo $about_us[0];
        @endphp

      </span>

        @foreach($about_us as $a)
          @if($loop->iteration > 1)
            {{$a}}
          @endif
        @endforeach

    </h3>
    <p class=" text-center text-muted mb-5">
      @php
        echo wordwrap($content->about_us_p,130,"<br>\n");
      @endphp
    </p>
    <div class="margin-1"></div>
    <div class="row about-us">
      <div class="col-md-3 back-im text-center">
          <img class="mt-4" src="{{asset('images/connect people.png')}}">
          <p class="text-white text-capitalize p-3 mt-4 font-weight-bold">connect people</p>
      </div>
      <div class="col-md-3 back-im text-center">
          <img class="mt-4" src="{{asset('images/services.png')}}">
          <p class="text-white text-capitalize p-3 mt-4 font-weight-bold">Services</p>
      </div>
      <div class="col-md-3 back-im text-center">
          <img class="mt-4" src="{{asset('images/connect people.png')}}">
          <p class="text-white text-capitalize p-3 mt-4 font-weight-bold">connect people</p>
      </div>
      <div class="col-md-3 back-im text-center">
          <img class="mt-4" src="{{asset('images/secuirty.png')}}">
          <p class="text-white text-capitalize p-3 mt-4 font-weight-bold">security check</p>
      </div>
    </div>
    <div class="margin-1"></div>
  </div>
</section>
<section class="blogs-section mb-5" id="blogs" style="background-image: url( '{{ (!empty($content->our_blogs_bg_image)) ? $content->our_blogs_bg_image : '../images/blogbackgroundw.png' }}' )">
  <div class="container-fluid">
        <img class="fone-image-1" src="{{ (!empty($content->our_blogs_rt_image)) ? $content->our_blogs_rt_image : asset('images/half phone.png') }}">

    <div class="our-blogs">
      <h3 class="text-center text-white text-capitalize pt-5">
          @php
            $blog = explode(' ', $content->our_blogs_h);
            echo $blog[0];
          @endphp

          <span class="font-weight-bold">

            @foreach($blog as $b)
                @if($loop->iteration > 1)
                {{$b}}
                @endif
            @endforeach

          </span>
      </h3>
      <p class=" text-center text-white mb-5" style="font-weight: 300;">
        @php
          echo wordwrap($content->our_blogs_p,120,"<br>\n");
        @endphp
      </p>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center" style="margin-top: 5rem;">
    @forelse($posts as $post)
      <div class="col-md-4">
        <a href="{{ route('single', [$post->slug]) }}" target="_blank" class="text-white"><h4 class="text-white"> {{$post->topic}} </h4></a>
        <p class="text-white" style="font-weight: 400;">________ {{$post->posted_on}}</p>
        <div class="background-1">
          <img class="w-100 mt-3 mb-5" src="{{$post->image}}">
          <p class="text-white" style="font-weight: 400;">
          @php
          $first10words = implode(' ', array_slice(str_word_count($post->excerpt,1), 0, 25));
          echo $first10words;
          @endphp
        </p>
          <img class="p-2" src="{{asset('images/fb.png')}}">
          <img class="p-2" src="{{asset('images/gmail.png')}}">
          <img  class="p-2"src="{{asset('images/pinterst.png')}}">
          <img class="p-2" src="{{asset('images/twitter.png')}}">
          <p class="text-white text-capitalize" style="font-weight: 300;">----------------------------------------- <a class="text-white text-capitalize " href="{{ route('single', [$post->slug]) }}" target="_blank">Read more</a> </p>
        </div>
      </div>
    @empty
      <div class="col-md-12">
        <h4>No Blogs Posts Yet!</h4>
      </div>
    @endforelse
    </div>
  </div>
  <img class="fone-image-2" src="{{ (!empty($content->our_blogs_bl_image)) ? $content->our_blogs_bl_image : asset('images/Layer 1358.png') }}">
</section>
<section class="get-app" id="news">
  <div class="container">
    <div class="margin-1"></div>
    <h1 class="text-center font-weight-bold" style="color: #003470">
        {{$content->updates_h}}
    </h1>
    <p class="text-center text-muted mb-5">
      {{$content->updates_p}}
    </p>
    <div class="row mb-5 justify-content-center">
      <input placeholder="Email" type="text" />
      <button class="btn btn-primary">subscribe</button>
    </div>
    <div class="margin-1"></div>
  </div>
</section>
<section class="download-app" style="background-image: url( '{{ (!empty($content->download_app_bg_image)) ? $content->download_app_bg_image : '../images/download.png' }}' )">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="text-white text-capitalize pt-5 pb-3">
          @php
            $download = explode(' ', $content->download_app_h);
            echo $download[0];
          @endphp
          <span class="font-weight-bold">
              @foreach($download as $d)
                @if($loop->iteration > 1)
                {{$d}}
                @endif
              @endforeach
          </span>
        </h2>
        <p class="text-white pb-3">
          @php
            echo wordwrap($content->download_app_p,55,"<br>\n");
          @endphp
        </p>
        <div class="row ">
          <img class="app-img-3" src="{{asset('images/playstore2.png')}}">
          <img class="app-img-4" src="{{asset('images/playstore2.png')}}">
        </div>
      </div>
      <div class="col-md-6 p-0 m-0">
        <img class="img-dwnldapp-1" src="{{ (!empty($content->download_app_r1_image)) ? $content->download_app_r1_image : asset('images/app-1.png') }}">
        <img class="img-dwnldapp-2" src="{{ (!empty($content->download_app_r2_image)) ? $content->download_app_r2_image : asset('images/app-2.png') }}">

      </div>
    </div>
  </div>
</section>
<section class="contact-section" id="contact">
  <div class="container">
    <div class="margin-1"></div>
    <h3 class="text-capitalize mt-5 mb-5">
      <span style="color: #003470;">
          @php
            $contact = explode(' ', $content->contact_us_h);
            echo $contact[0];
          @endphp
      </span>
      <span style="color: #c2236c;">
        @foreach($contact as $c)
          @if($loop->iteration > 1)
            {{$c}}
          @endif
        @endforeach
      </span>
    </h3>
    <div class="row">
      <div class="col-md-7">
        <form>
          <label class="text-muted  pt-5 pr-3">Name</label>
          <input placeholder="" type="text" style="width: 80%;" /><br>
          <label class="text-muted pt-5 pr-3">Email</label>
          <input placeholder="" type="text" style="width: 80%;" /><br>
          <label class="text-muted  pt-5">Subjects</label>
          <input placeholder="" type="text" style="width: 80%;" />
          <button class="btn btn-primary mt-5 mb-5">Send</button>
        </form>
      </div>
      <div class="col-md-5">
        <ul>
          <li><img class="p-3" src="{{ (!empty($content->location_image)) ? $content->location_image : asset('images/loc.png') }}" class="info-imgs"><span class="text-muted text-capitalize">
            {{$content->location}}
          </span></li>
          <li><img class="p-3" src="{{ (!empty($content->phone_image)) ? $content->phone_image : asset('images/phone.png') }}" class="info-imgs"><span class="text-muted text-capitalize"> {{$content->phone}}</span> </li>
          <li><img class="p-3" src="{{ (!empty($content->email_image)) ? $content->email_image : asset('images/mail.png') }}" class="info-imgs"><span class="text-muted text-capitalize"> {{$content->email}}</span> </li>
          <div class="row mt-4 pl-3 ">
            <img class="p-3" src="{{asset('images/fb footer.png')}}" class="info-imgs">
            <img class="p-3" src="{{asset('images/google footer.png')}}" class="info-imgs">
            <img class="p-3" src="{{asset('images/pinterst footer.png')}}" class="info-imgs">
          </div>
        </ul>
      </div>
    </div>
  </div>
</section>

@endsection