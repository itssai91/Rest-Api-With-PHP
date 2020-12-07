<?php
$jsonData = file_get_contents('http://localhost/Rest%20API%20With%20PHP/indiex.php');
$data = json_decode($jsonData);
echo $data['1']['id'];
