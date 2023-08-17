<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Coming Soon | E-Votting Osis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/brands/logo123.png') }}">
    @include('layouts.css')
</head>

<body data-topbar="light" data-layout="horizontal" data-layout-size="boxed">
    <div id="layout-wrapper">
        @include('frontend.header')
        <div class="main-content">
            @yield('ft')
            @include('frontend.footer')
        </div>
    </div>
</body>
@include('layouts.js')

</html>
