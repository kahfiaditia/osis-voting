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
            <form class="needs-validation" action="{{ route('pengguna.update_guru_listuser', $data->id) }}"
                enctype="multipart/form-data" method="POST" novalidate>
                @csrf
                @method('PATCH')
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
                                                    @if ($data->roles == 'siswa') selected @endif> Siswa
                                                </option>
                                                <option value="{{ $data->roles }}"
                                                    @if ($data->roles == 'guru') selected @endif> Guru
                                                </option>
                                                <option value="{{ $data->roles }}"
                                                    @if ($data->roles == 'Administrator') selected @endif> Adminitrator
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
                                            <label for="nis" class="form-label">NIK </label>
                                            <input type="text" class="form-control" name="nis" id="nis"
                                                value="{{ $data->nis }}" autocomplete="off" required>
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
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="avatar" id="avatar"
                                                autocomplete="off">
                                            @if ($data->avatar)
                                                <a href="javascript:void(0)" data-id="" id="get_data"
                                                    data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                                                    <i
                                                        class="mdi mdi-file-document font-size-16 align-middle text-primary me-2"></i>Lihat
                                                    Dokumen
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        {{-- <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select class="form-control select2" name="kelas" id="kelas">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $data->class_id) selected @endif>
                                                        {{ $item->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>



                                </div>
                                <div class="row">

                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('list_data_guru') }}"
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ URL::asset('avatar/' . $data->avatar) }}" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@endsection
