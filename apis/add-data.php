<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token() && isset($_GET['name']) && isset($_GET['roll']) && isset($_GET['email'])) {
    $name = ucwords($_GET['name']);
    $roll = strtoupper($_GET['roll']);
    $email = strtolower($_GET['email']);
    $result = $db->add_data($name, $roll, $email);
    if ($result) {
        echo json_encode(["status" => 200, "msg" => $email]);
    } else {
        echo json_encode(["status" => 300, "msg" => "Student Already Registered"]);
    }
} else {
    echo json_encode(['status' => 400, 'msg' => "Invalid API"]);
}
