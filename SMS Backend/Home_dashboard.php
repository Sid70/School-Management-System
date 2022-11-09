<!-- Home Page Start -->
<?php
    require_once('config.php');
    $signup_student = mysqli_query($conn, "SELECT DISTINCT * FROM registered_student_details;");
    $contact_us_student = mysqli_query($conn, "SELECT DISTINCT  * FROM  contact_us;");
?>



<h2>Welcome back,
    <?php echo $admin_detail['admin_name']; ?>
</h2>
<hr>
<div class="display-content my-5" id="Home" style="display: block;">
    <div class="row">
        <div class="col-sm-4">
            <div class="card text-bg-danger mb-3">
                <div class="card-header">
                    <h5 class="card-title">STUDENT</h5>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Number of Student:
                        <?php echo $total_student; ?>
                    </p>
                    <img src="https://img.icons8.com/color/96/000000/man_reading_a_book.png" width="100px"
                        height="80px">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-bg-success mb-3">
                <div class="card-header">
                    <h5 class="card-title">FACULTY</h5>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">

                    <p class="card-text">Number of Faculty:
                        <?php echo $total_faculty; ?>
                    </p>

                    <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-teacher-literature-flaticons-lineal-color-flat-icons-2.png"
                        width="100px" height="80px">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">New Enrollment</h5>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">New Enrollment:
                        <?php echo $new_enrollment; ?>
                    </p>
                    <img src="https://img.icons8.com/color/96/000000/man_reading_a_book.png" width="100px"
                        height="80px">
                </div>
            </div>
        </div>
    </div>
    <?php

    $fee_collected_from_class_11 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ( sum(`accademic_amount_fee`) + sum(`hostel_amount_fee`) ) AS Total FROM `fee_structure`;"));
    $fee_collected_from_class_12 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ( sum(`accademic_amount_fee`) + sum(`hostel_amount_fee`) ) AS Total FROM `fee_structure_class_12`;"));
    $total = ((float) $fee_collected_from_class_11['Total'] + (float) $fee_collected_from_class_12['Total']);

    ?>
    <div class="row my-4">
        <div class="col-sm-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-header">
                    <h5 class="card-title">Fee Structure</h5>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Total Fee Collect:
                        <?php echo 'Rs. ' . $total; ?>
                    </p>
                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-fee-digital-nomading-relocation-flaticons-flat-flat-icons.png"
                        width="100px" height="80px" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-bg-dark mb-3">
                <div class="card-header">
                    <h5 class="card-title">New Sign UP</h5>
                </div>
                <div class="card-body  d-flex justify-content-between align-items-center">
                    <p class="card-text">New Registerd Student:
                        <?php echo $no_of_registered; ?>
                    </p>
                    <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-enrollment-university-flaticons-lineal-color-flat-icons.png"
                        width="100px" height="80px" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-bg-info text-white mb-3">
                <div class="card-header">
                    <h5 class="card-title">ADMIN</h5>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Number of Admin:
                        <?php echo $total_admin; ?>
                    </p>
                    <img src="https://img.icons8.com/external-phatplus-lineal-color-phatplus/64/FA5252/external-admin-marketing-and-seo-phatplus-lineal-color-phatplus.png"
                        width="100px" height="80px">
                </div>
            </div>
        </div>
    </div>

    <div id="signup_details" class="table-responsive">
        <h2 class="my-4">Sign Up Student Details</h2>
        <div class="column">
            <table class="table  table-bordered table-hover">
                <tr class="table-info">
                    <th>Sl No.</th>
                    <th>Registered Student Name</th>
                    <th>Email Id</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                </tr>
                <?php
                    while ($result_student = mysqli_fetch_array($signup_student)) {
                        echo "<tr>";
                        echo "<td>".$result_student['sl_no']."</td>";
                        echo "<td>".$result_student['name']."</td>";
                        ?>
                        <td><a href="mailto:<?php echo $result_student["email"] ?>"><?php echo $result_student["email"]; ?></a></td>
                        <?php
                        echo "<td>".$result_student['phNumber']."</td>";
                        echo "<td>".$result_student['gender']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    <div id="contact_us_details" class="table-responsive">
        <h2 class="my-4">Contact Us Student Details</h2>
        <div class="column">

            <table class="table table-bordered table-hover">
                <tr class="table-info">
                    <th>Sl No.</th>
                    <th>Student Name</th>
                    <th>Email Id</th>
                    <th>Phone Number</th>
                    <th>About</th>
                    <th>Gender</th>
                </tr>
                <?php
                    while ($result_contact_us_student = mysqli_fetch_array($contact_us_student)) {
                        echo "<tr>";
                        echo "<td>".$result_contact_us_student['sl_no']."</td>";
                        echo "<td>".$result_contact_us_student['name']."</td>";
                        ?>
                        <td><a href="mailto:<?php echo $result_contact_us_student["email"]; ?>"><?php echo $result_contact_us_student["email"]; ?></a></td>
                        <?php
                        echo "<td>".$result_contact_us_student['phone_number']."</td>";
                        echo "<td>".$result_contact_us_student['about']."</td>";
                        echo "<td>".$result_contact_us_student['Gender']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<!-- Home Page End -->