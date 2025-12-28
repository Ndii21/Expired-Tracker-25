<?php
session_start();
include '..\config\database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
$data = mysqli_fetch_assoc($query);

// Validasi user & password
if ($data && password_verify($password, $data['password'])) {
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['user_nama'] = $data['nama'];
    echo "<script>
        alert('Login berhasil! Selamat datang, {$data['nama']}');
        window.location.href = '../items/index.php'; // ganti ke halaman utama 
    </script>";
} else {
    echo "<script>
        alert('Login gagal! Email atau password salah.');
        window.location.href = '../auth/login.php';
    </script>";
}
?>
