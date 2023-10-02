@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ $menu }}</li>
                                <li class="breadcrumb-item">{{ $data }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" novalidate>
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
                                                <label for="pembina" class="form-label">Pembina</label>
                                                <input type="text" class="form-control" name="nama_pembina"
                                                    id="nama_pembina" value="{{ $jadwal->nama_pembina }}" autocomplete="off"
                                                    readonly>
                                                <input type="text" class="form-control" name="pembina" id="pembina"
                                                    value="{{ $jadwal->id_pembina }}" autocomplete="off" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                                <input type="text" class="form-control" name="nama_kegiatan"
                                                    id="nama_kegiatan" value="{{ $jadwal->nama_kegiatan }}"
                                                    autocomplete="off" readonly>
                                                <input type="text" class="form-control" name="kegiatan" id="kegiatan"
                                                    value="{{ $jadwal->id_kegiatan }}" autocomplete="off" hidden>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="hari" class="form-label">Hari</label>
                                                <select class="form-control select select2 hari" name="hari"
                                                    id="hari">
                                                    @foreach ($nama_harinya as $inihari)
                                                        <option value="{{ $inihari->id }}"
                                                            {{ $inihari->id == $jadwal->id_hari ? 'selected' : '' }}>
                                                            {{ $inihari->nama_hari }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="mulai" class="form-label">Jam Mulai</label>
                                                    <input type="text" class="form-control" name="mulai" id="mulai"
                                                        value="{{ $jadwal->jam_mulai }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" name="selesai" id="selesai"
                                                    value="{{ $jadwal->jam_selesai }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="status1" class="form-label">Status</label>
                                                <select class="form-control" name="status1" id="status1" required>
                                                    <option value=""> -- Pilih --</option>
                                                    <option value="1"> Aktif </option>
                                                    <option value="2"> Tidak Aktif</option>
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
