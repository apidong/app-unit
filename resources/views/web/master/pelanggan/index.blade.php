@extends('layouts.index')

@section('title', 'Pelanggan')

@section('content_header')
    <h1>Daftar Pelanggan</h1>
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
                            <a href="{{ url('master/pelanggan/create') }}" type="button"
                                class="btn btn-sm btn-block btn-primary">
                                Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-alamat" class="table table-hover va-middle">
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
        $(function() {
            $('#table-alamat').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ url('master/pelanggan') }}',
                    method: 'get'
                },

                columnDefs: [{
                    orderable: false,
                    targets: [0, 1]
                }],
                columns: [{
                        'searchable': false,
                        "orderable": false,
                        "data": function(data) {
                            return `
                        <td class="text-left p-1 align-middle">
                                 <div class="row">
                                    <div class="col-12 font-weight-bold">
                                        ${data.nama} |  Nomor Telpon : ${data.nomor_telepon}
                                        </div>

                                        <div class="col-12 font-italic">
                                            ${data.alamat}  - ${data.lainnya} 
                                        </div>

                                        <div class="col-12  ">
                                        ${data.nama_kec}, ${data.nama_kab}, ${data.nama_prov}, ${data.kode_pos}
                                        </div>
                                    </div>
                        </td>`
                        }
                    },


                    {
                        'searchable': false,
                        "data": function(data) {
                            return `<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-primary btn-edit" href="{{ url('master/pelanggan') }}/${data.id}/edit"><i class="fas fa-pencil-alt"></i></a>
                                    <button data-href="{{ url('master/pelanggan') }}/${data.id}" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>`
                        }
                    },

                ]
            });
        });
    </script>
@endsection
