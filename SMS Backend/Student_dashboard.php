<?php

require_once("config.php");

$user_email = $_POST['email'];
$user_password = $_POST['password'];

// Checking Password is correct or not

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Student_details WHERE email = '$user_email';"))) {

    if (!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Student_details WHERE  email = '$user_email' AND password = '$user_password';"))) {
        session_destroy();
        exit("<h1>Your Password is incorrect !</h1>");

    }

} else {

    session_destroy();
    exit("<h1>You Email Id is not registered.</h1>");
}


// All data from student detail;
$student_details = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Student_details WHERE email = '$user_email' AND password = '$user_password';"));

// All data from Parent details
$parent_details = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Parent_details WHERE id = (SELECT student_id FROM Student_details WHERE email = '$user_email' AND password = '$user_password');"));

// All data from Address
$address = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Address WHERE id = (SELECT student_id FROM Student_details WHERE email = '$user_email' AND password = '$user_password');"));

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="Student_dashboard.css">
    <style>
        td,
        th {
            text-align: start;
        }
    </style>
</head>

<body>

    <!-- Navbar start -->

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#Home">School Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                aria-controls="staticBackdrop" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="home">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown px-3">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dashboard
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#Manage-Account"
                                    onclick="openMenu('Manage-Account');">Manage Account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../index.html">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <div class="d-flex flex-column">
                <h3>
                    <?php echo $student_details['name']; ?>
                </h3>
                <i>
                    <?php echo $student_details['email']; ?>
                </i>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#Home" onclick="openMenu('Home');">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Results" aria-current="page" onclick="openMenu('Results');">Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#Fee-Structure"
                        onclick="openMenu('Fee-Structure');">Fee Structure</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#Faculty"
                        onclick="openMenu('Faculty');">Faculty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#Faculty"
                        onclick="openMenu('Time-Table');">Time Table</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#Manage-Account" onclick="openMenu('Manage-Account');">Manage
                                Account</a></li>
                        <li><a class="dropdown-item" href="../index.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <!-- Navbar End -->

    <!-- Left fixed Navbar -->
    <div class="sidebar">
        <a class="active" href="#Home" onclick="openMenu('Home');"><i class="fa-solid fa-house-chimney"></i>
            Home</a>
        <a href="#Results" onclick="openMenu('Results');"><i class="fa-solid fa-square-poll-vertical"></i>
            Results</a>
        <a href="#Fee-Structure" onclick="openMenu('Fee-Structure');"><i class="fa-solid fa-chalkboard-user"></i>
            Fee
            Structure</a>
        <a href="#about" onclick="openMenu('Faculty');"><i class="fa-solid fa-school"></i> Faculty</a>
        <a href="#Time-Table" onclick="openMenu('Time-Table');"><i class="fa-solid fa-school"></i> Time Table</a>
    </div>

    <div class="content">
        <!-- Home Page Start -->

        <div class="display-content" id="Home" style="display: block;">
            <h2>
                <?php echo $student_details['name']; ?>'s Profile
            </h2>

            <nav class="nav nav-tabs">
                <a class="nav-link" href="#student_details">Student's Details</a>
                <a class="nav-link" href="#parent_details">Parent's Details</a>
                <a class="nav-link" href="#address">Address</a>
            </nav>

            <div id="student_details">
                <h4 class="pt-3">Student's Details</h4>
                <div class="column">

                    <table class="table table-hover">
                        <tr>
                            <th>Student ID :</th>
                            <td>
                                <?php echo $student_details['student_id']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Roll No :</th>
                            <td>
                                <?php echo $student_details['roll_no']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Student Name :</th>
                            <td>
                                <?php echo $student_details['name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email ID :</th>
                            <td>
                                <?php echo $student_details['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Birth :</th>
                            <td>
                                <?php echo $student_details['dob']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Addmission :</th>
                            <td>
                                <?php echo $student_details['date_of_admission']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Year of Addmission :</th>
                            <td>
                                <?php echo $student_details['year_of_admission']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Class :</th>
                            <td>
                                <?php echo $student_details['class']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Section:</th>
                            <td>
                                <?php echo $student_details['section']; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Gender :</th>
                            <td>
                                <?php echo $student_details['gender']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Mobile Number :</th>
                            <td>
                                <?php echo $student_details['phone_Number']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Adhar Number:</th>
                            <td>
                                <?php echo $student_details['adhar_number']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Account Status :</th>
                            <td>
                                <?php echo $student_details['status']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Account Password :</th>
                            <td>
                                <?php echo $student_details['password']; ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div id="parent_details">
                <h4 class="pt-3">Parent's Details</h4>

                <table class="table table-hover">
                    <tr>
                        <th>Father's Name :</th>
                        <td>Mr.
                            <?php echo $parent_details['father_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Mother's Name :</th>
                        <td>Mrs.
                            <?php echo $parent_details['mother_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Email Id :</th>
                        <td>
                            <?php echo $parent_details['email']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Mobile Number:</th>
                        <td>
                            <?php echo $parent_details['parent_phone_Number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Adhar Number :</th>
                        <td>
                            <?php echo $parent_details['parent_adhar_number']; ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="address">
                <h4 class="pt-3">Address</h4>

                <table class="table table-hover">
                    <tr>
                        <th>Address-1 :</th>
                        <td>
                            <?php echo $address['address1']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address-2 :</th>
                        <td>
                            <?php echo $address['address2']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>District :</th>
                        <td>
                            <?php echo $address['district']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Pin :</th>
                        <td>
                            <?php echo $address['pin']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>State :</th>
                        <td>
                            <?php echo $address['state']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Country :</th>
                        <td>
                            <?php echo $address['country']; ?>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <!-- Home Page End -->

        <!-- Results Start -->

        <?php

        // exam marks 1st internal
        $marks_on_each_subject_1st_internal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM first_internal JOIN student_details ON first_internal.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        //exam summary
        $exam_summary = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM exam_summary JOIN student_details ON exam_summary.id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        $marks_on_each_subject_2nd_internal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM second_internal JOIN student_details ON second_internal.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        $marks_on_each_subject_endterm = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM endterm JOIN student_details ON endterm.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        // exam marks 1st internal class-12
        $marks_on_each_subject_1st_internal_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM first_internal_class_12 JOIN student_details ON first_internal_class_12.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        //exam summary
        $exam_summary_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM exam_summary_class_12 JOIN student_details ON exam_summary_class_12.id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        $marks_on_each_subject_2nd_internal_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM second_internal_class_12 JOIN student_details ON second_internal_class_12.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

        $marks_on_each_subject_endterm_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM endterm_class_12 JOIN student_details ON endterm_class_12.student_id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));



        ?>



        <div class="display-content" id="Results" style="display: none;">

            <h2>
                <?php echo $student_details['name']; ?>'s Profile
            </h2>

            <div style="text-align: right;" class="my-3">
                <a class="btn btn-info text-white" role="button" onclick="class_change('class11');">
                    Class 11 </a>
                <a class="btn btn-info text-white" role="button" onclick="class_change('class12');">
                    Class 12</a>
            </div>

            <div id="class11" class="d_content" style="display:block;">
                <h3>Class 11<sup>st</sup> Result</h3>

                <nav class="nav nav-tabs">
                    <a class="nav-link" href="#first-internal">1<sup>st</sup> Internal</a>
                    <a class="nav-link" href="#second-internal">2<sup>nd</sup> Internal</a>
                    <a class="nav-link" href="#end-term">End Term</a>
                </nav>


                <div id="first-internal">
                    <h4 class="pt-3">First Internal (Full Marks on Each Paper: 40)</h4>
                    <div class="column">

                        <table class="table table-hover">

                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary['total_1st_internal']; ?>
                                </td>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary['percentage_1st_internal'] . "%"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary['grade_1st_internal']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="second-internal">
                    <h4 class="pt-3">Second Internal (Full Marks on Each Paper: 40)</h4>
                    <div class="column">

                        <table class="table table-hover">

                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary['total_2nd_internal']; ?>
                                </td>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary['percentage_2nd_internal'] . "%"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary['grade_2nd_internal']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="end-term">
                    <h4 class="pt-3">End Term (Full Marks on Each Paper: 100)</h4>
                    <div class="column">

                        <table class="table table-hover">
                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Physics_Lab']; ?>
                                </td>
                                <th>Chemistry Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Chemistry_Lab']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Zoology_Lab']; ?>
                                </td>
                                <th>Botany Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Botany_Lab']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm['Information_Technology_Lab']; ?>
                                </td>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary['total_endterm']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary['percentage_endterm'] . "%"; ?>
                                </td>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary['grade_endterm']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div id="class12" class="d_content" style="display:none;">

                <h3>Class 12<sup>nd</sup> Result</h3>
                <nav class="nav nav-tabs">
                    <a class="nav-link" href="#first-internal_class12">1<sup>st</sup> Internal</a>
                    <a class="nav-link" href="#second-internal_class12">2<sup>nd</sup> Internal</a>
                    <a class="nav-link" href="#end-term_class12">End Term</a>
                </nav>
                <div id="first-internal_class12">
                    <h4 class="pt-3">First Internal (Full Marks on Each Paper: 40)</h4>
                    <div class="column">

                        <table class="table table-hover">

                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_1st_internal_class12['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary_class12['total_1st_internal']; ?>
                                </td>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary_class12['percentage_1st_internal'] . "%"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary_class12['grade_1st_internal']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="second-internal_class12">
                    <h4 class="pt-3">Second Internal (Full Marks on Each Paper: 40)</h4>
                    <div class="column">

                        <table class="table table-hover">

                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_2nd_internal_class12['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary_class12['total_2nd_internal']; ?>
                                </td>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary_class12['percentage_2nd_internal'] . "%"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary_class12['grade_2nd_internal']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="end-term_class12">
                    <h4 class="pt-3">End Term (Full Marks on Each Paper: 100)</h4>
                    <div class="column">

                        <table class="table table-hover">
                            <tr>
                                <th>Mathematics:</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Mathematics']; ?>
                                </td>
                                <th>Chemistry :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Chemistry']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Physics']; ?>
                                </td>
                                <th>English :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['English']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Zoology']; ?>
                                </td>
                                <th>Botany :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Botany']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Information_Technology']; ?>
                                </td>
                                <th>Odia :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Odia']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hindi :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Hindi']; ?>
                                </td>
                                <th>Sanskrit :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Sanskrit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Physics Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Physics_Lab']; ?>
                                </td>
                                <th>Chemistry Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Chemistry_Lab']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Zoology Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Zoology_Lab']; ?>
                                </td>
                                <th>Botany Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Botany_Lab']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>IT Practical :</th>
                                <td>
                                    <?php echo (int) $marks_on_each_subject_endterm_class12['Information_Technology_Lab']; ?>
                                </td>
                                <th>Total :</th>
                                <td>
                                    <?php echo (int) $exam_summary_class12['total_endterm']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Percentage :</th>
                                <td>
                                    <?php echo $exam_summary_class12['percentage_endterm'] . "%"; ?>
                                </td>
                                <th>Grade :</th>
                                <td>
                                    <?php echo $exam_summary_class12['grade_endterm']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <?php


            $exam_status_class12 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT exam_summary_class_12.status AS e_status FROM `exam_summary_class_12` JOIN student_details ON student_details.student_id = exam_summary_class_12.id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));
            ?>

            <div class="status">
                <span>Status: </span>
                <?php

                if ($exam_status_class12['e_status'] == 'FAILED') {
                ?>
                <span class="badge text-bg-danger">
                    <?php echo $exam_status_class12['e_status']; ?>
                </span>
                <?php
                } elseif ($exam_status_class12['e_status'] == 'PASSED') {
                ?>
                <span class="badge text-bg-success">
                    <?php echo $exam_status_class12['e_status']; ?>
                </span>
                <?php
                } else {
                ?>
                <span class="badge text-bg-warning">
                    <?php echo $exam_status_class12['e_status']; ?>
                </span>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- Results Page End -->

        <!-- Fee structure start -->
        <div class="display-content" id="Fee-Structure" style="display: none;">
            <h2>
                <?php echo $student_details['name']; ?>'s Profile
            </h2>

            <?php

            $fee_structure_details = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM student_details JOIN fee_structure ON fee_structure.id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));


            ?>
            <div style="text-align: right;" class="my-3">
                <a class="btn btn-info text-white" role="button" onclick="fee_structure('f_class11');">
                    Class 11 </a>
                <a class="btn btn-info text-white" role="button" onclick="fee_structure('f_class12');">
                    Class 12</a>
            </div>

            <div class="table-responsive">
                <h4 class="pt-3">Fee Structure</h4>
                <!-- Class 11 Fee -->
                <div class="column fee" id="f_class11" style="display: block;">
                    <table class="table table-hover">
                        <tr>
                            <th>Student ID</th>
                            <td>
                                <?php echo $fee_structure_details['student_id']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Roll No :</th>
                            <td>
                                <?php echo $fee_structure_details['roll_no']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Student Name :</th>
                            <td>
                                <?php echo $fee_structure_details['name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email ID :</th>
                            <td>
                                <?php echo $fee_structure_details['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Class :</th>
                            <td>
                                <?php echo '11'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Type :</th>
                            <td>
                                <?php echo $fee_structure_details['type']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Accademic Fee Payment :</th>
                            <td>
                                <?php echo $fee_structure_details['date_of_accademic_amount_payment']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Amount Paid for Accademic Fee :</th>
                            <td>
                                <?php echo 'Rs. ' . $fee_structure_details['accademic_amount_fee']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Accademic Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details['accademic_fee_status']; ?>
                            </td>
                        </tr>
                        <?php
                        $residence_type = mysqli_fetch_array(mysqli_query($conn, "SELECT fee_structure.type AS residence_type FROM fee_structure JOIN student_details ON student_details.student_id = fee_structure.id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

                        if ($residence_type['residence_type'] == "Boarder") {
                        ?>

                        <tr>
                            <th>Date of Hostel Fee Payment :</th>
                            <td>
                                <?php echo $fee_structure_details['date_of_hostel_amount_payment']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Amount Paid for Hostel Fee :</th>
                            <td>
                                <?php echo 'Rs. ' . $fee_structure_details['hostel_amount_fee']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Hostel Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details['hostel_fee_status']; ?>
                            </td>
                        </tr>

                        <?php
                        }
                        ?>

                        <tr>
                            <th>Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details['account_status']; ?>
                            </td>
                        </tr>


                    </table>
                </div>

                <!-- Class 12 Fee -->
                <?php
                $fee_structure_details_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM student_details JOIN fee_structure_class_12 ON fee_structure_class_12.id = student_details.student_id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));
                ?>
                <div class="column fee" id="f_class12" style="display: none;">
                    <table class="table table-hover">
                        <tr>
                            <th>Student ID</th>
                            <td>
                                <?php echo $fee_structure_details_class12['student_id']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Roll No :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['roll_no']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Student Name :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email ID :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Class :</th>
                            <td>
                                <?php echo '12'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Type :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['type']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Accademic Fee Payment :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['date_of_accademic_amount_payment']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Amount Paid for Accademic Fee :</th>
                            <td>
                                <?php echo 'Rs. ' . $fee_structure_details_class12['accademic_amount_fee']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Accademic Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['accademic_fee_status']; ?>
                            </td>
                        </tr>
                        <?php
                        $residence_type_class12 = mysqli_fetch_array(mysqli_query($conn, "SELECT fee_structure_class_12.type AS residence_type FROM fee_structure_class_12 JOIN student_details ON student_details.student_id = fee_structure_class_12.id WHERE student_details.email = '$user_email' AND student_details.password = '$user_password';"));

                        if ($residence_type_class12['residence_type'] == "Boarder") {
                        ?>

                        <tr>
                            <th>Date of Hostel Fee Payment :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['date_of_hostel_amount_payment']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Amount Paid for Hostel Fee :</th>
                            <td>
                                <?php echo 'Rs. ' . $fee_structure_details_class12['hostel_amount_fee']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Hostel Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['hostel_fee_status']; ?>
                            </td>
                        </tr>

                        <?php
                        }
                        ?>
                        <tr>
                            <th>Account Status :</th>
                            <td>
                                <?php echo $fee_structure_details_class12['account_status']; ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

        </div>

        <!-- Faculty start  -->
        <div class="display-content" id="Faculty" style="display: none;">
            <h2>Faculty Details</h2>
            <nav class="nav nav-tabs">
                <a class="nav-link" href="#mth">Department of Mathematics</a>
                <a class="nav-link" href="#phy">Department of Physics</a>
                <a class="nav-link" href="#chem">Department of Chemistry</a>
                <a class="nav-link" href="#bioit">Department of Biology & IT</a>
                <a class="nav-link" href="#lang">Department of Language</a>
            </nav>

            <?php


            $faculty_math = mysqli_query($conn, "SELECT * FROM faculty WHERE dept_id = 'D01';");
            $faculty_chem = mysqli_query($conn, "SELECT * FROM faculty WHERE dept_id = 'D03';");
            $faculty_phy = mysqli_query($conn, "SELECT * FROM faculty WHERE dept_id = 'D02';");
            $faculty_bioit = mysqli_query($conn, "SELECT * FROM faculty WHERE dept_id = 'D04' OR dept_id = 'D10' OR dept_id='D05';");
            $faculty_lang = mysqli_query($conn, "SELECT * FROM faculty WHERE dept_id = 'D09' OR dept_id = 'D08' OR dept_id = 'D07';");
            ?>

            <div id="mth">
                <h4 class="pt-3">Department of Mathematics</h4>
                <div class="column">

                    <table class="table table-light table-hover">
                        <?php
                        while ($row_faculty_math = mysqli_fetch_array($faculty_math)) {
                            echo "<tr><th><strong>" . $row_faculty_math['faculty_name'] . "</strong><br>" . $row_faculty_math['designation'] . "</th>" . "<td><strong>Phone</strong>: " . $row_faculty_math['mobile_number'] . "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>

            <div id="phy">
                <h4 class="pt-3">Department of Physics</h4>

                <table class="table table-light table-hover">
                    <?php
                    while ($row_faculty_phy = mysqli_fetch_array($faculty_phy)) {
                        echo "<tr><th><strong>" . $row_faculty_phy['faculty_name'] . "</strong><br>" . $row_faculty_phy['designation'] . "</th>" . "<td><strong>Phone</strong>: " . $row_faculty_phy['mobile_number'] . "</td></tr>";
                    }
                    ?>
                </table>


            </div>

            <div id="chem">
                <h4 class="pt-3">Department of Chemistry</h4>


                <table class="table table-light table-hover">
                    <?php
                    while ($row_faculty_chem = mysqli_fetch_array($faculty_chem)) {
                        echo "<tr><th><strong>" . $row_faculty_chem['faculty_name'] . "</strong><br>" . $row_faculty_chem['designation'] . "</th>" . "<td><strong>Phone</strong>: " . $row_faculty_chem['mobile_number'] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <div id="bioit">
                <h4 class="pt-3">Department of Biology & IT</h4>

                <table class="table table-light table-hover">
                    <?php
                    while ($row_faculty_bioit = mysqli_fetch_array($faculty_bioit)) {
                        echo "<tr><th><strong>" . $row_faculty_bioit['faculty_name'] . "</strong><br>" . $row_faculty_bioit['designation'] . "</th>" . "<td><strong>Phone</strong>: " . $row_faculty_bioit['mobile_number'] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <div id="lang">
                <h4 class="pt-3">Department of Language</h4>

                <table class="table table-light table-hover">
                    <?php
                    while ($row_faculty_lang = mysqli_fetch_array($faculty_lang)) {
                        echo "<tr><th><strong>" . $row_faculty_lang['faculty_name'] . "</strong><br>" . $row_faculty_lang['designation'] . "</th>" . "<td><strong>Phone</strong>: " . $row_faculty_lang['mobile_number'] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- Faculty End -->

        <!-- Time Table start -->

        <div class="display-content" id="Time-Table" style="display: none;">
            <div class="table-responsive">
                <h2 class="pt-3">Time Table</h2>
                <div class="column">
                    <div class="ratio ratio-16x9 my-4">
                        <iframe src="timetable.pdf" title="Time Table" id="tt" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Table end -->

        <!-- Manage Account Start -->

        <div class="display-content" id="Manage-Account" style="display: none;">

            <h2>
                <?php echo $student_details['name']; ?>'s Profile
            </h2>
            <hr>
            <div class="row mt-2">
                <h3>Manage Account</h3>
                <div class="col-12 my-2">
                    <form class="row g-3 mt-2" action="student_manage_account_after_validation.php" method="post">
                        <div class="col-md-6">
                            <label for="ma_email" class="form-label">Student Email ID</label>
                            <input type="email" class="form-control" id="ma_email" name="ma_email" required
                                onchange="check_validity(this.value);">
                        </div>
                        <div class="col-md-6">
                            <label for="o_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="o_password" name="o_password" required
                                onchange="check_validity(this.value);">
                        </div>
                        <div class="col-md-6">
                            <label for="n_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="n_password" name="n_password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="c_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="c_password" name="c_password" required>
                        </div>
                        <div class="col-12">
                            <button onclick="return option();" type="submit"
                                class="btn btn-info text-white">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Manage Account End -->

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" onclick="openMenu('Home');" href="#Home">1</a></li>
                <li class="page-item"><a class="page-link" href="#Results" onclick="openMenu('Results');">2</a></li>
                <li class="page-item"><a class="page-link" href="#Fee-Structure"
                        onclick="openMenu('Fee-Structure');">3</a></li>
                <li class="page-item"><a class="page-link" href="#Faculty" onclick="openMenu('Faculty');">4</a></li>
                <li class="page-item"><a class="page-link" href="#Time-Table" onclick="openMenu('Time-Table');">5</a>
                </li>
            </ul>
        </nav>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
    <script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>
    <script>
        function openMenu(menuName) {

            // evt = "click" & menuName = "Home" or "Results" or "Fee Structure" or "Faculty"

            var i, x;
            x = document.getElementsByClassName("display-content"); //x is an object 
            //x.length = 4
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }

        function class_change(menuName) {
            var i, x;
            x = document.getElementsByClassName("d_content"); //x is an object 
            //x.length = 4
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }

        function fee_structure(menuName) {
            var i, x;
            x = document.getElementsByClassName("fee"); //x is an object 
            //x.length = 4
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }

        function option() {

            let pw = document.getElementById('n_password').value;
            let cpw = document.getElementById('c_password').value;

            if (pw == cpw) {

                if (confirm("Do you Realy want to Change your Password!")) {
                    return true;

                } else {
                    return false;
                }
            }
            else {
                alert("Your Confirm password is not match.Please Try Again!");
                return false;
            }

        }

        // function showUser(str,email,password) {
        //     if (str == "") {
        //         document.getElementById("txtHint").innerHTML = "";
        //         return;
        //     } else {
        //         var xmlhttp = new XMLHttpRequest();
        //         xmlhttp.onreadystatechange = function () {
        //             if (this.readyState == 4 && this.status == 200) {
        //                 alert(this.responseText);
        //             }
        //         };
        //         xmlhttp.open("GET", "student_manage_account.php?q=" + str + "&student_id=" + email + "&student_password=" + password , true);
        //         xmlhttp.send();
        //     }
        // }

    </script>
</body>

</html>

<?php

session_destroy();
exit();


?>