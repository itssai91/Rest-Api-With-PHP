<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once('conn.php');
require_once('DatabaseHandler.php');



if (isset($_GET['token']) && isset($_GET['name']) && isset($_GET['roll']) && isset($_GET['email'])) {

    $db = new DatabaseHandler($conn);

    $result = $db->add_data($_GET['token'], $_GET['name'], $_GET['roll'], $_GET['email']);

    if ($result) {
        echo json_encode(["status" => 200, "name" => $_GET['email']]);
    } else {
        echo json_encode(["status" => 200, "name" => "Student Already Registered"]);
    }
} else {
    echo json_encode(['status' => false, 'Error message' => "Invalid API"]);
}
