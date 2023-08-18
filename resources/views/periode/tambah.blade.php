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
                                <li class="breadcrumb-item">{{ $aksi }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('periode.store') }}" method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Periode
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="periode" name="periode"
                                                onkeyup="this.value = this.value.toUpperCase();"
                                                value="{{ old('periode') }}" autofocus required
                                                placeholder="etc: 2023/2024">
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('periode', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Flag</label>
                                            <input type="number" class="form-control" id="flag" name="flag"
                                                max="1" value="{{ old('flag') }}" autofocus placeholder="flag"
                                                autocomplete="off">
                                            <div class="invalid-feedback">
                                                Data 1 karakter.
                                            </div>
                                            {!! $errors->first('flag', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('periode.index') }}"
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
