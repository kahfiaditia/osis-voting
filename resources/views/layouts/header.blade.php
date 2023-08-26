<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/brands/logo123.png') }}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/brands/sman1.png') }}" alt="" height="40">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <form method="GET" action="{{ route('pengguna.profil') }}">
                    @csrf
                    <button class="btn header-item waves-effect">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name }}</span>
                    </button>
                </form>
            </div>
            <div class="">
                <form method="POST" action="{{ route('login.logout') }}">
                    @csrf
                    <button class="btn header-item noti-icon waves-effect logout_confirm">
                        <i class="mdi mdi-logout text-danger"></i>
                    </button>
                </form>
            </div>
            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div> --}}
        </div>

    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $('.logout_confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Keluar Aplikasi',
                text: 'Ingin keluar aplikasi?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });
    </script>
</header>
