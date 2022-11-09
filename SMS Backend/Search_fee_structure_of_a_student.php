<?php

require_once("config.php");

$value = $_GET['input'];

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

<?php



$result = mysqli_query($conn, "SELECT * FROM fee_structure JOIN student_details ON student_details.student_id = fee_structure.id WHERE student_details.student_id = '$value' OR student_details.email = '$value' OR student_details.roll_no = '$value' OR student_details.phone_Number = '$value';");

if ($value == '12' )
{
  $result = mysqli_query($conn, "SELECT * FROM fee_structure_class_12 JOIN student_details ON student_details.student_id = fee_structure_class_12.id WHERE student_details.class = '$value';");
  ?>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-info">
      <tr>
        <th class="th">Student ID</th>
        <th class="th">Roll No</th>
        <th class="th">Student Name</th>
        <th class="th">Email ID</th>
        <th class="th">Type</th>
        <th class="th">Date of Hostel fee payment</th>
        <th class="th">Date of Accademic Fee Payment</th>
        <th class="th">Accademic Fee Status</th>
        <th class="th">Hostel Fee Status</th>
        <th class="th">Account Status</th>
      
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
          <?php echo $row['type']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_hostel_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_accademic_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['accademic_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['hostel_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['account_status']; ?>
        </td>
      </tr>

      <?php
      }

      ?>

    </tbody>
  </table>
</div>
      <?php
}
elseif ($value == '11' )
{
  $result = mysqli_query($conn, "SELECT * FROM fee_structure JOIN student_details ON student_details.student_id = fee_structure.id WHERE student_details.class = '$value';");
  ?>

  <div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-info">
      <tr>
        <th class="th">Student ID</th>
        <th class="th">Roll No</th>
        <th class="th">Student Name</th>
        <th class="th">Email ID</th>
        <th class="th">Type</th>
        <th class="th">Date of Hostel fee payment</th>
        <th class="th">Date of Accademic Fee Payment</th>
        <th class="th">Accademic Fee Status</th>
        <th class="th">Hostel Fee Status</th>
        <th class="th">Account Status</th>
      
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
          <?php echo $row['type']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_hostel_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_accademic_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['accademic_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['hostel_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['account_status']; ?>
        </td>
      </tr>

      <?php
      }

      ?>

    </tbody>
  </table>
</div>
<?php

}

else
{
  $class_11_fee_status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `fee_structure`;"));
  $result = mysqli_query($conn, "SELECT * FROM fee_structure_class_12 JOIN student_details ON student_details.student_id = fee_structure_class_12.id WHERE student_details.student_id = '$value' OR student_details.email = '$value' OR student_details.roll_no = '$value' OR student_details.phone_Number = '$value';");
  ?>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-info">
      <tr>
        <th class="th">Student ID</th>
        <th class="th">Roll No</th>
        <th class="th">Student Name</th>
        <th class="th">Email ID</th>
        <th class="th">Class</th>
        <th class="th">Class 11 Account Status</th>
        <th class="th">Next Class</th>
        <th class="th">Type</th>
        <th class="th">Date of Hostel fee payment</th>
        <th class="th">Date of Accademic Fee Payment</th>
        <th class="th">Accademic Fee Status</th>
        <th class="th">Hostel Fee Status</th>
        <th class="th">Class 12 Account Status</th>
      
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
          <?php echo '11'; ?>
        </td>
        <td class="td">
          <?php echo $class_11_fee_status['account_status']; ?>
        </td>
        <td class="td">
          <?php echo '12'; ?>
        </td>
        <td class="td">
          <?php echo $row['type']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_hostel_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['date_of_accademic_amount_payment']; ?>
        </td>
        <td class="td">
          <?php echo $row['accademic_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['hostel_fee_status']; ?>
        </td>
        <td class="td">
          <?php echo $row['account_status']; ?>
        </td>
      </tr>


      <?php
    }
}


?>


<script src="https://kit.fontawesome.com/6c4e89634a.js" crossorigin="anonymous"></script>