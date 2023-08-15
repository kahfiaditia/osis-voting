<!-- resources/views/bursa/bursa_opname/data_import.blade.php -->
@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li> --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ dd($produkexcel) }} --}}

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                Cek data dibawah ini, Lakukan pengecekan secara cermat, jika terdapat data yang salah,
                                ubah kuantiti nya
                            </div>
                            <table class="table table-responsive table-bordered table-striped" id="opnametable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Produk</th>
                                        <th>Stok Fisik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produkexcel as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}
                                            </td>
                                            <td><input type="text" class="form-control" name="produk_nama[]"
                                                    value="{{ $item->produk->nama }}" readonly>
                                                <input type="text" class="form-control" name="produk_id[]"
                                                    value="{{ $item->produk_id }}" hidden>
                                                <input type="hidden" name="url" id="url"
                                                    value="{{ $item->produk_id }}">
                                            </td>
                                            </td>
                                            <td><input type="text" class="form-control" name="jumlah[]"
                                                    value="{{ $item->jumlah }}">
                                            </td>
                                            <td class="text-center">
                                                <?php $id = Crypt::encryptString($item->id); ?>
                                                <form class="delete-form"
                                                    action="{{ route('bursa_opname.delete_upload', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="d-flex gap-3">
                                                        <a href class="text-danger delete_confirm"><i
                                                                class="mdi mdi-delete font-size-18"></i></a>
                                                    </div>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <a href="{{ route('bursa_opname.index') }}" class="btn btn-danger waves-effect">Hapus Semua</a>
                            <button class="btn btn-success" type="button" style="float: right"
                                id="simpanopname">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).on('click', '#simpanopname', function() {
                var data = [];

                $('#opnametable tbody tr').each(function() {
                    var produkNama = $(this).find('input[name="produk_nama[]"]').val();
                    var produkId = $(this).find('input[name="produk_id[]"]').val();
                    var jumlah = $(this).find('input[name="jumlah[]"]').val();

                    data.push({
                        produkNama: produkNama,
                        produkId: produkId,
                        jumlah: jumlah
                    });
                });

                // console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('bursa_opname.simpan_data_opname') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        data: data,

                    },
                    success: response => {
                        if (response.code === 200) {
                            Swal.fire(
                                'Success',
                                'Data Opname Upload Berhasil di Simpan',
                                'success'
                            ).then(() => {
                                var APP_URL = {!! json_encode(url('/')) !!}
                                url = document.getElementById("url").value;
                                window.location = APP_URL + '/bursa/bursa_opname/'
                            })
                        } else {
                            Swal.fire(
                                'Gagal',
                                `${response.message}`,
                                'error',
                            )
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    },
                });
            });
        </script>
    @endsection
