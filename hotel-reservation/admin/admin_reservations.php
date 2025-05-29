<?php
include '../db.php';
include 'login-control.php';

$sql = "SELECT r.*, u.fullname, u.email, rm.room_number, r.nights
        FROM reservations r
        JOIN users u ON r.user_id = u.id
        JOIN rooms rm ON r.room_id = rm.id
        ORDER BY r.check_in DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Rezervasyon Yönetimi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>

<div class="container py-5">

  <!-- Çıkış Butonu -->
  <div class="logout-btn">
    <a href="../logout.php" class="btn btn-outline-danger btn-sm">
      <i class="fas fa-sign-out-alt me-1"></i> Çıkış Yap
    </a>
  </div>

  <!-- Geri Dön Butonu -->
  <div class="mb-3">
    <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">
      <i class="fas fa-arrow-left me-1"></i> Admin Panele Dön
    </a>
  </div>

  <!-- Başlık -->
  <div class="header-box mb-4">
    <h2><i class="fas fa-file-invoice me-2"></i>Rezervasyon Yönetimi</h2>
    <p>Sisteme yapılan tüm rezervasyonları buradan yönetebilirsiniz.</p>
  </div>

  <!-- Tablo -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover shadow-sm">
      <thead class="table-light">
        <tr>
          <th>Ad Soyad</th>
          <th>Email</th>
          <th>Oda No</th>
          <th>Giriş</th>
          <th>Çıkış</th>
          <th>Gece</th>
          <th>Durum</th>
          <th>İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['room_number']) ?></td>
          <td><?= htmlspecialchars($row['check_in']) ?></td>
          <td><?= htmlspecialchars($row['check_out']) ?></td>
          <td><?= (int)$row['nights'] ?> gece</td>
          <td>
            <?php if ($row['status'] === 'approved'): ?>
              <span class="badge bg-success">Onaylandı</span>
            <?php elseif ($row['status'] === 'pending'): ?>
              <span class="badge bg-warning text-dark">Beklemede</span>
            <?php elseif ($row['status'] === 'cancelled'): ?>
              <span class="badge bg-danger">İptal</span>
            <?php else: ?>
              <span class="badge bg-secondary">Bilinmiyor</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($row['status'] === 'pending'): ?>
              <a href="approve-reservation.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-success me-1">
                <i class="fas fa-check"></i>
              </a>
            <?php endif; ?>
            <a href="delete-reservation.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu rezervasyonu silmek istediğinizden emin misiniz?')">
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
</body>
</html>
