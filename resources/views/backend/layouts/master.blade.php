<!DOCTYPE html>
<html>
<head>
  <title>@yield('page_title') | @yield('page_title_sub')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
  <!-- plugin css -->
  <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
<body class="sidebar-dark" data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    <router-view :key="$route.fullPath"></router-view>    
  </div>
  @if (auth('admin')->user())
    <script>
        window.user = @json(auth('admin')->user());
    </script>
  @else
    <script>
      localStorage.removeItem("token")
      window.location.href.indexOf("login") > -1 ? '': location.href = "/backend/login"
    </script>
  @endif
  <!-- base js -->
  <script src="{{asset('js/app.js')}}"></script>
</body>
</html>