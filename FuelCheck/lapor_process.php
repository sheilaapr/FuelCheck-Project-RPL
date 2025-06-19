<?php
session_start();
include 'auth/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $spbu_id = $_POST['spbu_id'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $status = 'pending';
    $created_at = date('Y-m-d H:i:s');

    // Validasi spbu_id
    $cek_spbu = $conn->prepare('SELECT id FROM spbu WHERE id = ?');
    $cek_spbu->bind_param('i', $spbu_id);
    $cek_spbu->execute();
    $cek_spbu->store_result();
    if ($cek_spbu->num_rows === 0) {
        echo 'SPBU yang dipilih tidak valid.';
        exit();
    }
    $cek_spbu->close();

    // Simpan laporan
    $stmt = $conn->prepare('INSERT INTO laporan (user_id, spbu_id, deskripsi, status, created_at) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('iisss', $user_id, $spbu_id, $deskripsi, $status, $created_at);
    if ($stmt->execute()) {
        $laporan_id = $stmt->insert_id;
        // Upload bukti jika ada
        if (!empty($_FILES['bukti']['name'][0])) {
            $total = count($_FILES['bukti']['name']);
            for ($i = 0; $i < $total; $i++) {
                $tmp_name = $_FILES['bukti']['tmp_name'][$i];
                $name = basename($_FILES['bukti']['name'][$i]);
                $target = '../uploads/' . uniqid() . '_' . $name;
                if (move_uploaded_file($tmp_name, $target)) {
                    $file_path = basename($target);
                    $conn->query("INSERT INTO bukti_laporan (laporan_id, file_path) VALUES ($laporan_id, '$file_path')");
                }
            }
        }
        header('Location: laporan.php?success=1');
        exit();
    } else {
        echo 'Gagal menyimpan laporan.';
    }
} else {
    echo 'Akses tidak valid.';
}
