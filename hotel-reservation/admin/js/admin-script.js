
// Otomatik fiyat belirleme (add-room ve edit-room sayfaları için)
const priceField = document.getElementById('price');
const roomTypeField = document.getElementById('room_type_id');

if (roomTypeField) {
  const roomPrices = {
    1: 1500,
    2: 2500,
    3: 4000,
    4: 6000
  };

  roomTypeField.addEventListener('change', function () {
    const selectedTypeId = this.value;
    const price = roomPrices[selectedTypeId];
    if (priceField) {
      priceField.value = price ? price : '';
    }
  });
}

// Oda numarası kontrolü (add-room için)
function validateRoomNumber() {
  const roomNumber = document.getElementById('room_number').value;

  // 1,2,3,4 ile bitmeli
  if (!/[1234]$/.test(roomNumber)) {
    alert("Bu oda numarası sisteme uygun değil. Lütfen kontrol ediniz.");
    return false;
  }

  // Kat en fazla 15 olmalı
  const kat = Math.floor(roomNumber / 100);
  if (kat > 15) {
    alert("Bu kat numarası sisteme uygun değil. Lütfen kontrol ediniz.");
    return false;
  }

  return true;
}
