<?php
$data = file_get_contents('https://api.infranetstudio.com/apis/fetch-data.php?token=B8@c90E2xcV_39VeRT9-c689o04Q9c');
$student = json_decode($data, true);
// print_r($student);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" href="android-chrome-192*192.png">
    <link rel="icon" href="android-chrome-512*512.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Data</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .icon {
            color: #e63946;
            font-size: 35px;
        }

        .update-panel {
            margin-left: auto;
            margin-right: auto;
            background-color: #fff;
            width: 60%;
            padding: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;

        }

        .close-icon {
            position: relative;
            float: right;
        }
    </style>
</head>
<body">

    <!--Corona Data-->
    <section class="corona_data container-fluid">

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">



                <?php


                $total = count($student['data']);

                $i = 0;
                while ($i < $total) {

                ?>

                    <tr class="text-capitalize text-white">
                        <th style="color: #fff; background: #2196f3;">ID</th>
                        <th style="color: #fff; background: #008C76FF;">NAME</th>
                        <th style="color: #fff; background: #e91e7f;">ROLL NO</th>
                        <th style="color: #fff; background: #EE2737FF;">EMAIL ID</th>
                        <th style="color: #fff; background: #4caf50;">TIMESTAMP</th>
                        <th style="color: #fff; background: #2196f3;">Action</th>


                    </tr>

                    <tr class="mb-5">
                        <td style="background: #bed2f3"> <?php echo $student['data'][$i]['_id'] . "<br>" ?> </td>
                        <td style="background: #ffe493"> <?php echo $student['data'][$i]['name'] . "<br>" ?> </td>
                        <td style="background: #9ED9CCFF"> <?php echo $student['data'][$i]['roll_no'] . "<br>" ?> </td>
                        <td style="background: #fc95c6"> <?php echo $student['data'][$i]['email_id'] . "<br>" ?> </td>
                        <td style="background: #88d28b"> <?php echo $student['data'][$i]['timestamp'] . "<br>" ?> </td>

                        <td style="background: #bed2f3">
                            <form method="post">
                                <input type="text" hidden name="hidden-email" value="<?php echo $student['data'][$i]['email_id'] ?>">

                                <button name="delete" type="submit" class="btn icon material-icons">delete_outline</button>
                            </form>
                            <a target="_blank" href="update-data.php?old-email=<?php echo $student['data'][$i]['email_id'] ?>" class="btn icon material-icons">edit</a>
                        </td>
                    </tr>


                <?php

                    $i++;
                }

                ?>
            </table>
        </div>

        <div id="update-panel" class="update-panel">

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
            <div class="close-icon">
                <span id="close" class="btn icon material-icons">close</span>
            </div>
        </div>



    </section>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.getElementById("close").addEventListener("click", () => {
            document.getElementById("update-panel").style.display = "none";
        });
    </script>

    </body>

</html>

<?php

if (isset($_POST['delete'])) {

    $arr['email'] = $_POST['hidden-email'];

    $url = "https://api.infranetstudio.com/apis/delete-data.php?token=B8@c90E2xcV_39VeRT9-c689o04Q9c";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);

    $result = curl_exec($ch);
    curl_close($ch);

    $student = json_decode($result, true);

    if ($student['status'] === 200) {
        echo '<script>swal("Good job!", "Student Deleted Successfully", "success");</script>';
    } else if ($student['status'] === 300) {
        echo '<script>swal("Oops!", "Student Record Not Exist", "error");</script>';
    } else if ($student['status'] === 400) {
        echo '<script>swal("Something Wrong!", "Api Error", "warning");</script>';
    }
}
?>