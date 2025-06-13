<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (role, nama, email, password) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $role,  $nama, $email, $password);

        if ($stmt->execute()) {
            header("Location: ../login.php");
            exit;
        } else {
            echo "Registrasi gagal: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Gagal menyiapkan query: " . $conn->error;
    }
} else {
    echo "Akses tidak valid.";
}

