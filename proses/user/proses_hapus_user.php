<?php
include ("../../conf/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    // Query untuk memilih data pengguna yang akan dihapus
    $query_select = "SELECT * FROM tb_user WHERE id = '$id'";
    $result_select = mysqli_query($conn, $query_select);

    if ($result_select && mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_array($result_select);
        $username = $row['username'];

        // Query untuk menghapus data pengguna
        $query_delete = "DELETE FROM tb_user WHERE id = '$id'";
        $deleteResult = mysqli_query($conn, $query_delete);

        if ($deleteResult) {
            echo "<script>alert('Berhasil menghapus data $username.');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data $username, terjadi kesalahan.');</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus, data tidak ditemukan.');</script>";
    }

    echo "<script>window.location = '../../index.php?page=data_user';</script>";
}
?>