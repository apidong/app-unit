@push('js')
<script>
    $(function() {
        
        var select_kab = '#kabupaten';
        var select_kec = '#kecamatan';
        var select_desa = '#desa';
        
        var not_pelanggan = <?= $not_pelanggan ?? 0 ?>;
        const host = `/data/list_wilayah`;
        $('#provinsi').select2({
            ajax: {
                url: host,
                dataType: 'json',
                delay: 400,
                data: function(params) {
                    return {
                        cari: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(response, params) {
                    params.page = params.page || 1;

                    return {
                        results: $.map(response.results, function(item) {
                            return {
                                id: item.kode_prov,
                                text: item.nama_prov,
                            }
                        }),
                        pagination: response.pagination
                    };
                },
                cache: true
            }
        });

        setTimeout(() => {
            list_kabupaten();
        }, 500);

        $('#provinsi').on('change', function(e) {
            var kode = e.target.value;
            $(select_kab).prop('disabled', false);
            $(select_kab).val(null);
            $(select_kec).text(null);
            $(select_kec).val(null);
            $(select_desa).val(null);
            $(select_desa).text(null);
            list_kabupaten(kode);
        });

        setTimeout(() => {
            list_kecamatan();
        }, 500);

        $(select_kab).change(function(e) {
            var kode = e.target.value;
            $(select_kec).prop('disabled', false);
            $(select_kec).val(null);
            $(select_kec).text(null);
            $(select_desa).val(null);
            $(select_desa).text(null);
            $("#kode-desa").val();
            list_kecamatan(kode);
        });

        setTimeout(() => {
            list_desa();
        }, 500);

        $(select_kec).change(function(e) {
            console.log($('#label-kode').text());
            var kode = e.target.value;
            $(select_desa).prop('disabled', false);
            $(select_desa).val(null);
            $(select_desa).text(null);
            if ($('#label-kode').text() == 'Kecamatan') {
                $("#kode-desa").val(kode);
                var selected_kec = kode;
                var is_edit = $('#kode_kec').val();
                cek_desa(selected_kec, is_edit, 'kecamatan');
            }
            list_desa(kode);
        });

        function list_kabupaten(kode_prov = '') {
            if (kode_prov == '') {
                kode_prov = $('#provinsi').val();
            }
            
            $(select_kab).select2({
                ajax: {
                    url: host + '?kode=' + kode_prov,
                    dataType: 'json',
                    delay: 400,
                    data: function(params) {
                        return {
                            cari: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(response, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(response.results, function(item) {
                                return {
                                    id: item.kode_kab,
                                    text: item.nama_kab,
                                }
                            }),
                            pagination: response.pagination
                        };
                    },
                    cache: true
                }
            });
        }

        function list_kecamatan(kode_kab = '') {
            if (kode_kab == '') {
                kode_kab = $(select_kab).val();
            }
            $(select_kec).select2({
                ajax: {
                    url: host + '?kode=' + kode_kab,
                    dataType: 'json',
                    delay: 400,
                    data: function(params) {
                        return {
                            cari: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(response, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(response.results, function(item) {
                                return {
                                    id: item.kode_kec,
                                    text: item.nama_kec
                                }
                            }),
                            pagination: response.pagination
                        };
                    },
                    cache: true
                }
            });
        }

        function list_desa(kode_kec = '') {
            if (kode_kec == '') {
                kode_kec = $(select_kec).val();
            }
            $(select_desa).select2({
                ajax: {
                    url: host + '?kode=' + kode_kec,
                    dataType: 'json',
                    delay: 400,
                    data: function(params) {
                        return {
                            cari: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(response, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(response.results, function(item) {
                                return {
                                    id: item.kode_desa,
                                    text: item.nama_desa
                                }
                            }),
                            pagination: response.pagination
                        };
                    },
                    cache: true
                }
            });
        }

        $(`${select_kab}, ${select_kec}, ${select_desa}`).select2({
            placeholder: function() {
                $(this).data('placeholder');
            }
        })

        $(select_desa).change(function() {
            var kode_desa = $(select_desa).val();
            var is_edit = $('#kode_desa').val();
            cek_desa(kode_desa, is_edit)
            $("#kode-desa").val(kode_desa);
        });

        function cek_desa(kode_desa, is_edit, tipe = 'desa') {
            $.get('/data/api/wilayah/cek_desa?kode_desa=' + kode_desa + '&is_edit=' + is_edit + '&tipe=' + tipe, function(res) {
                console.log(res);
                if (res.status) {
                    $(`#status_${tipe}`).show()
                    $('#simpan').prop('disabled', true);
                } else {
                    $(`#status_${tipe}`).hide()
                    $('#simpan').prop('disabled', false);
                }
            })
        }
    })
</script>
@endpush