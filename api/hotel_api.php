<?php
header("Content-Type: application/json");
include 'conf/db_conn.php'; // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mengambil semua data lokasi hotel
    $sql = "SELECT * FROM tb_lokasi";
    $result = $conn->query($sql);
    $lokasi = [];

    while ($row = $result->fetch_assoc()) {
        $lokasi[] = $row;
    }
    echo json_encode($lokasi);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menambahkan lokasi hotel baru
    $name = $_POST['name'];
    $kategori = $_POST['kategori'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tb_lokasi (name, kategori, latitude, longitude, description) VALUES ('$name', '$kategori', '$latitude', '$longitude', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}
?>
