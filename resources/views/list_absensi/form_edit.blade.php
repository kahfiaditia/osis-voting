@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Absensi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Edit</li>
                                <li class="breadcrumb-item">Edit Absen</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('data_list_absen.update', $hasil->id) }}" method="POST"
                novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="nis" class="form-label">Nis</label>
                                                <input type="text" class="form-control" name="nis" id="nis"
                                                    value="{{ $hasil->nis }}" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    value="{{ $hasil->siswa }}" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="nis" class="form-label">Kegiatan</label>
                                                <input type="text" class="form-control" name="kegiatan" id="kegiatan"
                                                    value="{{ $hasil->kegiatan }}" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="kehadiran" class="form-label">Kehadiran</label>
                                                <select class="form-control select2" name="kehadiran" id="kehadiran">
                                                    <option value="1" {{ $hasil->status == '1' ? 'selected' : '' }}>
                                                        Hadir </option>
                                                    <option value="2" {{ $hasil->status == '2' ? 'selected' : '' }}>
                                                        Izin </option>
                                                    <option value="3" {{ $hasil->status == '3' ? 'selected' : '' }}>
                                                        Alpa </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('data_list_absen.absen_edit') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right">Simpan</button>
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
