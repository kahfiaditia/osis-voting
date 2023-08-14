@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('vote.store') }}" method="POST" novalidate>
                @csrf

                <div class="row">
                    <?php $no = 0; ?>
                    @foreach ($hasil_vote as $item)
                        <?php
                        $no = $no + 1;
                        $color = 'secondary';
                        ?>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-truncate font-size-15">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <span class="badge bg-{{ $color }}">Pasalon
                                                        {{ $no }}</span>
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-4">{{ $item->ketua }} & {{ $item->wakil }}</p>
                                            <div class="avatar-group" style="padding-left: 50px;">
                                                <div class="avatar-group-item" style="margin-left: 10px;">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('assets/images/users/' . $item->foto_ketua) }}"
                                                            alt="" class="rounded-circle avatar-xs"
                                                            style="height: 6rem;width: 6rem;">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item" style="margin-left: 10px;">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('assets/images/users/' . $item->foto_wakil) }}"
                                                            alt="" class="rounded-circle avatar-xs"
                                                            style="height: 6rem;width: 6rem;">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 border-top text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-3">
                                            <a href="javascript(0)" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalScrollable{{ $no }}">
                                                <i class="bx bx-comment-dots me-1"></i> Visi & Misi
                                            </a>
                                        </li>
                                        <li class="list-inline-item me-3 font-size-20" style="font-weight: 600;">
                                            <button type="button" data-id="{{ $item->id }}"
                                                class="btn btn-success waves-effect waves-light mt-2 me-1 vote">
                                                <i class="bx bx-check-double"></i> Vote
                                            </button>
                                        </li>
                                    </ul>
                                    <!-- Scrollable modal -->
                                    <div class="modal fade" id="exampleModalScrollable{{ $no }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Visi & Misi
                                                        Kandidat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $item->visi_misi; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="{{ asset('assets/scanner/html5-qrcode.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.vote').on('click', function(event) {

                event.preventDefault();
                Swal.fire({
                    title: 'Vote Kandidat',
                    text: 'Ingin vote kandidat?',
                    icon: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    focusConfirm: false,
                }).then((value) => {
                    if (value.isConfirmed) {
                        var dataId = $(this).data('id');
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('vote.store') }}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                dataId
                            },
                            success: (response) => {
                                if (response.code === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: `${response.message}`,
                                        showConfirmButton: false,
                                        timer: 1500,
                                        willClose: () => {
                                            var APP_URL =
                                                {!! json_encode(url('/')) !!}
                                            window.location = APP_URL +
                                                '/vote'
                                        }
                                    })

                                } else {
                                    Swal.fire(
                                        'Gagal',
                                        `${response.message}`,
                                        'error',
                                    )
                                }
                            },
                            error: err => console.log("Interal Server Error")
                        })
                    }
                });
            });
        });
    </script>
@endsection
