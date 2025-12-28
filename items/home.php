<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Expired Tracker | Selamat Datang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1cbc6e;
      --primary-dark: #109254;
      --accent: #ffc107;
      --dark: #15251a;
      --light: #f8fff9;
      --gray: #e2e8e4;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--light);
      color: var(--dark);
      overflow-x: hidden;
    }
    
    .navbar {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      padding: 1rem 2rem;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      transition: all 0.3s ease;
    }
    
    .navbar-scrolled {
      padding: 0.5rem 2rem;
    }
    
    .logo-container {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    
    .logo {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      transition: all 0.3s ease;
    }
    
    .brand-text {
      font-weight: 700;
      color: var(--primary-dark);
      font-size: 1.4rem;
      margin: 0;
    }
    
    .hero-section {
      background: linear-gradient(135deg, #36B37E, #1cbc6e);
      min-height: 100vh;
      padding-top: 100px;
      padding-bottom: 5rem;
      position: relative;
      overflow: hidden;
    }
    
    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
      opacity: 0.6;
    }
    
    .hero-content {
      color: white;
      position: relative;
      z-index: 10;
    }
    
    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      background: linear-gradient(90deg, #ffffff, #f0fff0);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    
    .hero-subtitle {
      font-size: 1.3rem;
      margin-bottom: 2rem;
      max-width: 600px;
    }
    
    .hero-image {
      width: 100%;
      max-width: 550px;
      border-radius: 20px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.2);
      transform: perspective(1500px) rotateY(-15deg);
      transition: all 0.5s ease;
    }
    
    .hero-image:hover {
      transform: perspective(1500px) rotateY(0);
    }
    
    .feature-card {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      height: 100%;
      transition: all 0.3s ease;
      border: 1px solid var(--gray);
      position: relative;
      overflow: hidden;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      border-color: var(--primary);
    }
    
    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 5px;
      height: 0;
      background: var(--primary);
      transition: height 0.3s ease;
    }
    
    .feature-card:hover::before {
      height: 100%;
    }
    
    .feature-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
      transform: scale(1.2);
    }
    
    .feature-title {
      font-weight: 600;
      margin-bottom: 1rem;
      font-size: 1.3rem;
    }
    
    .section-title {
      position: relative;
      display: inline-block;
      font-weight: 700;
      margin-bottom: 3rem;
      color: var(--dark);
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 50px;
      height: 5px;
      background: var(--primary);
      border-radius: 5px;
    }
    
    .how-it-works {
      padding: 6rem 0;
      background-color: #f5f9f6;
    }
    
    .step-card {
      background: white;
      border-radius: 16px;
      padding: al;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
      position: relative;
      z-index: 1;
      height: 100%;
      transition: all 0.3s ease;
      border: 1px solid var(--gray);
      padding: 2rem;
    }
    
    .step-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .step-number {
      background: var(--primary);
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }
    
    .testimonial-section {
      padding: 6rem 0;
      background: linear-gradient(135deg, #f0f9ff, #f8fff9);
    }
    
    .testimonial-card {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      height: 100%;
      transition: all 0.3s ease;
      border: 1px solid var(--gray);
      position: relative;
    }
    
    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .quote-icon {
      font-size: 3rem;
      color: var(--primary);
      opacity: 0.2;
      position: absolute;
      top: 20px;
      right: 20px;
    }
    
    .testimonial-author {
      display: flex;
      align-items: center;
      margin-top: 1.5rem;
    }
    
    .author-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--gray);
      margin-right: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--primary-dark);
    }
    
    .cta-section {
      padding: 6rem 0;
      background: linear-gradient(135deg, #36B37E, #1cbc6e);
      color: white;
      position: relative;
      overflow: hidden;
    }
    
    .cta-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
      opacity: 0.6;
    }
    
    .btn-custom {
      padding: 0.8rem 2.5rem;
      border-radius: 50px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn-primary-custom {
      background: var(--primary);
      border: none;
      color: white;
    }
    
    .btn-primary-custom:hover {
      background: var(--primary-dark);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .btn-outline-custom {
      background: transparent;
      border: 2px solid white;
      color: white;
    }
    
    .btn-outline-custom:hover {
      background: white;
      color: var(--primary);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .btn-custom::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.2);
      transition: all 0.4s ease;
      z-index: -1;
    }
    
    .btn-custom:hover::before {
      left: 100%;
    }
    
    .login-section {
      padding: 6rem 0;
      background: white;
    }
    
    .login-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 15px 50px rgba(0,0,0,0.1);
      overflow: hidden;
      max-width: 900px;
      margin: 0 auto;
    }
    
    .login-image {
      background: linear-gradient(135deg, #36B37E, #1cbc6e);
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    
    .login-form {
      padding: 3rem;
    }
    
    .form-control {
      border-radius: 10px;
      padding: 0.8rem 1rem;
      border: 1px solid var(--gray);
      margin-bottom: 1.5rem;
    }
    
    .tab-link {
      color: var(--dark);
      text-decoration: none;
      padding: 1rem;
      display: inline-block;
      font-weight: 600;
      position: relative;
    }
    
    .tab-link.active {
      color: var(--primary);
    }
    
    .tab-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: var(--primary);
      border-radius: 3px;
    }
    
    .footer {
      background: var(--dark);
      color: white;
      padding: 4rem 0 2rem;
    }
    
    .footer-title {
      font-weight: 600;
      margin-bottom: 1.5rem;
      font-size: 1.2rem;
    }
    
    .footer-link {
      color: #aaa;
      text-decoration: none;
      display: block;
      margin-bottom: 0.8rem;
      transition: all 0.3s ease;
    }
    
    .footer-link:hover {
      color: white;
      transform: translateX(5px);
    }
    
    .social-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255,255,255,0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 0.5rem;
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      background: var(--primary);
      transform: translateY(-5px);
    }
    
    .copyright {
      padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      margin-top: 3rem;
      text-align: center;
      color: #aaa;
    }
    
    .stats-section {
      padding: 6rem 0;
      background: white;
    }
    
    .counter-box {
      text-align: center;
    }
    
    .counter {
      font-size: 3rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1rem;
    }
    
    .counter-text {
      font-size: 1.1rem;
      font-weight: 500;
      color: var(--dark);
    }
    
    /* Animation Classes */
    .animate-fade-up {
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.6s ease;
    }
    
    .animate-fade-in {
      opacity: 0;
      transition: all 0.6s ease;
    }
    
    .animate-fade-right {
      opacity: 0;
      transform: translateX(-50px);
      transition: all 0.6s ease;
    }
    
    .animate-fade-left {
      opacity: 0;
      transform: translateX(50px);
      transition: all 0.6s ease;
    }
    
    .animate-visible {
      opacity: 1;
      transform: translate(0);
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 991px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-image {
        max-width: 100%;
        margin-top: 3rem;
      }
      
      .login-image {
        height: 200px;
      }
    }
    
    @media (max-width: 767px) {
      .navbar {
        padding: 1rem;
      }
      
      .navbar-scrolled {
        padding: 0.5rem 1rem;
      }
      
      .hero-section {
        padding-top: 80px;
      }
      
      .hero-title {
        font-size: 2rem;
      }
      
      .section-title {
        font-size: 1.8rem;
      }
      
      .feature-card,
      .step-card,
      .testimonial-card {
        margin-bottom: 2rem;
      }
    }
    
    /* Tooltip */
    .tooltip {
      position: relative;
      display: inline-block;
    }
    
    .tooltip .tooltiptext {
      visibility: hidden;
      width: 200px;
      background-color: var(--dark);
      color: white;
      text-align: center;
      border-radius: 6px;
      padding: 10px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -100px;
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 0.9rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .tooltip .tooltiptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: var(--dark) transparent transparent transparent;
    }
    
    .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }
    
    /* Floating Animation */
    @keyframes float {
      0% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
      100% {
        transform: translateY(0px);
      }
    }
    
    .float {
      animation: float 4s ease-in-out infinite;
    }
    
    /* Modal styles */
    .modal-custom {
      background: white;
      border-radius: 20px;
      max-width: 500px;
      margin: 2rem auto;
      padding: 2rem;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1050;
      display: none;
    }
    
    .modal-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1040;
      display: none;
    }
    
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }
    
    .modal-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--dark);
    }
    
    .loader {
      display: inline-block;
      width: 80px;
      height: 80px;
      position: relative;
    }
    
    .loader:after {
      content: " ";
      display: block;
      border-radius: 50%;
      width: 0;
      height: 0;
      margin: 8px;
      box-sizing: border-box;
      border: 32px solid var(--primary);
      border-color: var(--primary) transparent var(--primary) transparent;
      animation: loader 1.2s infinite;
    }
    
    @keyframes loader {
      0% {
        transform: rotate(0);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
      }
      50% {
        transform: rotate(180deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    .btn-primary-custom {
    background-color: #007bff;
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .btn-primary-custom:hover {
    background-color: #0056b3;
    color: #fff;
  }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand logo-container" href="#">
        <div class="d-flex align-items-center">
          <span class="brand-text">Expired Tracker</span>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#features">Fitur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#how-it-works">Cara Kerja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#testimonials">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#login">Login/Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <h1 class="hero-title animate-fade-up">Pantau Barang Sebelum Expired!</h1>
          <p class="hero-subtitle animate-fade-up">Sistem cerdas untuk mencatat dan mengingatkan masa berlaku bahan makanan, mencegah pemborosan dan mengoptimalkan stok.</p>
          <div class="d-flex flex-wrap gap-3 mb-4 animate-fade-up">
            <a href="#login" class="btn btn-warning btn-custom btn-lg">Mulai Sekarang</a>
            <a href="#features" class="btn btn-outline-custom btn-lg">Lihat Fitur</a>
          </div>
          
          <div class="d-flex align-items-center gap-4 mt-5 animate-fade-in">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2"></i>
              <span>Gratis 6 bulan</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2"></i>
              <span>No Credit Card</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6 text-center animate-fade-left">
          <img src="dashboard.png" alt="Dashboard Expired Tracker" class="hero-image float">
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5" id="features">
    <div class="container py-5">
      <div class="text-center mb-5">
        <h2 class="section-title display-5">Fitur Unggulan</h2>
        <p class="text-muted">Kelola persediaan dan tanggal kadaluarsa dengan lebih efisien</p>
      </div>
      
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up">
            <div class="feature-icon">
              <i class="bi bi-card-checklist"></i>
            </div>
            <h3 class="feature-title">Catatan Kadaluarsa</h3>
            <p>Rekam semua produk dan bahan makanan beserta tanggal kadaluarsanya dalam satu dashboard yang mudah diakses.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up" style="animation-delay: 0.2s;">
            <div class="feature-icon">
              <i class="bi bi-bell-fill"></i>
            </div>
            <h3 class="feature-title">Smart Reminder Status</h3>
            <p>Sistem penanda otomatis berbasis warna untuk mengklasifikasikan status barang berdasarkan tanggal kadaluarsa.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up" style="animation-delay: 0.4s;">
            <div class="feature-icon">
              <i class="bi bi-graph-up"></i>
            </div>
            <h3 class="feature-title">Analisis Visual</h3>
            <p>Pantau tren dan pola kadaluarsa melalui grafik interaktif dan laporan yang mudah dipahami.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up" style="animation-delay: 0.6s;">
            <div class="feature-icon">
              <i class="bi bi-qr-code-scan"></i>
            </div>
            <h3 class="feature-title">Scan Barcode</h3>
            <p>Tambahkan produk dengan cepat melalui pemindaian barcode untuk menghemat waktu input manual.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up" style="animation-delay: 0.8s;">
            <div class="feature-icon">
              <i class="bi bi-cloud-arrow-up"></i>
            </div>
            <h3 class="feature-title">Sync</h3>
            <p>Akses sistem dari perangkat mana saja, data tersimpan otomatis secara realtime.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="feature-card animate-fade-up" style="animation-delay: 1s;">
            <div class="feature-icon">
              <i class="bi bi-calendar-check"></i>
            </div>
            <h3 class="feature-title">Managemen Kategori Barang</h3>
            <p>Kelompokkan barang ke dalam kategori tertentu untuk mempermudah pencarian dan filterisasi secara lebih terorganisir.</p>
            <a href="#" class="text-decoration-none text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="row g-4 text-center">
        <div class="col-md-4">
          <div class="counter-box">
            <div class="counter" data-target="5000">0</div>
            <div class="counter-text">Pengguna Aktif</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="counter-box">
            <div class="counter" data-target="250000">0</div>
            <div class="counter-text">Item Terpantau</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="counter-box">
            <div class="counter" data-target="85">0</div>
            <div class="counter-text">Efisiensi Meningkat (%)</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="how-it-works" id="how-it-works">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title display-5">Cara Kerja</h2>
      <p class="text-muted">Mulai pantau stok kadaluarsa dengan 3 langkah mudah</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="step-card animate-fade-up p-4" style="min-height: 250px;">
          <div class="step-number">1</div>
          <h3 class="mb-3 fw-bold">Daftar Akun</h3>
          <p>Buat akun baru atau login dengan akun yang sudah ada sebelumnya</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="step-card animate-fade-up p-4" style="animation-delay: 0.2s; min-height: 250px;">
          <div class="step-number">2</div>
          <h3 class="mb-3 fw-bold">Tambah Barang</h3>
          <p>Input data barang beserta tanggal kadaluarsa secara manual atau dengan scan</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="step-card animate-fade-up p-4" style="animation-delay: 0.4s; min-height: 250px;">
          <div class="step-number">3</div>
          <h3 class="mb-3 fw-bold">Pantau & Kelola</h3>
          <p>Lihat dashboard interaktif dan kelola stok dengan lebih efisien</p>
        </div>
      </div>
    </div>
      
      <!-- Interactive Demo -->
      <div class="text-center mt-5 pt-4">
        <button class="btn btn-primary-custom btn-lg" id="demoButton">
          <i class="bi bi-play-circle-fill me-2"></i> Lihat Demo Interaktif
        </button>
      </div>
    </div>
  </section>

  <!-- Testimonial Section -->
  <section class="testimonial-section" id="testimonials">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title display-5">Apa Kata Mereka</h2>
        <p class="text-muted">Pengalaman dari pengguna setia Expired Tracker</p>
      </div>
      
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card animate-fade-up">
            <i class="bi bi-quote quote-icon"></i>
            <p class="fst-italic">"Semenjak pakai sistem ini, stok bahan di gudang jadi lebih teratur! Nggak ada lagi bahan makanan yang basi begitu aja. Sangat membantu untuk usaha katering kami."</p>
            <div class="testimonial-author">
              <div class="author-avatar">C</div>
              <div>
                <h5 class="mb-0">Cahyono</h5>
                <small class="text-muted">Admin HellaKitchen</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card animate-fade-up" style="animation-delay: 0.2s;">
            <i class="bi bi-quote quote-icon"></i>
            <p class="fst-italic">"Cocok banget buat UMKM kayak gue yang harus ngatur stok tiap minggu. penanda warnanya bikin gue selalu tau kondisi bahan makanan gue di gudang."</p>
            <div class="testimonial-author">
              <div class="author-avatar">I</div>
              <div>
                <h5 class="mb-0">Imam</h5>
                <small class="text-muted">Owner Warung Makan Kebumen</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card animate-fade-up" style="animation-delay: 0.4s;">
            <i class="bi bi-quote quote-icon"></i>
            <p class="fst-italic">"Dashboard-nya keren banget! Bisa langsung lihat barang apa yang mau expired dalam waktu dekat. Laporan bulanannya juga membantu untuk monitoring pengeluaran."</p>
            <div class="testimonial-author">
              <div class="author-avatar">S</div>
              <div>
                <h5 class="mb-0">Sutawijaya</h5>
                <small class="text-muted">Manajer Minimarket</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section">
    <div class="container text-center">
      <h2 class="display-5 fw-bold mb-4 animate-fade-up">Siap Mengoptimalkan Stok?</h2>
      <p class="fs-5 mb-5 animate-fade-up">Bergabunglah dengan 5,000+ bisnis yang telah menghemat biaya dan mengurangi pemborosan!</p>
      <div class="animate-fade-up">
        <a href="#login" class="btn btn-warning btn-lg btn-custom">Mulai Gratis Sekarang</a>
        <p class="mt-3 small text-white-50">Tanpa kartu kredit. Coba gratis selama 6 bulan.</p>
      </div>
    </div>
  </section>

 <!-- Login Section (2 Kolom Gambar + Tombol) -->
<section class="login-section py-5" id="login">
  <div class="container">
    <div class="row g-4 align-items-center">
      
      <!-- Kolom Gambar -->
      <div class="col-lg-6 d-none d-lg-block">
        <div class="login-image h-100">
          <!-- <img src="welcome.jpeg" alt="Welcome Image" class="img-fluid rounded-4 shadow" style="object-fit: cover; height: 100%;"> -->
          <img src="welcome.jpeg" alt="Welcome Image" class="img-fluid rounded-4 shadow" style="height: 50vh; width: 100%; object-fit: cover;">

        </div>
      </div>
      
      <!-- Kolom Tombol -->
      <div class="col-lg-6">
        <div class="text-center">
          <h2 class="section-title display-5 mb-3">Masuk / Daftar</h2>
          <p class="text-muted mb-4">Akses ke sistem pencatatan kadaluarsa paling andal</p>

          <div class="d-flex justify-content-center gap-4">
            <a href="login.php" class="btn btn-primary-custom btn-lg px-5">Login</a>
            <a href="register.php" class="btn btn-outline-primary btn-lg px-5">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h4 class="footer-title">Expired Tracker</h4>
          <p class="mb-4">Sistem pencatatan dan pengingat kadaluarsa bahan makanan untuk bisnis dan rumah tangga.</p>
          <div class="social-icons">
            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        
        <div class="col-md-2">
          <h4 class="footer-title">Layanan</h4>
          <a href="#" class="footer-link">Pencatatan</a>
          <a href="#" class="footer-link">Pengingat</a>
          <a href="#" class="footer-link">Analitik</a>
          <a href="#" class="footer-link">Integrasi</a>
        </div>
        
        <div class="col-md-2">
          <h4 class="footer-title">Perusahaan</h4>
          <a href="#" class="footer-link">Tentang Kami</a>
          <a href="#" class="footer-link">Karir</a>
          <a href="#" class="footer-link">Blog</a>
          <a href="#" class="footer-link">Kontak</a>
        </div>
        
        <div class="col-md-4">
          <h4 class="footer-title">Berlangganan Newsletter</h4>
          <p class="mb-3">Dapatkan tips pengelolaan stok dan update fitur terbaru.</p>
          <form class="d-flex">
            <input type="email" class="form-control me-2" placeholder="Email Anda">
            <button class="btn btn-warning">Daftar</button>
          </form>
        </div>
      </div>
      
      <div class="copyright">
        <p>&copy; 2025 Expired Tracker. Dibuat oleh Tim Kelompok 3.</p>
      </div>
    </div>
  </footer>

  <!-- Modal Demo -->
  <!-- Backdrop -->
<div class="modal-backdrop" id="modalBackdrop"></div>

<!-- Modal Box -->
<div class="modal-custom" id="demoModal" style="max-height: 90vh; overflow-y: auto;">
  <div class="modal-header sticky-top bg-white" style="z-index: 10;">
    <h4 class="modal-title">Demo Interaktif</h4>
    <button class="modal-close" id="modalClose">&times;</button>
  </div>

  <div class="modal-body text-center px-4 pb-4">
    <p class="mb-4">Berikut adalah preview dari dashboard Expired Tracker:</p>
    <img src="dashboard.png" alt="Dashboard Demo" class="img-fluid mb-4" style="border-radius: 12px;">

    <p class="fw-bold text-start">Fitur yang ditampilkan:</p>
    <ul class="text-start">
      <li>Tambah Data Barang</li>
      <img src="tambah.png" alt="Tambah Barang" class="img-fluid rounded mb-3">

      <li>Edit Data Barang</li>
      <img src="edit.png" alt="Notifikasi" class="img-fluid rounded mb-3">

      <li>Grafik visualisasi stok</li>
      <img src="laporan1.png" alt="Grafik Stok" class="img-fluid rounded mb-3">
      <img src="laporan2.png" alt="Grafik Stok" class="img-fluid rounded mb-3">
      <img src="laporan3.png" alt="Grafik Stok" class="img-fluid rounded mb-3">
      <img src="laporan4.png" alt="Grafik Stok" class="img-fluid rounded mb-3">
      
      <li>Filter kategori produk</li>
      <img src="img-filter.png" alt="Filter Produk" class="img-fluid rounded mb-3">
    </ul>
  </div>
</div>


  <!-- Bootstrap, jQuery & Custom Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    // Animation on Scroll
    document.addEventListener('DOMContentLoaded', function() {
      const animatedElements = document.querySelectorAll('.animate-fade-up, .animate-fade-in, .animate-fade-right, .animate-fade-left');
      
      function checkInView() {
        animatedElements.forEach(element => {
          const elementTop = element.getBoundingClientRect().top;
          const elementVisible = 150;
          
          if (elementTop < window.innerHeight - elementVisible) {
            element.classList.add('animate-visible');
          }
        });
      }
      
      window.addEventListener('scroll', checkInView);
      checkInView();
      
      // Navbar Scroll Effect
      const navbar = document.querySelector('.navbar');
      window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          navbar.classList.add('navbar-scrolled');
        } else {
          navbar.classList.remove('navbar-scrolled');
        }
      });
      
      // Tab Switching
      const tabLinks = document.querySelectorAll('.tab-link');
      tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Remove active class from all tabs
          tabLinks.forEach(tab => tab.classList.remove('active'));
          this.classList.add('active');
          
          // Hide all tab contents
          document.querySelectorAll('.tab-content').forEach(content => {
            content.style.display = 'none';
          });
          
          // Show selected tab content
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId).style.display = 'block';
        });
      });
      
      // Counter Animation
      const counters = document.querySelectorAll('.counter');
      const speed = 200;
      
      counters.forEach(counter => {
        const animate = () => {
          const value = +counter.getAttribute('data-target');
          const data = +counter.innerText;
          
          const time = value / speed;
          if (data < value) {
            counter.innerText = Math.ceil(data + time);
            setTimeout(animate, 1);
          } else {
            counter.innerText = value;
          }
        }
        
        animate();
      });
      
      // Modal Functionality
      const modal = document.getElementById('demoModal');
      const modalBackdrop = document.getElementById('modalBackdrop');
      const modalClose = document.getElementById('modalClose');
      const demoButton = document.getElementById('demoButton');
      
      demoButton.addEventListener('click', function() {
        modal.style.display = 'block';
        modalBackdrop.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
      
      modalClose.addEventListener('click', function() {
        modal.style.display = 'none';
        modalBackdrop.style.display = 'none';
        document.body.style.overflow = 'auto';
      });
      
      modalBackdrop.addEventListener('click', function() {
        modal.style.display = 'none';
        modalBackdrop.style.display = 'none';
        document.body.style.overflow = 'auto';
      });
    });
  </script>
</body>
</html>