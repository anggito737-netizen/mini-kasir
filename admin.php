<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Mini Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #4f46e5 !important; }
        .card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <span class="navbar-brand fw-bold">🛒 Mini Kasir</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white small">👤 <?= $_SESSION['username'] ?> (Admin)</span>
            <a href="logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h5 class="fw-bold mb-4">Dashboard Admin</h5>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card p-3 d-flex flex-row align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10">📦</div>
                    <div>
                        <div class="text-muted small">Total Barang</div>
                        <?php
                        include "koneksi.php";
                        $jml = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang"));
                        ?>
                        <div class="fw-bold fs-4"><?= $jml ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 d-flex flex-row align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10">🧾</div>
                    <div>
                        <div class="text-muted small">Total Transaksi</div>
                        <?php $trx = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi")); ?>
                        <div class="fw-bold fs-4"><?= $trx ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 d-flex flex-row align-items-center gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10">👥</div>
                    <div>
                        <div class="text-muted small">Total User</div>
                        <?php $usr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users")); ?>
                        <div class="fw-bold fs-4"><?= $usr ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <a href="barang.php" class="card p-4 text-decoration-none text-dark d-block">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary bg-opacity-10" style="font-size:28px">📦</div>
                        <div>
                            <div class="fw-semibold">Kelola Barang</div>
                            <div class="text-muted small">Tambah, edit, hapus data barang</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="tampil_transaksi.php" class="card p-4 text-decoration-none text-dark d-block">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-success bg-opacity-10" style="font-size:28px">📊</div>
                        <div>
                            <div class="fw-semibold">Laporan Transaksi</div>
                            <div class="text-muted small">Lihat riwayat semua transaksi</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>