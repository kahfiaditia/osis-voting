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
                    @if (count($hasil_vote) > 0)
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
                                                            <img src="{{ URL::asset('avatar/' . $item->foto_ketua) }}"
                                                                alt="" class="rounded-circle avatar-xs"
                                                                style="height: 6rem;width: 6rem;">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item" style="margin-left: 10px;">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('avatar/' . $item->foto_wakil) }}"
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
                                        <div class="modal fade" id="exampleModalScrollable{{ $no }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                            aria-hidden="true">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <div class="text-center">
                                <div class="row justify-content-center mt-5">
                                    <div class="col-sm-4">
                                        <div class="maintenance-img">
                                            <img src="{{ URL::asset('assets/images/coming-soon.svg') }}" alt=""
                                                class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-5">Tidak ada Kandidat OSIS</h4>
                                <p class="text-muted">Jika ada kendala segera hubungi Admin.</p>
                                <div class="row justify-content-center mt-5">
                                    <div class="col-md-8">
                                        <div data-countdown="2021/12/31" class="counter-number"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <!-- Static Backdrop Modal -->
        <div class="modal fade staticBackdrop" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-2">
                                    <div class="text-center">
                                        <div class="avatar-md mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-lock h1 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <h4>Verifikasi PIN</h4>
                                            <form action="{{ route('vote.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="email" id="email"
                                                    value="{{ Auth::user()->email }}">
                                                <input type="hidden" name="id_kandidat" id="id_kandidat">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit1-input" class="visually-hidden">Dight
                                                                1</label>
                                                            <input type="text" name='satu'
                                                                class="form-control form-control-lg text-center"
                                                                onkeyup="moveToNext(this, 2)" maxlength="1"
                                                                id="digit1-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit2-input" class="visually-hidden">Dight
                                                                2</label>
                                                            <input type="text" name='dua'
                                                                class="form-control form-control-lg text-center"
                                                                onkeyup="moveToNext(this, 3)" maxlength="1"
                                                                id="digit2-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit3-input" class="visually-hidden">Dight
                                                                3</label>
                                                            <input type="text" name='tiga'
                                                                class="form-control form-control-lg text-center"
                                                                onkeyup="moveToNext(this, 4)" maxlength="1"
                                                                id="digit3-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit4-input" class="visually-hidden">Dight
                                                                4</label>
                                                            <input type="text" name='empat'
                                                                class="form-control form-control-lg text-center"
                                                                onkeyup="moveToNext(this, 4)" maxlength="1"
                                                                id="digit4-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success w-md" type="submit">Confirm</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/two-step-verification.init.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
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
                        $('#staticBackdrop').modal('show');
                        var dataId = $(this).data('id');

                        document.getElementById("id_kandidat").value = $(this).data('id');
                        console.log(dataId);
                        // $.ajax({
                        //     type: 'POST',
                        //     url: '{{ route('vote.store') }}',
                        //     data: {
                        //         "_token": "{{ csrf_token() }}",
                        //         dataId
                        //     },
                        //     success: (response) => {
                        //         if (response.code === 200) {
                        //             Swal.fire({
                        //                 icon: 'success',
                        //                 title: `${response.message}`,
                        //                 showConfirmButton: false,
                        //                 timer: 1500,
                        //                 willClose: () => {
                        //                     var APP_URL =
                        //                         {!! json_encode(url('/')) !!}
                        //                     window.location = APP_URL +
                        //                         '/vote'
                        //                 }
                        //             })

                        //         } else {
                        //             Swal.fire(
                        //                 'Gagal',
                        //                 `${response.message}`,
                        //                 'error',
                        //             )
                        //         }
                        //     },
                        //     error: err => console.log("Interal Server Error")
                        // })
                    }
                });
            });
        });
    </script>
@endsection
