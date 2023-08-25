@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profil</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informasi User</h4>
                            <form class="needs-validation" action="{{ route('pengguna.updateprofil', $profil->id) }}"
                                method="POST" novalidate>
                                @csrf
                                @method('PATCH')
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="productname">Nama</label>
                                            <input name="nama" id="nama" type="text" value="{{ $profil->name }}"
                                                class="form-control" autocomplete="off" maxlenght="50" readonly>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturername">Email</label>
                                            <input name="email" id="email" value="{{ $profil->email }}" type="email"
                                                class="form-control" autocomplete="off" maxlenght="50">
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('email', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>

                                        <div class="mb-1">
                                            <label for="price">PIN</label>
                                            <input id="pin" name="pin" type="password" value="{{ $profil->pin }}"
                                                class="form-control" maxlenght="4" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Data wajib diisi.
                                        </div>
                                        {!! $errors->first('pin', '<div class="invalid-validasi">:message</div>') !!}
                                        <div class="mb-3">
                                            <label for="productdesc">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="2" maxlenght="50" readonly>{{ $profil->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="control-label">Role</label>
                                            <input id="text" name="role" type="role" value="{{ $profil->roles }}"
                                                class="form-control" autocomplete="off" maxlenght="60" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="manufacturername">NIK</label>
                                            <input name="nis" id="nis" type="text" class="form-control"
                                                value="{{ $profil->nis }}" autocomplete="off" maxlenght="15" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdesc">Password</label>
                                            <input id="password" name="password" type="password" {{ $profil->pssword }}
                                                class="form-control" autocomplete="off" maxlenght="60">
                                        </div>
                                        <div class="mb-1">
                                            <label for="price">PIN</label>
                                            <input id="phone" name="phone" type="number" value="{{ $profil->phone }}"
                                                class="form-control" maxlenght="4" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Data wajib diisi.
                                        </div>
                                        {!! $errors->first('pin', '<div class="invalid-validasi">:message</div>') !!}
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan
                                    </button>
                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-secondary waves-effect waves-light">Batal</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
