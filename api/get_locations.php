<?php
include_once "../conf/db_conn.php"; // Sesuaikan path koneksi database Anda

$sql = "SELECT nama_hotel, latitude, longitude FROM hotel";
$result = $conn->query($sql);

$locations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'name' => $row['nama_hotel'],
            'lat' => $row['latitude'],
            'lng' => $row['longitude']
        ];
    }
}

echo json_encode($locations); // Mengirim data dalam format JSON
?>
