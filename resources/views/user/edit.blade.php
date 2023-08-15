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
            <form class="needs-validation" action="{{ route('pengguna.update', $data->id) }}" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <!-- Form fields here -->

                </div>



                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <code>*</code></label>
                                            <select class="form-control select select2 role" name="role" id="role">
                                                <option value=""> -- Pilih --</option>
                                                <option value="{{ $data->roles }}"
                                                    @if ($data->roles == 'guru') selected @endif> Guru
                                                </option>
                                                <option value="{{ $data->roles }}"
                                                    @if ($data->roles == 'siswa') selected @endif> Siswa
                                                </option>
                                                <option value="{{ $data->roles }}"
                                                    @if ($data->roles == 'Adminitrator') selected @endif> Adminitrator
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <code>*</code></label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                value="{{ $data->name }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nis" class="form-label">Nis </label>
                                            <input type="text" class="form-control" name="nis" id="nis"
                                                value="{{ $data->nis }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK </label>
                                            <input type="text" class="form-control" name="nik" id="nik"
                                                value="{{ $data->nik }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select class="form-control" name="kelas" id="kelas">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $data->class_id) selected @endif>
                                                        {{ $item->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <code>*</code></label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                value="{{ $data->email }}" value="" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" id="alamat"
                                                value="{{ $data->address }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Phone <code>*</code></label>
                                            <input type="text" class="form-control" name="telepon" id="telepon"
                                                value="{{ $data->phone }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
