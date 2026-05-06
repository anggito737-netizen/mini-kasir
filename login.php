<?php session_start();
if(isset($_SESSION['role'])) {
    header("location:admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .card { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .btn-primary { background: #4f46e5; border: none; border-radius: 8px; }
        .btn-primary:hover { background: #4338ca; }
        .form-control { border-radius: 8px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4" style="width:380px">
        <div class="text-center mb-4">
            <div style="font-size:40px">🛒</div>
            <h4 class="fw-bold mt-2">Mini Kasir</h4>
            <p class="text-muted small">Silakan login untuk melanjutkan</p>
        </div>
        <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger rounded-3 small">Username atau password salah!</div>
        <?php endif; ?>
        <form method="POST" action="proses_login.php">
            <div class="mb-3">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Login</button>
        </form>
    </div>
</body>
</html>