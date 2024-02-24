@extends('layouts.index')

@section('title', 'Kontak')

@section('content_header')
    <h1 class="m-0 text-dark">
        Kategori
        <small class="font-weight-light ml-1 text-md">
            Tambah Kategori
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
                            <a href="<?= url('master/kategori') ?>" class="btn btn-sm btn-block btn-secondary"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= url("master/kategori/{$kategori->id}") ?>" method="post" enctype="multipart/form-data"
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
                                        value="{{ $kategori->nama }}" placeholder="Nama" autocomplete="off">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <h6>{{ $message }}</h6>
                                        </div>
                                    @enderror
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
