@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $menu }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">

                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('data_list_absen.index') }}">
                                            Laporan Data Absen
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#absensiedit" role="tab">
                                            Edit Data Absen
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <div class="col-xl-12">
                                <form class="row gy-4 gx-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select class="form-control select select2 kegiatan" name="data_kegiatan"
                                                id="data_kegiatan">
                                                <option value=""> -- Pilih Kegiatan --</option>
                                                @foreach ($jenis as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="hari_container" style="display: none;">
                                        <div class="mb-3">
                                            <select class="form-control select select2 hari" name="data_hari"
                                                id="data_hari">
                                                <option value=""> -- Pilih Hari --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="tanggal_container" style="display: none;">
                                        <div class="mb-3">
                                            <select class="form-control select select2 tanggal" name="data_tanggal"
                                                id="data_tanggal">
                                                <option value=""> -- Pilih Tanggal --</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th hidden>id</th>
                                        <th>Kegiatan</th>
                                        <th>Nis</th>
                                        <th>Siswa</th>
                                        <th>Hari</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            {{-- //modal --}}
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Modal content goes here -->
                    </div>
                </div>
            </div>
            {{-- //modal --}}

        </div>
    </div>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="{{ asset('assets/scanner/html5-qrcode.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#data_kegiatan').change(function() {
                var selectedKegiatan = $(this).val();
                if (selectedKegiatan) {
                    $('#hari_container').show();
                    fetchKegiatan(selectedKegiatan);
                } else {
                    $('#hari_container').hide();
                    $('#tanggal_container').hide();
                    $('#data_kegiatan').val('');
                }
            });

            $('#data_hari').change(function() {
                var selectedHari = $(this).val();
                if (selectedHari) {
                    fetchTanggal(selectedHari, $('#data_kegiatan').val());
                } else {
                    $('#tanggal_container').hide();
                    $('#data_tanggal').empty();
                }
            });

            $('#data_tanggal').change(function() {
                var selectedTanggal = $(this).val();
                if (selectedTanggal) {
                    fetchDataAbsen($('#data_kegiatan').val(), $('#data_hari').val(), selectedTanggal);
                }
            });

            function fetchKegiatan(Kegiatan) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('data_list_absen.data_jadwal') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_kegiatan": Kegiatan
                    },
                    success: function(response) {
                        if (response.code === 200 && response.data) {
                            var options =
                                '<option value=""> -- Pilih Hari --</option>';
                            $.each(response.data, function(index, item) {
                                options += '<option value="' + item.id_hari + '">' + item
                                    .nama_hari + '</option>';
                            });
                            $('#data_hari').html(options);
                            $('#data_hari').select2({
                                width: '100%'
                            });
                            $('#hari_container').show();
                        } else {
                            $('#data_hari').empty().html(
                                '<option value=""> -- Pilih Hari --</option>'
                            );
                            $('#data_hari').select2({
                                width: '100%'
                            });
                            $('#hari_container').hide();
                            $('#tanggal_container').hide();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    },
                });
            }

            function fetchTanggal(idHari, idKegiatan) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('data_list_absen.data_tanggal') }}', // Ganti dengan route yang sesuai
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_hari": idHari,
                        "id_kegiatan": idKegiatan // Mengirim id_kegiatan
                    },
                    success: function(response) {
                        if (response.code === 200 && response.data) {
                            var options =
                                '<option value=""> -- Pilih Tanggal --</option>';
                            $.each(response.data, function(index, item) {
                                options += '<option value="' + item.tanggal + '">' + item
                                    .tanggal + '</option>';
                            });
                            $('#data_tanggal').html(options);
                            $('#data_tanggal').select2({
                                width: '100%'
                            });
                            $('#tanggal_container').show();
                        } else {
                            $('#data_tanggal').empty().html(
                                '<option value=""> -- Pilih Tanggal --</option>'
                            );
                            $('#tanggal_container').hide();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    },
                });
            }

            function fetchDataAbsen(idKegiatan, idHari, tanggal) {
                // console.log(tanggal);
                $.ajax({
                    type: "POST",
                    url: '{{ route('data_list_absen.data_absen') }}', // Ganti dengan route yang sesuai
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_kegiatan": idKegiatan,
                        "id_hari": idHari,
                        "tanggal": tanggal
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.code === 200 && response.data) {
                            var tableRows = '';
                            $.each(response.data, function(index, item) {
                                var statusText = '';
                                if (item.status == 1) {
                                    statusText = 'Hadir';
                                } else if (item.status == 2) {
                                    statusText = 'Izin';
                                } else if (item.status == 3) {
                                    statusText = 'Alpa';
                                }

                                var alasan = '';
                                if (item.status == 2 && item.keterangan == null) {
                                    alasan =
                                        '<span style="color: red;">Tidak Ada Keterangan</span>';
                                } else if (item.status == 3 && item.keterangan == null) {
                                    alasan =
                                        '<span style="color: red;">Tidak Ada Keterangan</span>';
                                } else if (item.status == 3 && item.keterangan != null) {
                                    alasan = item.keterangan;
                                } else if (item.status == 2 && item.keterangan != null) {
                                    alasan = item.keterangan;
                                } else if (item.status == 1 && item.keterangan == null) {
                                    alasan = '';
                                }

                                tableRows += '<tr>' +
                                    '<td hidden>' + item.id + '</td>' +
                                    '<td>' + item.kegiatan + '</td>' +
                                    '<td>' + item.nis + '</td>' +
                                    '<td>' + item.siswa + '</td>' +
                                    '<td>' + item.hari + '</td>' +
                                    '<td>' + statusText + '</td>' +
                                    '<td>' + alasan + '</td>' +
                                    '<td>' + item.tanggal + '</td>' +
                                    '<td>' +
                                    '<a href="/data_list_absen/edit_absen_hasil/' + item.id +
                                    '" class="text-success edit-button"><i class="mdi mdi-pencil font-size-18"></i></a>' +
                                    '</td>' +
                                    '</tr>';
                            });
                            $('#datatable tbody').html(tableRows);

                        } else {
                            $('#datatable tbody').empty();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    },
                });
            }

            $('.edit-button').on('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior

                // Get the ID from the data attribute
                var itemId = $(this).data('item-id');

                // Load content into the modal (replace this with your actual modal content loading logic)
                $.ajax({
                    url: '/getEditModalContent/' + itemId, // Adjust the URL to your route
                    type: 'GET',
                    success: function(data) {
                        // Insert the loaded content into the modal
                        $('#editModal .modal-content').html(data);

                        // Show the modal
                        $('#editModal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
