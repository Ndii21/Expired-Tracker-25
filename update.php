<?php
include 'config.php';

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM makanan WHERE id = $id");
$data = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $tanggal = $_POST['tanggal_kadaluarsa'];
  $gambarLama = $_POST['gambar_lama'];

  if ($_FILES['gambar']['name']) {
    $gambarBaru = uniqid() . '-' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $gambarBaru);
  } else {
    $gambarBaru = $gambarLama;
  }

  $conn->query("UPDATE makanan SET 
    nama_barang='$nama',
    kategori='$kategori',
    tanggal_kadaluarsa='$tanggal',
    gambar='$gambarBaru'
    WHERE id=$id");

  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0f2f1, #f1f8e9);
      font-family: 'Segoe UI', sans-serif;
    }
    .form-card {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    .form-title {
      font-weight: 600;
      color: #2e7d32;
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-success {
      background-color: #2e7d32;
      border: none;
    }
    .btn-success:hover {
      background-color: #1b5e20;
    }
    .preview-img {
      width: 100px;
      border-radius: 10px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-card">
    <h3 class="form-title">📝 Edit Data Barang</h3>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama_barang'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
          <?php
          $kategoriList = [
            'Frozen Food', 'Sayur & Buah', 'Minuman',
            'Bumbu Dapur', 'Daging', 'Snack', 'Lainnya'
          ];
          foreach ($kategoriList as $item) {
            $selected = $data['kategori'] == $item ? 'selected' : '';
            echo "<option value='$item' $selected>$item</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Kadaluarsa</label>
        <input type="date" name="tanggal_kadaluarsa" class="form-control" value="<?= $data['tanggal_kadaluarsa'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar Barang (biarkan kosong jika tidak ingin ubah)</label>
        <input type="file" name="gambar" class="form-control">
        <img src="uploads/<?= $data['gambar'] ?>" class="preview-img">
      </div>

      <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">

      <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-success px-4">💾 Update</button>
        <a href="index.php" class="btn btn-outline-secondary">↩️ Kembali</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
