<?php

require_once("config.php");

$student_id = $_POST['student_id'];
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$date_of_admission = $_POST['date_of_admission'];
$student_mobile = $_POST['student_mobile'];
$year_of_admission = $_POST['year_of_admission'];
$student_roll_no = $_POST['student_roll_no'];
$class = $_POST['class'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$section = $_POST['section'];
$adhar_number = $_POST['adhar_number'];
$student_password = $_POST['student_password'];
$status = $_POST['status'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$parent_email = $_POST['parent_email'];
$parent_mobile = $_POST['parent_mobile'];
$parent_adhar_number = $_POST['parent_adhar_number'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$district = $_POST['district'];
$state = $_POST['state'];
$pin = $_POST['pin'];
$country = $_POST['country'];


if (!mysqli_query($conn, "INSERT INTO `student_details` (`student_id`, `email`, `name`, `date_of_admission`, `phone_Number`, `roll_no`, `year_of_admission`, `gender`, `class`, `adhar_number`, `dob`, `section`, `status`, `password`) VALUES ('$student_id','$student_email','$student_name','$date_of_admission','$student_mobile','$student_roll_no','$year_of_admission','$gender','$class','$adhar_number','$dob','$section','$status','$student_password');")) {

    echo ("Error description: " . mysqli_error($conn));
}

if (!mysqli_query($conn, "INSERT INTO `parent_details`(`id`, `father_name`, `mother_name`, `email`, `parent_phone_Number`, `parent_adhar_number`) VALUES ('$student_id','$father_name','$mother_name','$parent_email','$parent_mobile','$parent_adhar_number');")) {
    echo ("Error description: " . mysqli_error($conn));
}

if (!mysqli_query($conn, "INSERT INTO `address`(`id`, `address1`, `address2`, `district`, `state`, `pin`, `country`) VALUES ('$student_id','$address1','$address2','$district','$state','$pin','$country');")) {
    echo ("Error description: " . mysqli_error($conn));
}


// search for class 11 or 12

$find_class = mysqli_fetch_array(mysqli_query($conn, "SELECT class FROM student_details WHERE `student_id` = '$student_id' AND `roll_no` = '$student_roll_no';"));

if ($find_class['class'] == '11') {
    if (!mysqli_query($conn, "INSERT INTO `first_internal` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `second_internal` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `endterm` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `fee_structure` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `exam_summary` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `first_internal_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `second_internal_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `endterm_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `fee_structure_class_12` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `exam_summary_class_12` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    mysqli_query($conn,"INSERT INTO `student_details_those_are_passed_from_class_11` (`student_id`, `roll_no`,`previous_class`) VALUES ('$student_id','$student_roll_no','11');");
    
} else {
    if (!mysqli_query($conn, "INSERT INTO `first_internal_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `second_internal_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `endterm_class_12` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `fee_structure_class_12` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `exam_summary_class_12` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `first_internal` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `second_internal` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `endterm` (`student_id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `fee_structure` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
    }
    if (!mysqli_query($conn, "INSERT INTO `exam_summary` (`id`, `roll_no`) VALUES ('$student_id','$student_roll_no');")) {
        echo ("Error description: " . mysqli_error($conn));
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

        <h4>Registration Successful</h4>
    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>