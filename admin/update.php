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
  <style>
    /* body {
        display: block;
        margin: 0px;
        padding: 0px;
      } */
  </style>
</head>

<body class="main-1">
  <div class="container-fluid">
    <!--------------------------------------------------------------------------COURSES----------------------------------------------------------------------->
    <form action="" method="post" class="my-3">
      <div class="formContainer">
        <h2>Edit Courses</h2>
        <!--------------------------------------------------------------------------FACULTY----------------------------------------------------------------------->
        <h3>Edit Faculty</h3>
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
          class="mustFILL FACULTY"
          placeholder="Faculty of Applied Sciences -> FAS" />
        <label for="faculty1">Faculty</label>
        <input type="text" name="faculty1" id="faculty1" class="mustFILL FACULTY" />
        <button type="submit" name="cb-1" class="btn btn-dark cb-1 submitButton" data-section="FACULTY">
          Update
        </button>
        <?php
        $fid = $faculty = "";
        if (isset($_POST['cb-1'])) {
          $fid = $_POST['fid'];
          $faculty = $_POST['faculty1'];
          $updateQuery = "UPDATE `faculty` SET `facultyName`='$faculty' WHERE `faculty_id`='$fid'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => "FACULTY NAME UPDATED (Click the Side bar Update Button to see the tabel preview)"], "success");
        }
        ?>
        <!--------------------------------------------------------------------------DEPARTMENT----------------------------------------------------------------------->
        <h3>Edit Department</h3>
        <label for="did">Department ID</label>
        <input
          type="text"
          name="did"
          id="did"
          class="mustFILL DEPARTMENT"
          placeholder="Physical Sciences and Technology->APP" />
        <label for="department">Department</label>
        <input type="text" name="department" id="department" class="mustFILL DEPARTMENT" />
        <button type="submit" name="cb-2" class="btn btn-dark cb-2 submitButton" data-section="DEPARTMENT">
          Update
        </button>
        <?php
        $did = $department = "";
        if (isset($_POST['cb-2'])) {
          $did = $_POST['did'];
          $department = $_POST['department'];
          $updateQuery = "UPDATE `department` SET `department_name`='$department' WHERE `department_id`='$did'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => "DEPARMENT NAME UPDATED"], "success");
        }
        ?>
        <!--------------------------------------------------------------------------SUBJECTS----------------------------------------------------------------------->
        <h3>Edit Subject</h3>
        <!--subjects-->
        <label for="sid" class="SID">Subject ID</label>
        <input type="text" name="sid" id="sid" class="SID primaryKey SUBJECT" />
        <label for="subjectyear">Change Year</label>
        <select name="subjectyear" id="subjectyear" class="subForm SUBJECT">
          <option value="0">Select a Year</option>
          <option value="1">1st Year</option>
          <option value="2">2nd Year</option>
          <option value="3">3rd Year</option>
          <option value="4">4th Year</option>
        </select>
        <label for="subjectSem">Change Semester</label>
        <select name="subjectSem" id="subjectSem" class="subForm SUBJECT">
          <option value="0">Select a Semester</option>
          <option value="1">1st Semester</option>
          <option value="2">2nd Semester</option>
        </select>
        <label for="dob">Subjects</label>
        <input
          type="text"
          name="subjects"
          id="subjects"
          placeholder="Edit Subject Name"
          class="subForm SUBJECT" />
        <button type="submit" name="cb-3" class="btn btn-dark cb-3 submitButton_U" data-section="SUBJECT">
          Update
        </button>
      </div>
      <?php
      $sid = $year = $sem = $sub = "";
      if (isset($_POST['cb-3'])) {
        $sid = $_POST['sid'];
        $year = $_POST['subjectyear'];
        $sem = $_POST['subjectSem'];
        $sub = $_POST['subjects'];
        if ($year) {
          $updateQuery = "UPDATE `subject` SET `Year`='$year' WHERE `subject_id`='$sid'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Subject Year Updated")], "success");
        }
        if ($sem) {
          $updateQuery = "UPDATE `subject` SET `semester`='$sem' WHERE `subject_id`='$sid'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Subject Semester Updated")], "success");
        }
        if ($sub) {
          $updateQuery = "UPDATE `subject` SET `subject_name`='$sub' WHERE `subject_id`='$sid'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Subject Name Updated")], "success");
        }
      }
      ?>
    </form>
    <!--PHP REQUIRED FOR GENERATE SUBJECT ID-->
    <!--------------------------------------------------------------------------/COURSES----------------------------------------------------------------------->
    <form action="" method="post" class="my-3 STUDENTS" enctype="multipart/form-data">
      <div class="formContainer">
        <!--------------------------------------------------------------------------STUDENTS----------------------------------------------------------------------->
        <h2 id="std-panel">Student Details Editing Panel</h2>
        <!--Name-->
        <label for="stdID">Student ID</label>
        <input class="subForm primaryKey STUDENTS" type="text" name="stdID" id="stdID" />
        <label for="fname">First Name</label>
        <input class="subForm STUDENTS" type="text" name="fname" id="fname" />
        <label for="lname">Last Name</label>
        <input class="subForm STUDENTS" type="text" name="lname" id="lname" />
        <!--DOB-->
        <label for="dob">Date of birth</label>
        <input class="subForm STUDENTS" type="date" name="dob" id="dob" />
        <!--NIC-->
        <label for="nic">NIC</label>
        <input class="subForm STUDENTS" type="number" name="nic" id="nic" />
        <!--mail-->
        <label for="email">Email</label>
        <input class="subForm STUDENTS" type="email" name="email" id="email" />
        <!--Gender-->
        <label>Gender</label>
        <div class="gender-radio d-flex align-items-center">
          <input type="radio" name="gender" id="male-std" value="male" />
          <label class="pe-5 ps-2" for="male-std">Male</label>
          <input type="radio" name="gender" id="female-std" value="female" />
          <label class="pe-5 ps-2" for="female-std">Female</label>
        </div>
        <!--FACULTY-->
        <label for="facultySelection3">Faculty</label>
        <select
          name="facultySelection3"
          id="facultySelection3"
          onchange="inputbarEnabler();departmentSelectUpdator('facultySelection3','DepartmentSelector1');"
          class="subForm STUDENTS">
          <?php
          echo "<option value='0' selected hidden>Select a Faculty before select any Department</option>";
          facultySelectOptions($con);
          ?>
        </select>
        <!--Academic Year-->
        <?php
        $today = date_create(date("Y-m-d"));
        $date1 = date_format(date_modify($today, "-1 years"), "y");
        $date2 = date_format(date_modify($today, "-1 years"), "y");
        $date3 = date_format(date_modify($today, "-1 years"), "y");
        $date4 = date_format(date_modify($today, "-1 years"), "y");
        $date5 = date_format(date_modify($today, "-1 years"), "y");
        $date6 = date_format(date_modify($today, "-1 years"), "y");
        ?>
        <label for="aYear">Academic Year</label>
        <select name="aYear" id="aYear" class="subForm STUDENTS">
          <option value="0" selected>Select Year</option>
          <?php
          echo "
          <option value='$date2/$date1'>$date2/$date1</option>
          <option value='$date3/$date2'>$date3/$date2</option>
          <option value='$date4/$date3'>$date4/$date3</option>
          <option value='$date5/$date4'>$date5/$date4</option>
          <option value='$date6/$date4'>$date6/$date5</option>
          ";
          ?>
        </select>
        <!--give value="did(department ID)"-->
        <label for="DepartmentSelector1">Department</label>
        <select
          name="DepartmentSelector1"
          id="DepartmentSelector1"
          onchange="inputbarEnabler()"
          class="subForm STUDENTS">
          <option value="0" selected>Select a Department</option>
        </select>
        <label for="prof-std">Upload an Image</label>
        <input type="file" name="prof-std" id="prof-std" class="subForm STUDENTS" />
        <button type="submit" name="submit-A" class="btn btn-dark submit-A submitButton_U" data-section="STUDENTS">
          Update
        </button>
      </div>
      <?php
      $stdID = $fname = $lname = $dob = $nic = $email = $gender =  $faculty = $aYear = $Department = $profPic = "";
      if (isset($_POST['submit-A'])) {
        $stdID = $_POST['stdID'];
        $selectQuery = "SELECT * FROM `studets` WHERE `stdID`='$stdID'";
        $runner = mysqli_query($con, $selectQuery);
        $row  = mysqli_fetch_assoc($runner);
        if ($fname = $_POST['fname']) {
          $updateQuery = "UPDATE `studets` SET `std_fname`='$fname' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student First Name Updated")], "success");
        }
        if ($lname = $_POST['lname']) {
          $updateQuery = "UPDATE `studets` SET `std_lname`='$lname' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Last Name Updated")], "success");
        }
        if ($dob = $_POST['dob']) {
          $updateQuery = "UPDATE `studets` SET `std_dob`='$dob' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Date of Birth Updated")], "success");
        }
        if ($nic = $_POST['nic']) {
          $updateQuery = "UPDATE `studets` SET `nic`='$nic' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student NIC Updated")], "success");
        }
        if ($email = $_POST['email']) {
          $updateQuery = "UPDATE `studets` SET `email`='$email' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Email Updated")], "success");
        }
        if ($gender = $_POST['gender'] ?? "") {
          $updateQuery = "UPDATE `studets` SET `gender`='$gender' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Gender Updated")], "success");
        }
        if ($faculty = $_POST['facultySelection3']) {
          $newStdID = stdID($row['department_id'], $faculty, $row['aYear']);
          $updateQuery = "UPDATE `studets` SET `stdID`='$newStdID', `faculty_id`='$faculty' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Faculty Updated")], "success");
        }
        if ($aYear = $_POST['aYear']) {
          $newStdID = stdID($row['department_id'], $row['faculty_id'], $aYear);
          $updateQuery = "UPDATE `studets` SET `stdID`='$newStdID', `aYear`='$aYear' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student Academic Year Updated")], "success");
        }
        if ($Department = $_POST['DepartmentSelector1']) {
          $newStdID = stdID($Department, $row['faculty_id'], $row['aYear']);
          $updateQuery = "UPDATE `studets` SET `stdID`='$newStdID', `department_id`='$Department' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Students Department Updated")], "success");
        }
        if ($fname = $_POST['fname'] || $lname = $_POST['lname'] || $_FILES['prof-std']) {
          if ($fname = $_POST['fname'] || $lname = $_POST['lname']) {
            $imgNameArr = explode(".", $row['profile_pic_path']);
            $ext = $imgNameArr[sizeof($imgNameArr) - 1];
            $picName = $fname . $lname . "_" . $stdID . "." . $ext;
            if ($fname = $_POST['fname']) {
              $picName = $fname . "_" . $stdID . "." . $ext;
            } else if ($lname = $_POST['lname']) {
              $picName = $lname . "_" . $stdID . "." . $ext;
            }
            rename("../Dynamic images/students/{$row['profile_pic_path']}", "../Dynamic images/students/$picName");
            $updateQuery = "UPDATE `studets` SET `profile_pic_path`='$picName' WHERE `stdID`='$stdID'";
            mysqli_query($con, $updateQuery);
          }
          if ($img_name = $_FILES['prof-std']['name']) {
            $img_temp_path = $_FILES['prof-std']['tmp_name'];
            $imgNameArr = explode(".", $img_name);
            $ext = $imgNameArr[sizeof($imgNameArr) - 1];
            $profil_pic_name =  $row['profile_pic_path'];
            $profil_pic_path = "../Dynamic images/students/$profil_pic_name";
            $dir = dirname($profil_pic_path);
            if (!is_dir($dir)) {
              mkdir($dir, 0777, true);
            }
            if (in_array(strtolower($ext), ["png", "jpg", "jpeg"])) {
              move_uploaded_file($img_temp_path, $profil_pic_path);
              notify($message = ["success" => "STUDENT PROFILE PICTURE UPDATED"], "success");
            } else if ($ext == "") {
              return;
            } else {
              notify($message = ["success" => "UPLOADED FILE IS NOT AN IMAGE!"], "success");
            }
          }
        }
      }
      ?>
      <!--PHP REQUIRED FOR GENERATE SUBJECT ID-->
      <!--------------------------------------------------------------------------/STUDENTS----------------------------------------------------------------------->
    </form>
    <form action="" method="post" class="my-3" enctype="multipart/form-data">
      <!--------------------------------------------------------------------------STAFFS----------------------------------------------------------------------->
      <div class="formContainer">
        <h2 id="lc-panel">Staff Details Editing Panel</h2>
        <label for="stfID">Staff ID</label>
        <input type="text" name="stfID" id="stfID" class="primaryKey STAFFS" />
        <!--Name-->
        <label for="fname_L">First Name</label>
        <input type="text" name="fname_L" id="fname_L" class="subForm STAFFS" />
        <label for="lname_L">Last Name</label>
        <input class="subForm STAFFS" type="text" name="lname_L" id="lname_L" />
        <!--DOB-->
        <label for="dob_L">Date of birth</label>
        <input class="subForm STAFFS" type="date" name="dob_L" id="dob_L" />
        <!--NIC-->
        <label for="nic_L">NIC</label>
        <input class="subForm STAFFS" type="number" name="nic_L" id="nic_L" />
        <!--mail-->
        <label for="email_L">Email</label>
        <input class="subForm STAFFS" type="email" name="email_L" id="email_L" />
        <!--Gender-->
        <label>Gender</label>
        <div class="gender-radio d-flex align-items-center">
          <input class="subForm STAFFS" type="radio" name="gender" id="male_lec" value="male" />
          <label class="pe-5 ps-2" for="male_lec">Male</label>
          <input class="subForm STAFFS" type="radio" name="gender" id="female_lec" value="female" />
          <label class="pe-5 ps-2" for="female_lec">Female</label>
        </div>
        <!--Profile pic-->
        <label for="prof_lc">Upload an Image</label>
        <input class="subForm STAFFS" type="file" name="prof_lc" id="prof_lc" title="only PNG, JPG & JPEG allowed" />
        <!--Role-->
        <?php
        $selectQuery = "SELECT `status_ID`, `Academic_role`, `NON_Academic_role` FROM `role`";
        $runner1 = mysqli_query($con, $selectQuery);
        $runner2 = mysqli_query($con, $selectQuery);
        ?>
        <label for="role" class="role">Role</label>
        <select name="role" id="role" onchange="selectFunction1()" class="subForm STAFFS">
          <option value="#" selected>Select a role</option>
          <option value="Academic">Academic Staff</option>
          <option value="NON-Academic">NON-Academic Staff</option>
        </select>
        <!--academic-Role-->
        <select name="role_A" id="role-A" onchange="selectFunction1()">
          <option value="#" selected hidden>Select the Academic role</option>
          <?php
          while ($row = mysqli_fetch_assoc($runner1)) {
            echo "<option value='{$row['status_ID']}'>{$row['Academic_role']}</option>";
          }
          ?>
        </select>
        <!--NON-academic-Role-->
        <select name="role_NA" id="role-NA">
          <option value="#" selected hidden>Select the Non-Academic role</option>
          <?php
          while ($row = mysqli_fetch_assoc($runner2)) {
            echo "<option value='{$row['status_ID']}'>{$row['NON_Academic_role']}</option>";
          }
          ?>
        </select>
        <button type="submit" name="submit_B" class="btn btn-dark submit-B submitButton_U" data-section="STAFFS">
          Update
        </button>
      </div>
    </form>
    <?php
    $stfID = $fname_L = $lname_L = $dob_L = $nic_L = $email_L = $gender = $prof_lc = $role = $role_A = $role_NA = "";
    if (isset($_POST['stfID'])) {
      $stfID = $_POST['stfID'];
      //Getting data from DB-------------------->
      $selectQuery = "SELECT * FROM `staffs` WHERE `staffID`='$stfID'";
      $result = mysqli_query($con, $selectQuery);
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        $FNAME = !empty($fname_L) ? $fname_L : $row['staff_fname'];
        $LNAME = !empty($lname_L) ? $lname_L : $row['staff_lname'];
        $GENDER = !empty($gender) ? $gender : $row['gender'];
      } else {
        notify($message = ["waning" => "YOUR FIELDS ARE EMPTY!"], "waning");
      }
      if ($_POST['role'] != "#") {
        $ROLE = $_POST['role'];
        if ($_POST['role_A'] != "#") {
          $SUB_ROLE = $_POST['role_A'];
        } else {
          if ($_POST['role_NA'] != "#") {
            $SUB_ROLE = $_POST['role_NA'];
          } else {
            $SUB_ROLE = $row['sub_role'];
          }
        }
      } else {
        $ROLE = $row['role'] ?? "";
        $SUB_ROLE = $row['sub_role'] ?? "";
      }
      $oldImageFileName = $row['profile_pic'] ?? "";
      $imgNameArr = explode(".", $oldImageFileName);
      $ext = $imgNameArr[sizeof($imgNameArr) - 1];
      $ID = stfID($FNAME ?? "", $LNAME ?? "", $GENDER ?? "", $ROLE ?? "", $SUB_ROLE ?? "");
      //Getting data from DB-------------------->
      if (!empty($_POST['fname_L']) && !empty($_POST['lname_L'])) {
        $fname_L = $_POST['fname_L'];
        $lname_L = $_POST['lname_L'];
        $ID = stfID($fname_L, $lname_L, $GENDER, $ROLE, $SUB_ROLE);
        $IMG_FILE_NAME = $fname_L . $lname_L . $ID . "." . $ext;
        $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `staff_fname`='$fname_L', `staff_lname`='$lname_L', `profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        staffImageFileRenamer($ID, $fname_L, $lname_L, $ext, $oldImageFileName);
        notify($message = ["success" => "STAFFS FIRST AND LAST NAME UPDATED"], "success");
      } else if (!empty($_POST['fname_L'])) {
        // update only firstname
        $fname_L = $_POST['fname_L'];
        $ID = stfID($fname_L, $LNAME, $GENDER, $ROLE, $SUB_ROLE);
        $IMG_FILE_NAME = $fname_L . $LNAME . $ID . "." . $ext;
        $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `staff_fname`='$fname_L', `profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        staffImageFileRenamer($ID, $fname_L, $LNAME, $ext, $oldImageFileName);
        notify($message = ["success" => "STAFFS FIRST NAME UPDATED"], "success");
      } else if (!empty($_POST['lname_L'])) {
        // update only lastname
        $lname_L = $_POST['lname_L'];
        $ID = stfID($FNAME, $lname_L, $GENDER, $ROLE, $SUB_ROLE);
        $IMG_FILE_NAME = $FNAME . $lname_L . $ID . "." . $ext;
        $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `staff_lname`='$lname_L', `profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        staffImageFileRenamer($ID, $FNAME, $lname_L, $ext, $oldImageFileName);
        notify($message = ["success" => "STAFFS LAST NAME UPDATED"], "success");
      }
      if ($dob_L = $_POST['dob_L']) {
        $updateQuery = "UPDATE `staffs` SET `dob`='$dob_L' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        notify($message = ["success" => "STAFFS DATE OF BIRTH NAME UPDATED"], "success");
      }
      if ($nic_L = $_POST['nic_L']) {
        $updateQuery = "UPDATE `staffs` SET `nic`='$nic_L' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        notify($message = ["success" => "STAFFS NIC UPDATED"], "success");
      }
      if ($email_L = $_POST['email_L']) {
        $updateQuery = "UPDATE `staffs` SET `mail`='$email_L' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        notify($message = ["success" => "STAFFS EMAIL ADDRESS UPDATED"], "success");
      }
      if ($gender = $_POST['gender'] ?? "") {
        $ID = stfID($row['staff_fname'], $row['staff_lname'], $gender,  $row['role'], $row['sub_role']);
        $IMG_FILE_NAME =  $row['staff_fname'] . $row['staff_lname'] . $ID . "." . $ext;
        $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `gender`='$gender',`profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
        mysqli_query($con, $updateQuery);
        staffImageFileRenamer($ID, $row['staff_fname'], $row['staff_lname'], $ext, $oldImageFileName);
        notify($message = ["success" => "STAFFS GENDER UPDATED"], "success");
      }
      if ($_POST['role'] != "#") {
        $role = $_POST['role'];
        mysqli_query($con, $updateQuery);
        staffImageFileRenamer($ID, $row['staff_fname'], $row['staff_lname'], $ext, $oldImageFileName);
        if ($_POST['role_A'] != "#") {
          $role_A = $_POST['role_A'];
          $ID = stfID($row['staff_fname'], $row['staff_lname'], $row['gender'], $role, $role_A);
          $IMG_FILE_NAME =  $row['staff_fname'] . $row['staff_lname'] . $ID . "." . $ext;
          $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `role`='$role', `sub_role`='$role_NA',`profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
          mysqli_query($con, $updateQuery);
          staffImageFileRenamer($ID, $row['staff_fname'], $row['staff_lname'], $ext, $oldImageFileName);
          notify($message = ["success" => "STAFFS ACADEMIC ROLE UPDATED"], "success");
        } else if ($_POST['role_NA'] != "#") {
          $role_NA = $_POST['role_NA'];
          $ID = stfID($row['staff_fname'], $row['staff_lname'], $row['gender'], $role, $role_NA);
          $IMG_FILE_NAME = $FNAME . $LNAME . $ID . "." . $ext;
          $updateQuery = "UPDATE `staffs` SET `staffID`='$ID', `role`='$role', `sub_role`='$role_NA',`profile_pic`='$IMG_FILE_NAME' WHERE `staffID`='$stfID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => "STAFFS NON-ACADEMIC ROLE UPDATED"], "success");
        }
      }
      //IMAGE----------------------------------->
      if ($_FILES['prof_lc']['name'] != "") {
        $uploadedFile = $_FILES['prof_lc']['name'];
        $img_temp_path = $_FILES['prof_lc']['tmp_name']; //fileupload
        $imgNameArr = explode(".", $uploadedFile);
        $ext = $imgNameArr[sizeof($imgNameArr) - 1];
        if (!empty($_POST['fname_L']) || !empty($_POST['lname_L'])) {
          $IMG_FILE_NAME = $_POST['fname_L'] . $_POST['lname_L'] . $ID . "." . $ext;
          if (!empty($_POST['fname_L']) && empty($_POST['lname_L'])) {
            $IMG_FILE_NAME = $_POST['fname_L'] . $row['staff_lname'] . $ID . "." . $ext;
          } else if (!empty($_POST['lname_L']) && empty($_POST['fname_L'])) {
            $IMG_FILE_NAME = $row['staff_fname'] . $_POST['lname_L'] . $ID . "." . $ext;
          }
        } else if (empty($_POST['fname_L']) && empty($_POST['lname_L'])) {
          $IMG_FILE_NAME = $oldImageFileName;
        }
        $profil_pic_path = "../Dynamic images/staffs/$IMG_FILE_NAME"; //fileupload
        if (in_array(strtolower($ext), ["png", "jpg", "jpeg"])) {
          move_uploaded_file($img_temp_path, $profil_pic_path);
          notify($message = ["success" => "STAFFS PROFILE PICTURE UPDATED"], "success");
        } else if ($ext == "") {
          return;
        } else {
          notify($message = ["warning" => "UPLOADED FILE IS NOT AN IMAGE!"], "warning");
        }
      }
      //IMAGE----------------------------------->
    }
    ?>
    <!--------------------------------------------------------------------------/STAFFS----------------------------------------------------------------------->
  </div>
  <script src="../JavaScript/function.js"></script>
  <script>
    updateFormValidation();
  </script>
  <script>
  </script>
</body>

</html>