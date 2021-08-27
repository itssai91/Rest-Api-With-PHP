<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token() && isset($_GET['email'])) {
    if ($db->delete_data($_GET['email'])) {
        echo json_encode(["status" => 200, "msg" => $_GET['email'] . " Deleted"]);
    } else {
        echo json_encode(["status" => 300, "msg" => "Data Not Found"]);
    }
} else {
    echo json_encode(['status' => 400, 'Error message' => "Invalid API"]);
}
