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
                            <h4 class="card-title mb-3">{{ $title }}</h4>
                            {{-- {{ $data_kegiatan }} --}}
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-order" role="tab">
                                        Absensi Manual
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('barcode_absensi', $data_kegiatan) }}">Barcode</a>
                                </li>
                            </ul>

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
                                                                    name="" id="">
                                                                    <option value=""> -- Pilih --</option>
                                                                    <option value=""> Hadir </option>
                                                                    <option value=""> Alpa </option>
                                                                    <option value=""> Izin </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" name="scanner_barcode"
                                                                    class="form-control scanner_barcode"
                                                                    id="scanner_barcode" placeholder="NIS" autofocus>
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
                                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="width: 70px;">#</th>
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
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" name="absensi_pilihan"
                                                                            value="izin" id="absensi_pilihan_izin"
                                                                            onclick="setAllRadio('izin')">
                                                                        <label class="form-check-label">All Izin</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" name="absensi_pilihan"
                                                                            value="alpa" id="absensi_pilihan_alpa"
                                                                            onclick="setAllRadio('alpa')">
                                                                        <label class="form-check-label">All Alpa</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input absensi-all"
                                                                            type="radio" name="absensi_pilihan"
                                                                            value="hadir" id="absensi_pilihan_hadir"
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
                                        {{-- // --}}

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="tab-content">
                                <div class="tab-pane active" id="all-order" role="tabpanel">
                                    <div class="table-responsive mt-5">
                                        <table class="table table-hover datatable dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 70px;">#</th>
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
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input absensi" type="radio"
                                                                    name="absensi_{{ $list->id_user }}"
                                                                    id="alpa_{{ $list->id_user }}" value="3"
                                                                    onclick="toggleKeterangan('{{ $list->id_user }}', false)">
                                                                <label class="form-check-label">Alpa</label>
                                                            </div>
                                                        </td>
                                                        <td>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input absensi-all" type="radio"
                                                                name="absensi_pilihan" value="izin"
                                                                id="absensi_pilihan_izin" onclick="setAllRadio('izin')">
                                                            <label class="form-check-label">All Izin</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input absensi-all" type="radio"
                                                                name="absensi_pilihan" value="alpa"
                                                                id="absensi_pilihan_alpa" onclick="setAllRadio('alpa')">
                                                            <label class="form-check-label">All Alpa</label>
                                                        </div>
                                                    </td>
                                                    <td>
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
                            </div> --}}

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
                var kegiatan = $("#kegiatan option:selected").text(); // Ambil nama kegiatan dari dropdown
                var kodeKegiatan = $("#kegiatan").val(); // Ambil kode kegiatan dari dropdown

                // Validasi apakah kegiatan sudah dipilih
                if (!kodeKegiatan) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pilih Kegiatan',
                        text: 'Harap pilih kegiatan terlebih dahulu.',
                    });
                    return;
                }

                var table = $('#daftarBarcode').DataTable();
                var existingData = new Set();

                // Loop through existing rows to populate existingData
                table.rows().every(function() {
                    var rowData = this.data();
                    var dataKey = rowData[1] + "-" + rowData[
                        4]; // Assuming ID is in the first column and Kode Kegiatan is in the fifth column
                    existingData.add(dataKey);
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('follow.scanBarcode1') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        nis,
                    },
                    success: response => {
                        console.log(response);
                        if (response.code == 200) {
                            // Handle jika response memiliki kode 200 (berhasil)
                            if (response.type == 'siswa') {
                                console.log(response);

                                // Buat kunci unik untuk data siswa dari barcode
                                var dataKey = response.id + "-" + kodeKegiatan;

                                // Cek apakah data siswa dari barcode sudah ada di tabel
                                if (existingData.has(dataKey)) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Data sudah ada',
                                        text: 'Data siswa dari barcode sudah ada di input.',
                                    });
                                    return;
                                }

                                // Tambahkan data siswa dari barcode ke dalam tabel
                                var rowNode = table.row.add([
                                    table.rows().count() + 1,
                                    response.id,
                                    response.nis,
                                    response.name,
                                    kodeKegiatan,
                                    kegiatan,
                                    '<a href="#" class="text-danger delete-record"><i class="mdi mdi-delete font-size-18"></i></a>'
                                ]).draw().node();

                                // Tambahkan data siswa dari barcode ke dalam Set existingData
                                existingData.add(dataKey);

                                // Tambahkan data ke dalam row sebagai atribut data-barcode
                                $(rowNode).attr('data-barcode', dataKey);

                                // Bersihkan nilai input barcode setelah berhasil
                                $('#scanner_barcode').val('');
                                var lastRow = table.row(table.rows().count() - 1);
                                var cells = lastRow.node().cells;
                                $(cells[1]).addClass('hidden');
                                $(cells[4]).addClass('hidden');

                                // Hapus data jika tombol delete di klik
                                $(rowNode).find('.delete-record').click(function(e) {
                                    e.preventDefault();
                                    var dataKeyToRemove = $(rowNode).attr('data-barcode');
                                    existingData.delete(dataKeyToRemove);
                                    table.row(rowNode).remove().draw();
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Siswa sudah terdaftar!',
                                    showConfirmButton: false,
                                    timer: 3000,
                                })
                            }
                        } else {
                            // Handle jika response memiliki kode selain 200 (gagal)
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan saat memproses permintaan.',
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    },
                });
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

            })
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
