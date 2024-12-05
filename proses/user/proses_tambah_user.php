<?php
include ("../../conf/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];
    $role = 'User';
    $hashed_password = md5($password); // Changed variable name to avoid confusion

    $query = "INSERT INTO tb_user (username, email, no_hp, password, role) VALUES ('$username', '$email', '$no_hp', '$hashed_password', '$role')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Berhasil menambahkan data $username!');</script>";
        echo "<script>window.location = '../../index.php?page=data_user';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data $username, coba cek isian anda!');</script>";
        echo "<script>window.location = '../../index.php?page=tambah_user';</script>";
    }
}
?>