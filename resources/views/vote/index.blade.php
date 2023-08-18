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
                                        @if ($flagPriode == 1)
                                            @if ($cek_vote == 0)
                                                <a href="{{ route('vote.create') }}" type="button"
                                                    class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                                    <i class="mdi mdi-plus me-1"></i> Vote Kandidat
                                                </a>
                                            @endif
                                        @endif
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
                                        <th>Trx Number</th>
                                        <th>Periode</th>
                                        <th>Ketua Kandidat</th>
                                        <th>Wakil Kandidat</th>
                                        @if (Auth::user()->roles == 'Administrator')
                                            <th>Siswa</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->trx_number }}</td>
                                            <td>{{ $item->periode->periode_name }}</td>
                                            <td>{{ $item->kandidat->ketua->name }}</td>
                                            <td>{{ $item->kandidat->wakil->name }}</td>
                                            @if (Auth::user()->roles == 'Administrator')
                                                <td>{{ $item->siswa->name }}</td>
                                            @endif
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
