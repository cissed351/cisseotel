<?php
session_start();
include '../db.php';
include 'login-control.php';

$sql = "SELECT rooms.*, room_types.name AS room_type 
        FROM rooms 
        JOIN room_types ON rooms.room_type_id = room_types.id
        ORDER BY rooms.room_number ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Admin Paneli - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

  <!-- Hoş Geldiniz -->
  <div class="welcome-box">
    <h2><i class="fas fa-user-shield me-2"></i>Hoş Geldiniz, <strong><?= $_SESSION['fullname'] ?></strong></h2>
    <p>Admin kontrol paneline giriş yaptınız.</p>
  </div>

  <!-- Buton Navigasyon -->
<div class="mb-4 text-center">
  <a href="add-room.php" class="btn btn-warning btn-nav">
    <i class="fas fa-plus me-1"></i> Oda Ekle
  </a>
  <a href="admin_reservations.php" class="btn btn-info btn-nav text-white">
    <i class="fas fa-file-invoice me-1"></i> Rezervasyonları Yönet
  </a>
  <a href="admin_logs.php" class="btn btn-dark btn-nav">
    <i class="fas fa-database me-1"></i> Rezervasyon Logları
  </a>
  <a href="../index.php" class="btn btn-success btn-nav">
    <i class="fas fa-home me-1"></i> Siteye Dön
  </a>
</div>

  <!-- Oda Tablosu -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle shadow-sm">
      <thead>
        <tr>
          <th>Oda No</th>
          <th>Oda Tipi</th>
          <th>Fiyat</th>
          <th>Durum</th>
          <th>Düzenle</th>
          <th>Sil</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $currentFloor = null;
        while ($room = mysqli_fetch_assoc($result)) :
          $roomNumber = (int) $room['room_number'];
          $floor = floor($roomNumber / 100);

          if ($floor !== $currentFloor) {
            echo "<tr class='floor-header'><td colspan='6'>{$floor}. Kat</td></tr>";
            $currentFloor = $floor;
          }
        ?>
        <tr>
          <td><?= htmlspecialchars($room['room_number']) ?></td>
          <td><?= htmlspecialchars($room['room_type']) ?></td>
          <td><?= htmlspecialchars($room['price']) ?> ₺</td>
          <td>
            <?php
              if (trim($room['status']) === 'available') {
                echo '<span class="badge bg-success">Müsait</span>';
              } elseif (trim($room['status']) === 'booked') {
                echo '<span class="badge bg-danger">Dolu</span>';
              }
            ?>
          </td>
          <td>
            <a href="edit-room.php?id=<?= $room['id'] ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-pen"></i>
            </a>
          </td>
          <td>
            <a href="delete-room.php?id=<?= $room['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu odayı silmek istediğinize emin misiniz?')">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>
</body>
</html>
