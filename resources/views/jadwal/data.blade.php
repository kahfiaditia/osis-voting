@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if (Auth::user()->id == 1)
                                    <a href="{{ route('jadwal.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Jadwal
                                    </a>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['nama_kegiatan'])) {
                                        } else {
                                            echo 'collapsed';
                                        } ?>" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="bx bx-search-alt font-size-18"></i>
                                            <b>Cari & Unduh Data</b>
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse <?php
                                    if (isset($_GET['nama_kegiatan']) or isset($_GET['nama_hari']) or isset($_GET['jam_mulai']) or isset($_GET['jam_selesai']) or isset($_GET['name'])) {
                                        if ($_GET['nama_kegiatan'] != null or $_GET['nama_hari'] != null or $_GET['jam_mulai'] != null or $_GET['jam_selesai'] != null or $_GET['name'] != null) {
                                            echo 'show';
                                        }
                                    }
                                    if (isset($_GET['like'])) {
                                        if ($_GET['like'] != null) {
                                            echo 'show';
                                        }
                                    } ?>"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <form>
                                                    <div class="row" id="id_where">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-2">
                                                                    <input type="text" name="nama_kegiatan"
                                                                        id="nama_kegiatan"
                                                                        value="{{ isset($_GET['nama_kegiatan']) ? $_GET['nama_kegiatan'] : null }}"
                                                                        class="form-control" placeholder="Kegiatan"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="nama_hari" id="nama_hari"
                                                                        value="{{ isset($_GET['nama_hari']) ? $_GET['nama_hari'] : null }}"
                                                                        class="form-control" placeholder="Hari"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="jam_mulai" id="jam_mulai"
                                                                        value="{{ isset($_GET['jam_mulai']) ? $_GET['jam_mulai'] : null }}"
                                                                        class="form-control" placeholder="Jam Mulai"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="jam_selesai"
                                                                        id="jam_selesai"
                                                                        value="{{ isset($_GET['jam_selesai']) ? $_GET['jam_selesai'] : null }}"
                                                                        class="form-control" placeholder="Jam Selesai"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="name" id="name"
                                                                        value="{{ isset($_GET['name']) ? $_GET['name'] : null }}"
                                                                        class="form-control" placeholder="Pembina"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="id_like" style="display: none">
                                                        <div class="col-md-2 mb-2">
                                                            <input type="text" name="search_manual" id="search_manual"
                                                                value="{{ isset($_GET['search_manual']) ? $_GET['search_manual'] : null }}"
                                                                class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2 mb-2">
                                                            <div class="form-check form-check-right mb-3">
                                                                <input class="form-check-input" name="like"
                                                                    type="checkbox" id="like"
                                                                    value="{{ isset($_GET['like']) ? 'search' : 'default' }}"
                                                                    {{ isset($_GET['like']) ? 'checked' : null }}
                                                                    onclick="toggleCheckbox()">
                                                                <label class="form-check-label" for="like">
                                                                    Like semua data
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10 mb-2">
                                                            <button type="submit"
                                                                class="btn btn-primary w-md">Cari</button>
                                                            <a href="{{ route('kandidat.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            {{-- @if (isset($_GET['id_ketua']) or isset($_GET['id_ketua']))
                                                                <?php
                                                                $nama_kegiatan = $_GET['nama_kegiatan'];
                                                                $nama_hari = $_GET['nama_hari'];
                                                                $jam_mulai = $_GET['jam_mulai'];
                                                                $jam_selesai = $_GET['jam_selesai'];
                                                                $name = $_GET['name'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                                <a href="{{ route(
                                                                    'kandidat.index',
                                                                    'id_ketua=' .
                                                                        $id_ketua .
                                                                        '&id_wakil=' .
                                                                        $id_wakil .
                                                                        '&no_urut=' .
                                                                        $no_urut .
                                                                        '&id_periode=' .
                                                                        $id_periode .
                                                                        '&quote=' .
                                                                        $quote .
                                                                        '&visi_misi=' .
                                                                        $visi_misi .
                                                                        '&search_manual=' .
                                                                        $search_manual .
                                                                        '&like=' .
                                                                        $like .
                                                                        '',
                                                                ) }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @else
                                                                <a href="{{ route('kandidat.index') }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Selesai</th>
                                        <th>Pembina</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        function toggleCheckbox() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("nama_kegiatan").value = null;
                document.getElementById("nama_hari").value = null;
                document.getElementById("jam_mulai").value = null;
                document.getElementById("jam_selesai").value = null;
                document.getElementById("name").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }
        }

        $(document).ready(function() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("nama_kegiatan").value = null;
                document.getElementById("nama_hari").value = null;
                document.getElementById("jam_mulai").value = null;
                document.getElementById("jam_selesai").value = null;
                document.getElementById("name").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }

            // var i = document.getElementById("kode_transaksi").value = null;
            // console.log(i);

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('jadwal.data_list_jadwal') }}",
                    data: function(d) {
                        d.nama_kegiatan = (document.getElementById("nama_kegiatan").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "nama_kegiatan").value : null;
                        d.nama_hari = (document.getElementById("nama_hari").value.length != 0) ?
                            document
                            .getElementById(
                                "nama_hari").value : null;
                        d.jam_mulai = (document.getElementById("jam_mulai").value.length != 0) ?
                            document
                            .getElementById(
                                "jam_mulai").value : null;
                        d.jam_selesai = (document.getElementById("jam_selesai").value.length != 0) ?
                            document
                            .getElementById(
                                "jam_selesai").value : null;
                        d.name = (document.getElementById("name").value.length != 0) ?
                            document
                            .getElementById(
                                "name").value : null;
                        d.search_manual = (document.getElementById("search_manual").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "search_manual").value : null;
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'nama_hari',
                        name: 'nama_hari'
                    },
                    {
                        data: 'jam_mulai',
                        name: 'jam_mulai'
                    },
                    {
                        data: 'jam_selesai',
                        name: 'jam_selesai'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
