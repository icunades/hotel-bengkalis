<?php
include '../conf/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $kategori = $_POST['kategori'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tb_lokasi (name, kategori, latitude, longitude, description) VALUES ('$name', '$kategori', '$latitude', '$longitude', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Lokasi hotel berhasil ditambahkan!');</script>";
        echo "<script>window.location='../../index.php?page=data_hotel';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
