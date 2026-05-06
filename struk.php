<?php
session_start();
include "koneksi.php";
$id = $_GET['id'];
$trx = mysqli_fetch_array(mysqli_query($conn, "SELECT t.*, u.username FROM transaksi t JOIN users u ON t.user_id=u.id_user WHERE t.id_transaksi='$id'"));
$detail = mysqli_fetch_array(mysqli_query($conn, "SELECT d.*, b.nama_barang FROM detail_transaksi d JOIN barang b ON d.barang_id=b.id_barang WHERE d.transaksi_id='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .struk { max-width: 380px; margin: 40px auto; background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .divider { border-top: 2px dashed #dee2e6; margin: 1rem 0; }
        .badge-sukses { background: #d1fae5; color: #065f46; padding: 6px 16px; border-radius: 20px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="struk">
        <div class="text-center mb-3">
            <div style="font-size:40px">✅</div>
            <h5 class="fw-bold mt-2">Transaksi Berhasil</h5>
            <span class="badge-sukses">Pembayaran Diterima</span>
        </div>
        <div class="divider"></div>
        <div class="small text-muted mb-2"><?= date('d F Y, H:i', strtotime($trx['tanggal'])) ?></div>
        <div class="d-flex justify-content-between mb-1">
            <span>Barang</span>
            <span class="fw-semibold"><?= $detail['nama_barang'] ?></span>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <span>Jumlah</span>
            <span><?= $detail['jumlah'] ?> pcs</span>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <span>Subtotal</span>
            <span>Rp <?= number_format($detail['subtotal'],0,',','.') ?></span>
        </div>
        <div class="divider"></div>
        <div class="d-flex justify-content-between mb-1">
            <span class="fw-bold">Total</span>
            <span class="fw-bold text-primary">Rp <?= number_format($trx['total'],0,',','.') ?></span>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <span>Bayar</span>
            <span>Rp <?= number_format($trx['bayar'],0,',','.') ?></span>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <span>Kembalian</span>
            <span class="fw-bold text-success">Rp <?= number_format($trx['kembalian'],0,',','.') ?></span>
        </div>
        <div class="divider"></div>
        <div class="small text-muted text-center mb-3">Kasir: <?= $trx['username'] ?></div>
        <a href="kasir.php" class="btn btn-primary w-100 rounded-pill">Transaksi Baru</a>
    </div>
</body>
</html>