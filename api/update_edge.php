<?php
require_once '../conf/db_conn.php';

if (isset($_POST['id'], $_POST['start_node'], $_POST['end_node'], $_POST['start_lat'], $_POST['start_lng'], $_POST['end_lat'], $_POST['end_lng'], $_POST['weight'])) {
    $id = (int) $_POST['id'];
    $start_node = (int) $_POST['start_node'];
    $end_node = (int) $_POST['end_node'];
    $start_lat = (float) $_POST['start_lat'];
    $start_lng = (float) $_POST['start_lng'];
    $end_lat = (float) $_POST['end_lat'];
    $end_lng = (float) $_POST['end_lng'];
    $weight = (float) $_POST['weight'];

    $conn = getDatabaseConnection();
    
    $sql = "UPDATE edges SET start_node = ?, end_node = ?, start_lat = ?, start_lng = ?, end_lat = ?, end_lng = ?, weight = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiddddii', $start_node, $end_node, $start_lat, $start_lng, $end_lat, $end_lng, $weight, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Edge updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update edge']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
