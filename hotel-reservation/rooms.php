<?php
session_start();
include 'db.php';

$roomTypes = [
  1 => ['title' => 'Tek Kişilik Oda', 'description' => 'Sessiz, sade ve konforlu ortam.', 'slug' => 'tek', 'price' => 700],
  2 => ['title' => 'Çift Kişilik Oda', 'description' => 'Çiftler ve aileler için ferah alan.', 'slug' => 'cift', 'price' => 1200],
  3 => ['title' => 'Dörtlü Oda', 'description' => 'Arkadaş grupları için ideal seçim.', 'slug' => 'dort', 'price' => 1800],
  4 => ['title' => 'Deluxe Aile Odası', 'description' => 'Geniş ve lüks donanımlı aile alanı.', 'slug' => 'dlx', 'price' => 2500],
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Odalar | Cisse Confort Hotel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header class="bg-dark text-white text-center py-5 mb-4">
  <div class="container">
    <h1 class="display-5 fw-bold">Oda Seçeneklerimiz</h1>
    <p class="lead">Konfor, temizlik ve huzur için en uygun odanızı seçin</p>
  </div>
</header>

<div class="container py-4">
  <div class="row g-4">
    <?php foreach ($roomTypes as $id => $room): ?>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm animated-card">
          <img src="images/<?= $room['slug'] ?>1.jpg" class="card-img-top" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= $room['title'] ?></h5>
            <p class="card-text small text-muted"><?= $room['description'] ?></p>
            <p class="fw-bold">Fiyat: <?= $room['price'] ?> ₺ / gece</p>
            <a href="reservations.php?room_type_id=<?= $id ?>" class="btn btn-warning btn-animated">
              <i class="fas fa-calendar-check"></i> Rezervasyon Yap
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal Galeri -->
<?php foreach ($roomTypes as $id => $room): ?>
<div class="modal fade" id="modal<?= $id ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-4">
      <h5 class="modal-title text-center mb-3"><?= $room['title'] ?></h5>
      <img id="preview-<?= $room['slug'] ?>" src="images/<?= $room['slug'] ?>1.jpg" class="preview-img">
      <div class="row g-3">
        <?php for ($i = 1; $i <= 4; $i++): ?>
          <div class="col-6 col-md-3">
            <img src="images/<?= $room['slug'] . $i ?>.jpg" class="modal-img small-img" data-target="preview-<?= $room['slug'] ?>">
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
