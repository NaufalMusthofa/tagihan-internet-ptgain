<?php
$host = 'localhost';      // host database
$user = 'root';           // username default XAMPP
$pass = '';               // password default (kosong)
$db   = 'internet_billing'; // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
