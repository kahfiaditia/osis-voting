@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"> {{ $label }} </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Absen</a></li>
                                <li class="breadcrumb-item active"> {{ $kegiatan }} </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h4>Absen Mandiri</h4>
                        <p class="text-muted">Pastikan kehadirannya di setiap kegiatan tersebut dengan jadwal yang telah
                            ditentukan, kegiatan ini adalah penunjang penilaian</p>
                    </div>
                </div>
            </div>

            <div class="row">

                @foreach ($lists as $value1)
                    <div class="col-xl-3 col-md-6">
                        <div class="card plan-box">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5>{{ $value1->nama_kegiatan }}</h5>
                                        <p class="text-muted">{{ $value1->nama_hari }}</p>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <i class="bx bx-notepad h1 text-primary"></i>
                                    </div>
                                </div>
                                <?php $tanggalHariIni = date('Y-m-d'); ?>
                                <input type="text" class="form-control" value="{{ $value1->id_hari }}" name="hari"
                                    id="hari" placeholder="hari" hidden>
                                <input type="text" class="form-control" value="{{ $value1->id_kegiatan }}"
                                    name="kegiatan" id="kegiatan" placeholder="kegiatan" hidden>
                                <input type="text" class="form-control" value="{{ $value1->id }}" name="jadwal"
                                    id="jadwal" placeholder="jadwal" hidden>
                                <input type="text" class="form-control" value="{{ $tanggalHariIni }}" name="tanggal"
                                    id="tanggal" placeholder="tanggal" hidden>

                                <div class="text-center plan-btn">
                                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light"
                                        id="hadirButton">Hadir
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm waves-effect waves-light"
                                        id="izinButton">Izin
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm waves-effect waves-light"
                                        id="alpaButton">Alpa
                                    </a>
                                </div>

                                {{-- @endif --}}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div> <!-- container-fluid -->
    </div>
    <script script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#hadirButton').click(function(e) {
                e.preventDefault();

                // Tampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Yakin Anda Hadir?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika OK diklik, buat objek JSON dengan data yang akan dikirim
                        var dataToSend = {
                            _token: '{{ csrf_token() }}',
                            user_id: '{{ auth()->user()->id }}',
                            hari: $('#hari').val(),
                            kegiatan: $('#kegiatan').val(),
                            jadwal: $('#jadwal').val(),
                            tanggal: $('#tanggal').val(),
                            // Tambahkan data lain yang diperlukan
                        };

                        // Mengirim data dalam format JSON
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('absen_mandiri.data_hadir') }}', // Ganti dengan URL controller Anda
                            headers: {
                                'Content-Type': 'application/json', // Header untuk format JSON
                            },
                            data: JSON.stringify(dataToSend), // Mengubah data menjadi JSON
                            success: function(response) {

                                Swal.fire({
                                    title: 'Hadir berhasil',
                                    text: 'Anda telah hadir.',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error jika terjadi kesalahan saat mengirim data
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });

            $('#izinButton').click(function(e) {
                e.preventDefault();

                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Yakin Anda Izin?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika OK diklik, kirim data ke controller melalui AJAX
                        $.ajax({
                            type: 'POST',
                            url: '/path-to-your-controller', // Ganti dengan URL controller Anda
                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: '{{ auth()->user()->id }}',
                                value: 2
                            },
                            success: function(response) {
                                // Handle respons dari controller jika diperlukan
                                // Misalnya, jika Anda ingin menampilkan pesan sukses
                                Swal.fire({
                                    title: 'Izin berhasil',
                                    text: 'Anda telah Izin.',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error jika terjadi kesalahan saat mengirim data
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });

            $('#alpaButton').click(function(e) {
                e.preventDefault();

                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Yakin Anda memilih Alpa?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika OK diklik, kirim data ke controller melalui AJAX
                        $.ajax({
                            type: 'POST',
                            url: '', // Ganti dengan URL controller Anda
                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: '{{ auth()->user()->id }}',
                                value: 3
                            },
                            success: function(response) {
                                // Handle respons dari controller jika diperlukan
                                // Misalnya, jika Anda ingin menampilkan pesan sukses
                                Swal.fire({
                                    title: 'Absen berhasil',
                                    text: 'Anda telah Tidak Mauk.',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error jika terjadi kesalahan saat mengirim data
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
