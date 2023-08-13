@extends('frontend.main')
@section('ft')
    <div class="page-content" style="margin-top: 10px;">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('awal') }}" role="tab">
                                    Slide
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('grafik') }}" role="tab">
                                    Grafik
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Grafik Perolehan Suara Periode {{ $periode }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-body border-top">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="">
                                        <?php $no = 0; ?>
                                        @foreach ($hasil_vote as $item)
                                            <?php
                                            $no = $no + 1;
                                            if ($no == 1) {
                                                $color = 'success';
                                                $text = 'Pasalon ' . $no;
                                            } elseif ($no == 2) {
                                                $color = 'info';
                                                $text = 'Pasalon ' . $no;
                                            } elseif ($no == 3) {
                                                $color = 'warning';
                                                $text = 'Pasalon ' . $no;
                                            } elseif ($no == 4) {
                                                $color = 'danger';
                                                $text = 'Pasalon ' . $no;
                                            }
                                            ?>
                                            <div class="progress mb-4" style="height: 2rem;">
                                                <div class="progress-bar bg-{{ $color }}" role="progressbar"
                                                    style="width: {{ round(($item->jml / $all_vote) * 100) }}%;"
                                                    aria-valuenow="{{ round(($item->jml / $all_vote) * 100) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ round(($item->jml / $all_vote) * 100) }}%</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div style="padding: 15%">
                                        <p class="text-muted mb-2 font-size-24">Data Masuk</p>
                                        <h1 style="font-weight: 600;">
                                            {{ round(($jml_vote[0]->jml_vote / $all_vote) * 100) }}%</h1>

                                        <div class="mt-3">
                                            {{ number_format($jml_vote[0]->jml_vote) }} suara
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $no = 0; ?>
                @foreach ($hasil_vote as $item)
                    <?php
                    $no = $no + 1;
                    if ($no == 1) {
                        $color = 'success';
                        $text = 'Pasalon ' . $no;
                    } elseif ($no == 2) {
                        $color = 'info';
                        $text = 'Pasalon ' . $no;
                    } elseif ($no == 3) {
                        $color = 'warning';
                        $text = 'Pasalon ' . $no;
                    } elseif ($no == 4) {
                        $color = 'danger';
                        $text = 'Pasalon ' . $no;
                    }
                    ?>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15">
                                            <a href="javascript: void(0);" class="text-dark">
                                                <span class="badge bg-{{ $color }}">Pasalon 1</span>
                                            </a>
                                        </h5>
                                        <p class="text-muted mb-4">{{ $item->ketua }} & {{ $item->wakil }}</p>
                                        <div class="avatar-group" style="padding-left: 20px;">
                                            <div class="avatar-group-item" style="margin-left: 10px;">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="assets/images/users/{{ $item->foto_ketua }}" alt=""
                                                        class="rounded-circle avatar-xs" style="height: 6rem;width: 6rem;">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item" style="margin-left: 10px;">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="assets/images/users/{{ $item->foto_wakil }}" alt=""
                                                        class="rounded-circle avatar-xs" style="height: 6rem;width: 6rem;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3 font-size-20" style="font-weight: 600;">
                                        @if ($no == 1)
                                            <i class="bx bx bxs-crown text-success"></i>
                                        @endif
                                        {{ round(($item->jml / $all_vote) * 100) }}%
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <a href="javascript(0)" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalScrollable">
                                            <i class="bx bx-comment-dots me-1"></i> Visi & Misi
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end row -->
    </div>

    <!-- Scrollable modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Scrollable Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
