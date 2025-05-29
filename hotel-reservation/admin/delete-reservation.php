<?php
include '../db.php';
include 'login-control.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM reservations WHERE id = $id");
    header("Location: admin_reservations.php");
    exit();
}
?>

