<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Hakkımızda | Cisse Confort Hotel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap ve Ortak Stil -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet">
  
</head>
<body class="about-page">
<!-- Sayfa Başlığı -->
<div class="header">
  <h1 class="display-4 fw-bold">Cisse Confort Hotel</h1>
  <p class="lead">Konforun ve Huzurun Adresi</p>
</div>

<div class="container py-4">

  <!-- Genel Bilgiler -->
  <h3 class="section-title">Genel Bilgiler</h3>
  <p>
    İstanbul Ümraniye'de bulunan Cisse Confort Hotel, 15 katlı modern yapısıyla misafirlerine eşsiz bir konaklama deneyimi sunar. 
    Güler yüzlü personelimiz, modern mimarimiz ve huzurlu ortamımız ile konaklamanızı özel kılmak için buradayız.  
    Spor salonumuzla sağlığınızı ihmal etmeden konaklayabilirsiniz.
  </p>

  <!-- Misyon & Vizyon -->
  <h3 class="section-title">Misyon & Vizyon</h3>
  <ul>
    <li><strong>Misyonumuz:</strong> Her misafire evinde hissedeceği bir konfor sunmak.</li>
    <li><strong>Vizyonumuz:</strong> İstanbul’un en güvenilir ve tercih edilen oteli olmak.</li>
  </ul>

  <!-- Ekstra Hizmetler -->
  <h3 class="section-title">Ekstra Hizmetlerimiz</h3>
<ul>
  <li><i class="fas fa-suitcase-rolling icon-title text-primary"></i> Bagaj emanet hizmeti</li>
<li><i class="fas fa-soap icon-title text-success"></i> Ütü ve kuru temizleme hizmeti</li>
<li><i class="fas fa-taxi icon-title text-primary"></i> Havalimanı transfer servisi</li>
<li><i class="fas fa-phone icon-title text-info"></i> 7/24 oda servisi ve danışma hattı</li>
<li><i class="fas fa-gift icon-title text-primary"></i> Doğum günü ve özel süsleme imkanı</li>
<li><i class="fas fa-dumbbell icon-title text-warning"></i> Spor salonu kullanımı (ücretsiz)</li>
</ul>

  <!-- Oda Tipleri -->
  <h3 class="section-title">Oda Tipleri</h3>
  <ul>
    <li><strong>Tek Kışilik Oda:</strong> Sessiz, sade, konforlu.</li>
    <li><strong>Çift Kışilik Oda:</strong> Rahat yatak ve geniş alan.</li>
    <li><strong>Dörtlü Oda:</strong> Aileler ve arkadaş grupları için.</li>
    <li><strong>Deluxe Aile Odası:</strong> Lüks detaylar, oturma alanı, balkon.</li>
  </ul>

  <!-- Konum Avantajı -->
  <h3 class="section-title">Konum Avantajı</h3>
  <p>
    Otelimiz metro istasyonuna sadece 5 dakika mesafede olup çevresinde alışveriş merkezleri, parklar, camiler ve restoranlar bulunmaktadır. 
    Hem şehir içinde hem de havaalanına kolay ulaşım imkanı sağlar.
  </p>

  <!-- Neden Biz -->
    <h3 class="section-title">Neden Bizi Tercih Etmelisiniz?</h3>
  <ul>
    <li><i class="fas fa-shield-alt icon-title text-danger"></i> 7/24 güvenlik ve kamera sistemi</li>
    <li><i class="fas fa-pump-soap icon-title text-success"></i> Hijyen garantili oda temizliği</li>
    <li><i class="fas fa-wifi icon-title text-info"></i> Hızlı Wi-Fi altyapısı</li>
    <li><i class="fas fa-handshake icon-title text-secondary"></i> Güler yüzlü ve deneyimli personel</li>
    <li><i class="fas fa-balance-scale icon-title text-primary"></i> Uygun fiyat – yüksek kalite dengesi</li>
  </ul>



  <!-- Fotoğraf Galerisi -->
  <h3 class="section-title">Fotoğraf Galerisi</h3>
  <div class="row g-3">
    <?php for ($i = 1; $i <= 8; $i++): ?>
      <div class="col-md-3 col-sm-6">
        <img src="images/glr<?= $i ?>.jpg" class="gallery-img" alt="Galeri <?= $i ?>" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="showSlide(<?= $i ?>)">
      </div>
    <?php endfor; ?>
  </div>

  <!-- Modal Galeri -->
  <div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-dark">
        <div class="modal-header border-0">
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>">
                  <img src="images/glr<?= $i ?>.jpg" class="d-block w-100 rounded">
                </div>
              <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- İletişim Bilgileri -->
  <h3 class="section-title">İletişim Bilgileri</h3>
  <ul class="list-group mb-5">
    <li class="list-group-item"><strong>Adres:</strong> İstanbul, Ümraniye, Türkiye</li>
    <li class="list-group-item"><strong>Telefon:</strong> +90 535 869 53 00</li>
    <li class="list-group-item"><strong>E-posta:</strong> cissed351@gmail.com</li>
    <li class="list-group-item"><strong>Çalışma Saatleri:</strong> 7/24</li>
  </ul>
</div>

<!-- Footer -->
<footer>
  <p>© 2025 Cisse Confort Hotel | Tüm Hakları Saklıdır</p>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
