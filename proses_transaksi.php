<?php
session_start();
include "koneksi.php";

if (isset($_POST['harga'])) {
    $barang_id = $_POST['barang_id'];
    $harga     = $_POST['harga'];
    $jumlah    = $_POST['jumlah'];
    $diskon    = $_POST['diskon'];
    $bayar     = $_POST['bayar'];

    $subtotal  = $harga * $jumlah;
    $potongan  = $subtotal * ($diskon / 100);
    $total     = $subtotal - $potongan;
    $kembalian = $bayar - $total;

    if ($bayar < $total) {
        echo "<script>alert('Uang bayar kurang! Total: Rp $total');history.back();</script>";
    } else {
        $user_id = $_SESSION['user_id'];
        mysqli_query($conn, "INSERT INTO transaksi VALUES ('',NOW(),'$total','$bayar','$kembalian','$user_id')");
        $trx_id = mysqli_insert_id($conn);
        mysqli_query($conn, "INSERT INTO detail_transaksi VALUES ('','$trx_id','$barang_id','$jumlah','$harga','$subtotal')");
        mysqli_query($conn, "UPDATE barang SET stok=stok-$jumlah WHERE id_barang='$barang_id'");

        header("location:struk.php?id=$trx_id");
    }
}
?>