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
                                            <p class="text-muted fw-medium">Calon Osis</p>
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
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Siswa1</p>
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

                    </div>
                </div>
            </div>

            {{-- ini ganti --}}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Calon Ketua Osis</h4>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="border p-3 rounded mt-4">
                                                {{-- <h4 class="card-title">No 1</h4> --}}

                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-18">
                                                            <i class="mdi mdi-bitcoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Bitcoin</h5>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-18">
                                                            <i class="mdi mdi-bitcoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Wakil Bitcoin</h5>
                                                </div>
                                                <!-- Rest of the content -->
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="border p-3 rounded mt-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-ethereum"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Ethereum</h5>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-ethereum"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Ethereum</h5>
                                                </div>
                                                <!-- Rest of the content -->
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="border p-3 rounded mt-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                            <i class="mdi mdi-litecoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Litecoin</h5>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                            <i class="mdi mdi-litecoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Litecoin</h5>
                                                </div>
                                                <!-- Rest of the content -->
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="border p-3 rounded mt-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                            <i class="mdi mdi-litecoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Litecoin</h5>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-info bg-soft text-info font-size-18">
                                                            <i class="mdi mdi-litecoin"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Litecoin</h5>
                                                </div>
                                                <!-- Rest of the content -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ini ganti --}}
        </div>
    </div>
@endsection
