<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once ('conf/db_config.php');
include_once ('model/hotel.php');

$database = new Database();
$db = $database->connect();
$hotel = new Hotel($db);

if (isset($_GET['id'])) {
    // Validate $_GET['id']
    $id = intval($_GET['id']); // Ensure it's an integer for safety

    $data_hotel = $hotel->readHotelById($id);

    if ($data_hotel->rowCount() > 0) {
        $row = $data_hotel->fetch(PDO::FETCH_OBJ);

        // Delete the record from database
        if ($hotel->deleteHotel($id)) {
            echo json_encode(['message' => 'Berhasil menghapus data hotel!', 'data' => $row]);
        } else {
            echo json_encode(['message' => 'Gagal menghapus data hotel!', 'data' => null]);
        }
    } else {
        echo json_encode(['message' => 'Data hotel tidak ditemukan!', 'data' => null]);
    }
} else {
    echo json_encode(['message' => 'Parameter id tidak ditemukan!', 'data' => null]);
}
?>