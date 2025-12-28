<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: '../auth/login.php');");
    exit;
}
include '../config/database.php';

// Ambil data filter dan sort
$kategori = $_GET['filter_kategori'] ?? '';
$sort = $_GET['sort_exp'] ?? 'asc';

// Tambahkan filter untuk 
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM makanan WHERE user_id = $user_id";
if ($kategori != '') $sql .= " AND kategori = '". $conn->real_escape_string($kategori) ."'";
$sql .= " ORDER BY tanggal_kadaluarsa $sort";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Expired Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body class="bg-light">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Expired Tracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="create.php">Tambah Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="laporan.php">Laporan</a>
        </li>
        <li class="nav-item">
          <span class="nav-link disabled">👤 <?= htmlspecialchars($_SESSION['user_nama']) ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" onclick="return confirm('Apakah kamu yakin ingin logout?')">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="alert alert-success rounded-pill text-center position-relative overflow-hidden p-4 wave-container">
  <strong>Halo, <?= htmlspecialchars($_SESSION['user_nama']) ?>!</strong> Selamat datang di sistem expired tracker 😊

  <div class="wave wave-back"></div>
  <div class="wave wave-front"></div>
  </div>

  <!-- Filter Form -->
  <form method="GET" class="row mb-3">
    <div class="col-md-4">
      <select name="filter_kategori" class="form-select">
        <option value="">-- Semua Kategori --</option>
        <option value="Frozen Food">Frozen Food</option>
        <option value="Sayur & Buah">Sayur & Buah</option>
        <option value="Minuman">Minuman</option>
        <option value="Bumbu Dapur">Bumbu Dapur</option>
        <option value="Daging">Daging</option>
        <option value="Snack">Snack</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>
    <div class="col-md-4">
      <select name="sort_exp" class="form-select">
        <option value="asc">Kadaluarsa Terdekat</option>
        <option value="desc">Kadaluarsa Terjauh</option>
      </select>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
  </form>

  <!-- Dashboard Content -->
  <h3 class="mb-3">Daftar Barang</h3>
  <table class="table table-bordered table-hover">
    <thead class="table-success">
      <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Tanggal Kadaluarsa</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $today = date("Y-m-d");
      while ($row = $result->fetch_assoc()) {
        $exp = $row['tanggal_kadaluarsa'];
        $diff = (strtotime($exp) - strtotime($today)) / (60 * 60 * 24);

        if ($diff < 0) $status = '<span class="badge bg-danger">Kadaluarsa</span>';
        elseif ($diff <= 7) $status = '<span class="badge bg-warning text-dark">Hampir Kadaluarsa</span>';
        else $status = '<span class="badge bg-success">Aman</span>';

        echo "<tr>
                <td><img src='../assets/uploads/{$row['gambar']}' width='60' class='rounded' alt='gambar barang'></td>
                <td>{$row['nama_barang']}</td>
                <td>{$row['kategori']}</td>
                <td>{$row['tanggal_kadaluarsa']}</td>
                <td>$status</td>
                <td>
                  <a href='update.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                  <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data?\")'>Delete</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>