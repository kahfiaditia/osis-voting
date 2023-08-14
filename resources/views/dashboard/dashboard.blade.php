@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                        <div class="page-title-right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>System Information Evoting</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="avatar-md profile-user-wid mb-4">


                                        <input type="hidden" id="roles" value="">
                                        <input type="hidden" id="jabatan" value="">
                                        <input type="hidden" id="karyawan_id" value="">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">ghghfh</h5>
                                    <p class="text-muted mb-0 text-truncate">

                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pt-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">&nbsp;</h5>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15">&nbsp;</h5>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="" class="btn btn-primary waves-effect waves-light btn-sm">Akun
                                                <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Karyawan</p>
                                            <h4 class="mb-0">gsdgsdgsd</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-group font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Guru</p>
                                            <h4 class="mb-0">sdfgadfgdafg</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-group font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Siswa</p>
                                            <h4 class="mb-0">safgasfgasf</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-group font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card mini-stats-wid">
                                <div class="card-body">

                                    <div class="clearfix mt-4 mt-lg-0">
                                        <div class="dropdown float-end">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-wallet me-1"></i>
                                                    <span class="d-sm-inline-block">Total Tagihan :
                                                        <b>fgxfgxdfghxf</b>
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md"
                                                    style="">
                                                    <div class="dropdown-item-text">
                                                        <div>
                                                            <p class="text-muted mb-2">Total Biaya</p>
                                                            <h5 class="mb-0">
                                                                hxfhfxdhfdx
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript: void(0);">
                                                        Uang Formulir : <span class="float-end">dfghsdfh</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        Uang Pangkal : <span class="float-end">fdhfdhdfh</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        Uang SPP : <span class="float-end">@
                                                            fhfhdfh</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        Uang Kegiatan : <span class="float-end">@
                                                            fdhdfhdf</span>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-primary text-center" href="">
                                                        Rincian pembayaran
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- subscribeModal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="avatar-md mx-auto mb-4">
                            <div class="avatar-title bg-light rounded-circle text-primary h1">
                                <i class="mdi mdi-progress-alert"></i>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <h4 class="text-primary">Lengkapi Data !</h4>
                                <div class="text-danger message_alert" id="message_alert"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
@endsection
