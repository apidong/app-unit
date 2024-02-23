@extends('layouts.index')

@section('title', 'Beranda')

@push('css')
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@section('content_header')
    <h1>Beranda</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                
            </div>
        </div>
 
    </div>

    

 

@endsection


@section('footer')
    <strong>Hak cipta © <?= date('Y') ?> <a href="https://domain.co.id">App Unit</a>.</strong>
    Seluruh hak cipta dilindungi.
    <div class="float-right d-none d-sm-inline-block">
        <b>Versi</b> v{{ version('short') }}
    </div>
@endsection
