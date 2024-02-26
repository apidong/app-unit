@extends('layouts.index')

@section('title', 'Pemesanan Delivery Order')

@section('content_header')
    <h1>Daftar Pemesanan Delivery Order</h1>
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
                            <a href="{{ url('penjualan/do/create') }}" type="button" class="btn btn-sm btn-block btn-primary">
                                Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-do" class="table table-hover va-middle">
                            <thead>
                                <tr>
                                    <th>Nomor DO</th>
                                    <th>Alamat Saya</th>
                                    <th>Pelanggan</th>
                                    <th>Status</th>
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
        $(function() {
            $('#table-do').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ url('penjualan/do') }}',
                    method: 'get'
                },

                columnDefs: [{
                    orderable: false,
                    targets: [0, 1]
                }],
                columns: [{
                        "data": 'id'
                    },
                    {
                        'searchable': false,
                        "orderable": false,
                        "data": function(data) {
                            return `
                        <td class="text-left p-1 align-middle">
                                 <div class="row">
                                    <div class="col-12 font-weight-bold">
                                        ${data.alamat?.nama ?? '-'} 
                                        </div>

                                        <div class="col-12 font-italic">
                                            ${data.alamat?.alamat ?? '-'}  
                                        </div>

                                        <div class="col-12  ">
                                        ${data.alamat?.nama_kec ?? '-'}, ${data.alamat?.nama_kab ?? '-'}, ${data.alamat?.nama_prov ?? '-'}, ${data.alamat?.kode_pos ?? '-'}
                                        </div>
                                    </div>
                        </td>`
                        }
                    },

                    {
                        'searchable': false,
                        "orderable": false,
                        "data": function(data) {
                            return `
                        <td class="text-left p-1 align-middle">
                                 <div class="row">
                                    <div class="col-12 font-weight-bold">
                                        ${data.pelanggan?.nama ?? '-'} |  ${data.pelanggan?.nomor_telepon ?? '-'}
                                        </div>

                                        <div class="col-12 font-italic">
                                            ${data.pelanggan?.alamat ?? '-'}  
                                        </div>

                                        <div class="col-12  ">
                                        ${data.pelanggan?.nama_kec ?? '-'}, ${data.pelanggan?.nama_kab ?? '-'}, ${data.pelanggan?.nama_prov ?? '-'}, ${data.alamat?.kode_pos ?? '-'}
                                        </div>
                                    </div>
                        </td>`
                        }
                    },

                    {
                        'searchable': false,
                        "orderable": false,
                        "data": function(data) {
                            var badge = '';
                            switch (data.status) {
                                case 'draft':
                                    badge =
                                        `<span class="badge badge-pill badge-warning">Draft</span>`
                                    break;
                                case 'menunggu':
                                    badge =
                                        `<span class="badge badge-pill badge-info">Menunggu Persetujuan</span>`
                                    break;

                                case 'revisi':
                                    badge =
                                        `<span class="badge badge-pill badge-dark">Revisi</span>`
                                    break;

                                case 'tolak':
                                    badge =
                                        `<span class="badge badge-pill badge-danger">Tolak</span>`
                                    break;
                                case 'setuju':
                                    badge =
                                        `<span class="badge badge-pill badge-danger">Setuju</span>`
                                    break;
                                default:
                                    break;
                            }
                            return badge;
                        }
                    },


                    {
                        'searchable': false,
                        "data": function(data) {
                            var edit = '';
                            var hapus = '';
                            switch (data.status) {
                                case 'draft':
                                    edit =
                                        `<a class="btn btn-primary btn-edit" href="{{ url('penjualan/do') }}/${data.id}/edit"><i class="fas fa-pencil-alt"></i></a>`;
                                    hapus =
                                        `<button data-href="{{ url('penjualan/do') }}/${data.id}" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash"></i></button>`;
                                    break;


                                case 'revisi':
                                    edit =
                                        `<a class="btn btn-primary btn-edit" href="{{ url('penjualan/do') }}/${data.id}/edit"><i class="fas fa-pencil-alt"></i></a>`;
                                    break;


                                default:
                                    break;
                            }
                            return `<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                   ${edit}
                                   ${hapus}
                                </div>
                            </td>`
                        }
                    },

                ]
            });
        });
    </script>
@endsection
