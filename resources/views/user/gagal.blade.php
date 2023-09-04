@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">Gagal</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Gagal</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-sm-0 font-size-18">Pastikan Nis Wajib Diisi dan Unik, Email dan TLP JIKA DIISI
                                wajib Unik</h4>
                            <div class="alert alert-warning mt-3" role="alert">
                                Gagal Upload data Siswa <a href="javascript: void(0);" class="alert-link">an example
                                    link</a>. Pastikan Nis telah diisi dan unik, jika tlp dan email diisi pastikan tidak ada
                                yang sama dan belum pernah diupload.
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <a href="{{ route('pengguna.halaman') }}"
                                        class="btn btn-secondary waves-effect">Ulangi</a>
                                    {{-- <button class="btn btn-primary" type="submit" style="float: right"
                                        id="submit">Simpan</button> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
