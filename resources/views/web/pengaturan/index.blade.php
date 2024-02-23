@extends('layouts.index')

@section('title', 'Anggota')

@section('content_header')
    <h1>Anggota</h1>
@endsection

@section('content')
@include('layouts.components.global_delete')
@include('layouts.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card card-outline">
            <div class="card-header">Pengaturan Aplikasi</div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col col-sm-2 col-form-label form-label"></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" />
                    </div>
                    <label class="col col-sm-2 col-form-label form-label">Nama Aplikasi</label>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

 