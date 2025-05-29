<?php
include '../db.php';
include 'login-control.php'; // Giriş kontrolü

// Logları ve kullanıcı adlarını çek
$sql = "SELECT rl.*, u.fullname 
        FROM reservation_logs rl
        JOIN users u ON rl.user_id = u.id
        ORDER BY rl.action_time DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Rezervasyon Logları | Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin-style.css">
</head>

<body>
  <div class="container py-5">

    <!-- Çıkış Butonu -->
    <div class="logout-btn">
      <a href="../logout.php" class="btn btn-outline-danger">
        <i class="fas fa-sign-out-alt me-1"></i> Çıkış Yap
      </a>
    </div>

    <!-- Sayfa Başlığı -->
    <div class="welcome-box">
      <h2><i class="fas fa-database me-2"></i>Rezervasyon Logları</h2>
      <p>Sisteme kaydedilen tüm rezervasyon işlemleri burada listelenir.</p>
    </div>

    <!-- Geri Dön Butonu -->
    <div class="text-center mb-4">
      <a href="dashboard.php" class="btn btn-secondary btn-nav">
        <i class="fas fa-arrow-left me-1"></i> Admin Panele Dön
      </a>
    </div>

    <!-- Log Tablosu -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover shadow-sm align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>Oda ID</th>
            <th>Durum</th>
            <th>İşlem Zamanı</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            // Durum renkli rozet
            $badge = '';
            if ($row['status'] === 'pending') {
              $badge = '<span class="badge bg-warning text-dark">Beklemede</span>';
            } elseif ($row['status'] === 'approved') {
              $badge = '<span class="badge bg-success">Onaylandı</span>';
            } elseif ($row['status'] === 'cancelled') {
              $badge = '<span class="badge bg-danger">İptal Edildi</span>';
            }

            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['room_id']) . "</td>";
            echo "<td>$badge</td>";
            echo "<td>" . htmlspecialchars($row['action_time']) . "</td>";
            echo "</tr>";
            $count++;
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
