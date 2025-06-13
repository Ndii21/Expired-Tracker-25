<?php include 'config.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang - Expired Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html {
      overflow-y: scroll;
    }

    .navbar-custom {
    background: linear-gradient(135deg, #c2f7dc, #fdfbfb, #a0e9b3); /* hijau mint + putih soft + hijau pastel */
    transition: background 0.5s ease;
  }

  .navbar-custom .nav-link {
    color: #2d2d2d;
    transition: color 0.3s ease, transform 0.3s ease;
  }

  .navbar-custom .nav-link:hover {
    color: #198754; /* Bootstrap green */
    transform: scale(1.05);
  }

  .navbar-brand {
    font-weight: bold;
    font-size: 1.3rem;
    color: #198754;
    transition: transform 0.3s ease;
  }

  .navbar-brand:hover {
    transform: scale(1.1);
  }

  .nav-link.active {
    color: #157347 !important; /* Active link hijau tua */
    font-weight: bold;
  }

  .nav-link.disabled {
    opacity: 0.7;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-toggler:focus {
    outline: none;
    box-shadow: none;
  }

  /* 🌸 Background enhancement */
  body {
    background: linear-gradient(to bottom right, #f3fff6, #e6f9ee);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  /* 📦 Table container & spacing */
  .container {
    background: #ffffff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
  }

  @media (max-width: 991.98px) {
    .navbar-collapse {
      transition: all 0.4s ease-in-out;
    }
  }
  </style>
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
          <a class="nav-link" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="create.php">Tambah Barang</a>
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
  <h3 class="mb-4">Tambah Data Barang</h3>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $exp = $_POST['tanggal_kadaluarsa'];
    $user_id = $_SESSION['user_id']; // Ambil user_id dari session
  
    // Simpan gambar
    $gambarName = $_FILES['gambar']['name'];
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $target = "uploads/" . basename($gambarName);
  
    if (move_uploaded_file($gambarTmp, $target)) {
      // Ubah query untuk menyertakan user_id
      $stmt = $conn->prepare("INSERT INTO makanan (nama_barang, kategori, tanggal_kadaluarsa, gambar, user_id) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssi", $nama, $kategori, $exp, $gambarName, $user_id);
  
      if ($stmt->execute()) {
        echo '<div class="alert alert-success">Data berhasil ditambahkan!</div>';
      } else {
        echo '<div class="alert alert-danger">Gagal menyimpan data.</div>';
      }
      $stmt->close();
    } else {
      echo '<div class="alert alert-warning">Upload gambar gagal.</div>';
    }
  }
  ?>

<form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label for="nama_barang" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
    </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <select class="form-select" id="kategori" name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Frozen Food">Frozen Food</option>
        <option value="Sayur & Buah">Sayur & Buah</option>
        <option value="Minuman">Minuman</option>
        <option value="Bumbu Dapur">Bumbu Dapur</option>
        <option value="Daging">Daging</option>
        <option value="Snack">Snack</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
      <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
    </div>

    <div class="mb-3">
    <label for="gambar" class="form-label">Upload Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>