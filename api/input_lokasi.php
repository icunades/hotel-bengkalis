<?php
include("../conf/db_conn.php");

// Periksa apakah ada permintaan GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM tb_lokasi"; // Ganti tb_lokasi dengan nama tabel yang benar
    $result = mysqli_query($conn, $query);

    $lokasi = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $lokasi[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($lokasi);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari input
    $nama = $_POST['nama'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $latitude = $_POST['latitude'] ?? '';
    $longitude = $_POST['longitude'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    // Validasi input
    if (!empty($nama) && !empty($latitude) && !empty($longitude)) {
        // Siapkan query untuk memasukkan data lokasi ke database
        $query = "INSERT INTO tb_lokasi (nama, kategori, latitude, longitude, deskripsi) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $nama, $kategori, $latitude, $longitude, $deskripsi);

        // Eksekusi query
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Lokasi berhasil ditambahkan!']);
        } else {
            echo json_encode(['message' => 'Gagal menambahkan lokasi!']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Data tidak lengkap!']);
    }
} else {
    echo json_encode(['message' => 'Metode tidak diizinkan!']);
}

// Tutup koneksi
$conn->close();
?>
