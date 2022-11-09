<?php

require_once("config.php");


$a_student_id = $_POST['a_student_id'];
$a_roll_no = $_POST['a_roll_no'];
$math = $_POST['math'];
$physics = $_POST['physics'];
$chemistry = $_POST['chemistry'];
$zoology = $_POST['zoology'];
$botany = $_POST['botany'];
$english = $_POST['english'];
$it = $_POST['it'];
$odia = $_POST['odia'];
$hindi = $_POST['hindi'];
$sanskrit = $_POST['sanskrit'];

// search for class 11 or 12

$find_class = mysqli_fetch_array(mysqli_query($conn,"SELECT class FROM student_details WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no'; "));

if ( $find_class['class'] == '11' )
{
    mysqli_query($conn,"UPDATE `second_internal` SET `Mathematics`='$math',`Physics`='$physics',`Chemistry`='$chemistry',`English`='$english',`Zoology`='$zoology',`Botany`='$botany',`Information_Technology`='$it',`Odia`='$odia',`Sanskrit`='$sanskrit',`Hindi`='$hindi',`Physics_Lab`='0',`Chemistry_Lab`='0',`Zoology_Lab`='0',`Botany_Lab`='0',`Information_Technology_Lab`='0' WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");

    $total_2nd_internal = (float) ((int) $math + (int)$physics + (int)$chemistry  + (int)$zoology + (int)$botany + (int)$english + (int)$it + (int)$odia + (int)$hindi + (int)$sanskrit);

    $percentage_2nd_internal =  (float) (($total_2nd_internal / 240 ) * 100 );

    if ( $percentage_2nd_internal >= 90 && $percentage_2nd_internal <= 100 )
    {
        $grade_2nd_internal = 'E';
    }
    elseif ( $percentage_2nd_internal >= 80 && $percentage_2nd_internal < 90 )
    {
        $grade_2nd_internal = 'A+';
    }
    elseif ( $percentage_2nd_internal >= 70 && $percentage_2nd_internal < 80 )
    {
        $grade_2nd_internal = 'A';
    }
    elseif ( $percentage_2nd_internal >= 60 && $percentage_2nd_internal < 70 )
    {
        $grade_2nd_internal = 'B+';
    }
    elseif ( $percentage_2nd_internal >= 50 && $percentage_2nd_internal < 60 )
    {
        $grade_2nd_internal = 'B';
    }
    elseif ( $percentage_2nd_internal >= 40 && $percentage_2nd_internal < 50 )
    {
        $grade_2nd_internal = 'C+';
    }
    elseif ( $percentage_2nd_internal >= 30 && $percentage_2nd_internal < 40 )
    {
        $grade_2nd_internal = 'C';
    }
    elseif ( $percentage_2nd_internal < 40 )
    {
        $grade_2nd_internal = 'F';
    }

    if ( mysqli_num_rows( mysqli_query($conn,"SELECT `id` FROM `exam_summary` WHERE id = '$a_student_id';") ))
    {
        mysqli_query($conn,"UPDATE `exam_summary` SET `total_2nd_internal` = '$total_2nd_internal',`percentage_2nd_internal`= '$percentage_2nd_internal',`grade_2nd_internal` = '$grade_2nd_internal' WHERE `id` = '$a_student_id';");
    }
    else
    {
        mysqli_query($conn,"INSERT INTO `exam_summary`(`id`, `roll_no`, `total_2nd_internal`, `percentage_2nd_internal`, `grade_2nd_internal`) VALUES ('$a_student_id','$a_roll_no','$total_2nd_internal','$percentage_2nd_internal','$grade_2nd_internal');");
    }

}
else
{
    mysqli_query($conn,"UPDATE `second_internal_class_12` SET `Mathematics`='$math',`Physics`='$physics',`Chemistry`='$chemistry',`English`='$english',`Zoology`='$zoology',`Botany`='$botany',`Information_Technology`='$it',`Odia`='$odia',`Sanskrit`='$sanskrit',`Hindi`='$hindi',`Physics_Lab`='0',`Chemistry_Lab`='0',`Zoology_Lab`='0',`Botany_Lab`='0',`Information_Technology_Lab`='0' WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");

    $total_2nd_internal = (float) ((int) $math + (int)$physics + (int)$chemistry  + (int)$zoology + (int)$botany + (int)$english + (int)$it + (int)$odia + (int)$hindi + (int)$sanskrit);

    $percentage_2nd_internal =  (float) (($total_2nd_internal / 240 ) * 100 );

    if ( $percentage_2nd_internal >= 90 && $percentage_2nd_internal <= 100 )
    {
        $grade_2nd_internal = 'E';
    }
    elseif ( $percentage_2nd_internal >= 80 && $percentage_2nd_internal < 90 )
    {
        $grade_2nd_internal = 'A+';
    }
    elseif ( $percentage_2nd_internal >= 70 && $percentage_2nd_internal < 80 )
    {
        $grade_2nd_internal = 'A';
    }
    elseif ( $percentage_2nd_internal >= 60 && $percentage_2nd_internal < 70 )
    {
        $grade_2nd_internal = 'B+';
    }
    elseif ( $percentage_2nd_internal >= 50 && $percentage_2nd_internal < 60 )
    {
        $grade_2nd_internal = 'B';
    }
    elseif ( $percentage_2nd_internal >= 40 && $percentage_2nd_internal < 50 )
    {
        $grade_2nd_internal = 'C+';
    }
    elseif ( $percentage_2nd_internal >= 30 && $percentage_2nd_internal < 40 )
    {
        $grade_2nd_internal = 'C';
    }
    elseif ( $percentage_2nd_internal < 40 )
    {
        $grade_2nd_internal = 'F';
    }

    if ( mysqli_num_rows( mysqli_query($conn,"SELECT `id` FROM `exam_summary_class_12` WHERE id = '$a_student_id';") ))
    {
        mysqli_query($conn,"UPDATE `exam_summary_class_12` SET `total_2nd_internal` = '$total_2nd_internal',`percentage_2nd_internal`= '$percentage_2nd_internal',`grade_2nd_internal` = '$grade_2nd_internal' WHERE `id` = '$a_student_id';");
    }
    else
    {
        mysqli_query($conn,"INSERT INTO `exam_summary_class_12`(`id`, `roll_no`, `total_2nd_internal`, `percentage_2nd_internal`, `grade_2nd_internal`) VALUES ('$a_student_id','$a_roll_no','$total_2nd_internal','$percentage_2nd_internal','$grade_2nd_internal');");
    }
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

        <h4>Assessment Mark Add Successful</h4>
    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>