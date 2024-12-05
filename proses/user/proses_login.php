<?php
include ("../../conf/db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escaping input to prevent SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Encrypting the password using md5
    $hashed_password = md5($password);

    // Query to check the user credentials
    $sql_query = "SELECT * FROM tb_user WHERE email='$email' AND password='$hashed_password'";
    $result = mysqli_query($conn, $sql_query);

    // Fetching the result
    $row = mysqli_fetch_array($result);

    if ($row) {
        // Start the session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Setting session variables
        $_SESSION['email'] = $row['email'];
        $username = $row['username'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        // Success message and redirect
        echo "<script>alert('Selamat datang $username, kamu telah berhasil login!');</script>";
        echo "<script>window.location.href='../../index.php';</script>";
    } else {
        // Error message and redirect back to login
        echo "<script>alert('Masukkan data email dan password dengan benar!');</script>";
        echo "<script>window.location.href='../../pages/user/login.php';</script>";
    }
}
?>