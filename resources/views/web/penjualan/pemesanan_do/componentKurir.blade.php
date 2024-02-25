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