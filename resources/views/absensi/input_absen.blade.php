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

                            <h4 class="card-title">Absensi Kegiatan {{ $absen_kegiatan->nama_kegiatan }}
                                - {{ $absen_kegiatan->nama_hari }} - {{ $absen_kegiatan->created_at }}
                            </h4>
                            <hr>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        id="accordion-button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        <i class="bx bx-search-alt font-size-18"></i>
                                                        <b>Barcode</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body barcodeScanner">
                                                        <div class="row text-muted">
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="form-label">Metode Scan</label>
                                                                <div class="mb-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input radio" type="radio"
                                                                            name="toggle" id="inlineRadio1"
                                                                            value="Barcode">
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio1">Barcode</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input radio" type="radio"
                                                                            name="toggle" id="inlineRadio2"
                                                                            value="Scan Kamera">
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">Scan
                                                                            Kamera</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-muted div_barcode">
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-2">
                                                                <select class="form-control select select2 data_absen"
                                                                    name="absensi1" id="absensi1" required>
                                                                    <option value=""> -- Pilih --</option>
                                                                    <option value="1"> Hadir </option>
                                                                    <option value="3"> Alpa </option>
                                                                    <option value="2"> Izin </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control scanner_barcode"
                                                                    id="scanner_barcode" name="scanner_barcode"
                                                                    placeholder="NIS" autofocus>
                                                            </div>
                                                        </div>
                                                        <div class="row text-muted div_scan_camera">
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <div id="qr-reader"></div>
                                                                <div id="qr-reader-results"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- //data --}}
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="all-order" role="tabpanel">
                                                <div class="table-responsive mt-5">
                                                    <table class="table table-hover datatable dt-responsive nowrap"
                                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;"
                                                        id="tableAbsen">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="width: 70px;">#</th>
                                                                <th scope="col" style="width: 70px;" hidden>id</th>
                                                                <th scope="col" style="width: 120px;">Nis</th>
                                                                <th scope="col" style="width: 180px;">Nama</th>
                                                                <th scope="col" style="width: 120px;">Absensi</th>
                                                                <th scope="col" style="width: 120px;"></th>
                                                                <th scope="col" style="width: 120px;"></th>
                                                                <th scope="col">Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($absensinya as $list)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td hidden>{{ $list->id_user }}</td>
                                                                    <td>{{ $list->nis }}</td>
                                                                    <td>{{ $list->name }}</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input absensi"
                                                                                type="radio"
                                                                                name="absensi_{{ $list->id_user }}"
                                                                                id="izin_{{ $list->id_user }}"
                                                                                value="2"
                                                                                onclick="toggleKeterangan('{{ $list->id_user }}', true)">
                                                                            <label class="form-check-label">Izin</label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input absensi"
                                                                                type="radio"
                                                                                name="absensi_{{ $list->id_user }}"
                                                                                id="alpa_{{ $list->id_user }}"
                                                                                value="3"
                                                                                onclick="toggleKeterangan('{{ $list->id_user }}', false)">
                                                                            <label class="form-check-label">Alpa</label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input absensi"
                                                                                type="radio"
                                                                                name="absensi_{{ $list->id_user }}"
                                                                                id="hadir_{{ $list->id_user }}"
                                                                                value="1"
                                                                                onclick="toggleKeterangan('{{ $list->id_user }}', false)">
                                                                            <label class="form-check-label">Hadir</label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control keterangan-input"
                                                                            type="text"
                                                                            name="keterangan_{{ $list->id_user }}"
                                                                            id="keterangan_{{ $list->id_user }}"
                                                                            maxlength="20"
                                                                            placeholder="Tambahkan Keterangan Izin"
                                                                            style="display: none" required>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden>


                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" value="2"
                                                                            name="absensi_pilihan"
                                                                            id="absensi_pilihan_izin"
                                                                            onclick="setAllRadio('izin')">
                                                                        <label class="form-check-label">All Izin</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" value="3"
                                                                            name="absensi_pilihan"
                                                                            id="absensi_pilihan_alpa"
                                                                            onclick="setAllRadio('alpa')">
                                                                        <label class="form-check-label">All Alpa</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" value="1"
                                                                            name="absensi_pilihan"
                                                                            id="absensi_pilihan_hadir"
                                                                            onclick="setAllRadio('hadir')">
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
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>

    <script script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="{{ asset('assets/scanner/html5-qrcode.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    barcode = decodedText;
                    // pembeli = document.getElementById("pembeli").value;

                    // Check if absensi1 dropdown is empty
                    var absensiValue = $("#absensi1").val();
                    if (!absensiValue) {
                        // Display an alert if absensi1 is not selected
                        Swal.fire({
                            icon: 'error',
                            title: 'Pilih Data Absensi terlebih dahulu',
                            text: 'Harap pilih Data Absensi terlebih dahulu sebelum melakukan scan barcode.',
                        });
                        return;
                    }

                    // get value database 
                    getValueScanBarcodeCamera(barcode)
                    // getValueScanBarcodeCamera(barcode, pembeli)
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);

            $('.div_scan_camera').hide();
            $('.div_barcode').hide();

            collapseOne.classList.remove("show");

            function getValueScanBarcodeCamera(nis, user) {
                var absensiValue = $("#absensi1").val();
                if (!absensiValue) {
                    // Display an alert if absensi1 is not selected
                    Swal.fire({
                        icon: 'error',
                        title: 'Pilih Kehadiran',
                        text: 'Harap pilih Kehadiran Absensi.',
                    });
                    return;
                }

                var kehadiran = $("#absensi1 option:selected").text();
                // console.log(kehadiran);
                var kodeKehadiran = $("#absensi1").val();
                // console.log(kodeKehadiran);

                var table = $('#tableAbsen').DataTable();
                var existingData = new Set();

                // Loop through existing rows to populate existingData
                table.rows().every(function() {
                    var rowData = this.data();
                    var dataKey = rowData[1] + "-" + rowData[
                        4]; // Assuming ID is in the first column and Kode Kegiatan is in the fifth column
                    existingData.add(dataKey);
                });

                var nisFound = false;

                // Loop through the table rows to find the NIS
                table.rows().every(function() {
                    var rowData = this.data();
                    var nisInTable = rowData[2]; // Assuming NIS is in the third column
                    var radioName = 'absensi_' + rowData[1]; // Assuming ID is in the second column

                    if (nisInTable === nis) {
                        nisFound = true;
                        // Check the appropriate radio button based on absensi1 dropdown selection
                        $('input[name="' + radioName + '"]').each(function() {
                            if ($(this).val() === kodeKehadiran) {
                                $(this).prop('checked', true);
                            }
                        });

                        // Toggle visibility of Keterangan input field
                        if (kodeKehadiran === '2') { // '2' represents Izin
                            $('#keterangan_' + rowData[1]).show();
                        } else {
                            $('#keterangan_' + rowData[1]).hide();
                        }

                        return false; // Exit the loop since NIS is found
                    }
                });

                if (!nisFound) {
                    // Display an alert if the NIS is not found
                    Swal.fire({
                        icon: 'error',
                        title: 'NIS Not Found',
                        text: 'Siswa dengan NIS tersebut tidak ditemukan dalam daftar absensi.',
                    });
                } else {
                    // Display an alert for successful attendance record
                    Swal.fire({
                        icon: 'success',
                        title: 'Absensi Berhasil',
                        text: 'Absensi telah berhasil dicatat.',
                    });
                }
            }

            $(document).ready(function() {
                $('.radio').click(function() {
                    let metode_scan = $(this).val();
                    if (metode_scan == 'Barcode') {
                        $('.div_scan_camera').hide();
                        $('.div_barcode').show();
                    } else {
                        $('.div_scan_camera').show();
                        $('.div_barcode').hide();
                    }
                });

                $(".scanner_barcode").change(function() {
                    let barcode = $(this).val();
                    // user = document.getElementById("user").value;
                    document.getElementById('scanner_barcode').value = '';
                    // get value database 
                    getValueScanBarcodeCamera(barcode)
                    // getValueScanBarcodeCamera(barcode, user)
                });

            });
        });

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
        // function setAllRadio(value) {
        //     var absensiAllRadios = document.getElementsByClassName('absensi-all');
        //     for (var i = 0; i < absensiAllRadios.length; i++) {
        //         absensiAllRadios[i].checked = false;
        //     }
        //     document.getElementById('absensi_pilihan_' + value).checked = true;
        // }

        function setAllRadio(value) {
            // Menghapus ceklis dari semua radio button di tfoot
            var absensiAllRadios = document.getElementsByClassName('absensi-all');
            for (var i = 0; i < absensiAllRadios.length; i++) {
                absensiAllRadios[i].checked = false;
            }

            // Mengubah status radio button di tbody sesuai dengan value yang dipilih di tfoot
            var tbodyRadioButtons = document.querySelectorAll('tbody input[type="radio"]');
            for (var j = 0; j < tbodyRadioButtons.length; j++) {
                var id_user = tbodyRadioButtons[j].id.split('_')[1];
                if (value === 'izin') {
                    tbodyRadioButtons[j].checked = (tbodyRadioButtons[j].id === 'izin_' + id_user);
                } else if (value === 'alpa') {
                    tbodyRadioButtons[j].checked = (tbodyRadioButtons[j].id === 'alpa_' + id_user);
                } else if (value === 'hadir') {
                    tbodyRadioButtons[j].checked = (tbodyRadioButtons[j].id === 'hadir_' + id_user);
                }
            }

            var izinElements = document.querySelectorAll('tbody [id^="izin_"]');
            var alpaElements = document.querySelectorAll('tbody [id^="alpa_"]');
            var hadirElements = document.querySelectorAll('tbody [id^="hadir_"]');

            var isIzinEmpty = izinElements.length == 0;
            var isAlpaEmpty = alpaElements.length == 0;
            var isHadirEmpty = hadirElements.length == 0;

            if (isIzinEmpty && isAlpaEmpty && isHadirEmpty) {
                // Tidak ada elemen di tbody, hapus ceklis dari radio button di tfoot
                document.querySelector('#absensi_pilihan_izin').checked = false;
                document.querySelector('#absensi_pilihan_alpa').checked = false;
                document.querySelector('#absensi_pilihan_hadir').checked = false;
            }
        }


        // function updateTfootRadioButtons() {
        //     var izinElements = document.querySelectorAll('tbody [id^="izin_"]');
        //     var alpaElements = document.querySelectorAll('tbody [id^="alpa_"]');
        //     var hadirElements = document.querySelectorAll('tbody [id^="hadir_"]');

        //     var isIzinEmpty = izinElements.length == 0;
        //     var isAlpaEmpty = alpaElements.length == 0;
        //     var isHadirEmpty = hadirElements.length == 0;

        //     if (isIzinEmpty && isAlpaEmpty && isHadirEmpty) {
        //         // Tidak ada elemen di tbody, hapus ceklis dari radio button di tfoot
        //         document.querySelector('#absensi_pilihan_izin').checked = false;
        //         document.querySelector('#absensi_pilihan_alpa').checked = false;
        //         document.querySelector('#absensi_pilihan_hadir').checked = false;
        //     }
        // }

        // // Panggil fungsi saat halaman dimuat
        // updateTfootRadioButtons();

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
                url: '{{ route('daftar_absensi.simpan') }}',
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
