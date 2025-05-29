<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Giriş yapılmamışsa veya admin değilse giriş sayfasına yönlendir
    header("Location: ../login.php");
    exit();
}
?>
