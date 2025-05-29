<?php
include '../db.php';
include 'login-control.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $room_type_id = $_POST['room_type_id'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $check = mysqli_query($conn, "SELECT id FROM rooms WHERE room_number = '$room_number'");
    if (mysqli_num_rows($check) > 0) {
        $error_message = "❌ Bu oda zaten kayıtlı. Lütfen farklı bir numara giriniz.";
    } else {
        $sql = "INSERT INTO rooms (room_number, room_type_id, price, status)
                VALUES ('$room_number', '$room_type_id', '$price', '$status')";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        } else {
            $error_message = "❌ Hata oluştu: " . mysqli_error($conn);
        }
    }
}

$types_result = mysqli_query($conn, "SELECT id, name FROM room_types");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yeni Oda Ekle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>

<div class="form-box">
  <h3><i class="fas fa-bed me-2"></i>Yeni Oda Ekle</h3>

  <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger text-center"><?= $error_message ?></div>
  <?php elseif (!empty($success)): ?>
    <div class="alert alert-success text-center">
      ✅ Yeni oda başarıyla sisteme kaydedildi.
      <br>
      <a href="dashboard.php" class="btn btn-outline-primary mt-3"><i class="fas fa-arrow-left me-1"></i> Yönetim Paneline Dön</a>
    </div>
  <?php endif; ?>

  <?php if (empty($success)): ?>
  <form method="POST" onsubmit="return validateRoomNumber();">
    <div class="mb-3">
      <label for="room_number" class="form-label">Oda Numarası</label>
      <input type="number" class="form-control" id="room_number" name="room_number" required>
    </div>

    <div class="mb-3">
      <label for="room_type_id" class="form-label">Oda Tipi</label>
      <select class="form-select" id="room_type_id" name="room_type_id" required>
        <option value="">Seçiniz</option>
        <?php while ($type = mysqli_fetch_assoc($types_result)) : ?>
          <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['name']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Fiyat (₺)</label>
      <input type="number" class="form-control" id="price" name="price" required>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Durum</label>
      <select class="form-select" name="status" id="status" required>
        <option value="available">Müsait</option>
        <option value="booked">Dolu</option>
      </select>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Kaydet</button>
    </div>
  </form>

  <div class="text-center mt-4">
    <a href="dashboard.php" class="btn btn-link"><i class="fas fa-tools me-1"></i> Admin Paneline Dön</a>

  </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/admin-script.js"></script>
</body>
</html>
