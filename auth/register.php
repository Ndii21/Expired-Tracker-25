<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - ExpiredTracker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
  <div class="register-card">
    <h4 class="text-center">Expired Tracker</h4>
    <h5 class="text-center mb-4">Buat Akun Baru</h5>
    <form action="register_process.php" method="POST">
      <div class="mb-3">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama..." required>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email..." required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password..." required>
      </div>
      <button type="submit" class="btn btn-custom w-100 mt-3">Daftar</button>
      <div class="mt-4 text-center">
        Sudah punya akun? <a href="login.php">Login di sini</a>
      </div>
    </form>
  </div>
</body>
</html>
