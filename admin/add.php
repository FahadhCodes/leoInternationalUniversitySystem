<?php
require '../Includes/connection.php';
include('../Includes/function.php');
?>
<?php
//this MUST maintained TOP
if (isset($_POST['facultyId']) && !empty($_POST['facultyId'])) {
  $fid = $_POST['facultyId'];
  $selectQuery = "SELECT * FROM `department` WHERE `faculty_id`='$fid'";
  $RUNNER = mysqli_query($con, $selectQuery);
  echo "<option value='0' selected hidden>Select a Department</option>";
  while ($row = mysqli_fetch_assoc($RUNNER)) {
    $output .= "<option value={$row['department_id']}>{$row['department_name']}</option>";
  }
  echo $output;
  exit();
}
?>
<?php
if (isset($_POST['departmentID'], $_POST['subjectYear'], $_POST['sem'])) {
  $DID = $_POST['departmentID'];
  $selectQuery = "SELECT `date`, `department_id`, `department_name`, `faculty_id` FROM `department` WHERE `department_id`='$DID'";
  $RUNNER = mysqli_query($con, $selectQuery);
  $row = mysqli_fetch_assoc($RUNNER);
  echo (subjectID($row['department_name'], $_POST['subjectYear'], $_POST['sem']));
  exit();
}
?>
<?php
if (isset($_POST['test'])) {
  echo $_POST['test'];
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADD</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
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
    <form class="my-3" method="post">
      <div class="formContainer">
        <h2>Add New Courses</h2>
        <!--------------------------------------------------------------------------FACULTY----------------------------------------------------------------------->
        <h3>Adding New Faculty</h3>
        <label for="fid">Faculty ID</label>
        <input
          class="mustFILL FACULTIES"
          type="text"
          name="fid"
          id="fid"
          placeholder="Faculty of Applied Sciences -> FAS" />
        <label for="faculty1">Faculty</label>
        <input type="text" name="faculty1" id="faculty1" class="mustFILL FACULTIES" />
        <button type="submit" name="cb-1" class="btn cb-1 submitButton" data-section="FACULTIES">
          Add
        </button>
        <!---------------------------------------PHP-------------------------------------------->
        <?php
        if (isset($_POST['cb-1'])) {
          $fid = $faculty = '';
          $fid = $_POST['fid'];
          $faculty = $_POST['faculty1'];
          if (!empty($fid) && !empty($faculty)) {
            $InsertQuery = "INSERT INTO `faculty`(`faculty_id`, `facultyName`) VALUES ('$fid','$faculty')";
            mysqli_query($con, $InsertQuery);
            notify($message = ["success" => "NEW FACULTY ADDED"], "success");
          } else {
            notify($message = ["danger" => "PLEASE FILL ALL THE RQUIRED INPUT FIELDS"], "danger");
          }
        }
        ?>
        <!---------------------------------------/PHP-------------------------------------------->
        <!--------------------------------------------------------------------------DEPARTMENT----------------------------------------------------------------------->
        <h3>Adding New Department</h3>
        <label for="facultySelection1">Faculty</label>
        <select
          name="facultySelection1"
          id="facultySelection1"
          onchange="inputbarEnabler()"
          class="mustFILL DEPARTMENT">
          <option value="0" selected hidden>Select a Faculty before add a Department</option>
          <?php
          facultySelectOptions($con);
          ?>
        </select>
        <label for="did" class="depa">Department ID</label>
        <input
          type="text"
          name="did"
          id="did"
          class="depa mustFILL DEPARTMENT"
          placeholder="Physical Sciences and Technology->APP" />
        <label for="department" class="depa">Department</label>
        <input type="text" name="department" id="department" class="depa mustFILL DEPARTMENT" />
        <button type="submit" name="cb-2" class="btn cb-2 submitButton alertTriggerbtn" data-section="DEPARTMENT">
          Add
        </button>
        <?php
        if (isset($_POST['cb-2'])) {
          $did = $department = $facultyID = '';

          $facultyID = $_POST['facultySelection1'];
          $did = $_POST['did'];
          $department = $_POST['department'];
          #sql
          $selectQuery = "SELECT `department_id` FROM `department` WHERE `department_id`='$did'";
          $RUNNER = mysqli_query($con, $selectQuery);
          $row = mysqli_fetch_assoc($RUNNER);
          if (!empty($did) && !empty($department) && !empty($facultyID)) {
            if (isset($row['department_id'])) {
              notify($message = ["warning" => "PLEASE TRY DIFFERENT DEPARTMENT ID"], "warning");
            } else {
              $InsertQuery = "INSERT INTO `department`(`date`, `department_id`, `department_name`, `faculty_id`) VALUES (NOW(),'$did','$department','$facultyID')";
              mysqli_query($con, $InsertQuery);
              notify($message = ["success" => "DEPARTMENT DATABASE UPDATED"], "success");
            }
          } else {
            notify($message = ["danger" => "PLEASE FILL ALL THE RQUIRED INPUT FIELDS"], "danger");
          }
        }
        ?>
        <!--------------------------------------------------------------------------SUBJECTS----------------------------------------------------------------------->
        <h3>Adding a New Subject</h3>
        <!--subjects-->
        <label for="facultySelection2">Faculty</label>
        <select
          name="facultySelection2"
          id="facultySelection2"
          onchange="inputbarEnabler();departmentSelectUpdator('facultySelection2','DepartmentSelector');"
          class="mustFILL SUBJECT">
          <option value="0" selected hidden>Select a Faculty before select any Department</option>
          <?php
          facultySelectOptions($con);
          ?>
        </select>
        <label for="DepartmentSelector">Department</label>
        <!--give value="did(department ID)"-->
        <select
          name="DepartmentSelector"
          id="DepartmentSelector"
          onchange="inputbarEnabler()"
          oninput="subjectIDgenorator()"
          class="mustFILL SUBJECT">
          <option value="0" selected hidden>Select a Department before add a subject</option>
        </select>
        <label for="subjectyear" class="sub">Year</label>
        <select name="subjectyear" id="subjectyear" class="sub mustFILL SUBJECT" oninput="subjectIDgenorator()">
          <option value="0" selected hidden>Select a Year</option>
          <option value="1">1 st Year</option>
          <option value="2">2 nd Year</option>
          <option value="3">3 rd Year</option>
          <option value="4">4 th Year</option>
        </select>
        <label for="subjectSem" class="sub">Semester</label>
        <select name="subjectSem" id="subjectSem" class="sub mustFILL SUBJECT" oninput="subjectIDgenorator()">
          <option value="0" selected hidden>Select a Semester</option>
          <option value="1">1st Semester</option>
          <option value="2">2nd Semester</option>
        </select>
        <label for="subjects" class="sub">Subjects ID</label>
        <div class="sub_idinputsec row d-flex align-items-center justify-content-between">
          <input type="text" name="subjectsID" id="subjectsID" class="sub col-9 inputBarDesign hiddenFormElement mustFILL SUBJECT" />
          <button type="button" class="btn col-2 generalButton p-0 hiddenFormElement" id="subIdAuto">Auto</button>
          <p id="suggestedSubjectID" class="tradi-blue1 tradi-blue1-border fw-bold rounded"></p>
        </div>
        <label for="subjects" class="sub">Subjects</label>
        <input type="text" name="subjects" id="subjects" class="sub mustFILL SUBJECT" />
        <button type="submit" name="cb-3" class="btn cb-3 submitButton" data-section="SUBJECT">
          Add
        </button>
      </div>
    </form>
    <?php
    $department_id = $subjectyear = $subjectSem = $subjectsID = $subjectName = "";
    if (isset($_POST['cb-3'])) {
      $department_id = $_POST['DepartmentSelector'];
      $subjectyear = $_POST['subjectyear'];
      $subjectSem = $_POST['subjectSem'];
      $subjectsID = $_POST['subjectsID'];
      $subjectName = $_POST['subjects'];

      $selectQuery = "SELECT `subject_id`, `department_id`, `Year`, `semester`, `subject_name` FROM `subject` WHERE `subject_id`='$subjectsID'";
      $RUNNER = mysqli_query($con, $selectQuery);
      $row = mysqli_fetch_assoc($RUNNER);
      if (!empty($department_id) && !empty($subjectyear) && !empty($subjectSem) && !empty($subjectsID) && !empty($subjectName)) {
        if (isset($row['department_id'])) {
          notify($message = ["warning" => "REFRESH THE PAGE AND ADD ANOTHER SUBJECT ID"], "warning");
        } else {
          $InsertQuery = "INSERT INTO `subject`(`subject_id`, `department_id`, `Year`, `semester`, `subject_name`) VALUES ('$subjectsID','$department_id','$subjectyear','$subjectSem','$subjectName')";
          mysqli_query($con, $InsertQuery);
          notify($message = ["success" => "NEW SUBJECT ADDED"], "success");
        }
      } else {
        notify($message = ["danger" => "PLEASE FILL ALL THE RQUIRED INPUT FIELDS"], "danger");
      }
    }
    ?>
    <!--PHP REQUIRED FOR GENERATE SUBJECT ID-->
    <!--------------------------------------------------------------------------/COURSES----------------------------------------------------------------------->
    <form action="" method="post" class="my-3" enctype="multipart/form-data">
      <div class="formContainer">
        <!--------------------------------------------------------------------------STUDENTS----------------------------------------------------------------------->
        <h2 id="std-panel">Add New Students</h2>
        <!--Name-->
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" class="mustFILL STUDENTS" />
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" class="mustFILL STUDENTS" />
        <!--DOB-->
        <label for="dob">Date of birth</label>
        <input type="date" name="dob" id="dob" class="mustFILL STUDENTS" />
        <!--NIC-->
        <label for="nic">NIC</label>
        <input type="number" name="nic" id="nic" class="mustFILL STUDENTS" />
        <!--mail-->
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="mustFILL STUDENTS" />
        <!--Gender-->
        <label>Gender</label>
        <div class="gender-radio d-flex align-items-center">
          <input type="radio" name="gender" id="male-std" value="male" class="mustFILL STUDENTS" />
          <label class="pe-5 ps-2" for="male-std">Male</label>
          <input type="radio" name="gender" id="female-std" value="female" class="mustFILL STUDENTS" />
          <label class="pe-5 ps-2" for="female-std">Female</label>
        </div>
        <!--FACULTY-->
        <label for="facultySelection3">Faculty</label>
        <select
          name="facultySelection3"
          id="facultySelection3"
          onchange="inputbarEnabler();departmentSelectUpdator('facultySelection3','DepartmentSelector1');"
          class="mustFILL STUDENTS">
          <option value="0" selected disabled hidden>Select a Faculty before select any Department</option>
          <?php
          facultySelectOptions($con);
          ?>
        </select>
        <label for="DepartmentSelector1">Department</label>
        <!--give value="did(department ID)"-->
        <select
          name="DepartmentSelector1"
          id="DepartmentSelector1"
          onchange="inputbarEnabler()"
          class="mustFILL STUDENTS">
          <option value="0" selected disabled>Select a Department</option>
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
        <select name="aYear" id="aYear" class="mustFILL STUDENTS">
          <option value="0" disabled selected>Select Year</option>
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
        <label for="prof-std">Upload an Image</label>
        <input type="file" name="prof-std" id="prof-std" />
        <button type="submit" name="submit-A" class="btn submit-A submitButton" data-section="STUDENTS">
          Add
        </button>
      </div>
      <?php
      $fname = $lname = $dob = $nic = $email = $gender = $facultySelection3 = $DepartmentSelector1 = $aYear = $STDid = $profil_pic_path = "";

      if (isset($_POST['submit-A'])) {
        $fname = $_POST['fname'] ?? "";
        $lname = $_POST['lname'] ?? "";
        $dob = $_POST['dob'] ?? "";
        $nic = $_POST['nic'] ?? "";
        $email = $_POST['email'] ?? "";
        $gender = $_POST['gender'] ?? "";
        $facultySelection3 = $_POST['facultySelection3'] ?? "";
        $DepartmentSelector1 = $_POST['DepartmentSelector1'] ?? "";
        $aYear = $_POST['aYear'] ?? "";
        $STDid = stdID($DepartmentSelector1, $facultySelection3, $aYear);
        //IMG FILE
        $img_name = $_FILES['prof-std']['name'];
        $imgNameArr = explode(".", $img_name);
        $ext = $imgNameArr[sizeof($imgNameArr) - 1];
        $img_temp_path = $_FILES['prof-std']['tmp_name'];
        $profil_pic_name =  $fname . $lname . "_" . $STDid . "." . $ext;
        $profil_pic_path = "../Dynamic images/students/$profil_pic_name";
        $dir = dirname($profil_pic_path);
        if (!is_dir($dir)) {
          mkdir($dir, 0777, true);
        }
        if (
          !empty($fname)
          && !empty($lname)
          && !empty($dob)
          && !empty($nic)
          && !empty($email)
          && !empty($gender)
          && !empty($facultySelection3)
          && !empty($DepartmentSelector1)
          && !empty($aYear)
          && !empty($STDid)
        ) {
          if (in_array(strtolower($ext), ["png", "jpeg", "jpg", "png"])) {
            move_uploaded_file($img_temp_path, $profil_pic_path);
          } else {
            notify($message = ["danger" => "UPLOADED FILE IS NOT AN IMAGE!"], "danger");
          }
          //INSERTING
          $InsertQuery = "INSERT INTO `studets`(`stdID`, `std_fname`, `std_lname`, `std_dob`, `nic`, `email`, `gender`, `faculty_id`, `department_id`, `aYear`, `profile_pic_path`) VALUES ('$STDid','$fname','$lname','$dob','$nic','$email','$gender','$facultySelection3','$DepartmentSelector1','$aYear','$profil_pic_name')";
          mysqli_query($con, $InsertQuery);
          notify($message = ["success" => "NEW STUDENT ADDED"], "success");
        } else {
          notify($message = ["danger" => "PLEASE FILL ALL THE RQUIRED INPUT FIELDS"], "danger");
        }
      }
      ?>
      <!--PHP REQUIRED FOR GENERATE SUBJECT ID-->
      <!--------------------------------------------------------------------------/STUDENTS----------------------------------------------------------------------->
    </form>
    <form action="" method="post" class="my-3" enctype="multipart/form-data">
      <!--------------------------------------------------------------------------STAFFS----------------------------------------------------------------------->
      <div class="formContainer">
        <h2 id="lc-panel">Add New Staff</h2>
        <!--Name-->
        <label for="fname-L">First Name</label>
        <input type="text" name="fname-L" id="fname-L" class="mustFILL STAFFS" />
        <label for="lname-L">Last Name</label>
        <input type="text" name="lname-L" id="lname-L" class="mustFILL STAFFS" />
        <!--DOB-->
        <label for="dob-L">Date of birth</label>
        <input type="date" name="dob-L" id="dob-L" class="mustFILL STAFFS" />
        <!--NIC-->
        <label for="nic-L">NIC</label>
        <input type="number" name="nic-L" id="nic-L" class="mustFILL STAFFS" />
        <!--mail-->
        <label for="email-L">Email</label>
        <input type="email" name="email-L" id="email-L" class="mustFILL STAFFS" />
        <!--Gender-->
        <label>Gender</label>
        <div class="gender-radio d-flex align-items-center">
          <input type="radio" name="gender" id="male-lec" value="male" class="mustFILL STAFFS" />
          <label class="pe-5 ps-2" for="male-lec">Male</label>
          <input type="radio" name="gender" id="female-lec" class="mustFILL STAFFS" />
          <label class="pe-5 ps-2" for="female-lec" value="female">Female</label>
        </div>
        <!--Role-->
        <?php
        $selectQuery = "SELECT `status_ID`, `Academic_role`, `NON_Academic_role` FROM `role`";
        $runner1 = mysqli_query($con, $selectQuery);
        $runner2 = mysqli_query($con, $selectQuery);
        ?>
        <label for="role" class="role">Role</label>
        <select name="role" id="role" onchange="selectFunction1()" class="mustFILL STAFFS">
          <option value="0" selected>Select a role</option>
          <option value="Academic">Academic Staff</option>
          <option value="NON-Academic">NON-Academic Staff</option>
        </select>
        <!--academic-Role-->
        <select name="role_A" id="role-A" class="update" onchange="selectFunction1()">
          <option value="0" selected hidden>Select the Academic role</option>
          <?php
          while ($row = mysqli_fetch_assoc($runner1)) {
            echo "<option value='{$row['status_ID']}'>{$row['Academic_role']}</option>";
          }
          ?>
        </select>
        <!--NON-academic-Role-->
        <select name="role_NA" id="role-NA" class="update">
          <option value="0" selected hidden>Select the Non-Academic role</option>
          <?php
          while ($row = mysqli_fetch_assoc($runner2)) {
            echo "<option value='{$row['status_ID']}'>{$row['NON_Academic_role']}</option>";
          }
          ?>
        </select>
        <!--Profile pic-->
        <label for="prof-lc">Upload an Image</label>
        <input type="file" name="prof-lc" id="prof-lc" />
        <!--FACULTY-->
        <button type="submit" name="submit-B" class="btn submit-B submitButton" data-section="STAFFS">
          Add
        </button>
      </div>
      <!--PHP REQUIRED FOR GENERATE STAF ID-->
      <?php
      if (isset($_POST['submit-B'])) {
        $fname_L = $_POST['fname-L'] ?? "";
        $lname_L = $_POST['lname-L'] ?? "";
        $dob_L = $_POST['dob-L'] ?? "";
        $nic_L = $_POST['nic-L'] ?? "";
        $email_L = $_POST['email-L'] ?? "";
        $gender = $_POST['gender'] ?? "";
        $role = $_POST['role'] ?? "";
        if ($role = $_POST['role']) {
          if (!empty($_POST['role_A'])) {
            $sub_role = $_POST['role_A'] ?? "";
          } else if (!empty($_POST['role_NA'])) {
            $sub_role = $_POST['role_NA'] ?? "";
          }
        }

        if (
          !empty($fname_L) &&
          !empty($lname_L) &&
          !empty($dob_L) &&
          !empty($nic_L) &&
          !empty($email_L) &&
          !empty($gender) &&
          !empty($prof_lc) &&
          !empty($role) &&
          !empty($sub_role)
        ) {
          $staff_ID = stfID($fname_L, $lname_L, $gender, $role, $sub_role);
          //profile-pic
          $img_name = $_FILES['prof-lc']['name'];
          $imgNameArr = explode(".", $img_name);
          $ext = $imgNameArr[sizeof($imgNameArr) - 1];
          $img_temp_path = $_FILES['prof-lc']['tmp_name'];
          $profil_pic_name =  $fname_L . $lname_L . $staff_ID . "." . $ext;
          $profil_pic_path = "../Dynamic images/staffs/$profil_pic_name";
          $dir = dirname($profil_pic_path);
          if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
          }
          if (in_array(strtolower($ext), ["jpg", "png", "jpeg"])) {
            move_uploaded_file($img_temp_path, $profil_pic_path);
          } else {
            notify($message = ["warning" => "UPLOADED FILE IS NOT A VALID IMAGE!"], "warning");
          }
          //INSERTING
          $InsertQuery = "INSERT INTO `staffs`(`staffID`, `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role`) VALUES ('$staff_ID','$fname_L','$lname_L','$dob_L','$nic_L','$email_L','$gender','$profil_pic_name','$role','$sub_role')";
          mysqli_query($con, $InsertQuery);
          notify($message = ["success" => "NEW STAFF ADDED"], "success");
        } else {
          notify($message = ["danger" => "PLEASE FILL ALL THE RQUIRED INPUT FIELDS"], "danger");
        }
      }


      ?>
      <!---------------------------------------------------------------------------STAFFS----------------------------------------------------------------------->
    </form>
  </div>
  <script src="../JavaScript/function.js"></script>
  <script>
    const subjectIdgeneratorButton = document.getElementById("subIdAuto");
    document.getElementById("subjectsID").addEventListener("focus", () => {
      subjectIdgeneratorButton.style.transform = "scale(1,1)";
    });
  </script>
</body>

</html>