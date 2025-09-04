<?php
// admin/config.php
if (session_status() === PHP_SESSION_NONE) session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "webstoreskull";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi DB gagal: " . $conn->connect_error);
}
?>