<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - ExpiredTracker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
  <div class="login-card">
    <h4 class="text-center">Expired Tracker</h4>
    <h5 class="text-center mb-4">Login Akun</h5>
    <form action="login_process.php" method="POST">
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email..." required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password..." required>
      </div>
      <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
      <div class="mt-4 text-center">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
      </div>
    </form>
  </div>
</body>
</html>
