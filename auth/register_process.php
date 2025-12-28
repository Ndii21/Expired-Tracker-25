<?php
include 'config.php'; 

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // enkripsi password

// Cek email sudah terdaftar belum
$cek = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Email sudah terdaftar!');
        window.location.href = 'register.php';
    </script>";
    exit;
}

// Insert data
$query = mysqli_query($conn, "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')");

if ($query) {
    echo "<script>
        alert('Registrasi berhasil! Silakan login.');
        window.location.href = 'home.php';
    </script>";
} else {
    echo "<script>
        alert('Registrasi gagal!');
        window.location.href = 'home.php';
    </script>";
}
?>
