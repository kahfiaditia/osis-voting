<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-light.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="19">
                    </span>
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="login">
                    <i class="mdi mdi-login d-none d-xl-inline-block"></i>
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">Log-In</span>
                </button>
            </div>
        </div>
    </div>
</header>

<script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#login").on('click', function() {
            var APP_URL = {!! json_encode(url('/')) !!}
            window.location = APP_URL + '/login'
        })
    });
</script>
