<?php include "koneksi.php"; ?>

<h3>Data Barang</h3>
<?php
$data = mysqli_query($conn, "SELECT * FROM barang");
while ($d = mysqli_fetch_array($data)) {
    echo $d['nama_barang']." - Rp ".$d['harga']." ";
    echo "<a href='hapus_barang.php?id=".$d['id']."'>Hapus</a><br>";
}
?>
