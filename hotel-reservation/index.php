<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cisse Confort Hotel</title>

  <!-- Bootstrap ve Ortak Stil -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="index-page">

<div class="overlay">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo.png" alt="Cisse Confort Hotel">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Anasayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="reservations.php">Rezervasyon</a></li>
        <li class="nav-item"><a class="nav-link" href="rooms.php">Odalar</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">Hakkımızda</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Giriş</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Kayıt Ol</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Alanı -->
<div class="text-center py-5">
  <h1 class="display-3 fw-bold text-dark text-center section-title">Cisse Confort Hotel</h1>
  <p class="fs-4 text-center section-title">Konforun ve Huzurun Adresi</p>

</div>

<!-- Otelimizdeki Bölümler -->
<div class="container">
  <h3 class="section-title">Otelimizdeki Bölümler</h3>
  <div class="row g-4">
    <div class="col-md-3 col-sm-6 animated-card">
      <div class="card h-100 shadow-sm">
        <img src="images/resepsiyon.jpg" class="card-img-top" alt="Resepsiyon">
        <div class="card-body text-center">
          <h5 class="card-title"><i class="fas fa-concierge-bell icon-title text-primary"></i>Resepsiyon</h5>
          <p class="card-text">24 saat açık, güler yüzlü hizmet.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animated-card">
      <div class="card h-100 shadow-sm">
        <img src="images/yemekhane.jpg" class="card-img-top" alt="Yemekhane">
        <div class="card-body text-center">
          <h5 class="card-title"><i class="fas fa-utensils icon-title text-danger"></i>Yemekhane</h5>
          <p class="card-text">Zengin menümüzle hizmetinizdeyiz.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animated-card">
      <div class="card h-100 shadow-sm">
        <img src="images/mescit.jpg" class="card-img-top" alt="Mescit">
        <div class="card-body text-center">
          <h5 class="card-title"><i class="fas fa-mosque icon-title text-success"></i>Mescit</h5>
          <p class="card-text">Sessiz ve temiz ibadet alanı.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animated-card">
      <div class="card h-100 shadow-sm">
        <img src="images/spor.jpg" class="card-img-top" alt="Spor Salonu">
        <div class="card-body text-center">
          <h5 class="card-title"><i class="fas fa-dumbbell icon-title text-warning"></i>Spor Salonu</h5>
          <p class="card-text">Modern ekipmanlarla donatılmıştır.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Çevre ve Ulaşım -->
  <h3 class="section-title">Çevre & Ulaşım</h3>
  <ul class="list-group mb-4">
  <li class="list-group-item">
    <i class="fas fa-subway icon-title text-primary"></i>
    <strong>M5 Üsküdar – Samandıra Metrosu</strong>'na 5 dk yürüme mesafesinde
  </li>
  <li class="list-group-item">
    <i class="fas fa-bus icon-title text-primary"></i>
    İstanbul genelinde <strong>otobüs duraklarına</strong> yakın konum
  </li>
  <li class="list-group-item">
    <i class="fas fa-store icon-title text-primary"></i>
    <strong>Canpark AVM</strong> ve <strong>Bim, A101, Carrefour</strong> marketlerine yürüme mesafesi
  </li>
</ul>


  <!-- Sıkça Sorulan Sorular -->
  <h3 class="section-title">Sıkça Sorulan Sorular</h3>
  <div class="accordion" id="faqAccordion">
    <div class="accordion-item">
      <h2 class="accordion-header" id="q1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1" aria-expanded="true">
          Giriş ve çıkış saatleri nedir?
        </button>
      </h2>
      <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">Giriş saati 14:00, çıkış saati 12:00’dir.</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="q2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">
          Kahvaltı fiyata dahil mi?
        </button>
      </h2>
      <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">Evet, tüm rezervasyonlara kahvaltı dahildir.</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="q3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3">
          Otopark mevcut mu?
        </button>
      </h2>
      <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">Evet, ücretsiz otopark alanımız mevcuttur.</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="q4">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4">
          Evcil hayvan kabul ediyor musunuz?
        </button>
      </h2>
      <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">Maalesef evcil hayvan kabul edilmiyor.</div>
      </div>
    </div>
  </div>

  <!-- Hakkımızda Bağlantısı -->
  <p class="text-center mt-4">
    Daha fazla bilgi için <a href="about.php" class="fw-bold text-primary text-decoration-none">Hakkımızda</a> sayfamıza göz atabilirsiniz.
  </p>

  <!-- Rezervasyon CTA -->
  <div class="my-5 p-4 bg-warning rounded shadow text-center">
    <h4 class="fw-bold">Hayalinizdeki konaklama bir tık uzağınızda!</h4>
    <p class="mb-3">Şimdi rezervasyon yapın ve Cisse Confort Hotel farkını yaşayın.</p>
    <a href="reservations.php" class="btn btn-dark btn-animated">
  <i class="fas fa-calendar-check icon-title"></i>Hemen Rezervasyon Yap
</a>

  </div>
</div>

<!-- Footer -->
<footer class="text-center">
  <div class="container">
    <p class="mb-0">© 2025 Cisse Confort Hotel | Tüm Hakları Saklıdır</p>
  </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
