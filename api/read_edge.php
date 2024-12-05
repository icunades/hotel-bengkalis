<?php
require_once '../conf/db_conn.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM edges";
$result = $conn->query($sql);

$edges = [];
while ($row = $result->fetch_assoc()) {
    $edges[] = $row;
}

header('Content-Type: application/json');
echo json_encode($edges);

$conn->close();
?>
