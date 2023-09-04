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
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="uploadsiswa" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 20%;">Nama</th>
                                        <th style="width: 20%;">Nis</th>
                                        <th style="width: 20%;">Roles</th>
                                        <th style="width: 20%;">Email</th>
                                        <th style="width: 20%;">Kelas</th>
                                        {{-- <th>Phone</th> --}}
                                        {{-- <th>Alamat</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($importedData as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><input type="text" class="form-control" name="name[]" id="name[]"
                                                    value="{{ $item->name }}"></td>
                                            <td><input type="text" class="form-control" name="nis[]" id="nis[]"
                                                    value="{{ $item->nis }}"></td>
                                            <td><input type="text" class="form-control" name="roles[]" id="roles[]"
                                                    value="{{ $item->roles }}"></td>
                                            <td><input type="text" class="form-control" name="email[]" id="email[]"
                                                    value="{{ $item->email }}"></td>
                                            <td><input type="text" class="form-control" name="class_id[]" id="class_id[]"
                                                    value="{{ $item->class_id }}">
                                                <input type="text" class="form-control" name="phone[]" id="phone[]"
                                                    value="{{ $item->phone }}" hidden>
                                                <input type="text" class="form-control" name="pin[]" id="pin[]"
                                                    value="1234" hidden>
                                                <input type="text" class="form-control" name="password[]" id="password[]"
                                                    value="12345" hidden>
                                                <input type="text" name="address[]" id="address[]"
                                                    value="{{ $item->address }}" hidden>
                                                <input type="text" name="url" id="url"
                                                    value="{{ $item->id }}" hidden>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <a href="{{ route('pengguna.hapus_semua') }}"
                                        class="btn btn-secondary waves-effect">Hapus
                                        Semua</a>
                                    <button class="btn btn-primary" type="submit" style="float: right"
                                        id="simpansiswa">Simpan</button>
                                </div>

                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).on('click', '#simpansiswa', function() {
            var datasiswa = [];

            $('#uploadsiswa tbody tr').each(function() {
                var name = $(this).find('input[name="name[]"]').val();
                var nis = $(this).find('input[name="nis[]"]').val();
                var roles = $(this).find('input[name="roles[]"]').val();
                var email = $(this).find('input[name="email[]"]').val();
                var class_id = $(this).find('input[name="class_id[]"]').val();
                var address = $(this).find('input[name="address[]"]').val();
                var phone = $(this).find('input[name="phone[]"]').val();
                var pin = $(this).find('input[name="pin[]"]').val();
                var password = $(this).find('input[name="password[]"]').val();


                datasiswa.push({
                    nama: name,
                    nis: nis,
                    roles: roles,
                    email: email,
                    class_id: class_id,
                    address: address,
                    phone: phone,
                    pin: pin,
                    password: password,
                });
            });

            // console.log(data);
            $.ajax({
                type: 'POST',
                url: '{{ route('pengguna.simpanUserAjax') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    datasiswa: datasiswa,

                },
                success: response => {
                    if (response.code === 200) {
                        Swal.fire(
                            'Success',
                            'Data Upload Berhasil di Simpan',
                            'success'
                        ).then(() => {
                            var APP_URL = {!! json_encode(url('/')) !!}
                            url = document.getElementById("url").value;
                            window.location = APP_URL + '/pengguna/'
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            `${response.message}`,
                            'error'
                        ).then(() => {
                            var APP_URL = {!! json_encode(url('/')) !!}
                            window.location = APP_URL + '/halaman';
                        });
                    }
                },
                error: (err) => {
                    console.log(err);
                },
            });
        });
    </script>
@endsection
