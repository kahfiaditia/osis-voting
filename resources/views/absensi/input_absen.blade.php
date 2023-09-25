@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">

            {{-- <div class="page-content">
                <div class="container-fluid"> --}}

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Daftar</li>
                                <li class="breadcrumb-item active">{{ $kegiatan }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">{{ $title }}</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-order" role="tab">
                                        Absensi Manual
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#processing" role="tab">
                                        Processing
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="all-order" role="tabpanel">

                                    <div class="table-responsive mt-5">
                                        <table class="table table-hover datatable dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nis</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Absensi</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensinya as $list)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $list->nis }}</td>
                                                        <td>{{ $list->name }}</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input absensi" type="radio"
                                                                    name="absensi_{{ $list->id_user }}"
                                                                    id="izin_{{ $list->id_user }}" value="2"
                                                                    onclick="toggleKeterangan('{{ $list->id_user }}', true)">
                                                                <label class="form-check-label">Izin</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input absensi" type="radio"
                                                                    name="absensi_{{ $list->id_user }}"
                                                                    id="alpa_{{ $list->id_user }}" value="3"
                                                                    onclick="toggleKeterangan('{{ $list->id_user }}', false)">
                                                                <label class="form-check-label">Alpa</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input absensi" type="radio"
                                                                    name="absensi_{{ $list->id_user }}"
                                                                    id="hadir_{{ $list->id_user }}" value="1"
                                                                    onclick="toggleKeterangan('{{ $list->id_user }}', false)">
                                                                <label class="form-check-label">Hadir</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="form-control keterangan-input" type="text"
                                                                name="keterangan_{{ $list->id_user }}"
                                                                id="keterangan_{{ $list->id_user }}" maxlength="20"
                                                                placeholder="Tambahkan Keterangan Izin"
                                                                style="display: none" required>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input absensi-all" type="radio"
                                                                name="absensi_pilihan" value="izin"
                                                                id="absensi_pilihan_izin" onclick="setAllRadio('izin')">
                                                            <label class="form-check-label">All Izin</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input absensi-all" type="radio"
                                                                name="absensi_pilihan" value="alpa"
                                                                id="absensi_pilihan_alpa" onclick="setAllRadio('alpa')">
                                                            <label class="form-check-label">All Alpa</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input absensi-all" type="radio"
                                                                name="absensi_pilihan" value="hadir"
                                                                id="absensi_pilihan_hadir" onclick="setAllRadio('hadir')">
                                                            <label class="form-check-label">All Hadir</label>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a href="{{ route('daftar_absensi.index') }}"
                                                class="btn btn-secondary waves-effect">Batal</a>
                                            <button class="btn btn-primary" id="simpanButton"
                                                style="float: right">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>

    <script script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>

    <script>
        // Fungsi untuk mengatur tampilan input keterangan
        function toggleKeterangan(id, show) {
            var keteranganInput = document.getElementById('keterangan_' + id);
            keteranganInput.style.display = show ? 'block' : 'none';
        }

        // Fungsi untuk mengatur perilaku radio button pada baris siswa
        function setRadioValue(id, value) {
            document.getElementById('izin_' + id).checked = value === 'izin';
            document.getElementById('alpa_' + id).checked = value === 'alpa';
            document.getElementById('hadir_' + id).checked = value === 'hadir';
        }

        // Fungsi untuk mengatur radio button pada tfoot
        function setAllRadio(value) {
            var absensiAllRadios = document.getElementsByClassName('absensi-all');
            for (var i = 0; i < absensiAllRadios.length; i++) {
                absensiAllRadios[i].checked = false;
            }
            document.getElementById('absensi_pilihan_' + value).checked = true;
        }

        function simpanData() {
            var data = [];

            // Loop melalui baris siswa
            @foreach ($absensinya as $list)
                var id_user = '{{ $list->id_user }}';
                var id_kegiatan = '{{ $list->id_kegiatan }}';
                var absensi = document.querySelector('input[name="absensi_' + id_user + '"]:checked');
                var keterangan = document.getElementById('keterangan_' + id_user).value;

                // Tambahkan validasi untuk absensi yang harus diisi
                if (!absensi) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Absensi harus diisi',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return; // Hentikan proses jika absensi kosong
                }

                data.push({
                    id_user: id_user,
                    id_kegiatan: id_kegiatan,
                    absensi: absensi.value,
                    keterangan: keterangan
                });
            @endforeach

            // Kirim data melalui AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('daftar_absensi.simpan') }}', // Ganti dengan nama route yang sesuai
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data
                },
                success: function(response) {
                    if (response.code == 200) {
                        Swal.fire({
                            title: 'Absen berhasil di Input',
                            text: `${response.message}`,
                            icon: 'success',
                            timer: 1000,
                            willClose: () => {
                                // Mengarahkan ke route jadwal.index
                                window.location.href =
                                    '{{ route('daftar_absensi.index') }}';
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 1500,
                            willClose: () => {
                                location.reload();
                            }
                        })
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        // Tambahkan event listener untuk tombol "Simpan"
        document.getElementById('simpanButton').addEventListener('click', function() {
            simpanData();
        });
    </script>
@endsection
