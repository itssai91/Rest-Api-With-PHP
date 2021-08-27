<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once('conn.php');
require_once('DatabaseHandler.php');

$db = new DatabaseHandler($conn);



$result = $db->add_data($_GET['name'], $_GET['roll'], $_GET['email']);

if ($result) {
    echo json_encode(["status" => 200, "name" => $_GET['email']]);
} else {
    echo json_encode(["status" => 200, "name" => "Student Already Registered"]);
}
