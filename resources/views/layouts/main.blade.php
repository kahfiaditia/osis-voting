<!doctype html>
<html lang="en">

<head>

    {{-- <meta charset="utf-8" /> --}}
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard | EVot - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/brands/logo123.png') }}">

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
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        // Pop up for delete confirm
        $('.delete_confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Ingin menghapus data?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                console.log($(this).closest('form'))
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });
    </script>
</body>
@include('layouts.js')



</html>
