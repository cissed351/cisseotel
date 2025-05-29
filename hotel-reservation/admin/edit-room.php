<?php
include '../db.php';
include 'login-control.php';

if (!isset($_GET['id'])) {
    echo "Geçersiz oda ID.";
    exit();
}

$room_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_type_id = $_POST['room_type_id'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "UPDATE rooms 
            SET room_type_id = '$room_type_id', 
                price = '$price', 
                status = '$status' 
            WHERE id = $room_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?updated=1");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Hata: " . mysqli_error($conn) . "</div>";
    }
}

$room_result = mysqli_query($conn, "SELECT * FROM rooms WHERE id = $room_id");
$room = mysqli_fetch_assoc($room_result);
$types_result = mysqli_query($conn, "SELECT * FROM room_types");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Oda Düzenle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>

<div class="form-box">
  <h3><i class="fas fa-pen me-2"></i>Oda Düzenle (<?= htmlspecialchars($room['room_number']) ?>)</h3>
  <form method="POST">
    <div class="mb-3">
      <label for="room_type_id" class="form-label">Oda Tipi</label>
      <select class="form-select" id="room_type_id" name="room_type_id" required>
        <option value="">Seçiniz</option>
        <?php while ($type = mysqli_fetch_assoc($types_result)) : ?>
          <option value="<?= $type['id'] ?>" <?= ($type['id'] == $room['room_type_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($type['name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Fiyat (₺)</label>
      <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($room['price']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Durum</label>
      <select class="form-select" name="status" id="status" required>
        <option value="available" <?= ($room['status'] === 'available') ? 'selected' : '' ?>>Müsait</option>
        <option value="booked" <?= ($room['status'] === 'booked') ? 'selected' : '' ?>>Dolu</option>
      </select>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Güncelle
      </button>
    </div>
  </form>

  <div class="text-center mt-4">
    <a href="dashboard.php" class="btn btn-link">
      <i class="fas fa-tools me-1"></i> Admin Paneline Dön
    </a>
  </div>
</div>

<script>
  const roomPrices = {
    1: 1500,
    2: 2500,
    3: 4000,
    4: 6000
  };

  document.getElementById('room_type_id').addEventListener('change', function () {
    const selectedTypeId = this.value;
    const price = roomPrices[selectedTypeId];
    document.getElementById('price').value = price ? price : '';
  });
</script>

</body>
</html>
