<?php
$host = "localhost";
$user = "root";
$pass = "sheiapr204";
$db   = "db_fuelcheck";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

