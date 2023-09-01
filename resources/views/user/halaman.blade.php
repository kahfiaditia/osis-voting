@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Upload</a></li>
                                <li class="breadcrumb-item active">Create New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Import</h4>
                            <p class="card-title-desc">Upload Data Siswa</p>
                            <div class="alert alert-warning" role="alert">
                                Sebelum Upload, klik <a href="{{ route('pengguna.hapus_semua') }}" class="alert-link">DI
                                    SINI</a>
                                terlebih dahulu agar upload berjalan lancar
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('template') }}" class="btn btn-primary waves-effect mb-3"
                                    target="_blank">Download Excel Template</a>
                                <button type="button" class="btn btn-success waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target=".bs-example-modal-sm">Panduan Upload</button>
                            </div>
                            {{-- <a href="{{ route('template') }}" class="btn btn-primary waves-effect mb-3"
                                target="_blank">Download
                                Excel Template</a>

                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-sm">Panduan Upload</button> --}}

                            <form action="{{ route('pengguna.uploadExcel') }}" method="post" class="dropzone"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="mt-4">
                                    <div class="fallback">
                                        <input type="file" name="excelFile" id="excelFile" multiple="multiple"
                                            accept=".xls,.xlsx">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                        </div>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>

                                </div> --}}

                                <div class="container text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 mt-4">
                                            <div class="fallback">
                                                <input type="file" name="excelFile" id="excelFile" multiple="multiple"
                                                    accept=".xls,.xlsx">
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                </div>
                                                <h4>Drop files here or click to upload.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12">
                        <a href="{{ route('pengguna.alluser') }}" class="btn btn-secondary waves-effect">Batal</a>
                        {{-- <a href="{{ route('pengguna.hapus_semua') }}" class="btn btn-secondary waves-effect">Clear Cache</a> --}}
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>

    <!--  Small modal example -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Panduan Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>1. Tekan Tomobol Pembersihan Data Temporary dengan klik Tulisan <b>DI SINI</b></p>
                    <p>2. Pastikan Download Template Upload dan sesuaikan</p>
                    <p>3. Kelas bisa dilihat di menu kelas dengan memasukan ID Kelas pada menu kelas</p>
                    <p>4. Nis, Email dan Phone <b>harus unik atau berbeda</b> dengan yang lainnya</p>
                    <p>5. Nama dan Nis dan roles Harus/Wajib <b>diisi</b></p>
                    <p>6. Roles harus diisi dengan kata "siswa" <b>(Hilangkan tanda petik)</b></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
