<!DOCTYPE html>
<html lang="en" class="svgfilters csscalc cssgradients preserve3d supports svgclippaths svgasimg touchevents cssanimations boxsizing csstransforms csstransforms3d csstransitions svg">

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

    <!-- Photoswipe container-->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
            <button class="pswp__button pswp__button--share" title="Share"></button>
            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
          <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
  </div>

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
  <script src="{{ mix('js/app.min.js') }}"></script>
  <script src="{{ mix('js/axios.min.js') }}"></script>
  <script src="{{ mix('js/vendor.min.js') }}"></script>
  <script src="{{ mix('js/scripts.min.js') }}"></script>
  <script src="http://themes.rokaux.com/unishop/v2.2/template-1/customizer/customizer.min.js" type="text/javascript">

  </script>


  @stack('b-scripts')


</body>

</html>
