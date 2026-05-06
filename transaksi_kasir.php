function hitungDiskon($harga, $diskon) {
    $potongan = $harga * ($diskon / 100);
    return $harga - $potongan;
}

function hitungKembalian($bayar, $total) {
    return $bayar - $total;
}
