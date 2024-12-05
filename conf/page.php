<?php
// Mulai sesi hanya jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah parameter 'page' ada di URL
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        // Halaman Beranda
        case 'beranda':
            include 'pages/beranda.php';
            break;

        // Halaman untuk Data Hotel
        case 'data_hotel':
            include 'pages/hotel/data_hotel.php';
            break;
        case 'tambah_hotel':
            include 'pages/hotel/tambah_hotel.php';
            break;
        case 'ubah_lokasi':
            include 'pages/hotel/ubah_lokasi.php';
            break;
        case 'ubah_hotel':
            include 'pages/hotel/ubah_hotel.php'; // Pastikan path sesuai
            break;
        case 'peta_hotel';
            include 'pages/hotel/peta_hotel.php';
            break;

        // Halaman untuk Menambah Lokasi Hotel
        case 'tambah_lokasi':
            include 'pages/hotel/tambah_lokasi.php'; // Pastikan path sesuai
            break;
        

        // Halaman untuk Melihat Data Lokasi
        case 'data_lokasi':
            include 'pages/hotel/data_lokasi.php'; // Pastikan path sesuai
            break;

        // Halaman untuk Manajemen User (hanya Admin yang bisa akses)
        case 'data_user':
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                include 'pages/user/data_user.php';
            } else {
                include 'pages/error/401.php'; // Akses Ditolak
            }
            break;
        case 'tambah_user':
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                include 'pages/user/tambah_user.php';
            } else {
                include 'pages/error/401.php'; // Akses Ditolak
            }
            break;
        case 'ubah_user':
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                include 'pages/user/ubah_user.php';
            } else {
                include 'pages/error/401.php'; // Akses Ditolak
            }
            break;

        // Halaman default untuk halaman yang tidak ditemukan
        default:
            include 'pages/error/404.php'; // Halaman Tidak Ditemukan
            break;
    }
} else {
    // Jika parameter 'page' tidak ada, tampilkan halaman beranda
    include 'pages/beranda.php';
}
?>
