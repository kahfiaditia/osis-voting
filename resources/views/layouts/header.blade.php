<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark  mt-5">
                    <span class="logo-sm mt-4">
                        <img src="{{ URL::asset('assets/images/brands/logo123.png') }}" alt="" height="100">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/brands/logo123.png') }}" alt="" height="100">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light  mt-5">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/brands/logo123.png') }}" alt="" height="100">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/brands/logo123.png') }}" alt="" height="100">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                <form method="GET" action="{{ route('pengguna.index', Crypt::encryptString(Auth::user()->id)) }}">
                    @csrf
                    <button class="btn header-item waves-effect">
                        <?php
                        $avatar = DB::table('users')
                            // ->select('foto')
                            ->where('id', Auth::user()->id)
                            ->get();
                        ?>
                        {{-- @if (count($avatar) > 0 and $avatar[0]->foto != null)
                            <img class="rounded-circle header-profile-user"
                                src="{{ Storage::url('karyawan/foto/' . $avatar[0]->foto) }}" alt="Header Avatar">
                        @else
                            <img class="rounded-circle header-profile-user"
                                src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="Header Avatar">
                        @endif --}}
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
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>
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
