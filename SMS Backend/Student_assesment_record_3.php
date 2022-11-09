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
$p_practical = $_POST['p_practical'];
$c_practical = $_POST['c_practical'];
$z_practical = $_POST['z_practical'];
$b_practical = $_POST['b_practical'];
$it_practical = $_POST['it_practical'];

// Find the class of a student if that exist in student_details Table

$find_class = mysqli_fetch_array(mysqli_query($conn,"SELECT class FROM student_details WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no'; "));

if ( $find_class['class'] == '11' )
{
    mysqli_query($conn, "UPDATE `endterm` SET `Mathematics`='$math',`Physics`='$physics',`Chemistry`='$chemistry',`English`='$english',`Zoology`='$zoology',`Botany`='$botany',`Information_Technology`='$it',`Odia`='$odia ',`Sanskrit`='$sanskrit',`Hindi`='$hindi',`Physics_Lab`='$p_practical',`Chemistry_Lab`='$c_practical',`Zoology_Lab`='$z_practical',`Botany_Lab`='$b_practical',`Information_Technology_Lab`='$it_practical' WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");


    $total_endterm = (float) ((int) $math + (int) $physics + (int) $chemistry + (int) $zoology + (int) $botany + (int) $english + (int) $it + (int) $odia + (int) $hindi + (int) $sanskrit) + (int) $p_practical + (int) $c_practical + (int) $z_practical + (int) $b_practical + (int) $it_practical;

    $percentage_endterm = (float) (($total_endterm / 600) * 100);

    if ($percentage_endterm >= 90 && $percentage_endterm <= 100) {
        $grade_endterm = 'E';
    } elseif ($percentage_endterm >= 80 && $percentage_endterm < 90) {
        $grade_endterm = 'A+';
    } elseif ($percentage_endterm >= 70 && $percentage_endterm < 80) {
        $grade_endterm = 'A';
    } elseif ($percentage_endterm >= 60 && $percentage_endterm < 70) {
        $grade_endterm = 'B+';
    } elseif ($percentage_endterm >= 50 && $percentage_endterm < 60) {
        $grade_endterm = 'B';
    } elseif ($percentage_endterm >= 40 && $percentage_endterm < 50) {
        $grade_endterm = 'C+';
    } elseif ($percentage_endterm >= 30 && $percentage_endterm < 40) {
        $grade_endterm = 'C';
    } elseif ($percentage_endterm < 40) {
        $grade_endterm = 'F';
    }

    if (mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `exam_summary` WHERE id = '$a_student_id';"))) {
        mysqli_query($conn, "UPDATE `exam_summary` SET `total_endterm` = '$total_endterm',`percentage_endterm`= '$percentage_endterm' , `grade_endterm` = '$grade_endterm' WHERE `id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");

    } else {

        mysqli_query($conn, "INSERT INTO `exam_summary`(`id`, `roll_no`, `total_endterm`, `percentage$percentage_endterm`, `grade_endterm`) VALUES ('$a_student_id','$a_roll_no','$total_endterm','$percentage_endterm','$grade_endterm');");
    }

    $result = mysqli_fetch_array(mysqli_query($conn,"SELECT  `grade_1st_internal`,`grade_2nd_internal` FROM `exam_summary` WHERE `id` = '$a_student_id' AND `roll_no` = '$a_roll_no';"));


    if ( $grade_endterm != 'F'  && $result['grade_1st_internal'] != 'F' && $result['grade_2nd_internal'] != 'F' )
    {
        mysqli_query($conn, "UPDATE `exam_summary` SET `status` = 'PASSED'  WHERE `id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");
    }
    else
    {
        mysqli_query($conn, "UPDATE `exam_summary` SET `status` = 'FAILED'  WHERE `id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");
    }

    // ****************************************************************************************************
    // After End term those student are passed from class 11 will shift to class 12 and those student are in class 12 are passed from this school.

    $student_pass_status = mysqli_fetch_array(mysqli_query($conn,"SELECT exam_summary.status AS final_status , student_details.class AS student_class FROM exam_summary JOIN student_details ON student_details.student_id = exam_summary.id WHERE student_details.student_id = '$a_student_id' AND student_details.roll_no = '$a_roll_no';"));

    if ( $student_pass_status['final_status'] == "PASSED" && $student_pass_status['student_class'] == '11' )
    {
        mysqli_query($conn, "UPDATE `student_details` SET `class` = '12'  WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");
    }

}
//for class 12
elseif( $find_class['class'] == '12')
{
    mysqli_query($conn, "UPDATE `endterm_class_12` SET `Mathematics`='$math',`Physics`='$physics',`Chemistry`='$chemistry',`English`='$english',`Zoology`='$zoology',`Botany`='$botany',`Information_Technology`='$it',`Odia`='$odia ',`Sanskrit`='$sanskrit',`Hindi`='$hindi',`Physics_Lab`='$p_practical',`Chemistry_Lab`='$c_practical',`Zoology_Lab`='$z_practical',`Botany_Lab`='$b_practical',`Information_Technology_Lab`='$it_practical' WHERE `student_id` = '$a_student_id' AND `roll_no` = '$a_roll_no';");

    $total_endterm = (float) ((int) $math + (int) $physics + (int) $chemistry + (int) $zoology + (int) $botany + (int) $english + (int) $it + (int) $odia + (int) $hindi + (int) $sanskrit) + (int) $p_practical + (int) $c_practical + (int) $z_practical + (int) $b_practical + (int) $it_practical;

    $percentage_endterm = (float) (($total_endterm / 600) * 100);

    if ($percentage_endterm >= 90 && $percentage_endterm <= 100) {
        $grade_endterm = 'E';
    } elseif ($percentage_endterm >= 80 && $percentage_endterm < 90) {
        $grade_endterm = 'A+';
    } elseif ($percentage_endterm >= 70 && $percentage_endterm < 80) {
        $grade_endterm = 'A';
    } elseif ($percentage_endterm >= 60 && $percentage_endterm < 70) {
        $grade_endterm = 'B+';
    } elseif ($percentage_endterm >= 50 && $percentage_endterm < 60) {
        $grade_endterm = 'B';
    } elseif ($percentage_endterm >= 40 && $percentage_endterm < 50) {
        $grade_endterm = 'C+';
    } elseif ($percentage_endterm >= 30 && $percentage_endterm < 40) {
        $grade_endterm = 'C';
    } elseif ($percentage_endterm < 40) {
        $grade_endterm = 'F';
    }

    if (mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `exam_summary_class_12` WHERE id = '$a_student_id';"))) {
        mysqli_query($conn, "UPDATE `exam_summary_class_12` SET `total_endterm` = '$total_endterm',`percentage_endterm`= '$percentage_endterm' , `grade_endterm` = '$grade_endterm' WHERE `id` = '$a_student_id';");

    } else {

        mysqli_query($conn, "INSERT INTO `exam_summary_class_12`(`id`, `roll_no`, `total_endterm`, `percentage$percentage_endterm`, `grade_endterm`) VALUES ('$a_student_id','$a_roll_no','$total_endterm','$percentage_endterm','$grade_endterm');");
    }

    $result = mysqli_fetch_array(mysqli_query($conn,"SELECT  `grade_1st_internal`,`grade_2nd_internal` FROM `exam_summary_class_12` WHERE `id` = '$a_student_id';"));


    if ( $grade_endterm != 'F'  && $result['grade_1st_internal'] != 'F' && $result['grade_2nd_internal'] != 'F' )
    {
        mysqli_query($conn, "UPDATE `exam_summary_class_12` SET `status` = 'PASSED'  WHERE `id` = '$a_student_id';");
    }
    else
    {
        mysqli_query($conn, "UPDATE `exam_summary_class_12` SET `status` = 'FAILED'  WHERE `id` = '$a_student_id';");
    }
}

else
{
    exit("Personal details of a student is not save in database.");
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

        <h4>Assessment Mark Add Successful</h4>
    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>