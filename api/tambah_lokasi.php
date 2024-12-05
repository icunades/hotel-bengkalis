<?php
include 'conf/db_conn.php'; // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tb_lokasi (name, latitude, longitude, description) VALUES ('$name', '$latitude', '$longitude', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "Lokasi berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Hotel</title>
</head>
<body>
    <h1>Tambah Lokasi Hotel</h1>
    <form action="" method="POST">
        <label>Nama Hotel:</label><br>
        <input type="text" name="name" required><br>
        <label>Latitude:</label><br>
        <input type="text" name="latitude" required><br>
        <label>Longitude:</label><br>
        <input type="text" name="longitude" required><br>
        <label>Deskripsi:</label><br>
        <textarea name="description" required></textarea><br>
        <input type="submit" value="Tambah Lokasi">
    </form>
</body>
</html>
