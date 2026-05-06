<h3>Tambah Barang</h3>

<form method="POST">
    Nama: <input type="text" name="nama"><br>
    Harga: <input type="number" name="harga"><br>
    Stok: <input type="number" name="stok"><br>
    <button type="submit">Simpan</button>
</form>

<?php
include "koneksi.php";
if (isset($_POST['nama'])) {
    mysqli_query($conn, "INSERT INTO barang VALUES ('', '$_POST[nama]', '$_POST[harga]', '$_POST[stok]')");
}

?>
