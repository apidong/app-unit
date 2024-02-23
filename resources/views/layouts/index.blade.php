@extends('adminlte::page')

@section('footer')
    <strong>Hak cipta © <?= date('Y') ?> <a href="https://opendesa.id">OpenDesa</a>.</strong>
    Seluruh hak cipta dilindungi.
    <div class="float-right d-none d-sm-inline-block">
        <b>Versi</b> v{{ version('short') }}
    </div>
@endsection

@push('js')
    <script>
        $.extend($.fn.dataTable.defaults, {
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ],
            pageLength: 10,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json",
            }
        });

        $.fn?.select2?.defaults?.set("theme", "bootstrap4");
    </script>
@endpush