<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Coming Soon | E-Votting Osis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @include('layouts.css')
</head>

<body data-topbar="light" data-layout="horizontal" data-layout-size="boxed">
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('frontend.header')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('ft')
            <!-- End Page-content -->
            @include('frontend.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
</body>

@include('layouts.js')

</html>
