<?php
session_start();
if(!isset($_SESSION['role'])) header("location:login.php");
include "koneksi.php";

if (isset($_POST['nama'])) {
    $n = $_POST['nama'];
    $h = $_POST['harga'];
    $s = $_POST['stok'];
    mysqli_query($conn, "INSERT INTO barang VALUES ('','$n','$h','$s')");
    $success = "Barang berhasil ditambahkan!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #4f46e5 !important; }
        .card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .btn-primary { background: #4f46e5; border: none; }
        .form-control, .btn { border-radius: 8px; }
        .badge-stok { padding: 4px 10px; border-radius: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <span class="navbar-brand fw-bold">🛒 Mini Kasir</span>
        <div class="d-flex gap-2">
            <a href="admin.php" class="btn btn-light btn-sm rounded-pill">← Dashboard</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <?php if(isset($success)): ?>
        <div class="alert alert-success rounded-3"><?= $success ?></div>
        <?php endif; ?>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4">
                    <h6 class="fw-bold mb-3">➕ Tambah Barang</h6>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Barang</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-4">
                    <h6 class="fw-bold mb-3">📦 Daftar Barang</h6>
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM barang");
                        $no = 1;
                        while ($d = mysqli_fetch_array($data)):
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= $d['nama_barang'] ?></td>
                                <td>Rp <?= number_format($d['harga'],0,',','.') ?></td>
                                <td>
                                    <span class="badge-stok <?= $d['stok'] < 5 ? 'bg-danger text-white' : 'bg-success text-white' ?>">
                                        <?= $d['stok'] ?> pcs
                                    </span>
                                </td>
                                <td>
                                    <a href="hapus_barang.php?id=<?= $d['id_barang'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Hapus barang ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>