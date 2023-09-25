@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"> {{ $data['extra'] }} </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                <li class="breadcrumb-item active"> {{ $data['extra'] }} </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h4>Pilih kegiatan yang ingin diikuti</h4>
                        <p class="text-muted">Pastikan kehadirannya di setiap kegiatan tersebut dengan jadwal yang telah
                            ditentukan, kegiatan ini adalah penunjang penilaian</p>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- {{ dd($jadwal) }} --}}
                @foreach ($data['jadwal'] as $data)
                    <div class="col-xl-3 col-md-6">
                        <div class="card plan-box">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5>{{ $data->Kegiatan }}</h5>
                                        <p class="text-muted">Ketua : {{ $data->Pembina }}</p>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <i class="bx bx-notepad h1 text-primary"></i>
                                    </div>
                                </div>
                                @php
                                    $inidatavalidasi = in_array($data->id_ekstrakurikuler, $cekvalidasi['inidatavalidasi']);
                                @endphp

                                @if ($inidatavalidasi)
                                    <p class="text-success">Sudah Mengikuti</p>
                                @else
                                    <div class="text-center plan-btn">
                                        <a href="{{ route('daftar_mandiri.daftar_kegiatan', ['dataId' => $data->id_ekstrakurikuler]) }}"
                                            class="btn btn-primary btn-sm waves-effect waves-light">Daftar Kegiatan
                                            {{ $data->Kegiatan }}</a>
                                    </div>
                                @endif
                                <div class="plan-features mt-5">
                                    <p><i class="bx bx-checkbox-square text-primary me-2"></i> {{ $data->Hari }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
