<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Commerce - @yield('title') </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ mix('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('admin/font-awesome/css/font-awesome.min.css') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ mix('admin/css/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ mix('admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ mix('admin/css/style.min.css') }}">



    @stack('t-scripts')

</head>
<body>
  <div id="app">
    <!-- Wrapper-->
      <div id="wrapper app">

          <!-- Navigation -->
          @include('admin.layouts.navigation')

          <!-- Page wraper -->
          <div id="page-wrapper" class="gray-bg">

              <!-- Page wrapper -->
              @include('admin.layouts.topnavbar')

              <!-- Main view  -->
              @yield('content')

              <!-- Footer -->
              @include('admin.layouts.footer')

          </div>
          <!-- End page wrapper-->

      </div>
      <!-- End wrapper-->
  </div>


    <!-- Mainly scripts -->
    <script src="{{ mix('admin/js/app.min.js') }}"></script>
    {{-- <script src="{{ mix('js/axios.min.js') }}"></script> --}}
    <script src="{{ mix('admin/js/plugins/metisMenu/jquery.metisMenu.min.js') }}"></script>
    <script src="{{ mix('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ mix('admin/js/inspinia.min.js') }}"></script>
    <script src="{{ mix('admin/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ mix('admin/js/vendor.min.js') }}"></script>

    <!-- Custom -->
    @stack('b-scripts')

</body>
</html>
