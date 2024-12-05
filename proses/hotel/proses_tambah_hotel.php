<?php
include ("../../conf/db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect form data
    $nama_hotel = $_POST['nama_hotel'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $no_hp = $_POST['no_hp'];
    $image_url = $_POST['image_url'];

    // Validate image URL
    if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        echo "<script>alert('URL gambar tidak valid!');</script>";
        echo "<script>window.location='../../index.php?page=tambah_hotel';</script>";
        exit;
    }

    // Insert data into database
    $query = "INSERT INTO tb_hotel (nama_hotel, kategori, alamat, harga, image_url, deskripsi, no_hp) VALUES ('$nama_hotel', '$kategori', '$alamat', '$harga', '$image_url', '$deskripsi', '$no_hp')";

    $insert_result = mysqli_query($conn, $query);
    if ($insert_result) {
        echo "<script>alert('Berhasil menambahkan hotel $nama_hotel!');</script>";
        echo "<script>window.location='../../index.php?page=data_hotel';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan hotel $nama_hotel, coba cek isian anda!');</script>";
        echo "<script>window.location='../../index.php?page=tambah_hotel';</script>";
    }
}
?>