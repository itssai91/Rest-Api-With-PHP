<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token()) {

    $result = $db->get_data($_GET['token']);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        echo json_encode(['status' => 200, 'data' => $arr]);
        $db->close();
    } else {
        echo json_encode(['status' => 300, 'msg' => 'Data Not Found']);
    }
} else {
    echo json_encode(['status' => 400, 'msg' => "Invalid API"]);
}
