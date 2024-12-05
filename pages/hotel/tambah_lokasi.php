<?php
include 'conf/db_conn.php'; // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $kategori = $_POST['kategori']; // Ambil kategori dari form

    // Validasi kategori agar sesuai dengan ENUM
    if (!in_array($kategori, ['hotel', 'wisma'])) {
        echo "<script>
                alert('Kategori tidak valid!');
                window.location.href = '?page=tambah_lokasi'; // Redirect ke halaman input
              </script>";
        exit();
    }

    // Query untuk menambahkan data lokasi ke database
    $sql = "INSERT INTO tb_lokasi (name, latitude, longitude, description, kategori) 
            VALUES ('$name', '$latitude', '$longitude', '$description', '$kategori')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Lokasi berhasil ditambahkan!');
                window.location.href = '?page=data_lokasi'; // Redirect ke halaman data lokasi
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Hotel/Wisma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Tambah Data Lokasi Hotel/Wisma</h1>
    <a href="index.php?page=data_lokasi" class="btn btn-warning">Lihat Data Lokasi</a>
    <hr>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel/Wisma</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label><br>
            <div>
                <input type="radio" name="kategori" value="hotel" required> Hotel
                <input type="radio" name="kategori" value="wisma" required> Wisma
            </div>
        </div>
        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" id="longitude" name="longitude" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="javascript:history.back()" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
