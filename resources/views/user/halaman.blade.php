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
                            <a href="{{ route('pengguna.template') }}" class="btn btn-primary waves-effect"
                                target="_blank">Download
                                Excel Template</a>

                            <form action="{{ route('pengguna.uploadExcel') }}" method="post" class="dropzone"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mt-4">
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

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
@endsection
