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
        <span class="title">Update Student Data</span>
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

if (isset($_POST['submit']) && $_GET['old-email']) {

    $arr['name'] = $_POST['name'];
    $arr['roll'] = $_POST['roll'];
    $arr['new-email'] = $_POST['email'];
    $arr['old-email'] = $_GET['old-email'];

    $url = "https://api.infranetstudio.com/apis/update-data.php?token=B8@c90E2xcV_39VeRT9-c689o04Q9c";

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

?>