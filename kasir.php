<?php
session_start();
if(!isset($_SESSION['role'])) header("location:login.php");
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kasir - Mini Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #4f46e5 !important; }
        .card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .btn-primary { background: #4f46e5; border: none; }
        .form-control, .form-select, .btn { border-radius: 8px; }
        .result-box { background: #f8f9ff; border-radius: 12px; border: 2px dashed #4f46e5; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <span class="navbar-brand fw-bold">🛒 Mini Kasir</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white small">👤 <?= $_SESSION['username'] ?> (Kasir)</span>
            <a href="logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="card p-4">
                    <h6 class="fw-bold mb-3">🧾 Form Transaksi</h6>
                    <form method="POST" action="proses_transaksi.php">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Pilih Barang</label>
                            <select name="barang_id" class="form-select" required onchange="isiHarga(this)">
                                <option value="">-- Pilih Barang --</option>
                                <?php
                                $brg = mysqli_query($conn, "SELECT * FROM barang WHERE stok > 0");
                                while ($b = mysqli_fetch_array($brg)):
                                ?>
                                <option value="<?= $b['id_barang'] ?>" data-harga="<?= $b['harga'] ?>">
                                    <?= $b['nama_barang'] ?> - Rp <?= number_format($b['harga'],0,',','.') ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Harga Satuan</label>
                            <input type="number" name="harga" id="harga" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Diskon (%)</label>
                            <input type="number" name="diskon" class="form-control" value="0" min="0" max="100">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold">Uang Bayar (Rp)</label>
                            <input type="number" name="bayar" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Proses Transaksi</button>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card p-4">
                    <h6 class="fw-bold mb-3">📋 Transaksi Terakhir</h6>
                    <table class="table table-hover align-middle small">
                        <thead class="table-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Total</th>
                                <th>Bayar</th>
                                <th>Kembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $trx = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY tanggal DESC LIMIT 5");
                        while ($t = mysqli_fetch_array($trx)):
                        ?>
                            <tr>
                                <td><?= date('d/m H:i', strtotime($t['tanggal'])) ?></td>
                                <td>Rp <?= number_format($t['total'],0,',','.') ?></td>
                                <td>Rp <?= number_format($t['bayar'],0,',','.') ?></td>
                                <td class="text-success fw-semibold">Rp <?= number_format($t['kembalian'],0,',','.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    function isiHarga(sel) {
        const harga = sel.options[sel.selectedIndex].dataset.harga;
        document.getElementById('harga').value = harga || '';
    }
    </script>
</body>
</html>