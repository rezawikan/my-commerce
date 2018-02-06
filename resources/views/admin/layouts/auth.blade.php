<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from byrushan.com/projects/material-admin/app/2.0/jquery/bs4/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Jan 2018 02:01:56 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} @yield('title')</title>

        <!-- App styles -->
        <link rel="stylesheet" href="{{ mix('admin/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ mix('admin/font-awesome/css/font-awesome.min.css') }}">

        <link rel="stylesheet" href="{{ mix('admin/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ mix('admin/css/style.min.css') }}">
    </head>

    <body class="gray-bg">

        @yield('content')

        <!-- Javascript -->
        <script src="{{ mix('admin/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ mix('admin/js/bootstrap.min.js') }}"></script>
</body>
</html>
