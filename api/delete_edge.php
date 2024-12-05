<?php
require_once '../conf/db_conn.php';

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM edges WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Edge deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete edge']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
