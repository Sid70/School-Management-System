<?php

require_once("config.php");

$faculty_id = $_POST['faculty_id'];
$faculty_name = $_POST['faculty_name'];
$designation = $_POST['designation'];
$faculty_mobile = $_POST['faculty_mobile'];
$subject_taken_class_11 = $_POST['subject_taken_class_11'];
$subject_taken_class_12 = $_POST['subject_taken_class_12'];
$dept_id = "";

if ($subject_taken_class_11 == "Mathematics" or $subject_taken_class_12 == "Mathematics" )
{
    $dept_id = "D01";
}
elseif ($subject_taken_class_11 == "Physics" or $subject_taken_class_12 == "Physics" )
{
    $dept_id = "D02";
}
elseif ($subject_taken_class_11 == "Chemistry" or $subject_taken_class_12 == "Chemistry" )
{
    $dept_id = "D03";
}
elseif ($subject_taken_class_11 == "Zoology" or $subject_taken_class_12 == "Zoology" )
{
    $dept_id = "D04";
}
elseif ($subject_taken_class_11 == "Botany" or $subject_taken_class_12 == "Botany" )
{
    $dept_id = "D05";
}
elseif ($subject_taken_class_11 == "Odia" or $subject_taken_class_12 == "Odia" )
{
    $dept_id = "D07";
}
elseif ($subject_taken_class_11 == "Hindi" or $subject_taken_class_12 == "Hindi" )
{
    $dept_id = "D08";
}
elseif ($subject_taken_class_11 == "Sanskrit" or $subject_taken_class_12 == "Sanskrit" )
{
    $dept_id = "D09";
}
elseif ($subject_taken_class_11 == "English" or $subject_taken_class_12 == "English" )
{
    $dept_id = "D06";
}
else
{
    $dept_id = "D10";
}

mysqli_query($conn,"INSERT INTO `faculty`(`faculty_id`, `faculty_name`, `designation`, `mobile_number`, `subject_id_taken_cl_11`, `subject_id_taken_cl_12`, `dept_id`) VALUES ('$faculty_id','$faculty_name','$designation','$faculty_mobile','$subject_taken_class_11','$subject_taken_class_12','$dept_id');");

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

        .button
        {
            text-decoration: none;
            border: 2px solid lightgray;
            padding: 6px 12px;
            border-radius: 7px;
        }

        .button:hover
        {
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

        <h4>Faculty Add Successful</h4>

    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>