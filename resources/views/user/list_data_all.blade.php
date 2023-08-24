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
                                <li class="breadcrumb-item">User</li>
                                <li class="breadcrumb-item">List Data User</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if (Auth::user()->roles == 'Administrator')
                                    <a href="{{ route('pengguna.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i>Guru
                                    </a>
                                    <a href="{{ route('pengguna.tambah_siswa') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Siswa
                                    </a>
                                    <a href="{{ route('pengguna.tambah_administrator') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Administrator
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
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#guru" role="tab">
                                        Data Guru
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#siswa" role="tab">
                                        Data Siswa
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#administrator" role="tab">
                                        Administrator
                                    </a>
                                </li>
                            </ul>

                            {{-- Search and Filter --}}
                            {{-- <div class="accordion mt-3" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['name'])) {
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
                                    if (isset($_GET['name']) or isset($_GET['email']) or isset($_GET['nis']) or isset($_GET['roles'])) {
                                        if ($_GET['name'] != null or $_GET['email'] != null or $_GET['nis'] != null or $_GET['roles'] != null) {
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
                                                                    <input type="text" name="name" id="name"
                                                                        value="{{ isset($_GET['name']) ? $_GET['name'] : null }}"
                                                                        class="form-control" placeholder="Nama"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="email" id="email"
                                                                        value="{{ isset($_GET['email']) ? $_GET['email'] : null }}"
                                                                        class="form-control" placeholder="Email"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="nis" id="nis"
                                                                        value="{{ isset($_GET['nis']) ? $_GET['nis'] : null }}"
                                                                        class="form-control" placeholder="Nis"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="roles" id="roles"
                                                                        value="{{ isset($_GET['roles']) ? $_GET['roles'] : null }}"
                                                                        class="form-control" placeholder="Kelas"
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
                                                            <a href="{{ route('pengguna.alluser') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['name']) or isset($_GET['like']))
                                                                <?php
                                                                $name = $_GET['name'];
                                                                $email = $_GET['email'];
                                                                $nis = $_GET['nis'];
                                                                $roles = $_GET['roles'];
                                                                // $name = $_GET['name'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Tab content -->
                            <div class="tab-content">
                                <div class="tab-pane" id="guru">
                                    <table id="tableGuru" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Guru</th>
                                                <th>Email</th>
                                                <th>NIK</th>
                                                <th>Roles</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>


                                <div class="tab-pane" id="siswa">
                                    <table id="tableSiswa" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Siswa</th>
                                                <th>Email</th>
                                                <th>NIS</th>
                                                <th>Roles</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane" id="administrator">
                                    <table id="tableAdministrator" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Admin</th>
                                                <th>Email</th>
                                                <th>Nis / Nik</th>
                                                <th>Roles</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script>
        function toggleCheckbox() {
            var like = document.getElementById("like").checked;
            if (like) {
                document.getElementById("name").value = null;
                document.getElementById("email").value = null;
                document.getElementById("nis").value = null;
                document.getElementById("nik").value = null;
                document.getElementById("roles").value = null;
                $('#type').val("").trigger('change');
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
            // var like = document.getElementById("like").checked;
            // if (like) {
            //     document.getElementById("name").value = null;
            //     document.getElementById("email").value = null;
            //     document.getElementById("nis").value = null;
            //     document.getElementById("nik").value = null;
            //     document.getElementById("roles").value = null;
            //     $('#type').val("").trigger('change');
            //     document.getElementById("id_where").style.display = 'none';
            //     document.getElementById("id_like").style.display = 'block';
            // } else {
            //     document.getElementById("search_manual").value = null;
            //     document.getElementById("like").checked = false;
            //     document.getElementById("id_like").style.display = 'none';
            //     document.getElementById("id_where").style.display = 'block';
            // }

            $('#tableGuru').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengguna.get_data_guru') }}",
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                ]
            });

            $('#tableSiswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengguna.get_data_siswa') }}",
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                ]
            });

            $('#tableAdministrator').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengguna.get_data_administrator') }}",
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                ]
            });
        });
    </script>
@endsection
