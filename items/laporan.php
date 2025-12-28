<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include '../config/database.php';

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan - Expired Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../assets/css/laporan.css">  
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
          <a class="nav-link" aria-current="page" href="create.php">Tambah Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="laporan.php">Laporan</a>
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
  <h3 class="mb-4">Laporan</h3>

  <div class="row">
    <!-- Grafik Kategori Barang -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Distribusi Kategori Barang</h5>
          <div class="chart-container">
            <canvas id="kategoriChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik Barang Akan Kadaluarsa -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Status Kadaluarsa</h5>
          <div class="chart-container">
            <canvas id="expiredChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Grafik Bar Chart Kadaluarsa per Bulan -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title">Jumlah Barang Kadaluarsa per Bulan</h5>
      <div class="chart-container">
        <canvas id="monthlyExpiredChart"></canvas>
      </div>
    </div>
  </div>

  <!-- DIAGRAM Line Chart Tren Penambahan Barang -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title">Tren Penambahan Barang (6 Bulan Terakhir)</h5>
      <div class="chart-container">
        <canvas id="trendChart"></canvas>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- DIAGRAM Radar Chart Perbandingan Kategori -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Perbandingan Kategori Barang</h5>
          <div class="chart-container">
            <canvas id="radarChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- DIAGRAM Horizontal Bar Chart Risiko Kadaluarsa per Kategori -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Persentase Risiko Kadaluarsa per Kategori</h5>
          <div class="chart-container">
            <canvas id="risikoChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-4">
  <div class="card-body">
    <h5 class="card-title">Perbandingan Tren Penambahan vs Kadaluarsa</h5>
    <div class="chart-container">
      <canvas id="trendCompareChart"></canvas>
    </div>
  </div>
  </div>

  <div class="card shadow-sm mb-4">
  <div class="card-body">
    <h5 class="card-title">Distribusi Usia Barang</h5>
    <div class="chart-container">
      <canvas id="bubbleChart"></canvas>
    </div>
  </div>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title">Data Barang per Kategori</h5>
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Kategori</th>
            <th>Jumlah Barang</th>
            <th>Akan Kadaluarsa (7 hari)</th>
            <th>Kadaluarsa</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Data kategori - FILTER BY USER_ID
            $kategori_query = $conn->query("SELECT kategori, COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id GROUP BY kategori");
            
            while ($row = $kategori_query->fetch_assoc()) {
              $kategori = $row['kategori'];
              
              // Hitung yang akan kadaluarsa dalam 7 hari - FILTER BY USER_ID
              $akan_kadaluarsa = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)")->fetch_assoc()['jumlah'];
              
              // Hitung yang sudah kadaluarsa - FILTER BY USER_ID
              $kadaluarsa = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa < CURDATE()")->fetch_assoc()['jumlah'];
              
              echo "<tr>
                      <td>{$row['kategori']}</td>
                      <td>{$row['jumlah']}</td>
                      <td>{$akan_kadaluarsa}</td>
                      <td>{$kadaluarsa}</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Daftar Barang Yang Akan Kadaluarsa (30 Hari ke Depan)</h5>
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // FILTER BY USER_ID
            $barang_query = $conn->query("SELECT * FROM makanan WHERE user_id = $user_id AND tanggal_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY) ORDER BY tanggal_kadaluarsa ASC");
            
            while ($row = $barang_query->fetch_assoc()) {
              $tanggal_kadaluarsa = new DateTime($row['tanggal_kadaluarsa']);
              $sekarang = new DateTime();
              $selisih = $sekarang->diff($tanggal_kadaluarsa);
              $hari_tersisa = $selisih->days;
              
              // Tentukan status berdasarkan hari tersisa
              $status = "";
              $status_class = "";
              
              if ($tanggal_kadaluarsa < $sekarang) {
                $status = "Sudah Kadaluarsa";
                $status_class = "text-danger fw-bold";
              } elseif ($hari_tersisa <= 7) {
                $status = "Segera Kadaluarsa ({$hari_tersisa} hari)";
                $status_class = "text-warning fw-bold";
              } else {
                $status = "Aman ({$hari_tersisa} hari)";
                $status_class = "text-success";
              }
              
              echo "<tr>
                      <td>{$row['nama_barang']}</td>
                      <td>{$row['kategori']}</td>
                      <td>{$row['tanggal_kadaluarsa']}</td>
                      <td class='{$status_class}'>{$status}</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script>
  // Data untuk grafik kategori
<?php
  // FILTER BY USER_ID
  $kategori_data = $conn->query("SELECT kategori, COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id GROUP BY kategori");
  $kategori_labels = [];
  $kategori_values = [];
  
  while ($row = $kategori_data->fetch_assoc()) {
    $kategori_labels[] = $row['kategori'];
    $kategori_values[] = $row['jumlah'];
  }
?>

// Data untuk grafik kadaluarsa
<?php
  // FILTER BY USER_ID
  $exp_query = $conn->query("
    SELECT 
      'Sudah Kadaluarsa' as status, 
      COUNT(*) as jumlah 
    FROM makanan 
    WHERE user_id = $user_id AND tanggal_kadaluarsa < CURDATE()
    UNION
    SELECT 
      'Dalam 7 Hari' as status, 
      COUNT(*) as jumlah 
    FROM makanan 
    WHERE user_id = $user_id AND tanggal_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    UNION
    SELECT 
      '8-30 Hari' as status, 
      COUNT(*) as jumlah 
    FROM makanan 
    WHERE user_id = $user_id AND tanggal_kadaluarsa BETWEEN DATE_ADD(CURDATE(), INTERVAL 8 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    UNION
    SELECT 
      'Lebih dari 30 Hari' as status, 
      COUNT(*) as jumlah 
    FROM makanan 
    WHERE user_id = $user_id AND tanggal_kadaluarsa > DATE_ADD(CURDATE(), INTERVAL 30 DAY)
  ");
  
  $exp_labels = [];
  $exp_values = [];
  $exp_colors = ['#dc3545', '#ffc107', '#0dcaf0', '#198754'];
  
  $i = 0;
  while ($row = $exp_query->fetch_assoc()) {
    $exp_labels[] = $row['status'];
    $exp_values[] = $row['jumlah'];
    $i++;
  }
?>

// Data untuk grafik bar chart kadaluarsa per bulan
<?php
  // Mendapatkan data untuk 6 bulan ke depan
  $bulan_labels = [];
  $bulan_data = [];
  $bulan_colors = [];
  
  // Bulan sekarang
  $current_month = date('n');
  $current_year = date('Y');
  
  // Warna untuk bar chart
  $colors = ['#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#E91E63', '#607D8B'];
  
  // Ambil data 6 bulan ke depan
  for($i = 0; $i < 6; $i++) {
    $month_num = ($current_month + $i) % 12;
    if($month_num == 0) $month_num = 12; // Bulan 0 menjadi Desember
    
    $year = $current_year;
    if($current_month + $i > 12) {
      $year++;
    }
    
    $month_name = date('F', mktime(0, 0, 0, $month_num, 1, $year));
    $bulan_labels[] = $month_name;
    
    // Hitung jumlah barang yang kadaluarsa di bulan ini - FILTER BY USER_ID
    $start_date = date('Y-m-01', mktime(0, 0, 0, $month_num, 1, $year));
    $end_date = date('Y-m-t', mktime(0, 0, 0, $month_num, 1, $year));
    
    $monthly_query = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND tanggal_kadaluarsa BETWEEN '$start_date' AND '$end_date'");
    $bulan_data[] = $monthly_query->fetch_assoc()['jumlah'];
    
    $bulan_colors[] = $colors[$i % count($colors)];
  }
?>

// DATA UNTUK DIAGRAM BARU: Line Chart Tren Penambahan Barang
<?php
  // Data untuk 6 bulan terakhir
  $trend_labels = [];
  $trend_data = [];
  
  // Bulan sekarang
  $current_month = date('n');
  $current_year = date('Y');
  
  // Ambil data 6 bulan ke belakang
  for($i = 5; $i >= 0; $i--) {
    $month_num = ($current_month - $i);
    $year = $current_year;
    
    if($month_num <= 0) {
      $month_num = 12 + $month_num;
      $year--;
    }
    
    $month_name = date('M Y', mktime(0, 0, 0, $month_num, 1, $year));
    $trend_labels[] = $month_name;
    
    // Hitung jumlah barang yang ditambahkan di bulan ini - FILTER BY USER_ID
    $start_date = date('Y-m-01', mktime(0, 0, 0, $month_num, 1, $year));
    $end_date = date('Y-m-t', mktime(0, 0, 0, $month_num, 1, $year));
    
    $trend_query = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND tanggal_input BETWEEN '$start_date' AND '$end_date'");
    $trend_data[] = $trend_query->fetch_assoc()['jumlah'];
  }
?>

// DATA UNTUK DIAGRAM BARU: Radar Chart Perbandingan Kategori
<?php
  // Mengambil semua kategori - FILTER BY USER_ID
  $radar_kategori = [];
  $radar_data = [];
  $kategori_list = $conn->query("SELECT DISTINCT kategori FROM makanan WHERE user_id = $user_id");
  
  // Data untuk radar chart
  $radar_datasets = [];
  
  // Metrik untuk perbandingan (kita akan membandingkan 5 metrik)
  $metrics = [
    'total' => 'Total Barang',
    'expired' => 'Sudah Kadaluarsa',
    'soon_expired' => 'Segera Kadaluarsa',
    'safe' => 'Aman',
    'avg_days' => 'Rata-rata Hari Tersisa'
  ];
  
  // Untuk setiap kategori, hitung metrik
  while ($cat = $kategori_list->fetch_assoc()) {
    $kategori = $cat['kategori'];
    $radar_kategori[] = $kategori;
    
    // Total barang - FILTER BY USER_ID
    $total = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori'")->fetch_assoc()['jumlah'];
    
    // Sudah kadaluarsa - FILTER BY USER_ID
    $expired = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa < CURDATE()")->fetch_assoc()['jumlah'];
    
    // Segera kadaluarsa (7 hari) - FILTER BY USER_ID
    $soon = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)")->fetch_assoc()['jumlah'];
    
    // Aman - FILTER BY USER_ID
    $safe = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa > DATE_ADD(CURDATE(), INTERVAL 7 DAY)")->fetch_assoc()['jumlah'];
    
    // Rata-rata hari tersisa - FILTER BY USER_ID
    $avg_days_query = $conn->query("SELECT AVG(DATEDIFF(tanggal_kadaluarsa, CURDATE())) as avg_days FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa >= CURDATE()");
    $avg_days = $avg_days_query->fetch_assoc()['avg_days'];
    if($avg_days === NULL) $avg_days = 0;
    
    // Normalisasi nilai untuk skala yang sama (0-100)
    $data = [
      'total' => $total,
      'expired' => $expired,
      'soon_expired' => $soon,
      'safe' => $safe,
      'avg_days' => min(100, $avg_days) // Maximal 100 hari untuk visualisasi
    ];
    
    $radar_data[$kategori] = $data;
  }
  
  // Buat array untuk dataset radar chart
  $radar_datasets = [];
  $radar_colors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 
                  'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
  $radar_borders = ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
                    'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)'];
  
  $i = 0;
  foreach($radar_kategori as $kategori) {
    $dataset = [
      'label' => $kategori,
      'data' => [
        $radar_data[$kategori]['total'],
        $radar_data[$kategori]['expired'],
        $radar_data[$kategori]['soon_expired'],
        $radar_data[$kategori]['safe'],
        $radar_data[$kategori]['avg_days']
      ],
      'fill' => true,
      'backgroundColor' => $radar_colors[$i % count($radar_colors)],
      'borderColor' => $radar_borders[$i % count($radar_borders)],
      'pointBackgroundColor' => $radar_borders[$i % count($radar_borders)],
      'pointBorderColor' => '#fff',
      'pointHoverBackgroundColor' => '#fff',
      'pointHoverBorderColor' => $radar_borders[$i % count($radar_borders)]
    ];
    
    $radar_datasets[] = $dataset;
    $i++;
  }
?>

// DATA UNTUK DIAGRAM BARU: Horizontal Bar Chart Risiko Kadaluarsa per Kategori
<?php
  // Data untuk chart risiko
  $risiko_labels = [];
  $risiko_data = [];
  $risiko_colors = [];
  
  // Ambil data kategori dan hitung persentase risiko - FILTER BY USER_ID
  $risiko_query = $conn->query("SELECT kategori FROM makanan WHERE user_id = $user_id GROUP BY kategori");
  $risk_colors = [
    '#4CAF50', // Hijau - risiko rendah
    '#FFC107', // Kuning - risiko sedang
    '#FF5722', // Oranye - risiko tinggi
    '#F44336'  // Merah - risiko sangat tinggi
  ];
  
  $i = 0;
  while ($row = $risiko_query->fetch_assoc()) {
    $kategori = $row['kategori'];
    $risiko_labels[] = $kategori;
    
    // Hitung total barang dalam kategori - FILTER BY USER_ID
    $total = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori'")->fetch_assoc()['jumlah'];
    
    // Hitung barang berisiko (kadaluarsa dan akan kadaluarsa dalam 7 hari) - FILTER BY USER_ID
    $berisiko = $conn->query("SELECT COUNT(*) as jumlah FROM makanan WHERE user_id = $user_id AND kategori = '$kategori' AND tanggal_kadaluarsa <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)")->fetch_assoc()['jumlah'];
    
    // Hitung persentase risiko
    $persentase = ($total > 0) ? ($berisiko / $total) * 100 : 0;
    $risiko_data[] = round($persentase, 1); // Bulatkan ke 1 desimal
    
    // Tentukan warna berdasarkan tingkat risiko
    if ($persentase < 25) {
      $risiko_colors[] = $risk_colors[0]; // Hijau
    } elseif ($persentase < 50) {
      $risiko_colors[] = $risk_colors[1]; // Kuning
    } elseif ($persentase < 75) {
      $risiko_colors[] = $risk_colors[2]; // Oranye
    } else {
      $risiko_colors[] = $risk_colors[3]; // Merah
    }
    
    $i++;
  }
?>

// Buat grafik kategori
const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
const kategoriChart = new Chart(kategoriCtx, {
  type: 'pie',
  data: {
    labels: <?php echo json_encode($kategori_labels); ?>,
    datasets: [{
      data: <?php echo json_encode($kategori_values); ?>,
      backgroundColor: [
        '#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#E91E63', '#607D8B'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'right',
      }
    }
  }
});

// Buat grafik kadaluarsa
const expiredCtx = document.getElementById('expiredChart').getContext('2d');
const expiredChart = new Chart(expiredCtx, {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($exp_labels); ?>,
    datasets: [{
      data: <?php echo json_encode($exp_values); ?>,
      backgroundColor: <?php echo json_encode($exp_colors); ?>,
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'right',
      }
    }
  }
});

// Buat grafik bar chart bulanan
const monthlyExpiredCtx = document.getElementById('monthlyExpiredChart').getContext('2d');
const monthlyExpiredChart = new Chart(monthlyExpiredCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($bulan_labels); ?>,
    datasets: [{
      label: 'Jumlah Barang Kadaluarsa',
      data: <?php echo json_encode($bulan_data); ?>,
      backgroundColor: <?php echo json_encode($bulan_colors); ?>,
      borderColor: <?php echo json_encode($bulan_colors); ?>,
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Jumlah Barang Kadaluarsa per Bulan (6 Bulan ke Depan)'
      },
      legend: {
        display: false
      }
    }
  }
});

// BUAT GRAFIK BARU: Line Chart Tren Penambahan Barang
const trendCtx = document.getElementById('trendChart').getContext('2d');
const trendChart = new Chart(trendCtx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($trend_labels); ?>,
    datasets: [{
      label: 'Jumlah Barang Ditambahkan',
      data: <?php echo json_encode($trend_data); ?>,
      fill: false,
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Tren Penambahan Barang (6 Bulan Terakhir)'
      }
    }
  }
});

// BUAT GRAFIK BARU: Radar Chart Perbandingan Kategori
const radarCtx = document.getElementById('radarChart').getContext('2d');
const radarChart = new Chart(radarCtx, {
  type: 'radar',
  data: {
    labels: ['Total Barang', 'Sudah Kadaluarsa', 'Segera Kadaluarsa', 'Aman', 'Rata-rata Hari Tersisa'],
    datasets: <?php echo json_encode($radar_datasets); ?>
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    elements: {
      line: {
        borderWidth: 3
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Perbandingan Metrik Antar Kategori'
      }
    }
  }
});

// BUAT GRAFIK BARU: Horizontal Bar Chart Risiko Kadaluarsa per Kategori
const risikoCtx = document.getElementById('risikoChart').getContext('2d');
const risikoChart = new Chart(risikoCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($risiko_labels); ?>,
    datasets: [{
      label: '% Barang Berisiko Kadaluarsa',
      data: <?php echo json_encode($risiko_data); ?>,
      backgroundColor: <?php echo json_encode($risiko_colors); ?>,
      borderColor: <?php echo json_encode($risiko_colors); ?>,
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'y',
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        beginAtZero: true,
        max: 100,
        title: {
          display: true,
          text: 'Persentase (%)'
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Persentase Barang Berisiko Kadaluarsa per Kategori'
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            return context.raw + '% barang berisiko kadaluarsa';
          }
        }
      }
    }
  }
});

// PHP untuk data
<?php
  // Data untuk perbandingan tren
  $compare_labels = [];
  $added_data = [];
  $expired_data = [];
  
  // 6 bulan terakhir
  for($i = 5; $i >= 0; $i--) {
    $month_num = ($current_month - $i);
    $year = $current_year;
    
    if($month_num <= 0) {
      $month_num = 12 + $month_num;
      $year--;
    }
    
    $month_name = date('M Y', mktime(0, 0, 0, $month_num, 1, $year));
    $compare_labels[] = $month_name;
    
    $start_date = date('Y-m-01', mktime(0, 0, 0, $month_num, 1, $year));
    $end_date = date('Y-m-t', mktime(0, 0, 0, $month_num, 1, $year));
    
    // Jumlah ditambahkan - FILTER BY USER_ID
    $added_query = $conn->query("SELECT COUNT(*) as jumlah FROM makanan 
                                WHERE user_id = $user_id AND tanggal_input BETWEEN '$start_date' AND '$end_date'");
    $added_data[] = $added_query->fetch_assoc()['jumlah'];
    
    // Jumlah kadaluarsa - FILTER BY USER_ID
    $expired_query = $conn->query("SELECT COUNT(*) as jumlah FROM makanan 
                                  WHERE user_id = $user_id AND tanggal_kadaluarsa BETWEEN '$start_date' AND '$end_date'");
    $expired_data[] = $expired_query->fetch_assoc()['jumlah'];
  }
?>

// JS untuk membuat chart
const trendCompareCtx = document.getElementById('trendCompareChart').getContext('2d');
const trendCompareChart = new Chart(trendCompareCtx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($compare_labels); ?>,
    datasets: [
      {
        label: 'Barang Ditambahkan',
        data: <?php echo json_encode($added_data); ?>,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(75, 192, 192, 0.1)',
        fill: true,
        tension: 0.1
      },
      {
        label: 'Barang Kadaluarsa',
        data: <?php echo json_encode($expired_data); ?>,
        borderColor: 'rgb(255, 99, 132)',
        backgroundColor: 'rgba(255, 99, 132, 0.1)',
        fill: true,
        tension: 0.1
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0
        }
      }
    },
    interaction: {
      mode: 'index',
      intersect: false,
    },
    plugins: {
      title: {
        display: true,
        text: 'Perbandingan Barang Ditambahkan vs Kadaluarsa'
      }
    }
  }
});

// PHP untuk data
<?php
  // Data untuk bubble chart
  $bubble_data = [];
  
  // Ambil kategori unik - FILTER BY USER_ID
  $kategori_list = $conn->query("SELECT DISTINCT kategori FROM makanan WHERE user_id = $user_id");
  $bubble_colors = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 
                   'rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)'];
  
  $i = 0;
  while ($cat = $kategori_list->fetch_assoc()) {
    $kategori = $cat['kategori'];
    
    // Ambil data untuk kategori ini - FILTER BY USER_ID
    $bubble_query = $conn->query("
      SELECT 
        DATEDIFF(tanggal_kadaluarsa, CURDATE()) as days_left,
        COUNT(*) as count
      FROM makanan 
      WHERE user_id = $user_id AND kategori = '$kategori'
      GROUP BY days_left
      HAVING days_left > -30 AND days_left < 180
    ");
    
    $points = [];
    while ($row = $bubble_query->fetch_assoc()) {
      $days = intval($row['days_left']);
      $count = intval($row['count']);
      
      // Buat titik bubble dengan format: x = hari tersisa, y = 1 (fixed), r = jumlah barang
      $points[] = [
        'x' => $days,
        'y' => $i + 1, // Posisi Y sesuai kategori
        'r' => min(25, max(5, $count * 5)) // Radius berdasarkan count, min 5 max 25
      ];
    }
    
    $bubble_data[] = [
      'label' => $kategori,
      'data' => $points,
      'backgroundColor' => $bubble_colors[$i % count($bubble_colors)]
    ];
    
    $i++;
  }
?>

// JS untuk membuat chart
const bubbleCtx = document.getElementById('bubbleChart').getContext('2d');
const bubbleChart = new Chart(bubbleCtx, {
  type: 'bubble',
  data: {
    datasets: <?php echo json_encode($bubble_data); ?>
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        min: -10,
        max: 90,
        title: {
          display: true,
          text: 'Hari Tersisa Sebelum Kadaluarsa'
        },
        ticks: {
          callback: function(value) {
            if (value < 0) return 'Kadaluarsa ' + Math.abs(value) + ' hari';
            return value + ' hari lagi';
          }
        }
      },
      y: {
        title: {
          display: true,
          text: 'Kategori'
        },
        ticks: {
          stepSize: 1,
          callback: function(value, index) {
            return <?php echo json_encode($radar_kategori); ?>[index-1] || '';
          }
        }
      }
    },
    plugins: {
      tooltip: {
        callbacks: {
          label: function(context) {
            return context.raw.r/5 + ' barang, ' + 
                  (context.raw.x < 0 ? 'kadaluarsa ' + Math.abs(context.raw.x) + ' hari lalu' : 
                                      context.raw.x + ' hari tersisa');
          }
        }
      }
    }
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>