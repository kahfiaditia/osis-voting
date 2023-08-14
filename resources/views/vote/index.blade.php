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
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('vote.create') }}" type="button"
                                    class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    <i class="mdi mdi-plus me-1"></i> Vote Kandidat
                                </a>
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
                                        <th>Trx Number</th>
                                        <th>Periode</th>
                                        <th>Ketua Kandidat</th>
                                        <th>Wakil Kandidat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->trx_number }}</td>
                                            <td>{{ $item->kandidat->periode->periode_name }}</td>
                                            <td>{{ $item->kandidat->ketua->name }}</td>
                                            <td>{{ $item->kandidat->wakil->name }}</td>
                                            <td>
                                                {{-- <form class="delete-form"
                                                    action="{{ route('uks_kategori.destroy', Crypt::encryptString($item->id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        @if (in_array('113', $session_menu))
                                                            <a href="{{ route('uks_kategori.edit', Crypt::encryptString($item->id)) }}"
                                                                class="text-success"><i
                                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                                        @endif
                                                        @if (in_array('114', $session_menu))
                                                            <a href class="text-danger delete_confirm"><i
                                                                    class="mdi mdi-delete font-size-18"></i></a>
                                                        @endif
                                                    </div>
                                                </form> --}}
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
