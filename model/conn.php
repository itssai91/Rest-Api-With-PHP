<?php

//localhost server

$host = "localhost";
$user = "root";
$password = "";
$db = "test";

//main server

// $db_host = "localhost";
// $db_user = "biologyc_main";
// $db_password = "sai@72465333";
// $db_name = "biologyc_inf";

$conn = mysqli_connect($host, $user, $password, $db);

if($conn->connect_error){
    die("Connection Failed");
}
