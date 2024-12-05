<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once ("conf/db_config.php");
include_once ("model/hotel.php");

$database = new Database();
$db = $database->connect();
$hotel = new Hotel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Mengambil data dari body request
    $data = $_POST ?: json_decode(file_get_contents("php://input"), true);

    if (empty($data)) {
        echo json_encode(['message' => 'No data provided', 'data' => null]);
        exit;
    }

    // Menyiapkan parameter untuk update
    $params = [
        'id' => $data['id'] ?? null,
        'nama_hotel' => $data['nama_hotel'] ?? null,
        'kategori' => $data['kategori'] ?? null,
        'alamat' => $data['alamat'] ?? null,
        'harga' => $data['harga'] ?? null,
        'image_url' => $data['image_url'] ?? null,
        'deskripsi' => $data['deskripsi'] ?? null,
        'no_hp' => $data['no_hp'] ?? null
    ];

    // Memastikan semua field yang diperlukan ada
    $required_fields = ['id', 'nama_hotel', 'kategori', 'alamat', 'harga', 'image_url', 'deskripsi', 'no_hp'];
    foreach ($required_fields as $field) {
        if (!isset($params[$field]) || empty($params[$field])) {
            echo json_encode(['message' => "Field '$field' is required", 'data' => null]);
            exit;
        }
    }

    // Melakukan update hotel
    if ($hotel->updateHotel($params)) {
        echo json_encode(['message' => 'Data hotel berhasil diupdate!', 'data' => $params]);
    } else {
        echo json_encode(['message' => 'Gagal mengupdate data hotel!', 'data' => null]);
    }
} else {
    echo json_encode(['message' => 'Method not allowed', 'data' => null]);
}
?>