<?php

require_once("config.php");

$ma_email = $_POST['ma_email'];
$o_password = $_POST['o_password'];
$n_password = $_POST['n_password'];




if (mysqli_num_rows(mysqli_query($conn, "SELECT email,password FROM student_details WHERE email = '$ma_email';"))) {

    if (!mysqli_num_rows(mysqli_query($conn, "SELECT email,password FROM student_details WHERE email = '$ma_email' AND password = '$o_password';"))) {
        session_destroy();
        exit("<h1>Your Password is incorrect !</h1>");
    }

} else {
    session_destroy();
    exit("<h1>You Email Id is not registered.</h1>");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            border: 0;
        }

        h4 {
            text-align: center;
            text-transform: uppercase;
            font-size: 26px;
            padding-bottom: 20px;
        }

        p {
            text-align: center;
        }

        .btn {
            text-align: center;
            padding: 20px;
        }

        .container {
            /* background-color: green; */
            width: 100%;
            margin: auto;
            padding: 100px 0px 200px;
        }

        .verify {
            margin: auto;
            background-color: rgb(123, 234, 138);
            width: 50%;
            color: green;
            padding: 30px;
            border-radius: 7px;
        }

        .icon {
            text-align: center;
            color: green;
            padding-bottom: 20px;
            width: 100%;
        }

        .button {
            text-decoration: none;
            border: 2px solid lightgray;
            padding: 6px 12px;
            border-radius: 7px;
        }

        .button:hover {
            background-color: antiquewhite;
        }

        @media (max-width:768px) {
            .verify {
                width: 80%;
                color: green;
                padding: 30px;
                border-radius: 7px;
            }
        }

        @media (max-width:425px) {
            .verify {
                width: 98%;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="icon">
            <i class="fa-solid fa-7x fa-circle-check"></i>
        </div>

        <h4>Password Changed Successful</h4>

        <div class="btn">
            <a href="../index.html" class="button">Log Out</a>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>

<?php

session_destroy();

?>

