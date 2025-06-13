<?php
include 'config.php';

$id = $_GET['id'];

// Hapus file gambar
$get = $conn->query("SELECT gambar FROM makanan WHERE id = $id");
if ($get && $get->num_rows > 0) {
  $data = $get->fetch_assoc();
  $gambar = $data['gambar'];
  if (file_exists("uploads/$gambar")) {
    unlink("uploads/$gambar");
  }
}

// Hapus dari database
$conn->query("DELETE FROM makanan WHERE id = $id");
header("Location: index.php");
?>
