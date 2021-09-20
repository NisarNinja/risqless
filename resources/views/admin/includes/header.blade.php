<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') | {{ \Config::get('app.name') }}</title>

<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/gif" sizes="16x16">

@include("admin.includes.styles")
@include("admin.includes.scripts")
