<?php
$host = "sql308.infinityfree.com";
$user = "if0_39111338";
$password = "Da763122865";
$database = "if0_39111338_if0_39111338_otel";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
