<?php

require_once("config.php");


$admin_email = $_POST['Email_id'];
$admin_password = $_POST['Password'];



// Checking Password is correct or not


if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin_login WHERE admin_email_id = '$admin_email';"))) {

    if (!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin_login WHERE  admin_email_id = '$admin_email' AND admin_password = '$admin_password';"))) {
        session_destroy();
        exit("<h1>Your Password is incorrect !</h1>");

    }

} else {

    session_destroy();
    exit("<h1>You Email Id is not registered.</h1>");
}

$admin_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin_login WHERE admin_email_id = '$admin_email';"));

include("./Head_dashboard.php");

?>


<body>

    <?php

    include("Navbar_dashboard.php");

    // Total Number of Student count
    $total_student = mysqli_num_rows(mysqli_query($conn, "SELECT student_id FROM student_details; "));
    // Total Number of Faculty count
    $total_faculty = mysqli_num_rows(mysqli_query($conn, "SELECT faculty_id FROM faculty;"));
    // Total number of admin
    
    $total_admin = mysqli_num_rows(mysqli_query($conn, "SELECT admin_id FROM admin_login;"));

    // Count the number of new enrollment
    $year = date("Y");
    $new_enrollment = mysqli_num_rows(mysqli_query($conn, "SELECT student_id FROM student_details WHERE year_of_admission = $year;"));

    // Count Number of registerd Student
    
    $no_of_registered = mysqli_num_rows(mysqli_query($conn, "SELECT sl_no FROM registered_student_details;"));

    ?>

    <div class="content">

        <?php

        include("Home_dashboard.php");

        ?>


        <!-- ******************************************************************************************* -->
        <!-- Admission start -->

        <div class="display-content my-3" id="Admission" style="display: none;">

            <div style="text-align: right;">
                <a class="btn btn-info text-white" role="button" onclick="student_add('search_student');"><i
                        class="fa-solid fa-magnifying-glass"></i>
                    Search</a>
                <a class="btn btn-info text-white" role="button" onclick="student_add('add_student');"><i
                        class="fa-solid fa-plus"></i> Add</a>
            </div>

            <!-- Search Student Start -->

            <div id="search_student" style="display: block;" class="student_admission">
                <h2 class="my-4">Search Student</h2>

                <!-- Search student -->

                <!-- action="admin_search_student.php" method="post" -->

                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="m_student_id" class="form-label">Student Id</label>
                        <input type="text" class="form-control" id="m_student_id" name="m_student_id"
                            placeholder="(Ex. 'S001','S002'...)" onchange="MangeStudent(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Student Email Id</label>
                        <input type="email" class="form-control" id="email" name="email"
                            onchange="MangeStudent(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="number" maxlength="10" minlength="10" minlength="10" class="form-control" id="mobile"
                            name="mobile" onchange="MangeStudent(this.value)" maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label for="roll_no" class="form-label">Roll No</label>
                        <input type="text" class="form-control" id="roll_no" name="roll_no"
                            onchange="MangeStudent(this.value)">
                    </div>
                    <div class="col-md-4">
                        <label for="class" class="form-label">Class</label>
                        <select id="class" class="form-select" name="class" onchange="MangeStudent(this.value)">
                            <option value="">-- Select --</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </form>

                <div id="txtHint" class="mt-5"><b>Person info will be listed here...</b></div>
            </div>

            <!-- Search Student End -->

            <!-- Add Student Start -->

            <div id="add_student" style="display: none;" class="student_admission">
                <h2 class="mb-3">Add Student</h2>
                <hr>
                <form class="row g-3" action="Student_data_store_in_database_by_admin.php" method="post"
                    target="_blank">
                    <!-- Student Details -->
                    <h4>Student Details</h4>
                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Student Id</label>
                        <input type="text" class="form-control" id="student_id" name="student_id"
                            placeholder="(Ex.'S001','S002'...)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Student Email Id</label>
                        <input type="email" class="form-control" id="email" name="student_email" required>
                    </div>
                    <div class="col-md-3">
                        <label for="date_of_admission" class="form-label">Date of Admission</label>
                        <input type="date" class="form-control" id="date_of_admission" name="date_of_admission" required>
                    </div>
                    <div class="col-md-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="number" maxlength="10" minlength="10" class="form-control" id="mobile"
                            name="student_mobile" required>
                    </div>
                    <div class="col-md-4">
                        <label for="year_of_admission" class="form-label">Year of Admission</label>
                        <input type="number" class="form-control" id="year_of_admission" name="year_of_admission" required>
                    </div>
                    <div class="col-md-4">
                        <label for="roll_no" class="form-label">Roll No</label>
                        <input type="text" class="form-control" id="roll_no" name="student_roll_no"
                            placeholder="EX.(admission_year/001),2022/001" required>
                    </div>

                    <div class="col-md-4">
                        <label for="class" class="form-label">Class</label>
                        <select id="class" class="form-select" name="class" required>
                            <option selected disabled>-- Select --</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-select" name="gender" required>
                            <option disabled selected>-- Select --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="adhar_number" class="form-label">Adhar Number</label>
                        <input type="number" class="form-control" id="adhar_number" name="adhar_number" required maxlength="12" minlength="12">
                    </div>
                    <div class="col-md-4">
                        <label for="section" class="form-label">Section</label>
                        <select id="section" class="form-select" name="section" required>
                            <option disabled selected>-- Select --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="student_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="student_password" name="student_password" required>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select" name="status" required>
                            <option disabled selected>-- Select --</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <!-- Parent Details -->
                    <h4>Parent Details</h4>
                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="parent_email" class="form-label">Parent Email Id</label>
                        <input type="email" class="form-control" id="email" name="parent_email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="mobile" class="form-label">Parent's Mobile Number</label>
                        <input type="number" maxlength="10" minlength="10" class="form-control" id="parent_mobile"
                            name="parent_mobile" required>
                    </div>
                    <div class="col-md-4">
                        <label for="parent_adhar_number" class="form-label">Parent's Adhar Number</label>
                        <input type="number" class="form-control" id="parent_adhar_number" name="parent_adhar_number" required maxlength="12" minlength="12">
                    </div>

                    <!-- Address -->
                    <h4>Address</h4>
                    <div class="col-md-6">
                        <label for="address1" class="form-label">Address-1</label>
                        <input type="text" class="form-control" id="address1" name="address1">
                    </div>
                    <div class="col-md-6">
                        <label for="address2" class="form-label">Address-2</label>
                        <input type="text" class="form-control" id="address2" name="address2">
                    </div>
                    <div class="col-md-3">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" id="district" name="district" required>
                    </div>
                    <div class="col-md-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="col-md-3">
                        <label for="pin" class="form-label">PIN</label>
                        <input type="text" class="form-control" id="pin" name="pin" required>
                    </div>
                    <div class="col-md-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                    </div>
                    <div class="col-12" style="text-align: right;">
                        <button type="submit" class="btn btn-info text-white my-4">Save</button>
                    </div>
                </form>
            </div>

            <!-- Add Student Start -->


        </div>

        <!-- Admission End -->

        <!-- ******************************************************************************************* -->



        <!-- Student Assessment Start -->

        <div class="display-content" id="Assesment" style="display: none;">

            <div style="text-align: right;">
                <a class="btn btn-info text-white" role="button"
                    onclick="assessment_add('search_student_assessment');"><i class="fa-solid fa-magnifying-glass"></i>
                    Search </a>
                <a class="btn btn-info text-white" role="button" onclick="assessment_add('add_student_assessment');"><i
                        class="fa-solid fa-plus"></i>
                    Add</a>
            </div>

            <!-- Search Student Assessment Start -->

            <div id="search_student_assessment" class="student_assesment" style="display: block;">

                <h2 class="mb-4">Search Student Assessment</h2>

                <!-- Search student -->

                <!-- action="admin_search_student.php" method="post" -->
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="m_student_id" class="form-label">Student Id</label>
                        <input type="text" class="form-control" id="m_student_id" name="m_student_id"
                            placeholder="(Ex. 'S001','S002'...)" onchange="SearchStudentAssessment(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Student Email Id</label>
                        <input type="email" class="form-control" id="email" name="email"
                            onchange="SearchStudentAssessment(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="roll_no" class="form-label">Roll No</label>
                        <input type="text" class="form-control" id="roll_no" name="roll_no"
                            onchange="SearchStudentAssessment(this.value)">
                    </div>
                    <div class="col-md-4">
                        <label for="class" class="form-label">Class</label>
                        <select id="class" class="form-select" name="class"
                            onchange="SearchStudentAssessment(this.value)">
                            <option value="">-- Select --</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </form>

                <div id="txt" class="mt-5"><b>Person info will be listed here...</b></div>
            </div>



            <!-- Search Student Assessment End -->

            <!-- Add Student Assessment Start-->
            <div id="add_student_assessment" class="student_assesment" style="display: none;">

                <h2 class="my-2">Student Assessment</h2>

                <nav class="nav nav-tabs">
                    <a class="nav-link" href="#first-internal">1<sup>st</sup> Internal</a>
                    <a class="nav-link" href="#second-internal">2<sup>nd</sup> Internal</a>
                    <a class="nav-link" href="#End-term">End Term</a>
                </nav>

                <div id="first-internal">

                    <h4 class="pt-3">First Internal</h4>

                    <form class="row g-3" action="Student_assesment_record_1.php" method="post" target="_blank">
                        <div class="col-md-6">
                            <label for="a_roll_no_1" class="form-label">Student Roll No</label>
                            <input type="text" class="form-control" id="a_roll_no_1"
                                placeholder="EX. addmission_year/001" name="a_roll_no" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_student_id_1" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="a_student_id_1" placeholder="EX. S001,S002...."
                                name="a_student_id" required>
                        </div>

                        <div class="col-md-3">
                            <label for="math_1" class="form-label">Math</label>
                            <input type="number" class="form-control" id="math_1" name="math" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="physics_1" class="form-label">Physics</label>
                            <input type="number" class="form-control" id="physics_1" name="physics" maxlength="3"
                                max="40" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="chemistry_1" class="form-label">Chemistry</label>
                            <input type="number" class="form-control" id="chemistry_1" name="chemistry" maxlength="3"
                                max="40" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="zoology_1" class="form-label">Zoology</label>
                            <input type="number" class="form-control" id="zoology_1" name="zoology" maxlength="3"
                                max="20" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="botany_1" class="form-label">Botany</label>
                            <input type="number" class="form-control" id="botany_1" name="botany" maxlength="3" max="20"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="english_1" class="form-label">English</label>
                            <input type="number" class="form-control" id="english_1" name="english" maxlength="3"
                                max="40" min="0" >
                        </div>
                        <div class="col-md-3">
                            <label for="it_1" class="form-label">Information Technology</label>
                            <input type="number" class="form-control" id="it_1" name="it" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="odia_1" class="form-label">Odia</label>
                            <input type="number" class="form-control" id="odia_1" name="odia" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="hindi_1" class="form-label">Hindi</label>
                            <input type="number" class="form-control" id="hindi_1" name="hindi" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="sanskrit_1" class="form-label">Sanskrit</label>
                            <input type="number" class="form-control" id="sanskrit_1" name="sanskrit" maxlength="3"
                                max="40" min="0">
                        </div>

                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-info text-white my-2">Save</button>
                        </div>
                    </form>
                </div>

                <div id="second-internal">

                    <h4 class="pt-3">Second Internal</h4>

                    <form class="row g-3" action="Student_assesment_record_2.php" target="_blank" method="post">
                        <div class="col-md-6">
                            <label for="a_roll_no_2" class="form-label">Student Roll No</label>
                            <input type="text" class="form-control" id="a_roll_no_2"
                                placeholder="EX. addmission_year/001" name="a_roll_no" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_student_id_2" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="a_student_id_2" placeholder="EX. S001,S002...."
                                name="a_student_id" required>
                        </div>
                        <div class="col-md-3">
                            <label for="math_2" class="form-label">Math</label>
                            <input type="number" class="form-control" id="math_2" name="math" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="physics_2" class="form-label">Physics</label>
                            <input type="number" class="form-control" id="physics_2" name="physics" maxlength="3"
                                max="40" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="chemistry_2" class="form-label">Chemistry</label>
                            <input type="number" class="form-control" id="chemistry_2" name="chemistry" maxlength="3"
                                max="40" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="zoology_2" class="form-label">Zoology</label>
                            <input type="number" class="form-control" id="zoology_2" name="zoology" maxlength="3"
                                max="20" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="Botany_2" class="form-label">Botany</label>
                            <input type="number" class="form-control" id="Botany_2" name="botany" maxlength="3" max="20"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="english_2" class="form-label">English</label>
                            <input type="number" class="form-control" id="english_2" name="english" maxlength="3"
                                max="40" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="it_2" class="form-label">Information Technology</label>
                            <input type="number" class="form-control" id="it_2" name="it" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="odia_2" class="form-label">Odia</label>
                            <input type="number" class="form-control" id="odia_2" name="odia" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="hindi_2" class="form-label">Hindi</label>
                            <input type="number" class="form-control" id="hindi_2" name="hindi" maxlength="3" max="40"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="sanskrit_2" class="form-label">Sanskrit</label>
                            <input type="number" class="form-control" id="sanskrit_2" name="sanskrit" maxlength="3"
                                max="40" min="0">
                        </div>

                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-info text-white my-2">Save</button>
                        </div>
                    </form>
                </div>

                <div id="End-term">

                    <h4 class="pt-3">End Term</h4>

                    <form class="row g-3" action="Student_assesment_record_3.php" target="_blank" method="post">
                        <div class="col-md-6">
                            <label for="a_roll_no" class="form-label">Student Roll No</label>
                            <input type="text" class="form-control" id="a_roll_no" placeholder="EX. addmission_year/001"
                                name="a_roll_no" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="a_student_id" placeholder="EX. S001,S002...."
                                name="a_student_id" required>
                        </div>

                        <div class="col-md-3">
                            <label for="math" class="form-label">Math</label>
                            <input type="number" class="form-control" id="math" name="math" maxlength="3" max="100"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="physics" class="form-label">Physics</label>
                            <input type="number" class="form-control" id="physics" name="physics" maxlength="3" max="70"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="chemistry" class="form-label">Chemistry</label>
                            <input type="number" class="form-control" id="chemistry" name="chemistry" maxlength="3"
                                max="70" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="zoology" class="form-label">Zoology</label>
                            <input type="number" class="form-control" id="zoology" name="zoology" maxlength="3" max="35"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="Botany" class="form-label">Botany</label>
                            <input type="number" class="form-control" id="botany" name="botany" maxlength="3" max="35"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="english" class="form-label">English</label>
                            <input type="number" class="form-control" id="english" name="english" maxlength="3"
                                max="100" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="it" class="form-label">Information Technology</label>
                            <input type="number" class="form-control" id="it" name="it" maxlength="3" max="100" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="odia" class="form-label">Odia</label>
                            <input type="number" class="form-control" id="odia" name="odia" maxlength="3" max="100"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="hindi" class="form-label">Hindi</label>
                            <input type="number" class="form-control" id="hindi" name="hindi" maxlength="3" max="100"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="sanskrit" class="form-label">Sanskrit</label>
                            <input type="number" class="form-control" id="sanskrit" name="sanskrit" maxlength="3"
                                max="100" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="p_practical" class="form-label">Physics Practical</label>
                            <input type="number" class="form-control" id="p_practical" name="p_practical" max="30"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="c_practical" class="form-label">Chemistry Practical</label>
                            <input type="number" class="form-control" id="c_practical" name="c_practical" max="30"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="z_practical" class="form-label">Zoology Practical</label>
                            <input type="number" class="form-control" id="z_practical" name="z_practical" max="15"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="b_practical" class="form-label">Botany Practical</label>
                            <input type="number" class="form-control" id="b_practical" name="b_practical" max="15"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="it_practical" class="form-label">Information Technology Practical</label>
                            <input type="number" class="form-control" id="it_practical" name="it_practical" max="30"
                                min="0">
                        </div>

                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-info text-white my-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Add Student Assessment End -->


            <!-- Student Assessment End -->

        </div>

        <!-- Student Assessment End -->


        <!-- Fee structure start -->

        <div class="display-content" id="Fee-Structure" style="display: none;">

            <div style="text-align: right;">
                <a class="btn btn-info text-white" role="button" onclick="feeStructure('Search_Student_Fee_Status');"><i
                        class="fa-solid fa-magnifying-glass"></i>
                    Search </a>
                <a class="btn btn-info text-white" role="button" onclick="feeStructure('Add_Student_Fee_Details');"><i
                        class="fa-solid fa-plus"></i>
                    Add</a>
            </div>

            <div id="Search_Student_Fee_Status" class="fee" style="display: block;">
                <h2 class="mb-4">Search Student Fee Details</h2>

                <!-- Search Fee student -->

                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="fee_student_id" class="form-label">Student Id</label>
                        <input type="text" class="form-control" id="fee_student_id" name="fee_student_id"
                            placeholder="(Ex. 'S001','S002'...)" onchange="search_fee_structure(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="fee_email" class="form-label">Student Email Id</label>
                        <input type="email" class="form-control" id="fee_email" name="fee_email"
                            onchange="search_fee_structure(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="fee_mobile" class="form-label">Mobile Number</label>
                        <input type="number" maxlength="10" minlength="10" class="form-control" id="fee_mobile"
                            name="fee_mobile" onchange="search_fee_structure(this.value)">
                    </div>
                    <div class="col-md-6">
                        <label for="fee_roll_no" class="form-label">Roll No</label>
                        <input type="text" class="form-control" id="fee_roll_no" name="fee_roll_no"
                            onchange="search_fee_structure(this.value)">
                    </div>
                    <div class="col-md-4">
                        <label for="fee_class" class="form-label">Class</label>
                        <select id="fee_class" class="form-select" name="fee_class" onchange="search_fee_structure(this.value)">
                            <option value=" ">-- Select --</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </form>

                <div id="feeStructur_details" class="mt-5"><b>Person info will be listed here...</b></div>
            </div>


            <div id="Add_Student_Fee_Details" class="fee" style="display: none;">

                <h2 class="mb-4">Add Student Fee Details</h2>

                <!-- Search student -->

                <form class="row g-4" action="Student_fee_structure.php" method="post" target="_blank">
                    <div class="col-md-4">
                        <label for="f_student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="f_student_id"
                            placeholder="(Ex. 'S001','S002'...)" required>
                    </div>
                    <div class="col-md-4">
                        <label for="f_student_roll_no" class="form-label">Student Roll No</label>
                        <input type="text" class="form-control" id="f_student_roll_no" name="f_student_roll_no"
                            placeholder="EX. addmission_year/001" required>
                    </div>
                    <div class="col-md-4">
                        <label for="f_class" class="form-label">Class</label>
                        <select id="f_class" class="form-select" name="f_class" required>
                            <option disabled selected>-- Select --</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="f_type" class="form-label">Type</label>
                        <select id="f_type" class="form-select" name="f_type" required>
                            <option disabled selected>-- Select --</option>
                            <option value="Boarder">Boarder</option>
                            <option value="Non-Boarder">Non-Boarder</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="f_date_of_accademic_fee_payment" class="form-label">Payment Date of Accademic
                            Fee</label>
                        <input type="date" class="form-control" id="f_date_of_accademic_fee_payment"
                            name="f_date_of_accademic_fee_payment" required>
                    </div>
                    <div class="col-md-4">
                        <label for="f_accademic_fee_amount" class="form-label">Amount of Accademic Fee</label>
                        <input type="number" class="form-control" id="f_accademic_fee_amount"
                            name="f_accademic_fee_amount" required>
                    </div>
                    <div class="col-md-4">
                        <label for="f_accademic_fee_status" class="form-label">Accademic Fee Status</label>
                        <select id="f_accademic_fee_status" class="form-select" name="f_accademic_fee_status" required>
                            <option disabled selected>-- Select --</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="f_date_of_hostel_fee_payment" class="form-label">Payment Date of Hostel Fee</label>
                        <input type="date" class="form-control" id="f_date_of_hostel_fee_payment"
                            name="f_date_of_hostel_fee_payment">
                    </div>
                    <div class="col-md-4">
                        <label for="f_hostel_fee_amount" class="form-label">Amount of Hostel Fee</label>
                        <input type="number" class="form-control" id="f_accademic_fee_amount"
                            name="f_hostel_fee_amount">
                    </div>
                    <div class="col-md-4">
                        <label for="f_hostel_fee_status" class="form-label">Hostel Fee Status</label>
                        <select id="f_hostel_fee_status" class="form-select" name="f_hostel_fee_status">
                            <option disabled selected>-- Select --</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-12" style="text-align: end;">
                        <button type="submit" class="btn btn-info text-white my-4">Save</button>
                    </div>
                </form>

            </div>




        </div>

        <!-- Fee structure End -->


        <!-- Faculty start  -->

        <div class="display-content" id="Faculty" style="display: none;">
            <div style="text-align: right;" class="my-3">
                <a class="btn btn-info text-white" role="button" onclick="faculty_add('faculty_details');"><i
                        class="fa-solid fa-magnifying-glass"></i>
                    Faculty Details</a>
                <a class="btn btn-info text-white" role="button" onclick="faculty_add('add_faculty');"><i
                        class="fa-solid fa-plus"></i> Add
                    New Faculty</a>
            </div>

            <div id="faculty_details" class="fac" style="display: block;">

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

            <div id="add_faculty" class="fac" style="display: none;">

                <!-- Faculty Details -->
                <h2 class="mb-3">Add Faculty</h2>
                <form class="row g-3" action="admin_add_faculty.php" method="post" target="_blank">
                    <div class="col-md-6">
                        <label for="faculty_id" class="form-label">Faculty ID</label>
                        <input type="text" class="form-control" id="faculty_id" placeholder="EX. F001,F002..."
                            name="faculty_id" required>
                    </div>
                    <div class="col-md-6">
                        <label for="faculty_name" class="form-label">Faculty Name</label>
                        <input type="text" class="form-control" id="faculty_name" name="faculty_name" required>
                    </div>

                    <div class="col-md-4">
                        <label for="designation" class="form-label">Degisgnation</label>
                        <select id="designation" class="form-select" name="designation">
                            <option selected disabled> -- select -- </option>
                            <option value="HOD">HOD</option>
                            <option value="Asst. Professor">Asst. Professor</option>
                            <option value="Lab. Assistant">Lab. Assistant</option>
                            <option value="Guest Faculty">Guest Faculty</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="faculty_mobile" class="form-label">Faculty Mobile Number</label>
                        <input type="number" class="form-control" id="faculty_mobile" name="faculty_mobile" maxlength="10" minlength="10">
                    </div>
                    <div class="col-md-4">
                        <label for="subject_taken_class_11" class="form-label">Subject Taken (class-11)</label>
                        <select id="subject_taken_class_11" class="form-select" name="subject_taken_class_11" required>
                            <option selected disabled>-- select -- </option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Zoology">Zoology</option>
                            <option value="Botany">Botany</option>
                            <option value="English">English</option>
                            <option value="Odia">Odia</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Sanskrit">Sanskrit</option>
                            <option value="Information Technology">Information Technology</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="subject_taken_class_12" class="form-label">Subject Taken (class-12)</label>
                        <select id="subject_taken_class_12" class="form-select" name="subject_taken_class_12" required>
                            <option selected disabled>-- select -- </option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Zoology">Zoology</option>
                            <option value="Botany">Botany</option>
                            <option value="English">English</option>
                            <option value="Odia">Odia</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Sanskrit">Sanskrit</option>
                            <option value="Information Technology">Information Technology</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-info text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Faculty End -->

        <!-- ************************************************************************************************* -->

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
            <div class="row mt-2">
                <h3>Manage Account</h3>
                <div class="col-12 my-2">
                    <form class="row g-3 mt-2" action="admin_manage_account_after_validation.php" method="post">
                        <div class="col-md-6">
                            <label for="ma_email" class="form-label">Admin Email ID</label>
                            <input type="email" class="form-control" id="ma_email" name="ma_email" required onchange="Validate(this.value)">
                        </div>
                        <div class="col-md-6">
                            <label for="o_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="o_password" name="o_password" required onchange="Validate(this.value)">
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


        <!-- **************************************************************************************** -->

        <!-- Page Navigation start -->

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" onclick="openMenu('Home');" href="#Home">1</a></li>
                <li class="page-item"><a class="page-link" href="#Admission" onclick="openMenu('Admission');">2</a></li>
                <li class="page-item"><a class="page-link" href="#Assesment"
                        onclick="openMenu('Assesment');">3</a>
                </li>
                <li class="page-item"><a class="page-link" href="#Fee-Structure" onclick="openMenu('Fee-Structure');">4</a></li>
                <li class="page-item"><a class="page-link" href="#Faculty" onclick="openMenu('Faculty');">5</a></li>
                <li class="page-item"><a class="page-link" href="#Time-Table" onclick="openMenu('Time-Table');">6</a></li>
            </ul>
        </nav>

        <!-- Page Navigation end -->

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
            //x.length = 5
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }

        function student_add(menuName) {

            var i, x;
            x = document.getElementsByClassName("student_admission"); //x is an object 

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }

        function faculty_add(menuName) {

            var i, x;
            x = document.getElementsByClassName("fac"); //x is an object 

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
            //when i press on eat then ( menuName ="Home" ) so the Other part is not visible
        }
        function feeStructure(menuName) {
            var i, x;
            x = document.getElementsByClassName("fee");

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";

        }

        function assessment_add(menuName) {
            var i, x;
            x = document.getElementsByClassName("student_assesment");

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            } //at this time all object are at display:none (or not visible)

            document.getElementById(menuName).style.display = "block";
        }


        // Using AJAX (PHP and DATABASE)
        function MangeStudent(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "admin_search_student.php?input=" + str, true);
                xmlhttp.send();
            }
        }

        function SearchStudentAssessment(str) {
            if (str == "") {
                document.getElementById("txt").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txt").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search_student_assessment_record.php?input=" + str, true);
                xmlhttp.send();
            }
        }

        function search_fee_structure(str)
        {
            if (str == "") {
                document.getElementById("txt").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("feeStructur_details").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "Search_fee_structure_of_a_student.php?input=" + str, true);
                xmlhttp.send();
            }
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

    </script>
</body>

</html>