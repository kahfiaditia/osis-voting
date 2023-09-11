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
            <form class="needs-validation" action="{{ route('periode.update', $edit->id) }}" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Periode
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="periode" name="periode"
                                                onkeyup="this.value = this.value.toUpperCase();"
                                                value="{{ $edit->periode_name }}" autofocus required placeholder="etc: 2">
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('periode', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="d-block">Tipe Foto<code>*</code></label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type_foto"
                                                    id="inlineRadio1" value="Kandidat" onchange="typeChoice(this);"
                                                    @if ($edit->type_foto == 'Kandidat') checked @endif required>
                                                <label class="form-check-label" for="inlineRadio1">Foto Gabungan Pasalon
                                                    (1
                                                    Foto 2 Pasalon)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type_foto"
                                                    id="inlineRadio2" value="User" onchange="typeChoice(this);"
                                                    @if ($edit->type_foto == 'User') checked @endif>
                                                <label class="form-check-label" for="inlineRadio2">Foto Terpisah Pasalon
                                                    (Foto dari data Siswa)</label>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="flag" class="form-label">Aktif ? <code>*</code></label>
                                            <br>
                                            <input type="checkbox" name="flag" id="flagSwitch" switch="none"
                                                {{ $edit->flag === null ? 'checked' : '' }} />
                                            <label for="flagSwitch" data-on-label="On" data-off-label="Off"></label>
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
