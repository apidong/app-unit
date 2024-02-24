@extends('layouts.index')

@section('title', 'Produk')

@section('content_header')
    <h1 class="m-0 text-dark">
        Kategori
        <small class="font-weight-light ml-1 text-md">
            Tambah Produk
        </small>
    </h1>
@endsection

@section('content')
    @include('layouts.components.notification')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-left">
                        <div class="btn-group">
                            <a href="<?= url('master/produk') ?>" class="btn btn-sm btn-block btn-secondary"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body"> 
                    <form action="<?= url("master/produk/{$produk->id}") ?>" method="post" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ $produk->nama }}"
                                        placeholder="Nama" autocomplete="off">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <select class="form-control select2 @error('kategori') is-invalid @enderror"
                                        name="kategori" placeholder="kategori produk">
                                        @foreach ($kategori as $value)
                                            <option value="{{ $value->id }}" @selected($produk->id_kategori == $value->id)>
                                                {{ $value->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Deksripsi Produk</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <textarea name="deskripsi" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama">{{ $produk->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">SKU Produk</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="sku"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ $produk->sku }}"
                                        placeholder="SKU Produk" autocomplete="off">

                                    @error('sku')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="harga"
                                        class="form-control harga-rupiah @error('harga') is-invalid @enderror"
                                        value="{{ $produk->harga }}" placeholder="Harga Produk" autocomplete="off">

                                    @error('harga')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Berat</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" name="berat"
                                        class="form-control harga-rupiah @error('berat') is-invalid @enderror"
                                        value="{{ $produk->berat }}" placeholder="Berat Produk" autocomplete="off">

                                    @error('berat')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror

                                    <div class="input-group-append">
                                        <span class="input-group-text">Gram</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ukuran Paket</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="ukuran[width]"
                                        class="form-control harga-rupiah @error('ukuran["width"]') is-invalid @enderror"
                                        value="{{ $produk->ukuran['width'] ?? '' }}" placeholder="L" autocomplete="off">
                                    @error('ukuran["width"]')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text">Cm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="ukuran[length]"
                                        class="form-control harga-rupiah @error('ukuran["length"]') is-invalid @enderror"
                                        value="{{ $produk->ukuran['length'] ?? '' }}" placeholder="P" autocomplete="off">
                                    @error('ukuran["length"]')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text">Cm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="ukuran[height]"
                                        class="form-control harga-rupiah @error('ukuran["height"]') is-invalid @enderror"
                                        value="{{ $produk->ukuran['height'] ?? '' }}" placeholder="T" autocomplete="off">
                                    @error('ukuran["height"]')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text">Cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>

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
