
    $(document).ready(function() {
        // Logika perhitungan total harga saat barang diubah atau diinput
        $(document).on('change', "#qty_ubah, #harga_beli_ubah", function() {
            var qty_ubah = parseFloat($("#qty_ubah").val()) || 0;
            var harga_beli_ubah = parseFloat($("#harga_beli_ubah").val()) || 0;

            var total_ubah = qty_ubah * harga_beli_ubah;

            $("#total_ubah").val(total_ubah);
        });

        // Logika perhitungan total harga saat barang masuk diubah atau diinput
        $(document).on('change', "#qty_masuk, #harga_beli_masuk", function() {
            var qty_masuk = parseFloat($("#qty_masuk").val()) || 0;
            var harga_beli_masuk = parseFloat($("#harga_beli_masuk").val()) || 0;

            var total_masuk = qty_masuk * harga_beli_masuk;

            $("#total_masuk").val(total_masuk);
        });
    });

