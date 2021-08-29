<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Add Data With Apis</title>
    <style>
        .header {
            background-color: #003566;
            width: 100%;
            height: 10vh;
        }

        .title {
            color: #fff;
            font-size: 1.5rem;
            margin-left: 50px;

        }

        .icon {
            color: #003566;
            font-size: 35px;
        }
    </style>
</head>

<body>
    <header class="header">
        <span class="title">Add Student</span>
    </header>
    <div>

        <form method="post" class="form-inline">

            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="name" placeholder="Enter Student Name" class="form-control" required />
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="roll" placeholder="Enter Student Roll Number" class="form-control" required />
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="email" placeholder="Enter Student Email Id" class="form-control" required />
            </div>

            <button name="submit" type="submit" class="btn icon material-icons">add_circle_outline</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $arr['name'] = $_POST['name'];
    $arr['roll'] = $_POST['roll'];
    $arr['email'] = $_POST['email'];

    $url = "https://api.infranetstudio.com/apis/add-data.php?token=B8@c90E2xcV_39VeRT9-c689o04Q9c";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);

    $result = curl_exec($ch);
    curl_close($ch);

    $student = json_decode($result, true);

    if ($student['status'] === 200) {
        echo '<script>swal("Good job!", "Student Added Successfully", "success");</script>';
    } else if ($student['status'] === 300) {
        echo '<script>swal("Oops!", "Student Already Register", "error");</script>';
    } else if ($student['status'] === 400) {
        echo '<script>swal("Something Wrong!", "Api Error", "warning");</script>';
    }
}


// function call_api($name, $roll, $email)
// {

//     define("URL", "https://api.infranetstudio.com/");
//     define("END_POINT", "apis/add-data.php");
//     define("API_TOKEN", "B8@c90E2xcV_39VeRT9-c689o04Q9c");

//     define("TOKEN", "?token=");
//     define("NAME", "&name=");
//     define("ROLL", "&roll=");
//     define("EMAIL", "&email=");

//     $url = URL . END_POINT . TOKEN . API_TOKEN;

//     // Initializes a new cURL session
//     $curl = curl_init($url);
//     // 1. Set the CURLOPT_RETURNTRANSFER option to true
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//     // 2. Set the CURLOPT_POST option to true for POST request
//     curl_setopt($curl, CURLOPT_POST, true);

//     // 3. Set the request data as JSON using json_encode function
//     curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

//     // 4. Set custom headers for RapidAPI Auth and Content-Type header
//     curl_setopt($curl, CURLOPT_HTTPHEADER, [
//         'X-RapidAPI-Host: kvstore.p.rapidapi.com',
//         'X-RapidAPI-Key: [Input your RapidAPI Key Here]',
//         'Content-Type: application/json'
//     ]);


// $data = file_get_contents($api);
// $student = json_decode(true, $data);

// $res = $student['status'];

// if ($res === 200) {
//     echo "Student Added";
// } else if ($res === 300) {
//     echo "Student Already Register";
// } else if ($res === 400) {
//     echo "Api Error";
// }
//}

?>