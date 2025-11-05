<?php
require '../Includes/connection.php';
include('../Includes/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UPDATE</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style.css" />
</head>

<body class="main-1">
  <div class="container-fluid">
    <!--------------------------------------------------------------------------COURSES----------------------------------------------------------------------->
    <form action="" method="post" class="my-3">
      <div class="formContainer">
        <h2>Remove Courses</h2>
        <!--------------------------------------------------------------------------FACULTY----------------------------------------------------------------------->
        <h3>Faculty Details</h3>
        <table>
          <thead>
            <tr>
              <th>Faculty ID</th>
              <th>Faculty</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $selectQuery = "SELECT `faculty_id`, `facultyName` FROM `faculty`";
            $runner = mysqli_query($con, $selectQuery);
            while ($row = mysqli_fetch_assoc($runner)) {
              echo "
                <tr>
                  <td>" . $row['faculty_id'] . "</td>
                  <td>" . $row['facultyName'] . "</td>
                </tr>
              ";
            }
            ?>
          </tbody>
        </table>
        <label for="fid">Faculty ID</label>
        <input
          type="text"
          name="fid"
          id="fid"
          placeholder="Faculty of Applied Sciences -> FAS" />
        <button type="submit" name="cb-1" class="btn btn-dark cb-1 delete">
          Delete Faculty
        </button>
        <?php
        if (isset($_POST['cb-1'])) {
          $fid = $_POST['fid'];
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          try {
            $deleteQuery = "DELETE FROM `faculty` WHERE `faculty_id`='$fid'";
            mysqli_query($con, $deleteQuery);
            notify($message = ["success" => "A FACULTY REMOVED"], "success");
          } catch (mysqli_sql_exception $e) {
            notify($message = ["warning" => "YOU CAN NOT DELETE A FACULTY THAT STUDENTS ARE STUDYING"], "warning");
          }
        }
        ?>
        <!--------------------------------------------------------------------------DEPARTMENT----------------------------------------------------------------------->
        <h3>Delete Department</h3>
        <label for="did">Department ID</label>
        <input
          type="text"
          name="did"
          id="did"
          placeholder="Physical Sciences and Technology->APP" />
        <button type="submit" name="cb-2" class="btn btn-dark cb-2">
          Delete Department
        </button>
        <?php
        if (isset($_POST['cb-2'])) {
          $did = $_POST['did'];
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          try {
            $deleteQuery = "DELETE FROM `department` WHERE `department_id`='$did'";
            mysqli_query($con, $deleteQuery);
            notify($message = ["success" => "A DEPARTMENT REMOVED"], "success");
          } catch (mysqli_sql_exception $e) {
            notify($message = ["success" => "YOU CAN NOT DELETE A DEPARTMENT THAT STUDENTS ARE STUDYING"], "success");
          }
        }
        ?>
        <!--------------------------------------------------------------------------SUBJECTS----------------------------------------------------------------------->
        <h3>Delete Subject</h3>
        <!--subjects-->
        <label for="sid">Subject ID</label>
        <input type="text" name="sid" id="sid" />
        <button type="submit" name="cb-3" class="btn btn-dark cb-3">
          Delete Subject
        </button>
        <?php
        if (isset($_POST['cb-3'])) {
          $sid = $_POST['sid'];
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          try {
            $deleteQuery = "DELETE FROM `subject` WHERE `subject_id`='$sid'";
            mysqli_query($con, $deleteQuery);
            notify($message = ["success" => "A SUBJECT REMOVED"], "success");
          } catch (mysqli_sql_exception $e) {
            notify($message = ["success" => "YOU CAN NOT DELETE A SUBJECT THAT STUDENTS ARE STUDYING"], "success");
          }
        }
        ?>
      </div>
    </form>
    <!--------------------------------------------------------------------------/COURSES----------------------------------------------------------------------->
    <form action="" method="post" class="my-3">
      <div class="formContainer">
        <!--------------------------------------------------------------------------STUDENTS----------------------------------------------------------------------->
        <h2 id="std-panel">Student Removing Panel</h2>
        <!--Name-->
        <label for="stdID">Student ID</label>
        <input type="text" name="stdID" id="stdID" />
        <button type="submit" name="submit-A" class="btn btn-dark submit-A delete">
          Delete Student Data
        </button>
        <?php
        if (isset($_POST['submit-A'])) {
          $stdID = $_POST['stdID'];
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          try {
            $selectQuery = "SELECT * FROM `studets` WHERE `stdID`='$stdID'";
            $result = mysqli_query($con, $selectQuery);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            $fileName = $row['profile_pic_path'] ?? "";
            if ($count > 0) {
              $deleteQuery = "DELETE FROM `studets` WHERE `stdID`='$stdID'";
              mysqli_query($con, $deleteQuery);
              unlink("../Dynamic images/students/{$fileName}");
              notify($message = ["success" => "A STUDENT REMOVED"], "success");
            } else {
              notify($message = ["success" => strtoupper("There is no such student recode in database!")], "success");
            }
          } catch (mysqli_sql_exception $e) {
            notify($message = ["success" => "DELETE THE STUDENT ACCOUNT BEFORE REMOVE THEM"], "success");
          }
        }
        ?>
      </div>
      <!--------------------------------------------------------------------------/STUDENTS----------------------------------------------------------------------->
    </form>
    <form action="" method="post" class="my-3">
      <!--------------------------------------------------------------------------Student Account----------------------------------------------------------------------->
      <div class="formContainer">
        <h2 id="std-panel1">Student Account Removing Panel</h2>
        <label for="stdID">Stuednt ID</label>
        <input type="text" name="stdID" id="stdID" />
        <button type="submit" name="submit-A1" class="btn btn-dark submit-A1">
          Delete Account
        </button>
        <?php
        if (isset($_POST['submit-A1'])) {
          $stdID = $_POST['stdID'];
          $deleteQuery = "DELETE FROM `studentaccount` WHERE `stdID`='$stdID'";
          $status = mysqli_query($con, $deleteQuery);
          notify($message = ["success" => "ACCOUNT REMOVED"], "success");
        }
        ?>
      </div>
      <!--------------------------------------------------------------------------/Student Account----------------------------------------------------------------------->
    </form>
    </form>
    <form action="" method="post" class="my-3">
      <!--------------------------------------------------------------------------STAFFS----------------------------------------------------------------------->
      <div class="formContainer">
        <h2 id="lc-panel">Staff Removing Panal</h2>
        <label for="stfID">Staff ID</label>
        <input type="text" name="stfID" id="stfID" />
        <button type="submit" name="submit-B" class="btn btn-dark submit-B">
          Delete Staff
        </button>
        <?php
        if (isset($_POST['submit-B'])) {
          $stfID = $_POST['stfID'];
          $selectQuery = "SELECT `staffID`, `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role` FROM `staffs` WHERE `staffID`='$stfID'";
          $count = mysqli_num_rows(mysqli_query($con, $selectQuery));
          if ($count > 0) {
            $deleteQuery = "DELETE FROM `staffs` WHERE `staffID`='$stfID'";
            mysqli_query($con, $deleteQuery);
            notify($message = ["success" => "A STAFF REMOVED"], "success");
          } else {
            notify($message = ["success" => strtoupper("There is no such staff recode in database!")], "success");
          }
        }
        ?>
      </div>
      <!--------------------------------------------------------------------------/STAFFS----------------------------------------------------------------------->
    </form>
  </div>
  <script src="../JavaScript/function.js"></script>
</body>

</html>