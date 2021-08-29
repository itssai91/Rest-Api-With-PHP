<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../model/conn.php');
require_once('../model/DatabaseHandler.php');

$db = new DatabaseHandler($conn);

if (isset($_GET['token']) && $_GET['token'] === $db->get_api_token() && isset($_POST['name']) && isset($_POST['roll']) && isset($_POST['email'])) {

    $name = ucwords($_POST['name']);
    $roll = strtoupper($_POST['roll']);
    $email = strtolower($_POST['email']);
    $date_time = date_time();

    $result = $db->add_data($name, $roll, $email, $date_time);
    if ($result) {
        echo json_encode(["status" => 200, "msg" => $email]);
    } else {
        echo json_encode(["status" => 300, "msg" => "Student Already Registered"]);
    }
} else {
    echo json_encode(['status' => 400, 'msg' => "Invalid API"]);
}




function date_time()
{
    $tz = 'Asia/Kolkata';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    return $dt->format('d-m-Y, H:i:s');
}