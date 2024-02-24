@extends('layouts.index')

@section('title', 'Alamat')

@section('content_header')
    <h1 class="m-0 text-dark">
        Pelanggan
        <small class="font-weight-light ml-1 text-md">
            Ubah Pelanggan
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
                            <a href="<?= url('master/pelanggan') ?>" class="btn btn-sm btn-block btn-secondary"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= url("master/pelanggan/{$pelanggan->id}") ?>" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ $pelanggan->nama }}" placeholder="Nama" autocomplete="off">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="nomor_telepon"
                                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        value="{{ $pelanggan->nomor_telepon }}" placeholder="0852313750001"
                                        autocomplete="off">
                                    @error('nomor_telepon')
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
                                <select class="form-control-sm @error('nama_prov') is-invalid @enderror" id="provinsi"
                                    data-placeholder="Pilih Provinsi" name="nama_prov" style="width: 100%;">
                                    <option selected value="{{ substr($pelanggan->kode_kec, 0, 2) }}">
                                        {{ $pelanggan->nama_prov }}
                                    </option>
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
                                <select class="form-control-sm @error('nama_kab') is-invalid @enderror" id="kabupaten"
                                    data-placeholder="Pilih Kabupaten" name="nama_kab" style="width: 100%;">
                                    <option selected value="{{ substr($pelanggan->kode_kec, 0, 5) }}">
                                        {{ $pelanggan->nama_kab }}
                                    </option>
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
                                <select class="form-control-sm @error('nama_kec') is-invalid @enderror" name="nama_kec"
                                    id="kecamatan" name="nama_kec" data-placeholder="Pilih Kecamatan" style="width: 100%;">
                                    <option value="{{ $pelanggan->kode_kec }}" selected>{{ $pelanggan->nama_kec }}
                                    </option>
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
                                        value="{{ $pelanggan->kode_pos }}" placeholder="Kode Pos" autocomplete="off">
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
                                        placeholder="Nama jalan, Gedung, Nomor Rumah">{{ $pelanggan->alamat }}</textarea>
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
                                        value="{{ $pelanggan->lainnya }}"
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
                        <input type="hidden" id="latitude" name="latitude"
                            value="{{ $pelanggan->region['latitude'] }}">
                        <input type="hidden" id="longitude" name="longitude"
                            value="{{ $pelanggan->region['longitude'] }}">

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
            var latitude = $('input[name="latitude"]').val()
            var longitude = $('input[name="longitude"]').val()

            var map = L.map('map').setView([latitude, longitude], 13);

            // Add a tile layer to the map (you can use other tile providers)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var markers = [];
            // marker first load
            var newMarker = L.marker([latitude, longitude]).addTo(map);
            markers.push(newMarker);

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
