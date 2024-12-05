<?php
if (!defined('DB_SERVER'))
    define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME'))
    define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD'))
    define('DB_PASSWORD', '');
if (!defined('DB_NAME'))
    define('DB_NAME', 'db_hotel');

// Membuat koneksi ke database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>