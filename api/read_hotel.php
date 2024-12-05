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

if (isset($_GET['id'])) {
    $data = $hotel->readHotelById($_GET['id']);

    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $list_data[] = [
                'id' => $row->id,
                'nama_hotel' => $row->nama_hotel,
                'kategori' => $row->kategori,
                'alamat' => $row->alamat,
                'harga' => $row->harga,
                'deskripsi' => $row->deskripsi,
                'no_hp' => $row->no_hp,
                'image_url' => $row->image_url
            ];
        }
        echo json_encode(['message' => 'Data hotel berhasil ditemukan!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data hotel yang dicari tidak ada!', 'data' => null]);
    }
} else {
    $data = $hotel->readHotel();

    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $item = [
                'id' => $row->id,
                'nama_hotel' => $row->nama_hotel,
                'kategori' => $row->kategori,
                'alamat' => $row->alamat,
                'harga' => $row->harga,
                'deskripsi' => $row->deskripsi,
                'no_hp' => $row->no_hp,
                'image_url' => $row->image_url
            ];
            array_push($list_data, $item);
        }
        echo json_encode(['message' => 'Data hotel berhasil diambil!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data hotel tidak berhasil diambil!', 'data' => null]);
    }
}
?>