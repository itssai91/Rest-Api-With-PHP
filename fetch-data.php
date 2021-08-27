<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once('conn.php');
require_once('DatabaseHandler.php');

$db = new DatabaseHandler($conn);

$result = $db->get_data();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
    echo json_encode(['status' => true, 'data' => $arr]);
    $db->close();
} else {
    echo json_encode(['status' => true, 'data' => 'Data Not Found']);
}
