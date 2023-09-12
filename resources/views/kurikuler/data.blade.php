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
                                <li class="breadcrumb-item">{{ ucwords($title) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">

                                        <a href="{{ route('kegiatan.create') }}" type="button"
                                            class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                            <i class="mdi mdi-plus me-1"></i> Tambah
                                        </a>

                                    </ol>
                                </div>
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
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ dd($kegiatan) }} --}}
                                    @foreach ($kegiatan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            </td>
                                            <td>
                                                <?php $id = $item->id; ?>
                                                <form class="delete-form" action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('kegiatan.edit', $id) }}" class="text-success">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                        <a href class="text-danger delete_confirm"><i
                                                                class="mdi mdi-delete font-size-18"></i></a>

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
    </div>
@endsection
