<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once ('conf/db_config.php');
include_once ('model/hotel.php');

$database = new Database();
$db = $database->connect();

$hotel = new Hotel($db);

try {
    // Logika untuk menangani permintaan ke root direktori /api
    if ($_SERVER['REQUEST_URI'] == '/hotel/api/' || $_SERVER['REQUEST_URI'] == '/hotel/api') {
        $data = $hotel->home();
        
        // Pastikan $data tidak null
        if ($data === null) {
            $data = 'No data available'; // Berikan nilai default
        }
        
        // Mengirimkan respons JSON dengan format yang konsisten
        echo json_encode(['message' => $data, 'data' => '']);
        exit;
    }

    // Jika permintaan tidak sesuai dengan endpoint yang ditangani
    echo json_encode(['error' => 'Invalid endpoint']);
} catch (Exception $e) {
    // Menangani error dan mengembalikan pesan error dalam format JSON
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
