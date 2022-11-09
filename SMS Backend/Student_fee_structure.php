<?php

require_once("config.php");

$f_student_id = $_POST['f_student_id'];
$f_student_roll_no = $_POST['f_student_roll_no'];
$f_type = $_POST['f_type'];
$f_class = $_POST['f_class'];
$f_date_of_accademic_fee_payment = $_POST['f_date_of_accademic_fee_payment'];
$f_accademic_fee_amount = $_POST['f_accademic_fee_amount'];
$f_date_of_hostel_fee_payment = $_POST['f_date_of_hostel_fee_payment'];
$f_hostel_fee_amount = $_POST['f_hostel_fee_amount'];
$f_accademic_fee_status = $_POST['f_accademic_fee_status'];
$f_hostel_fee_status = $_POST['f_hostel_fee_status'];

if ( $f_class = '11' )
{
    if ($f_type != 'Boarder' )
    {
        $f_date_of_hostel_fee_payment = null;
        $f_hostel_fee_amount = 0;
        $f_hostel_fee_status = null;
    }

    mysqli_query($conn,"UPDATE `fee_structure` SET `type`='$f_type',`accademic_amount_fee`='$f_accademic_fee_amount',`hostel_amount_fee`='$f_hostel_fee_amount',`date_of_accademic_amount_payment`='$f_date_of_accademic_fee_payment',`date_of_hostel_amount_payment`='$f_date_of_hostel_fee_payment',`accademic_fee_status`='$f_accademic_fee_status',`hostel_fee_status`='$f_hostel_fee_status' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");

    $result = mysqli_fetch_array(mysqli_query($conn,"SELECT `type`,`accademic_fee_status`,`hostel_fee_status` FROM `fee_structure` WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';"));

    if ( $result['type'] == 'Boarder' )
    {
        if ( $result['accademic_fee_status'] == "Pending" && $result['hostel_fee_status'] == "Pending")
        {
            mysqli_query($conn,"UPDATE `fee_structure` SET `account_status`= 'Pending' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        }
        else
        {
            mysqli_query($conn,"UPDATE `fee_structure` SET `account_status`= 'Complete' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        }
    }
    else
    {
        if (  $result['accademic_fee_status'] == "Complete" )
        {
            mysqli_query($conn,"UPDATE `fee_structure` SET `account_status`= 'Complete' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");        
        }
        else
        {
            mysqli_query($conn,"UPDATE `fee_structure` SET `account_status`= 'Pending' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        } 
    }
}
else
{
    if ($f_type != 'Boarder' )
    {
        $f_date_of_hostel_fee_payment = null;
        $f_hostel_fee_amount = 0;
        $f_hostel_fee_status = null;
    }

    mysqli_query($conn,"UPDATE `fee_structure_class_12` SET `type`='$f_type',`accademic_amount_fee`='$f_accademic_fee_amount',`hostel_amount_fee`='$f_hostel_fee_amount',`date_of_accademic_amount_payment`='$f_date_of_accademic_fee_payment',`date_of_hostel_amount_payment`='$f_date_of_hostel_fee_payment',`accademic_fee_status`='$f_accademic_fee_status',`hostel_fee_status`='$f_hostel_fee_status' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");

    $result = mysqli_fetch_array(mysqli_query($conn,"SELECT `type`,`accademic_fee_status`,`hostel_fee_status` FROM `fee_structure_class_12` WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';"));

    if ( $result['type'] == 'Boarder' )
    {
        if ( $result['accademic_fee_status'] == "Pending" && $result['hostel_fee_status'] == "Pending")
        {
            mysqli_query($conn,"UPDATE `fee_structure_class_12` SET `account_status`= 'Pending' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        }
        else
        {
            mysqli_query($conn,"UPDATE `fee_structure_class_12` SET `account_status`= 'Complete' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        }
    }
    else
    {
        if (  $result['accademic_fee_status'] == "Complete" )
        {
            mysqli_query($conn,"UPDATE `fee_structure_class_12` SET `account_status`= 'Complete' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");        
        }
        else
        {
            mysqli_query($conn,"UPDATE `fee_structure_class_12` SET `account_status`= 'Pending' WHERE `id` = '$f_student_id' AND `roll_no` = '$f_student_roll_no';");
        } 
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

        <h4>Account Update Successful</h4>

    </div>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
</body>

</html>
