<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['room_type_id'])) {
    $room_type_id = (int) $_GET['room_type_id'];

    $sql = "SELECT * FROM rooms WHERE room_type_id = $room_type_id AND status = 'available' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $room = mysqli_fetch_assoc($result);

    if (!$room || !isset($room['id'])) {
        echo '<!DOCTYPE html>
        <html lang="tr">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Oda Müsait Değil</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
          <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
        <div class="container mt-5 text-center">
          <div class="alert alert-warning shadow-sm p-4">
            <i class="fas fa-triangle-exclamation fa-2x icon-title text-warning mb-3"></i><br>
            <strong>Üzgünüz!</strong> Bu oda tipinde şu anda <strong>müsait oda bulunmamaktadır.</strong>
          </div>
          <a href="rooms.php" class="btn btn-outline-primary btn-animated">
            <i class="fas fa-bed me-2"></i>Diğer Odaları Gör
          </a>
        </div>
        </body>
        </html>';
        exit;
    }

    $room_id = (int) $room['id'];
    $price_per_night = (float) $room['price'];
    $room_images = [1 => 'tek1.jpg', 2 => 'cift1.jpg', 3 => 'dort1.jpg', 4 => 'dlx1.jpg'];
    $room_names = [1 => 'Tek Kışilik Oda', 2 => 'Çift Kışilik Oda', 3 => 'Dörtlü Oda', 4 => 'Deluxe Aile Odası'];
    $image = $room_images[$room_type_id] ?? 'default.jpg';
    $room_name = $room_names[$room_type_id] ?? 'Oda';

    if (isset($_POST['reserve'])) {
        $check_in = mysqli_real_escape_string($conn, $_POST['check_in']);
        $check_out = mysqli_real_escape_string($conn, $_POST['check_out']);

        // 💡 calculate_nights() fonksiyonu ile gece sayısı hesaplanıyor ve tabloya ekleniyor
        $sql = "INSERT INTO reservations (user_id, room_id, check_in, check_out, status, nights)
                VALUES ('$user_id', '$room_id', '$check_in', '$check_out', 'pending', calculate_nights('$check_in', '$check_out'))";

        if (mysqli_query($conn, $sql)) {
            echo '<!DOCTYPE html>
            <html lang="tr">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>Rezervasyon Alındı</title>
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
              <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
              <link rel="stylesheet" href="css/style.css">
            </head>
            <body>
            <div class="container mt-5 text-center">
              <div class="alert alert-success shadow-sm p-4">
                <i class="fas fa-circle-check fa-2x icon-title text-success mb-3"></i><br>
                <strong>Rezervasyon talebiniz başarıyla alındı!</strong><br>
                📩 Onay işlemi sonrasında e-posta veya panel üzerinden bilgilendirileceksiniz.
              </div>
              <a href="index.php" class="btn btn-outline-primary btn-animated">
                <i class="fas fa-home me-2"></i>Ana Sayfaya Dön
              </a>
            </div>
            </body>
            </html>';
            exit;
        } else {
            echo '<div class="alert alert-danger mt-5 text-center">❌ Hata: ' . mysqli_error($conn) . '</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rezervasyon Yap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body data-price-per-night="<?= $price_per_night ?>">
<div class="container mt-5">
  <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
    <img src="images/<?= $image ?>" class="img-fluid rounded mb-4" alt="<?= $room_name ?>">
    <h3 class="text-center mb-3"><?= $room_name ?> - Rezervasyon</h3>
    <p class="text-center text-muted">Gecelik ücret: <strong><?= $price_per_night ?> ₺</strong></p>

    <form method="POST">
      <div class="mb-3">
        <label for="check_in" class="form-label">Giriş Tarihi:</label>
        <input type="text" id="check_in" name="check_in" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="check_out" class="form-label">Çıkış Tarihi:</label>
        <input type="text" id="check_out" name="check_out" class="form-control" required>
      </div>
      <div class="mb-3">
        <span id="total_nights">0</span> gece × <?= $price_per_night ?> ₺ = 
        <strong><span id="total_price">0</span> ₺</strong>
      </div>
      <button type="submit" name="reserve" class="btn btn-primary w-100 btn-animated">
        <i class="fas fa-calendar-check me-2"></i>Rezervasyonu Tamamla
      </button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php exit; } ?>

<!-- Oda seçilmeden girilirse -->
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Rezervasyon Sayfası</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5 text-center">
  <div class="alert alert-warning shadow-sm p-4">
    <i class="fas fa-circle-info fa-2x icon-title text-warning mb-3"></i><br>
    Lütfen rezervasyon yapmadan önce <strong>oda seçimi</strong> yapınız.
  </div>
  <a href="rooms.php" class="btn btn-outline-primary btn-animated">
    <i class="fas fa-bed me-2"></i>Odaları Gör
  </a>
</div>
</body>
</html>
