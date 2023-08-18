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
                                {{-- <li class="breadcrumb-item">{{ ucwords($submenu) }}</li> --}}
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if ($cek_vote == 0)
                                    <a href="{{ route('vote.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Vote Kandidat
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
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['trx_number'])) {
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
                                    if (isset($_GET['trx_number']) or isset($_GET['id_periode']) or isset($_GET['id_kandidat']) or isset($_GET['id_user_vote'])) {
                                        if ($_GET['trx_number'] != null or $_GET['id_periode'] != null or $_GET['id_kandidat'] != null or $_GET['id_user_vote'] != null) {
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
                                                                    <input type="text" name="trx_number" id="trx_number"
                                                                        value="{{ isset($_GET['trx_number']) ? $_GET['trx_number'] : null }}"
                                                                        class="form-control" placeholder="Kode Voting"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="id_periode" id="id_periode"
                                                                        value="{{ isset($_GET['id_periode']) ? $_GET['id_periode'] : null }}"
                                                                        class="form-control" placeholder="Periode"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="id_kandidat"
                                                                        id="id_kandidat"
                                                                        value="{{ isset($_GET['id_kandidat']) ? $_GET['id_kandidat'] : null }}"
                                                                        class="form-control" placeholder="Kandidat"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="id_user_vote"
                                                                        id="id_user_vote"
                                                                        value="{{ isset($_GET['id_user_vote']) ? $_GET['id_user_vote'] : null }}"
                                                                        class="form-control" placeholder="Voters"
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
                                                            <a href="{{ route('vote.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            {{-- @if (isset($_GET['periode_name']) or isset($_GET['like']))
                                                            <?php
                                                            $trx_number = $_GET['trx_number'];
                                                            $id_periode = $_GET['id_periode'];
                                                            $id_kandidat = $_GET['id_kandidat'];
                                                            $id_user_vote = $_GET['id_user_vote'];
                                                            $search_manual = $_GET['search_manual'];
                                                            if (isset($_GET['like'])) {
                                                                $like = $_GET['like'];
                                                            } else {
                                                                $like = null;
                                                            }
                                                            ?>
                                                            <a href="{{ route(
                                                                'pengguna.index',
                                                                'periode_name=' . $periode_name . '&flag=' . $flag . '&search_manual=' . $search_manual . '&like=' . $like . '',
                                                            ) }}"
                                                                class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                    class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                        @else
                                                            <a href="{{ route('periode.index') }}"
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
                                        <th>Trx Number</th>
                                        <th>Periode</th>
                                        <th>Kandidat</th>
                                        {{-- <th>Wakil Kandidat</th> --}}
                                        {{-- @if (Auth::user()->roles == 'Administrator') --}}
                                        <th>Siswa</th>
                                        {{-- @endif --}}
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
                document.getElementById("trx_number").value = null;
                document.getElementById("id_periode").value = null;
                document.getElementById("id_kandidat").value = null;
                document.getElementById("id_user_vote").value = null;

                // document.getElementById("name").value = null;
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
                document.getElementById("trx_number").value = null;
                document.getElementById("id_periode").value = null;
                document.getElementById("id_kandidat").value = null;
                document.getElementById("id_user_vote").value = null;
                // document.getElementById("name").value = null;
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
                    url: "{{ route('vote.data_voters') }}",
                    data: function(d) {
                        d.trx_number = (document.getElementById("trx_number").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "trx_number").value : null;
                        d.id_periode = (document.getElementById("id_periode").value.length != 0) ?
                            document
                            .getElementById(
                                "id_periode").value : null;
                        d.id_kandidat = (document.getElementById("id_kandidat").value.length != 0) ?
                            document
                            .getElementById(
                                "id_kandidat").value : null;
                        d.id_user_vote = (document.getElementById("id_user_vote").value.length != 0) ?
                            document
                            .getElementById(
                                "id_user_vote").value : null;
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
                        data: 'trx_number',
                        name: 'trx_number'
                    },
                    {
                        data: 'id_periode',
                        name: 'id_periode'
                    },
                    {
                        data: 'id_kandidat',
                        name: 'id_kandidat'
                    },
                    {
                        data: 'id_user_vote',
                        name: 'id_user_vote'
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
