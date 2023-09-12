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
                                {{-- <li class="breadcrumb-item">{{ $aksi }}</li> --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('kegiatan.update', $edit->id) }}" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Kode
                                            </label>
                                            <input type="text" class="form-control" id="kode" name="kode"
                                                onkeyup="this.value = this.value.toUpperCase();" value="{{ $edit->kode }}"
                                                autofocus maxlength="12" placeholder="Kode Kegiatan etc: PMK">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Nama
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                maxlength="30" value="{{ $edit->name }}" autofocus required
                                                placeholder="Nama Kegiatan">
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="validationCustom02" class="form-label">Deskripsi
                                            </label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                value="{{ $edit->deskripsi }}" autofocus maxlength="30"
                                                placeholder="etc: 2">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="flag" class="form-label">Aktif ? <code>*</code></label>
                                            <br>
                                            <input type="checkbox" name="status" id="flagSwitch" switch="none"
                                                {{ $edit->status == 1 ? 'checked' : '' }} />
                                            <label for="flagSwitch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('kegiatan.index') }}"
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
