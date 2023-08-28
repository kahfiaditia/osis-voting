<?php $id = $model->id; ?>
<?php $id_decrypted = Crypt::encryptString($id); ?>
<form class="delete-form" action="{{ route('pengguna.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="d-flex gap-3">

        @if (Auth::user()->roles == 'Administrator')
            <a href="{{ route('pengguna.edit_admin', $id) }}" class="text-success"><i
                    class="mdi mdi-pencil font-size-18"></i></a>
            {{-- <a href="#" class="text-warning reset_confirm" data-user-id="{{ $id }}" data-toggle="tooltip"
                data-placement="top" title="Reset Password"><i class="mdi mdi-key font-size-18"></i></a> --}}
            <a href="#" class="text-danger delete_confirm"><i class="mdi mdi-delete font-size-18"></i></a>
        @endif


    </div>
</form>
<script>
    $(document).ready(function() {
        $('.delete_confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Ingin menghapus data?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });

        $('.reset_confirm').click(function(event) {
            event.preventDefault();
            var userId = $(this).data('user-id'); // Menggunakan 'user-id' sebagai atribut data

            Swal.fire({
                title: 'Konfirmasi Reset Password',
                text: "Anda yakin ingin mereset password?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{ route('pengguna.reset_password', ['id' => '__id__']) }}'
                            .replace('__id__', userId),
                        type: 'POST',
                        data: {
                            _token: csrfToken
                        },
                        success: function(data) {
                            // Lakukan sesuatu dengan data yang diterima
                            Swal.fire(
                                'Reset Berhasil!',
                                'Format (NIK+tgl+Bln), exp :12342508',
                                'success'
                            );
                        },
                        error: function(error) {
                            console.error(error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat mereset password.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
