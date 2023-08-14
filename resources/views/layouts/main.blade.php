<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | EVot - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @include('layouts.css')
</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        @include('sweetalert::alert')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('evoting')
        </div>
        <!-- end main content-->
    </div>
    @include('layouts.footer')
    <!-- END layout-wrapper -->

</body>
@include('layouts.js')

</html>
