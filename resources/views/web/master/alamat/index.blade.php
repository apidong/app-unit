@extends('layouts.index')

@section('title', 'alamat')

@section('content_header')
    <h1>Daftar Alamat</h1>
@endsection

@section('content')
@include('layouts.components.global_delete')
@include('layouts.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card card-outline">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="{{ url('master/alamat/create') }}" type="button" class="btn btn-sm btn-block btn-primary">
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-user" class="table table-hover va-middle">
                        <thead>
                            <tr>
                                 
                                <th>Alamat</th>
                                <th width='200px'>Aksi</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js')
<script>
    $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ url('master/alamat') }}',
            method: 'get'
        },
        order: [
            [2, 'asc']
        ],
        columnDefs: [{
            orderable: false,
            targets: [0, 1]
        }],
        columns: [
           
            {
                'searchable': false,
                "orderable": false,
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-primary btn-edit" href="{{ url('master/produk') }}/${data.id}/edit"><i class="fas fa-pencil-alt"></i></a>
                                    <button data-href="{{ url('master/produk') }}/${data.id}" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>`
                }
            },
            {
                'data': 'nama'
            },
            {
                'data': 'deskripsi'
            },
            {
                'data': 'harga',
                
                
            },
            {
                'data': 'created_at'
            },
        ]
    });
</script>
@endsection