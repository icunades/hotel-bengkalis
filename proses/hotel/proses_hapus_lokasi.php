<?php
require ("../../conf/db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the ID is valid
    if (!is_numeric($id)) {
        die("Invalid ID format");
    }

    // Prepare and execute the DELETE query
    $query = "DELETE FROM tb_lokasi WHERE id='$id'"; // Ganti tb_lokasi sesuai nama tabel Anda
    $deleteResult = mysqli_query($conn, $query);

    if ($deleteResult) {
        echo "<script>alert('Data lokasi berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data lokasi.');</script>";
    }

    echo "<script>window.location='../../index.php?page=data_lokasi';</script>"; // Redirect ke halaman data lokasi
} else {
    echo "<script>alert('Permintaan tidak valid.');</script>";
    echo "<script>window.location='../../index.php?page=data_lokasi';</script>"; // Redirect ke halaman data lokasi
}
?>
