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
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('pengguna.store') }}" enctype="multipart/form-data"
                method="POST" novalidate>
                @csrf
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <a href="{{ route('pengguna.halaman') }}" type="button"
                            class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i> Upload Excel
                        </a>
                    </ol>
                </div>
                <input type="hidden" name="flag" value="tambah_siswa">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <code>*</code></label>
                                            <input type="text" class="form-control" name="role" id="role"
                                                value="siswa" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <code>*</code></label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                autocomplete="off" maxlength="30" required>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nis" class="form-label">Nis </label>
                                            <input type="text" class="form-control" name="nis" id="nis"
                                                autocomplete="off" maxlength="15" required>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nis', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select class="form-control select2" name="kelas" id="kelas">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($kelas as $datakelas)
                                                    <option value="{{ $datakelas->id }}">
                                                        {{ $datakelas->class_name . ' - ' . $datakelas->class_level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                value="" autocomplete="off" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" id="alamat"
                                                autocomplete="off" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="telepon" id="telepon"
                                                autocomplete="off" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="avatar" id="avatar"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('pengguna.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right"
                                            id="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
