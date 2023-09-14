<?php $id = $model->id; ?>
<?php $id_decrypted = Crypt::encryptString($id); ?>
<form class="delete-form" action="{{ route('jadwal.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="d-flex gap-3">

        @if (Auth::user()->roles == 'Administrator')
            <a href="{{ route('jadwal.edit', $id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
            <a href="#" class="text-danger delete_confirm"><i class="mdi mdi-delete font-size-18"></i></a>
        @endif


    </div>
</form>
<script>
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
</script>
