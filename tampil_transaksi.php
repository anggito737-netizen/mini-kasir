<?php
session_start();
if(!isset($_SESSION['role'])) header("location:login.php");
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #4f46e5 !important; }
        .card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <span class="navbar-brand fw-bold">🛒 Mini Kasir</span>
        <a href="admin.php" class="btn btn-light btn-sm rounded-pill">← Dashboard</a>
    </nav>
    <div class="container mt-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3">📊 Laporan Transaksi</h6>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                        <th>Kasir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT t.*, u.username FROM transaksi t JOIN users u ON t.user_id=u.id_user ORDER BY tanggal DESC");
                $no = 1;
                $grandtotal = 0;
                while ($d = mysqli_fetch_array($data)):
                    $grandtotal += $d['total'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($d['tanggal'])) ?></td>
                        <td>Rp <?= number_format($d['total'],0,',','.') ?></td>
                        <td>Rp <?= number_format($d['bayar'],0,',','.') ?></td>
                        <td class="text-success">Rp <?= number_format($d['kembalian'],0,',','.') ?></td>
                        <td><?= $d['username'] ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="2">Grand Total</th>
                        <th class="text-primary">Rp <?= number_format($grandtotal,0,',','.') ?></th>
                        <th colspan="3"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>