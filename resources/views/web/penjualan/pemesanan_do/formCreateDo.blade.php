@extends('layouts.index')

@section('title', 'Kontak')

@section('content_header')
    <h1 class="m-0 text-dark">
        Pemesanan Delivery Order
        <small class="font-weight-light ml-1 text-md">
            Tambah Pemesanan DO
        </small>
    </h1>
@endsection
@include('layouts.components.select2Wilayah')

@section('content')
    @include('layouts.components.notification')
    <form action="<?= url('master/pelanggan') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <i class="fas fa-search"></i>
                            Cari Barang
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" id="searchInput"
                                    placeholder="Masukkan SKU / Nama Barang" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8" id="card-produk">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <i class="fas fa-search"></i>
                            Hasil Pencarian Barang
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table-produk" class="table  table-striped table-hover va-middle">
                                    <thead>
                                        <tr>
                                            <td>SKU</td>
                                            <td>Nama Barang</td>
                                            <td>Harga Jual</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-left">Keranjang</div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table-keranjang" class="table  table-striped table-hover va-middle">
                                    <thead>
                                        <tr>
                                            <td>Nomor</td>
                                            <td>Nama Barang</td>
                                            <td>Harga Jual</td>
                                            <td>Jumlah</td>
                                            <td>Total Harga</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12 m-0">
                            <div class="float-right">
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-primary">Total : </span>
                                    </div>
                                    <input type="text" class="form-control " value="0" id="total-semua"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-sm btn-block btn-success">
                                    Simpan Draft <i class="fas fa-save"></i>
                                </button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button type="submit" class="btn btn-sm btn-block btn-primary">
                                    Lanjutkan <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col-md-12" id="form-pengiriman">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-left">
                            Form Alamat Saya
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class=" ml-3 mr-3 col-form-label  text-primary"><i
                                            class="fas fa-map-marker-alt"></i>
                                        Dikirim Dari</label> <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-alamat">Pilih alamat</button>
                                </div>


                                <table class="table table-borderless" id="alamat-pilih">

                                </table>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" id="form-detail">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-left">
                            Form Pengiriman
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class=" ml-3 mr-3 col-form-label  text-primary"><i
                                            class="fas fa-map-marker-alt"></i> Dikirim ke</label> <button type="button"
                                        class="btn btn-info" data-toggle="modal" data-target="#modal-pelanggan">Pilih
                                        Pelanggan</button>
                                </div>
                                <table class="table table-borderless" id="pelanggan-pilih">

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class=" ml-3 mr-3 col-form-label  text-primary"><i
                                            class="fas fa-dolly-flatbed"></i> Opsi Pengiriman: </label> <button
                                        type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-pelanggan">Pilih
                                        Pengiriman</button>
                                </div>
                                <table class="table table-borderless" id="pelanggan-pilih">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <!-- Modal alamat -->
    <div class="modal fade" id="modal-alamat" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alamat Saya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover va-middle table-borderless table-striped" id="tabel-alamat"></table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn-konfirmasi-alamat">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pelanggan -->
    <div class="modal fade" id="modal-pelanggan" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover va-middle table-borderless table-striped" id="tabel-pelanggan">
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn-konfirmasi-pelanggan">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            numeral.locale('id')
            var keranjang = [];
            var alamatsaya = [];
            var kirimPelanggan = [];

            var dataproduk = $('#table-produk').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                lengthChange: false,
                searching: false,
                ajax: {
                    url: '{{ url('master/produk') }}',
                    method: 'get',
                    data: function(d) {
                        d.search['value'] = $('#searchInput').val();
                    }
                },
                order: [
                    [1, 'asc']
                ],
                columnDefs: [{
                    orderable: true,
                    targets: [0, 1]
                }],
                columns: [{
                        'data': 'sku',

                    },
                    {
                        'data': 'nama',

                    },
                    {
                        'searchable': false,
                        'data': function(data, type, full, meta) {
                            var number = numeral(data.harga_non_format);
                            return 'Rp. ' + number.format();;
                        }

                    },
                    {
                        'searchable': false,
                        "orderable": false,
                        "data": function(data, type, full, meta) {

                            return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-info tambah-produk" data-id="${meta.row}"><i class="fas fa-plus-square"></i></button>
                            </div>
                        </td>`
                        }
                    },

                ]
            });

            var tabel_keranjang = $('#table-keranjang').DataTable({
                paging: false,
                autoWidth: false,
                lengthChange: false,
                searching: false,
                data: keranjang,
                order: [
                    [1, 'asc']
                ],
                columnDefs: [{
                    orderable: true,
                    targets: [0, 1]
                }],
                columns: [{
                        'data': 'sku',
                    },
                    {
                        'data': 'nama',

                    },
                    {
                        'searchable': false,
                        "orderable": false,
                        'data': function(data, type, full, meta) {
                            var number = numeral(data.harga_non_format);
                            var tampil = number.format();

                            return `<td class="text-left py-0 align-middle show-harga" data-id="${meta.row}"> ${tampil} </td>`;

                        }

                    },

                    {
                        'searchable': false,
                        "orderable": false,
                        'data': function(data, type, full, meta) {
                            return ` 
                                <input class="form-control input-jumlah" value="${data.jumlah}" data-row="${meta.row}">
                                 `
                        },

                    },

                    {
                        'searchable': false,
                        "orderable": false,
                        'data': function(data, type, full, meta) {
                            var number = numeral(data.total_harga);
                            var tampil = number.format();
                            return `<div class="show-total" data-id="${meta.row}"> ${tampil} </div>`;
                        }

                    },
                    {
                        'searchable': false,
                        "orderable": false,
                        "data": function(data, type, full, meta) {

                            return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-danger hapus-keranjang" data-row="${meta.row}"><i class="fas fa-minus"></i></button>
                            </div>
                        </td>`
                        }
                    },

                ]
            });

            function performSearch() {
                console.log('dfds')
                if ($('#searchInput').val() != '') {
                    $('#table-produk').show();
                } else {
                    $('#table-produk').hide();
                }

                dataproduk.ajax.reload();

            }


            // Debounce function
            function debounce(func, delay) {
                let timeoutId;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(function() {
                        func.apply(context, args);
                    }, delay);
                };
            }

            // Debounce the input event
            const debouncedSearch = debounce(performSearch, 500);

            // Attach the debounced function to the input event
            $("#searchInput").on("input", debouncedSearch);

            $('#table-produk').on('click', 'button.tambah-produk', function() {
                var rowData = dataproduk.row($(this).data('id')).data();
                rowData['jumlah'] = 1;
                rowData['total_harga'] = Number(rowData['jumlah']) * Number(rowData['harga_non_format'])
                keranjang.push(rowData)

                tabel_keranjang.clear();

                tabel_keranjang.rows.add(keranjang);
                // Redraw the table
                tabel_keranjang.draw();

                hitungSemua()
            });

            $('#table-keranjang').on('input', 'input.input-jumlah', function() {
                var el_total = $(this).parent().parent().find('div.show-total');
                var rowData = tabel_keranjang.row($(this).data('row')).data();

                keranjang[$(this).data('row')].jumlah = $(this).val();
                var jumlah = Number($(this).val() ?? 0);
                var harga = Number(keranjang[$(this).data('row')].harga_non_format);

                //update variable 
                keranjang[$(this).data('row')].jumlah = jumlah;
                keranjang[$(this).data('row')].total_harga = jumlah * harga

                //update tampilan
                var number = numeral(jumlah * harga);
                var tampil = number.format();
                el_total.html(tampil)
                // console.log(keranjang);
                // console.log($(this).parent().parent().find('div.show-total'))
                hitungSemua()
            });

            // fungsi hapus keranjang
            $('#table-keranjang').on('click', 'button.hapus-keranjang', function() {
                var index = $(this).data('row');
                Swal.fire({
                    title: 'Hapus produk dalam keranjang?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    console.log(result)
                    if (result.value == true) {
                        keranjang.splice(index, 1);
                        console.log(keranjang)
                        tabel_keranjang.clear();

                        tabel_keranjang.rows.add(keranjang);
                        // Redraw the table
                        tabel_keranjang.draw();

                        hitungSemua()

                        Swal.fire({
                            type: "success",
                            position: "top-end",
                            toast: true,
                            text: 'Keranjang berhasil dihapus',
                            showConfirmButton: false,
                            timer: 2000 // Auto-close after 2 seconds
                        });
                    }
                });
            });

            function hitungSemua() {
                var total = _.chain(keranjang).map('total_harga').sum().value();
                var number = numeral(total);
                $('#total-semua').val(number.format())
            }

            // kumpulan perintah untuk alamat
            var tabelAlamat = $('#tabel-alamat').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                lengthChange: false,
                paging: false,
                info: false,
                searching: false,
                ajax: {
                    url: '{{ url('master/alamat') }}',
                    method: 'get',
                    data: function(d) {
                        d.search['value'] = $('#searchInput').val();
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: '_all'
                    } // Disable ordering for all columns
                ],


                columns: [{
                        'orderable': false,
                        'width': '30px',
                        'render': function(data, type, full, meta) {
                            return `
                            <input class="form-check-input" type="radio" name="radioalamat" value="${meta.row}">`
                        }
                    },
                    {
                        'orderable': false,
                        'data': function(data, type, full, meta) {
                            return `
                            <div class="row">
                                <div class="col-12 font-weight-bold">${data.nama}</div>
                                 
                                <div class="col-12 ">${data.alamat}</div>
                                <div class="col-12 font-weight-light">${data.nama_prov.toUpperCase()}. ${data.nama_kab.toUpperCase()}. ${data.nama_kec.toUpperCase()}</div>
                                <div class="col-12 font-weight-light">Kode Pos : ${data.kode_pos} </div>
                            </div>
                            `
                        },
                    },

                ],
                createdRow: function(row, data, dataIndex) {
                    // Add custom classes to columns as needed
                    $(row).find('td:eq(0)').addClass('text-center');

                }
            });

            $('#modal-alamat').on('show.bs.modal', function(event) {
                tabelAlamat.ajax.reload();
            });

            $('#tabel-alamat').on('click', 'tr', function() {
                var row = tabelAlamat.row(this);

                $(this).find('input').prop('checked', true);
                var rowData = row.data();
                alamatsaya = rowData;

            });

            $('#btn-konfirmasi-alamat').click(function(e) {
                var selectedAlamat = $('#tabel-alamat').find('input:checked')
                var row = tabelAlamat.row(selectedAlamat.val());
                var rowData = row.data();
                alamatsaya = [rowData];
                $('#modal-alamat').modal('hide');
                tabel_alamat_pilih.clear();
                tabel_alamat_pilih.rows.add(alamatsaya);

                tabel_alamat_pilih.draw();
            });

            var tabel_alamat_pilih = $('#alamat-pilih').DataTable({
                paging: false,
                autoWidth: false,
                lengthChange: false,
                searching: false,
                data: alamatsaya,
                info: false,
                columns: [{
                        'data': function(data, type, full, meta) {
                            return `
                            <label class="text-weight-bold">${data.nama}</label>
                            `;
                        }
                    },
                    {
                        'data': function(data, type, full, meta) {
                            return `
                            <div class="row">
                                <div class="col-12">${data.alamat}</div>
                                <div class="col-12 text-weight-light">${data.nama_kec} ${data.nama_kab} ${data.nama_prov}</div>
                                <div class="col-12 text-weight-light">Kode Pos : ${data.kode_pos}</div>
                            </div>
                            `;
                        }

                    },


                ]
            });

            // kumpulan perintah untuk pelanggan
            var tabelPelanggan = $('#tabel-pelanggan').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                lengthChange: false,
                info: false,
                searching: false,
                ajax: {
                    url: '{{ url('master/pelanggan') }}',
                    method: 'get',
                },
                columnDefs: [{
                        orderable: false,
                        targets: '_all'
                    } // Disable ordering for all columns
                ],


                columns: [{
                        'orderable': false,
                        'width': '30px',
                        'render': function(data, type, full, meta) {
                            return `
                            <input class="form-check-input" type="radio" name="radioalamat" value="${meta.row}">`
                        }
                    },
                    {
                        'orderable': false,
                        'data': function(data, type, full, meta) {
                            return `
                            <div class="row">
                                <div class="col-12 font-weight-bold">${data.nama}</div>
                                 
                                <div class="col-12 ">${data.alamat}</div>
                                <div class="col-12 font-weight-light">${data.nama_prov.toUpperCase()}. ${data.nama_kab.toUpperCase()}. ${data.nama_kec.toUpperCase()}</div>
                                <div class="col-12 font-weight-light">Kode Pos : ${data.kode_pos} </div>
                            </div>
                            `
                        },
                    },

                ],
                createdRow: function(row, data, dataIndex) {
                    // Add custom classes to columns as needed
                    $(row).find('td:eq(0)').addClass('text-center');

                }
            });

            $('#modal-pelanggan').on('show.bs.modal', function(event) {
                tabelPelanggan.ajax.reload();
            });

            $('#tabel-pelanggan').on('click', 'tr', function() {
                var row = tabelPelanggan.row(this);

                $(this).find('input').prop('checked', true);
                var rowData = row.data();
                alamatsaya = rowData;

            });

            $('#btn-konfirmasi-pelanggan').click(function(e) {

                var selectedAlamat = $('#tabel-pelanggan').find('input:checked')
                var row = tabelAlamat.row(selectedAlamat.val());
                var rowData = row.data();

                kirimPelanggan = [rowData];
                $('#modal-pelanggan').modal('hide');
                tabel_pelanggan_pilih.clear();
                tabel_pelanggan_pilih.rows.add(kirimPelanggan);

                tabel_pelanggan_pilih.draw();
            });

            var tabel_pelanggan_pilih = $('#pelanggan-pilih').DataTable({
                paging: false,
                autoWidth: false,
                lengthChange: false,
                searching: false,
                data: kirimPelanggan,
                info: false,
                columns: [{
                        'data': function(data, type, full, meta) {
                            return `
                            <label class="text-weight-bold">${data.nama}</label>
                            `;
                        }
                    },
                    {
                        'data': function(data, type, full, meta) {
                            return `
                            <div class="row">
                                <div class="col-12">${data.alamat}</div>
                                <div class="col-12 text-weight-light">${data.nama_kec} ${data.nama_kab} ${data.nama_prov}</div>
                                <div class="col-12 text-weight-light">Kode Pos : ${data.kode_pos}</div>
                            </div>
                            `;
                        }

                    },


                ]
            });

            

        })
    </script>
@endpush
