<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "test";

$conn = mysqli_connect($host, $user, $password, $db);

if($conn->connect_error){
    die("Connection Failed");
}
