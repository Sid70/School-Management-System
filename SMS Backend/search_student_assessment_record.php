<?php

require_once("config.php");

$value = $_GET['input'];

$combine_result = mysqli_query($conn, "SELECT student_details.student_id AS student_id , student_details.roll_no AS roll_no , student_details_those_are_passed_from_class_11.previous_class AS previous_class , student_details.name AS name , student_details.email AS email , exam_summary.percentage_endterm AS class11_endterm_percentage , exam_summary.grade_endterm AS class_11_Endterm_Grade , exam_summary.status AS class_11_status , student_details.class AS class , exam_summary_class_12.total_1st_internal AS total_1st_internal , exam_summary_class_12.percentage_1st_internal AS percentage_1st_internal , exam_summary_class_12.grade_1st_internal AS internal_1st_grade , exam_summary_class_12.total_2nd_internal AS total_2nd_internal , exam_summary_class_12.percentage_2nd_internal AS percentage_2nd_internal , exam_summary_class_12.grade_2nd_internal AS  grade_2nd_internal , exam_summary_class_12.total_endterm AS total_endterm , exam_summary_class_12.percentage_endterm AS percentage_endterm , exam_summary_class_12.grade_endterm AS grade_endterm , exam_summary_class_12.status AS status FROM student_details JOIN exam_summary ON student_details.student_id = exam_summary.id JOIN student_details_those_are_passed_from_class_11 ON student_details.student_id = student_details_those_are_passed_from_class_11.student_id JOIN exam_summary_class_12 ON student_details.student_id = exam_summary_class_12.id WHERE exam_summary.id = '$value' OR exam_summary.roll_no = '$value' OR student_details.email = '$value';");

// $result = mysqli_query($conn, "SELECT * FROM student_details JOIN exam_summary ON student_details.student_id = exam_summary.id WHERE student_details.student_id = '$value' OR student_details.roll_no = '$value' OR student_details.email = '$value';");

if ($value == '11' )
{
  $result = mysqli_query($conn, "SELECT * FROM student_details JOIN exam_summary ON student_details.student_id = exam_summary.id WHERE student_details.class = '11';");

  ?>

    <style>
      .th ,.td {
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
            <th class="th">Class</th>
            <th class="th">Student Name</th>
            <th class="th">Email ID</th>
            <th class="th">1st Internal Total</th>
            <th class="th">1st Internal Percentage</th>
            <th class="th">2nd Internal Total</th>
            <th class="th">2nd Internal Percentage</th>
            <th class="th">Endterm Total</th>
            <th class="th">Endterm Percentage</th>
            <th class="th">Endterm Grade</th>
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
              <?php echo $row['class']; ?>
            </td>
            <td class="td">
              <?php echo $row['name']; ?>
            </td>
            <td class="td">
              <?php echo $row['email']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_1st_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_1st_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_2nd_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_2nd_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_endterm']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_endterm']; ?>
            </td>
            <td class="td">
              <?php echo $row['grade_endterm']; ?>
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
  
  <?php
}

elseif ($value == '12' )
{
  $result = mysqli_query($conn, "SELECT * FROM student_details JOIN exam_summary_class_12 ON student_details.student_id = exam_summary_class_12.id WHERE student_details.class = '12';");

  ?>

    <style>
      .th,.td {
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
            <th class="th">Class</th>
            <th class="th">Student Name</th>
            <th class="th">Email ID</th>
            <th class="th">1st Internal Total</th>
            <th class="th">1st Internal Percentage</th>
            <th class="th">2nd Internal Total</th>
            <th class="th">2nd Internal Percentage</th>
            <th class="th">Endterm Total</th>
            <th class="th">Endterm Percentage</th>
            <th class="th">Endterm Grade</th>
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
              <?php echo $row['class']; ?>
            </td>
            <td class="td">
              <?php echo $row['name']; ?>
            </td>
            <td class="td">
              <?php echo $row['email']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_1st_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_1st_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_2nd_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_2nd_internal']; ?>
            </td>
            <td class="td">
              <?php echo $row['total_endterm']; ?>
            </td>
            <td class="td">
              <?php echo $row['percentage_endterm']; ?>
            </td>
            <td class="td">
              <?php echo $row['grade_endterm']; ?>
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
<?php

}
else
{
?>
<style>
  .th,.td {
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
        <th class="th">Privious Class</th>
        <th class="th">Student Name</th>
        <th class="th">Email ID</th>
        <th class="th">Endterm Percentage</th>
        <th class="th">Endterm Grade</th>
        <th class="th">Status</th>
        <th class="th">Next Class</th>
        <th class="th">1st Internal Total</th>
        <th class="th">1st Internal Percentage</th>
        <th class="th">1st Internal Grade</th>
        <th class="th">2nd Internal Total</th>
        <th class="th">2nd Internal Percentage</th>
        <th class="th">2nd Internal Grade</th>
        <th class="th">Endterm Total</th>
        <th class="th">Endterm Percentage</th>
        <th class="th">Endterm Grade</th>
        <th class="th">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_array($combine_result)) {
      ?>
      <tr>
        <td class="td">
          <?php echo $row['student_id']; ?>
        </td>
        <td class="td">
          <?php echo $row['roll_no']; ?>
        </td>
        <td class="td">
          <?php echo $row['previous_class']; ?>
        </td>
        <td class="td">
          <?php echo $row['name']; ?>
        </td>
        <td class="td">
          <?php echo $row['email']; ?>
        </td>
        <td class="td">
          <?php echo $row['class11_endterm_percentage']; ?>
        </td>
        <td class="td">
          <?php echo $row['class_11_Endterm_Grade']; ?>
        </td>
        <td class="td">
          <?php echo $row['class_11_status']; ?>
        </td>
        <td class="td">
          <?php echo '12'; ?>
        </td>
        <td class="td">
          <?php echo $row['total_1st_internal']; ?>
        </td>
        <td class="td">
          <?php echo $row['percentage_1st_internal']; ?>
        </td>
        <td class="td">
          <?php echo $row['internal_1st_grade']; ?>
        </td>
        <td class="td">
          <?php echo $row['total_2nd_internal']; ?>
        </td>
        <td class="td">
          <?php echo $row['percentage_2nd_internal']; ?>
        </td>
        <td class="td">
          <?php echo $row['grade_2nd_internal']; ?>
        </td>
        <td class="td">
          <?php echo $row['total_endterm']; ?>
        </td>
        <td class="td">
          <?php echo $row['percentage_endterm']; ?>
        </td>
        <td class="td">
          <?php echo $row['grade_endterm']; ?>
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

<?php
}
?>
