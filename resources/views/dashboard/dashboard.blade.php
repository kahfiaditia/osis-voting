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
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{ Auth::user()->name }}</h5>
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
                                            <a href="{{ route('pengguna.profil') }}"
                                                class="btn btn-primary waves-effect waves-light btn-sm">Akun
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
                                            <p class="text-muted fw-medium">User</p>
                                            <h4 class="mb-0">{{ count($user) }}</h4>
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
                                            <h4 class="mb-0">{{ $guru }}</h4>
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
                                            <h4 class="mb-0">{{ $siswa }}</h4>
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
                                            <p class="text-muted fw-medium">Calon Osis</p>
                                            <h4 class="mb-0">{{ count($hasil_vote) }}</h4>
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
                                        <?php $no = 0; ?>
                                        @foreach ($hasil_vote as $item)
                                            <?php
                                            $no = $no + 1;
                                            $color = 'secondary';
                                            ?>
                                            <div class="col-xl-3 col-sm-6">
                                                <div class="card">
                                                    <div class="border p-3 rounded mt-4">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate font-size-15">
                                                                        <a href="javascript: void(0);" class="text-dark">
                                                                            <span
                                                                                class="badge bg-{{ $color }}">Pasalon
                                                                                {{ $no }}</span>
                                                                        </a>
                                                                    </h5>
                                                                    <p class="text-muted mb-4">{{ $item->ketua }} &
                                                                        {{ $item->wakil }}</p>
                                                                    <div class="avatar-group" style="padding-left: 50px;">
                                                                        <div class="avatar-group-item"
                                                                            style="margin-left: 10px;">
                                                                            <a href="javascript: void(0);"
                                                                                class="d-inline-block">
                                                                                <img src="{{ URL::asset('assets/images/users/' . $item->foto_ketua) }}"
                                                                                    alt=""
                                                                                    class="rounded-circle avatar-xs"
                                                                                    style="height: 6rem;width: 6rem;">
                                                                            </a>
                                                                        </div>
                                                                        <div class="avatar-group-item"
                                                                            style="margin-left: 10px;">
                                                                            <a href="javascript: void(0);"
                                                                                class="d-inline-block">
                                                                                <img src="{{ URL::asset('assets/images/users/' . $item->foto_wakil) }}"
                                                                                    alt=""
                                                                                    class="rounded-circle avatar-xs"
                                                                                    style="height: 6rem;width: 6rem;">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="px-4 py-3 border-top text-center">
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item me-3">
                                                                    <a href="javascript(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModalScrollable{{ $no }}">
                                                                        <i class="bx bx-comment-dots me-1"></i> Visi & Misi
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="modal fade"
                                                                id="exampleModalScrollable{{ $no }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalScrollableTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalScrollableTitle">Visi &
                                                                                Misi
                                                                                Kandidat</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php echo $item->visi_misi; ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
