<?php
ob_start(); // Güvenli yönlendirme için output buffer
include '../db.php';
include 'login-control.php';

// 1. ID kontrolü
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin_reservations.php?error=invalid_id");
    exit();
}

$reservationId = intval($_GET['id']);

// 2. Rezervasyon var mı? Varsa room_id alınır
$resQuery = "SELECT room_id FROM reservations WHERE id = $reservationId";
$resResult = mysqli_query($conn, $resQuery);

if (!$resResult || mysqli_num_rows($resResult) === 0) {
    header("Location: admin_reservations.php?error=notfound");
    exit();
}

$resData = mysqli_fetch_assoc($resResult);
$roomId = intval($resData['room_id']);

// 3. Rezervasyon durumunu güncelle
$updateReservation = mysqli_query($conn, "UPDATE reservations SET status = 'approved' WHERE id = $reservationId");

// 4. Oda durumunu güncelle
$updateRoom = mysqli_query($conn, "UPDATE rooms SET status = 'booked' WHERE id = $roomId");

// 5. Başarı kontrolü
if ($updateReservation && $updateRoom) {
    header("Location: admin_reservations.php?success=approved");
} else {
    header("Location: admin_reservations.php?error=updatefail");
}
exit();
?>

