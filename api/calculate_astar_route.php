<?php
// Mengimpor file koneksi database
require_once '../conf/db_conn.php';

function haversine($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6371;  // Radius Bumi dalam km
    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLng / 2) * sin($dLng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earth_radius * $c; // Jarak dalam km
}

function get_neighbors($current_node, $conn) {
    $neighbors = [];
    
    // Ambil tetangga dari tabel `edges`
    $sql = "SELECT end_node, end_lat, end_lng, weight FROM edges WHERE start_node = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $current_node['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $neighbors[] = [
            'id' => $row['end_node'],
            'lat' => $row['end_lat'],
            'lng' => $row['end_lng'],
            'weight' => $row['weight'],
        ];
    }
    
    return $neighbors;
}

function a_star($start_lat, $start_lng, $end_lat, $end_lng, $conn) {
    $start_node = [
        'id' => 0,
        'lat' => $start_lat,
        'lng' => $start_lng,
    ];
    $goal_node = [
        'id' => 1,
        'lat' => $end_lat,
        'lng' => $end_lng,
    ];

    $open_set = [];
    $closed_set = [];
    
    // Initial g, f costs
    $g_scores = [];
    $f_scores = [];
    
    $g_scores[$start_node['id']] = 0;
    $f_scores[$start_node['id']] = haversine($start_lat, $start_lng, $end_lat, $end_lng);

    // Push the start node
    $open_set[] = $start_node;

    while (!empty($open_set)) {
        // Ambil node dengan f_score terendah
        usort($open_set, function ($a, $b) use ($f_scores) {
            return $f_scores[$a['id']] - $f_scores[$b['id']];
        });
        $current_node = array_shift($open_set);

        // Jika goal tercapai
        if (haversine($current_node['lat'], $current_node['lng'], $goal_node['lat'], $goal_node['lng']) < 0.01) {
            // Rekonstruksi jalur
            $path = [];
            while ($current_node) {
                $path[] = ['lat' => $current_node['lat'], 'lng' => $current_node['lng']];
                $current_node = $current_node['parent'] ?? null;
            }
            return array_reverse($path);
        }

        $closed_set[] = $current_node;

        // Mendapatkan tetangga dari current_node
        $neighbors = get_neighbors($current_node, $conn);

        foreach ($neighbors as $neighbor) {
            if (in_array($neighbor, $closed_set)) {
                continue;
            }

            // Hitung g_score dan f_score
            $tentative_g_score = $g_scores[$current_node['id']] + $neighbor['weight'];

            if (!in_array($neighbor, $open_set)) {
                $open_set[] = $neighbor;
            } elseif ($tentative_g_score >= $g_scores[$neighbor['id']]) {
                continue; // Ini bukan jalur yang lebih baik
            }

            // Simpan g_score terbaik dan parent node
            $g_scores[$neighbor['id']] = $tentative_g_score;
            $f_scores[$neighbor['id']] = $tentative_g_score + haversine($neighbor['lat'], $neighbor['lng'], $goal_node['lat'], $goal_node['lng']);
            $neighbor['parent'] = $current_node;
        }
    }

    // Jika tidak ada jalur ditemukan
    return [];
}

if (isset($_GET['start_lat'], $_GET['start_lng'], $_GET['end_lat'], $_GET['end_lng'])) {
    $start_lat = (float)$_GET['start_lat'];
    $start_lng = (float)$_GET['start_lng'];
    $end_lat = (float)$_GET['end_lat'];
    $end_lng = (float)$_GET['end_lng'];

    $conn = getDatabaseConnection();

    $route = a_star($start_lat, $start_lng, $end_lat, $end_lng, $conn);

    // Return hasil rute sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($route);

    // Tutup koneksi
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
