<?php 
require('conn.php');

$query = "SELECT * FROM chse";
$result = $conn->query($query);

if($result->num_rows > 0){
    while($rows = $result->fetch_assoc()){
        $data[] = $rows;
    }
}
echo json_encode($data);

