document.addEventListener("DOMContentLoaded", () => {
  // index.php - Başlık animasyonu
  document.querySelectorAll(".section-title").forEach(el => el.classList.add("fade-in"));

  // index.php - Kart animasyonu
  const cards = document.querySelectorAll('.animated-card');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.2 });

  cards.forEach(card => observer.observe(card));

  // rooms.php - Küçük resimlere tıklayınca büyük resmi güncelle
  document.querySelectorAll('.small-img').forEach(img => {
    img.addEventListener('click', function () {
      const targetId = this.dataset.target;
      const previewImg = document.getElementById(targetId);
      if (previewImg) {
        previewImg.src = this.src;
      }
    });
  });

  // dashboard.php - Hoşgeldiniz animasyonu ve tablo aç/kapa
  const welcome = document.getElementById("welcomeScreen");
  const dash = document.getElementById("dashboard");

  if (welcome && dash) {
    setTimeout(() => {
      welcome.style.display = "none";
      dash.style.display = "block";
    }, 3000);
  }

  // reservation.php - Tarih ve fiyat hesaplama
  const checkIn = document.getElementById('check_in');
  const checkOut = document.getElementById('check_out');
  const totalNights = document.getElementById('total_nights');
  const totalPrice = document.getElementById('total_price');

  if (checkIn && checkOut && totalNights && totalPrice) {
    const pricePerNight = parseFloat(document.body.dataset.pricePerNight || 0);

    flatpickr(checkIn, {
      dateFormat: "Y-m-d",
      minDate: "today",
      onChange: calculateNights
    });

    flatpickr(checkOut, {
      dateFormat: "Y-m-d",
      minDate: "today",
      onChange: calculateNights
    });

    function calculateNights() {
      if (checkIn.value && checkOut.value) {
        const inDate = new Date(checkIn.value);
        const outDate = new Date(checkOut.value);
        const diffTime = outDate - inDate;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        if (diffDays > 0) {
          totalNights.textContent = diffDays;
          totalPrice.textContent = (diffDays * pricePerNight).toFixed(2);
        } else {
          totalNights.textContent = 0;
          totalPrice.textContent = 0;
        }
      }
    }
  }
});

function toggleTable() {
  const table = document.getElementById("reservationTable");
  if (table) {
    table.style.display = table.style.display === "none" ? "block" : "none";
  }
}

