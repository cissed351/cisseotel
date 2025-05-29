<?php
include '../db.php'; 

if (isset($_GET['id'])) {
    $roomId = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $roomId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?status=silindi"); 
    } else {
        echo "Hata: Oda silinemedi.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
