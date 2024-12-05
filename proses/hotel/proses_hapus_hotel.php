<?php
require ("../../conf/db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the ID is valid
    if (!is_numeric($id)) {
        die("Invalid ID format");
    }

    // Prepare and execute the DELETE query
    $query = "DELETE FROM tb_hotel WHERE id='$id'";
    $deleteResult = mysqli_query($conn, $query);

    if ($deleteResult) {
        echo "<script>alert('Data berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }

    echo "<script>window.location='../../index.php?page=data_hotel';</script>"; // Corrected redirect path
} else {
    echo "<script>alert('Invalid request.');</script>";
    echo "<script>window.location='../../index.php?page=data_hotel';</script>"; // Corrected redirect path
}
?>
