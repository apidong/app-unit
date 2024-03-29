@extends('layouts.index')

@section('title', 'Kontak')

@section('content_header')
    <h1 class="m-0 text-dark">
        Alamat
        <small class="font-weight-light ml-1 text-md">
            Tambah Alamat 
        </small>
    </h1>
@endsection
@include('layouts.components.select2Wilayah')

@section('content')
    @include('layouts.components.notification')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-left">
                        <div class="btn-group">
                            <a href="<?= url('master/alamat') ?>" class="btn btn-sm btn-block btn-secondary"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= url('master/alamat') ?>" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                        placeholder="Nama" autocomplete="off">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <select class="form-control-sm @error('nama_prov') is-invalid @enderror" id="provinsi" data-placeholder="Pilih Provinsi"
                                    name="nama_prov" style="width: 100%;">
                                </select>
                                @error('nama_prov')
                                    <h6 class="text-danger mt-3 text-error">
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-sm-8">
                                <select class="form-control-sm @error('nama_kab') is-invalid @enderror" id="kabupaten" disabled data-placeholder="Pilih Kabupaten"
                                    name="nama_kab" style="width: 100%;">
                                </select>

                                @error('nama_kab')
                                    <h6 class="text-danger mt-3 text-error">
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-8"> 
                                <select class="form-control-sm @error('nama_kec') is-invalid @enderror" name="nama_kec" id="kecamatan" disabled name="nama_kec"
                                    data-placeholder="Pilih Kecamatan" style="width: 100%;">
                                </select>

                                @error('nama_kec')
                                    <h6 class="text-danger mt-3 text-error">
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Pos</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="kode_pos"
                                        class="form-control @error('kode_pos') is-invalid @enderror"
                                        value="{{ old('kode_pos') }}" placeholder="Kode Pos" autocomplete="off">
                                    @error('kode_pos')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Nama jalan, Gedung, Nomor Rumah">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Detail Lainnya</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="lainnya"
                                        class="form-control @error('lainnya') is-invalid @enderror"
                                        value="{{ old('lainnya') }}"
                                        placeholder="Detail Lainnya (Cth: Blok / Unit No., Patokan)" autocomplete="off">
                                    @error('lainnya')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Peta</label>
                            <div class="col-sm-8">

                                <div id="map" style="height: 400px;"
                                    class="  @error('latitude') is-invalid @enderror"></div>
                                @error('latitude')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                                @enderror
                                @error('longitude')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <div class="float-right">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-block btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {

            var map = L.map('map').setView([-7.515194, 112.52635], 13);

            // Add a tile layer to the map (you can use other tile providers)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var markers = [];

            // Add a click event listener to the map
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                // Remove the last marker (if exists)
                if (markers.length > 0) {
                    var lastMarker = markers.pop();
                    map.removeLayer(lastMarker);
                }

                // Create a new marker at the clicked coordinates
                var newMarker = L.marker([lat, lng]).addTo(map);
                $('input[name="latitude"]').val(lat);
                $('input[name="longitude"]').val(lng);

                markers.push(newMarker);
            });
        })
    </script>
@endpush
