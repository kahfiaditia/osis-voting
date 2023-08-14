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

            <form class="needs-validation" action="{{ route('kandidat.update', $edit->id) }}" method="POST" novalidate>
                @csrf
                @method('PATCH')
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
                                                @foreach ($pilihan as $ketua)
                                                    <option value=""> --pilih
                                                        {{ $ketua->name }}
                                                    </option>
                                                    <option value="{{ $ketua->id }}" data-id="{{ $ketua->id }}"
                                                        {{ $ketua->id == $edit->id_ketua ? 'selected' : '' }}>
                                                        {{ $ketua->name }}
                                                    </option>
                                                @endforeach
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
                                            <select class="form-control" name="wakil" id="wakil">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($pilihanwakil as $itemwakil)
                                                    <option value="{{ $itemwakil->id }}"
                                                        {{ $edit->id_wakil == $itemwakil->id ? 'selected' : '' }}>
                                                        {{ $itemwakil->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Nis Wakil
                                                <code>*</code></label>
                                            <input type="text" class="form-control" id="nisketua" name="nisketua"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Qoute <code>*</code></label>
                                            <textarea class="form-control" name="quote" id="quote">{{ $edit->quote }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Periode
                                                <code>*</code></label>
                                            <select class="form-control" name="periode" id="periode">
                                                <option value=""> -- Pilih --</option>
                                                @foreach ($periode as $data1)
                                                    <option value="{{ $data1->id }}"
                                                        {{ $edit->id_periode == $data1->id ? 'selected' : '' }}>
                                                        {{ $data1->periode_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Deskripsi Visi dan Misi
                                                <code>*</code></label>
                                            <textarea name="editor1" id="editor1">{{ $edit->visi_misi }}</textarea>
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
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
