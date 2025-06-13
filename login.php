<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - ExpiredTracker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: 'Outfit', sans-serif;
      background: linear-gradient(135deg, #67B26F, #4ca2cd);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 2.5rem;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      color: white;
      animation: fadeIn 1s ease-out;
    }
    h4, h5, label {
      color: white;
    }
    .form-control {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
    }
    .form-control::placeholder {
      color: #ddd;
    }
    .form-control:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: none;
      color: white;
    }
    .btn-custom {
      background-color: #fff;
      color: #4ca2cd;
      font-weight: 600;
      border-radius: 30px;
      transition: all 0.3s ease;
    }
    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }
    a {
      color: #fff;
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
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
