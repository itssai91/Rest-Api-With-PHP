<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token() && isset($_GET['name']) && isset($_GET['roll']) && isset($_GET['new-email']) && isset($_GET['old-email'])) {
    if ($db->update_data($_GET['name'], $_GET['roll'], $_GET['new-email'], $_GET['old-email'])) {
        echo json_encode(["status" => 200, "msg" => $_GET['new-email']]);
    } else {
        echo json_encode(["status" => 300, "msg" => "Data Can't Update"]);
    }
} else {
    echo json_encode(['status' => 400, 'Error message' => "Invalid API"]);
}
