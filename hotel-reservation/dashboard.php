<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$kullanici_adi = $_SESSION['fullname'] ?? 'Ziyaretçi';

// 📌 Stored Procedure kullanılarak kullanıcının rezervasyonları alınıyor
$stmt = $conn->prepare("CALL get_user_reservations(?)");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$reservations_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kullanıcı Paneli</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="user-dashboard">

<!-- Hoş geldiniz animasyonu -->
<div id="welcomeScreen" class="welcome-screen">
  Hoş geldiniz, <?= htmlspecialchars($kullanici_adi) ?>
</div>

<!-- Dashboard içeriği -->
<div id="dashboard" class="dashboard" style="display: none;">
  <div class="logout-btn">
    <a href="logout.php" class="btn btn-sm btn-outline-danger">
      <i class="fas fa-sign-out-alt me-1"></i> Çıkış</a>
  </div>

  <div class="user-header">Hoş geldiniz, <?= htmlspecialchars($kullanici_adi) ?></div>

  <div class="menu-column">
    <div class="menu-btn" onclick="toggleTable()">
      <i class="fas fa-clipboard-list icon-title text-info"></i> Geçmiş Rezervasyonlarım
    </div>
    <a href="rooms.php" class="menu-btn"> <i class="fas fa-bed icon-title text-success"></i> Rezervasyon Yap</a>
    <a href="index.php" class="menu-btn"> <i class="fas fa-home icon-title text-primary"></i> Ana Sayfa</a>
  </div>

  <div id="reservationTable" class="container" style="display: none;">
    <?php if (!$reservations_result): ?>
      <div class="alert alert-danger">Veritabanı hatası: <?= mysqli_error($conn) ?></div>
    <?php elseif (mysqli_num_rows($reservations_result) === 0): ?>
      <div class="alert alert-info text-center">Hiç rezervasyon bulunamadı.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
          <thead class="table-light text-center">
            <tr>
              <th>Oda Tipi</th>
              <th>Giriş</th>
              <th>Çıkış</th>
              <th>Durum</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php while($res = mysqli_fetch_assoc($reservations_result)): ?>
            <tr>
              <td><?= htmlspecialchars($res['room_type']) ?></td>
              <td><?= htmlspecialchars($res['check_in']) ?></td>
              <td><?= htmlspecialchars($res['check_out']) ?></td>
              <td>
                <?php
                  $status = $res['status'];
                  if ($status === 'approved') {
                    echo '<span class="badge bg-success">Onaylandı</span>';
                  } elseif ($status === 'pending') {
                    echo '<span class="badge bg-warning text-dark">Beklemede</span>';
                  } elseif ($status === 'cancelled') {
                    echo '<span class="badge bg-danger">İptal</span>';
                  } else {
                    echo '<span class="badge bg-secondary">Bilinmiyor</span>';
                  }
                ?>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
