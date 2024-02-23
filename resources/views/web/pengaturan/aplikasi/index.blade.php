@extends('layouts.index')

@section('title', 'Anggota')

@section('content_header')
    <h1>Anggota</h1>
@endsection

@section('content')
@include('layouts.components.notification')

    <div class="row">
        <div class="col-12">

            <div class="card card-outline">
                <form action="<?= url("pengaturan/aplikasi") ?>" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="card-header">Pengaturan Aplikasi</div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @foreach ($data as $pengaturan)
                            <div class="row mb-3">
                                <label class="col col-sm-2 col-form-label form-label">{{ $pengaturan->judul }}</label>
                                <div class="col-sm-6">
                                    @include('layouts.components.input_type', [
                                        'type' => $pengaturan->jenis,
                                        'value' => $pengaturan->value,
                                        'key' => $pengaturan->key,
                                    ])

                                </div>
                                <label class="col col-sm-2 col-form-label form-label">{{ $pengaturan->keterangan }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <label class="btn btn-default p-0">
                            <button type="submit" size="sm" class="btn btn-info btn-sm">Simpan
                            </button>
                        </label>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
