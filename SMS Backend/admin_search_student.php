<?php

require_once("config.php");

$value = $_GET['input'];

$result = mysqli_query($conn, "SELECT * FROM student_details WHERE student_id = '$value' OR email = '$value' OR class = '$value' OR phone_Number = '$value' OR 	roll_no = '$value';");


?>

<style>
  .th {
    font-size: smaller;
    text-align: center;
  }

  .td {
    font-size: smaller;
    text-align: center;
  }

  a {
    cursor: pointer;
  }
</style>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-info">
      <tr>
        <th class="th">Student ID</th>
        <th class="th">Roll No</th>
        <th class="th">Student Name</th>
        <th class="th">Email ID</th>
        <th class="th">Date of Admission</th>
        <th class="th">Class</th>
        <th class="th">Phone Number</th>
        <th class="th">Gender</th>
        <th class="th">Date of Birth</th>
        <th class="th">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
        <td class="td">
          <?php echo $row['student_id']; ?>
        </td>
        <td class="td">
          <?php echo $row['roll_no']; ?>
        </td>
        <td class="td">
          <?php echo $row['name']; ?>
        </td>
        <td class="td">
          <?php echo $row['email']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_admission']; ?>
        </td>
        <td class="td">
          <?php echo $row['class']; ?>
        </td>
        <td class="td">
          <?php echo $row['phone_Number']; ?>
        </td>
        <td class="td">
          <?php echo $row['gender']; ?>
        </td>
        <td class="td">
          <?php echo $row['dob']; ?>
        </td>
        <td class="td">
          <?php echo $row['status']; ?>
        </td>
      </tr>

      <?php
      }

      ?>

    </tbody>
  </table>
</div>

<script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>