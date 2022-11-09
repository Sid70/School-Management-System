<?php

require_once('config.php');


$student_pass_status = mysqli_fetch_array(mysqli_query($conn,"SELECT exam_summary.status AS final_status , student_details.class AS student_class FROM exam_summary JOIN student_details ON student_details.student_id = exam_summary.id WHERE student_details.student_id = 'S003' AND student_details.roll_no = '2022/003';"));

if ( $student_pass_status['final_status'] == 'PASSED' && $student_pass_status['student_class'] = '11' )
{
    echo "Passed to class 12";
    mysqli_query($conn,"UPDATE `student_details` SET `class`= '12' WHERE `student_id` = 'S001' AND `roll_no` = '2022/001';");
}
else
{
    echo "Clear your exam";
}


?>