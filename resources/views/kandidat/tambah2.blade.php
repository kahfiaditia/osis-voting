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
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                                {{-- <li class="breadcrumb-item">{{ ucwords($submenu) }}</li> --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form class="needs-validation" action="{{ route('kandidat.store') }}" method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Ketua
                                                <code>*</code></label>
                                            <select class="form-control select select2 ketua" name="ketua" id="ketua"
                                                required>
                                                <option value="" required> -- Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Nis Ketua
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="nisketua" name="nisketua"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Wakil <code>*</code></label>
                                            <select class="form-control select select2 wakil" name="wakil" id="wakil"
                                                required>
                                                <option value="" required> -- Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Nis Wakil
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="niswakil" name="niswakil"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Qoute <code>*</code></label>
                                            <textarea class="form-control" name="quote" id="quote"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Periode
                                                <code>*</code></label>
                                            <select class="form-control" name="periode" id="periode">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($periode as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->periode_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Nomor Urut Calon
                                                <code>*</code></label>
                                            <select class="form-control select select2" name="urut" id="urut"
                                                data-select2-id="urut">
                                                <option value=""> -- Pilih --</option>
                                                <option value="1"> 1 </option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Deskripsi Visi dan Misi
                                                <code>*</code></label>
                                            <textarea name="editor1" id="editor1">fhdf</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('kandidat.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right"
                                            id="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1');

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: '{{ route('kandidat.get_calonketua') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                },

                success: response => {
                    $.each(response.data, function(i, item) {
                        $('.ketua').append(
                            `<option value="${item.id}" data-id="${item.name}" data-value="${item.nis}" data-value1="${item.nik}" data-value2="${item.class_id}" data-value3="${item.email}">${item.name}</option>`
                        )
                    })

                    $(".ketua").change(function() {
                        var nisketua = $('option:selected', this).attr('data-value');
                        document.getElementById("nisketua").value = nisketua;
                    });

                },
                error: (err) => {
                    console.log(err);
                },
            });
        })

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: '{{ route('kandidat.get_calonwakil') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                },

                success: response => {
                    $.each(response.data, function(i, item) {
                        $('.wakil').append(
                            `<option value="${item.id}" data-id="${item.name}" data-value="${item.nis}" data-value1="${item.nik}" data-value2="${item.class_id}" data-value3="${item.email}">${item.name}</option>`
                        )
                    })

                    $(".wakil").change(function() {
                        var niswakil = $('option:selected', this).attr('data-value');
                        document.getElementById("niswakil").value = niswakil;
                    });

                },
                error: (err) => {
                    console.log(err);
                },
            });
        })
    </script>
@endsection
