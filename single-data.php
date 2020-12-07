<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require('conn.php');

$singleData = json_decode(file_get_contents("php://input"), true);
$id_no = $singleData['sid'];

$query = "SELECT * FROM chse WHERE id = {$id_no}";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
}
