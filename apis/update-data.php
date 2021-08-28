<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token() && isset($_GET['name']) && isset($_GET['roll']) && isset($_GET['new-email']) && isset($_GET['old-email'])) {
    $name = ucwords($_GET['name']);
    $roll = strtoupper($_GET['roll']);
    $new_email = strtolower($_GET['new-email']);
    $old_email = strtolower($_GET['old-email']);
    if ($db->update_data($name, $roll, $new_email, $old_email)) {
        echo json_encode(["status" => 200, "msg" => $new_email . " updated"]);
    } else {
        echo json_encode(["status" => 300, "msg" => "Data Can't Update"]);
    }
} else {
    echo json_encode(['status' => 400, 'msg' => "Invalid API"]);
}
