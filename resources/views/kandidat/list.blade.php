{{-- @extends('layouts.main')
@section('evoting') --}}
{{-- <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($title) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if (Auth::user()->id == 1)
                                    <a href="{{ route('kandidat.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Calon Osis
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
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Urut</th>
                                        <th>Ketua</th>
                                        <th>Wakil</th>
                                        <th>Deskripsi</th>
                                        <th>Visi Misi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kandidat as $per)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $per->no_urut }}</td>
                                            <td>{{ $per->ketua->name }}</td>
                                            <td>{{ $per->wakil->name }}</td>
                                            <td>{{ $per->quote }}</td>
                                            <td><?php echo $per->visi_misi; ?></td>
                                            <td>
                                                <?php $id = $per->id; ?>
                                                <form class="delete-form" action="{{ route('kandidat.destroy', $id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('kandidat.edit', $id) }}" class="text-success">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                        <a href class="text-danger delete_confirm">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                                    <a href="{{ route('kandidat.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Calon Osis
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
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['id_ketua'])) {
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
                                    if (isset($_GET['id_ketua']) or isset($_GET['id_wakil']) or isset($_GET['no_urut']) or isset($_GET['id_periode']) or isset($_GET['quote']) or isset($_GET['visi_misi'])) {
                                        if ($_GET['id_ketua'] != null or $_GET['id_wakil'] != null or $_GET['no_urut'] != null or $_GET['id_periode'] != null or $_GET['quote'] != null or $_GET['visi_misi'] != null) {
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
                                                                    <input type="text" name="id_ketua" id="id_ketua"
                                                                        value="{{ isset($_GET['id_ketua']) ? $_GET['id_ketua'] : null }}"
                                                                        class="form-control" placeholder="Ketua"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="id_wakil" id="id_wakil"
                                                                        value="{{ isset($_GET['id_wakil']) ? $_GET['id_wakil'] : null }}"
                                                                        class="form-control" placeholder="Wakil"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="no_urut" id="no_urut"
                                                                        value="{{ isset($_GET['no_urut']) ? $_GET['no_urut'] : null }}"
                                                                        class="form-control" placeholder="No Urut"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="id_periode" id="id_periode"
                                                                        value="{{ isset($_GET['id_periode']) ? $_GET['id_periode'] : null }}"
                                                                        class="form-control" placeholder="Periode"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="quote" id="quote"
                                                                        value="{{ isset($_GET['quote']) ? $_GET['quote'] : null }}"
                                                                        class="form-control" placeholder="Quote"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="visi_misi" id="visi_misi"
                                                                        value="{{ isset($_GET['visi_misi']) ? $_GET['visi_misi'] : null }}"
                                                                        class="form-control" placeholder="Visi Misi"
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
                                                                $id_ketua = $_GET['id_ketua'];
                                                                $id_wakil = $_GET['id_wakil'];
                                                                $no_urut = $_GET['no_urut'];
                                                                $id_periode = $_GET['id_periode'];
                                                                $quote = $_GET['quote'];
                                                                $visi_misi = $_GET['visi_misi'];
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
                                        <th>Ketua</th>
                                        <th>Wakil</th>
                                        <th>No Urut</th>
                                        <th>Periode</th>
                                        <th>Qoute</th>
                                        <th>Visi Misi</th>
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
                document.getElementById("id_ketua").value = null;
                document.getElementById("id_wakil").value = null;
                document.getElementById("no_urut").value = null;
                document.getElementById("id_periode").value = null;
                document.getElementById("quote").value = null;
                document.getElementById("visi_misi").value = null;
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
                document.getElementById("id_ketua").value = null;
                document.getElementById("id_wakil").value = null;
                document.getElementById("no_urut").value = null;
                document.getElementById("id_periode").value = null;
                document.getElementById("quote").value = null;
                document.getElementById("visi_misi").value = null;
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
                    url: "{{ route('kandidat.data_kandidat') }}",
                    data: function(d) {
                        d.id_ketua = (document.getElementById("id_ketua").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "id_ketua").value : null;
                        d.id_wakil = (document.getElementById("id_wakil").value.length != 0) ?
                            document
                            .getElementById(
                                "id_wakil").value : null;
                        d.no_urut = (document.getElementById("no_urut").value.length != 0) ?
                            document
                            .getElementById(
                                "no_urut").value : null;
                        d.id_periode = (document.getElementById("id_periode").value.length != 0) ?
                            document
                            .getElementById(
                                "id_periode").value : null;
                        d.quote = (document.getElementById("quote").value.length != 0) ?
                            document
                            .getElementById(
                                "quote").value : null;
                        d.visi_misi = (document.getElementById("visi_misi").value.length != 0) ?
                            document
                            .getElementById(
                                "visi_misi").value : null;
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
                        data: 'ketua_name',
                        name: 'ketua_name'
                    },
                    {
                        data: 'wakil_name',
                        name: 'wakil_name'
                    },
                    {
                        data: 'no_urut',
                        name: 'no_urut'
                    },
                    {
                        data: 'periode_name',
                        name: 'periode_name'
                    },
                    {
                        data: 'quote',
                        name: 'quote'
                    },
                    {
                        data: 'visi_misi',
                        name: 'visi_misi'
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
