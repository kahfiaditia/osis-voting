@extends('frontend.main')
@section('ft')
    <div class="page-content" style="margin-top: 10px;">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Grafik Perolehan Suara Periode {{ $periode }}</h4>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="card card-body border-top">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="button-items">
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
                                            @if (round(($item->jml / $all_vote) * 100) > 0)
                                                <button type="button"
                                                    class="btn btn-{{ $color }} waves-effect waves-light w-sm"
                                                    style="min-width: 220px; min-height: {{ (200 * round(($item->jml / $all_vote) * 100)) / 100 + 35 }}px; bottom: 0;">
                                                    {{ round(($item->jml / $all_vote) * 100) }}% </button>
                                            @endif
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
                </div> --}}
                <div class="col-12">
                    <div class="card card-body border-top">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="">
                                        <?php
                                        $no = 0;
                                        ?>
                                        @foreach ($hasil_vote as $item)
                                            <?php
                                            $no = $item->no_urut;
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
                                                    {{ round(($item->jml / $all_vote) * 100, 2) }}%</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-muted mb-2 font-size-24">Total Suara</p>
                                    <h1 style="font-weight: 600;">
                                        {{ round(($jml_vote[0]->jml_vote / $all_vote) * 100, 2) }}%</h1>
                                    <div class="mt-3">
                                        {{ number_format($jml_vote[0]->jml_vote) }} suara
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pt-4">
                                                <p class="text-muted mb-2 font-size-24">Jumlah Pemilih</p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15"><i class="mdi mdi-vote-outline"></i>
                                                        </h5>
                                                        <h5 class="font-size-15">Siswa</h5>
                                                        <p class="text-muted mb-0">
                                                            {{ number_format($jml_vote_siswa[0]->jml_vote) }} suara</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15"><i class="mdi mdi-vote-outline"></i>
                                                        </h5>
                                                        <h5 class="font-size-15">Guru</h5>
                                                        <p class="text-muted mb-0">
                                                            {{ number_format($jml_vote_guru[0]->jml_vote) }} suara</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $no = 0;
                $persent = 0;
                $king = 0;
                ?>
                @foreach ($hasil_vote as $item)
                    <?php
                    if ($item->jml > $persent) {
                        $persent = $item->jml;
                        $king = 1;
                    } else {
                        $persent = 0;
                        $king = 0;
                    }
                    
                    $no = $item->no_urut;
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
                                                <span class="badge bg-{{ $color }}">Pasalon
                                                    {{ $item->no_urut }}</span>
                                            </a>
                                        </h5>
                                        <p class="text-muted mb-4">{{ $item->ketua }} & {{ $item->wakil }}</p>
                                        @if ($type_foto == 'Kandidat')
                                            <div class="text-center">
                                                <div class="">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('avatar_kandidat/' . $item->avatar_kandidat) }}"
                                                            alt="" class="rounded-circle avatar-xs"
                                                            style="height: 10rem;width: 10rem;">
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="avatar-group" style="padding-left: 20px;">
                                                <div class="avatar-group-item" style="margin-left: 10px;">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        @if ($item->foto_ketua)
                                                            <img src="{{ URL::asset('avatar/' . $item->foto_ketua) }}"
                                                                alt="" class="rounded-circle avatar-xs"
                                                                style="height: 6rem;width: 6rem;">
                                                        @else
                                                            <img src="{{ URL::asset('assets/default.jpg') }}"
                                                                alt="" class="rounded-circle avatar-xs"
                                                                style="height: 6rem;width: 6rem;">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item" style="margin-left: 10px;">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        @if ($item->foto_wakil)
                                                            <img src="{{ URL::asset('avatar/' . $item->foto_wakil) }}"
                                                                alt="" class="rounded-circle avatar-xs"
                                                                style="height: 6rem;width: 6rem;">
                                                        @else
                                                            <img src="{{ URL::asset('assets/default.jpg') }}"
                                                                alt="" class="rounded-circle avatar-xs"
                                                                style="height: 6rem;width: 6rem;">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 border-top">
                                <div class="col-6">
                                    <div class="text-center mt-3">
                                        <h5 class="font-size-20">
                                            @if (count($winner) > 0)
                                                @if ($item->id_kandidat == $winner[0]->id_kandidat)
                                                    <i class="bx bx bxs-crown text-{{ $color }}"></i>
                                                @endif
                                            @endif
                                            {{ round(($item->jml / $all_vote) * 100, 2) }}%
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center mt-3">
                                        <h5 class="font-size-20">
                                            {{ number_format($item->jml) }} suara
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3" style="padding-top: 0rem!important;">
                                <div class="text-center">
                                    <a href="javascript(0)" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalScrollable{{ $no }}">
                                        <i class="bx bx-comment-dots me-1"></i> Visi & Misi
                                    </a>
                                </div>
                            </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" id="flag" value="{{ $flag }}">
            </div>
        </div>
    </div>
@endsection
<script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        flag = document.getElementById("flag").value;
        if (flag != 'kosong' && flag != '1') {
            setTimeout(function() {
                location.reload();
            }, 10000);
            // 1000 (1 detik)
        }
    });
</script>
