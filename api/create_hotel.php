<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once('conf/db_config.php');
include_once('model/hotel.php');

$database = new Database();
$db = $database->connect();
$hotel = new Hotel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = [
        'nama_hotel' => $_POST['nama_hotel'],
        'kategori' => $_POST['kategori'],
        'alamat' => $_POST['alamat'],
        'harga' => $_POST['harga'],
        'image_url' => isset($_POST['image_url']) ? $_POST['image_url'] : 'logo_default.png',
        'deskripsi' => $_POST['deskripsi'],
        'no_hp' => formatNomorWhatsApp($_POST['no_hp']) // Memformat nomor WhatsApp
    ];

    if ($hotel->createHotel($params)) {
        echo json_encode(['message' => 'Data hotel berhasil ditambahkan!', 'data' => $params]);
    } else {
        echo json_encode(['message' => 'Gagal menambahkan data hotel!', 'data' => null]);
    }
}

// Fungsi untuk memformat nomor WhatsApp ke format internasional
function formatNomorWhatsApp($no_hp) {
    // Menghilangkan spasi, tanda plus, dan karakter non-numerik lainnya
    $no_hp = preg_replace('/[^0-9]/', '', $no_hp);

    // Mengonversi format nomor telepon
    if (strpos($no_hp, '0') === 0) {
        $no_hp = '62' . substr($no_hp, 1); // Mengganti 0 dengan 62
    }
    
    return $no_hp;
}
?>
