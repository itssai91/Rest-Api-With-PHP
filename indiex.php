<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require('conn.php');

$query = "SELECT * FROM chse";
$result = $conn->query($query);

if($result->num_rows > 0){
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
    }


