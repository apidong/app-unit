$(function () {
    var elements = document.getElementsByClassName("harga-rupiah");

    for (let index = 0; index < elements.length; index++) {
        const element = elements[index];
        IMask(element, {
            mask: Number,
            scale: 2, // jumlah digit
            thousandsSeparator: ".", // any single char
            padFractionalZeros: false, // if true, then pads zeros at end to the length of scale
            normalizeZeros: false, // appends or removes zeros at ends
            radix: ",", // fractional delimiter
            mapToRadix: ["."], // symbols to process as radix
        });
    }

    $(".select2").select2({
        placeholder: $(".select2").attr("placeholder"),
    });
    // $(".rentang-tanggal").daterangepicker({
    //     locale: {
    //         format: "DD-MM-YYYY",
    //     },
    // });

    // $(".form-tanggal").daterangepicker({
    //     locale: {
    //         format: "YYYY-MM-DD",
    //         separator: " - ",
    //         applyLabel: "Terapkan",
    //         cancelLabel: "Batal",
    //         fromLabel: "Dari",
    //         toLabel: "Untuk",
    //         customRangeLabel: "Kustom",
    //         weekLabel: "M",
    //         daysOfWeek: ["Mig", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    //         monthNames: [
    //             "Januari",
    //             "Februari",
    //             "Maret",
    //             "April",
    //             "Mei",
    //             "Juni",
    //             "Juli",
    //             "Agustus",
    //             "September",
    //             "Oktober",
    //             "November",
    //             "Desember",
    //         ],
    //     },
    //     singleDatePicker: true,
    //     maxDate: new Date(),
    //     startDate: new Date(),
    // });
});

numeral.register('locale', 'id', {
    delimiters: {
        thousands: '.',
        decimal: ','
    },
    abbreviations: {
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't'
    },
    ordinal: function (number) {
        return number;
    },

    currency: {
        symbol: 'Rp.'
    }
});
