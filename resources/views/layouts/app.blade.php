<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} @yield('title')</title>

  <!-- SEO Meta Tags-->
  <meta name="description" content="Unishop - Universal E-Commerce Template">
  <meta name="keywords" content="shop, e-commerce, modern, flat style, responsive, online store, business, mobile, blog, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Rokaux">


  <!-- Favicon and Apple Icons-->
  {{--
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="apple-touch-icon" href="touch-icon-iphone.png">
  <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
  <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
  <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png"> --}}

  <!-- Bootstrap Styles -->
  <link rel="stylesheet" media="screen" href="{{ mix('css/bootstrap.min.css') }}">

  <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
  <link rel="stylesheet" media="screen" href="{{ mix('css/vendor.min.css') }}">

  <!-- Main Template Styles-->
  <link id="mainStyles" rel="stylesheet" media="screen" href="{{ mix('css/styles.min.css') }}">
  <!-- Modernizr-->
  <script src="{{ mix('js/modernizr.min.js') }}"></script>

  @stack('t-scripts')
</head>
<!-- Body-->

<body>
  <div id="app">
    <!-- Off-Canvas Category Menu-->
    @include('layouts.menu-desktop')
    <!-- Off-Canvas Mobile Menu-->
    @include('layouts.menu-mobile')
    <!-- Topbar-->
    @include('layouts.top')
    <!-- Navbar-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    @include('layouts.navbar')
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      @yield('content')
      <!-- Site Footer-->
      @include('layouts.footer')
    </div>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
  </div>

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
  <script src="{{ mix('js/jquery.min.js') }}"></script>
  <script src="{{ mix('js/popper.min.js') }}"></script>
  <script src="{{ mix('js/bootstrap.min.js') }}"></script>
  <script src="{{ mix('js/axios.min.js') }}"></script>
  <script src="{{ mix('js/vendor.min.js') }}"></script>
  <script src="{{ mix('js/scripts.min.js') }}"></script>
  <script src="{{ mix('js/app.min.js') }}"></script>

  @stack('b-scripts')


</body>

</html>
