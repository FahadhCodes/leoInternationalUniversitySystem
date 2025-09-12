<?php
require '../Includes/connection.php';
include('../Includes/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>READ</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../style.css" />
</head>

<body class="main-1">
  <div class="container-fluid">
    <!--------------------------------------------------------------------------COURSES----------------------------------------------------------------------->
    <form action="#facultySelection4" method="post" class="my-3">
      <div class="formContainer section1"><!--FORMCONTAINER-->
        <h2>Read Courses</h2>
        <!--------------------------------------------------------------------------FACULTY----------------------------------------------------------------------->
        <h3>Reading Course Module by Faculty</h3>
        <label for="facultySelection4">Faculty</label>
        <select
          name="facultySelection4"
          id="facultySelection4"
          onchange="inputbarEnabler();departmentSelectUpdator('facultySelection4','DepartmentSelector1');"
          class="">
          <?php
          echo "<option value='0' selected hidden>Select a Faculty before select any Department</option>";
          facultySelectOptions($con);
          ?>
        </select>
        <button type="submit" name="cb-1" class="btn btn-dark cb-1 read">
          Read
        </button>
        <?php
        //DEPARTMENT TABLE START------------------------------>
        if (isset($_POST['cb-1'])) {
          $fid = $_POST['facultySelection4'];
          $selectQuery = "SELECT `faculty_id`, `facultyName` FROM `faculty` WHERE `faculty_id` = '$fid'";
          $result = mysqli_query($con, $selectQuery);
          $row = mysqli_fetch_assoc($result);
          $FACULTY = strtoupper($row['facultyName'] ?? "");
          echo "<h4 class='text-center tradi-blue1-bg tradi-yellow1 rounded p-3 fw-bolder' style='grid-column:span 4' id='fid'>{$FACULTY}</h4>";
        }
        echo "
        <table>
          <thead>
            <tr>
              <th>Department ID</th>
              <th>Department</th>
            </tr>
          </thead>
          <tbody>";
        //fetch------------------>
        if (isset($_POST['cb-1'])) {
          $fid = $_POST['facultySelection4'];
          $selectQuery = "SELECT `date`, `department_id`, `department_name`, `faculty_id` FROM `department` WHERE `faculty_id`='$fid'";
          $result = mysqli_query($con, $selectQuery);
          while ($row = mysqli_fetch_assoc($result)) {
            echo    "<tr>
                        <td>{$row['department_id']}</td>
                        <td><a class='themLink' href='AdminPanal.php?read={$row['department_id']}'>Department of {$row['department_name']}</a></td>
                      </tr>";
          }
        }
        //fetch------------------>
        echo "
          </tbody>
        </table>
        ";
        //DEPARTMENT TABLE ENDS------------------------------>
        $did = $_GET['read'] ?? "";
        $selectQuery1 = "SELECT `date`, `department_id`, `department_name`, `faculty_id` FROM `department` WHERE `department_id`='$did'";
        $result1 = mysqli_query($con, $selectQuery1);
        $row1 = mysqli_fetch_assoc($result1);
        $DEPARTMENT = "DEPARTMENT OF " . strtoupper($row1['department_name'] ?? "");
        echo "<h4 class='text-center tradi-blue2-bg tradi-blue1 rounded p-1 fw-bold' style='grid-column:span 4' id='did'>{$DEPARTMENT}</h4>";
        //SUBJECTS MODULE TABLE AREA STARS------------------->
        echo "<div class='ftableContainer'>"; //TABLRCONTAINER---->SUBJECTS
        //YEAR----------------------------1111>
        echo   "<table class='fetchtable'>";
        echo    "<tr>
                    <th colspan='2' class='tradi-blue1-bg'>Year 1</th>
                  </tr>";
        //fetch------------------>
        if (!empty($_GET['read'])) {
          $did = $_GET['read'];
          $year = 1;
          YearSemTables($con, $did, $year);
        }
        //fetch------------------>
        echo   "</table>";
        //YEAR----------------------------1111>
        //YEAR----------------------------2222>
        echo   "<table class='fetchtable'>";
        echo    "<tr>
                    <th colspan='2' class='tradi-blue1-bg'>Year 2</th>
                  </tr>";
        //fetch------------------>
        if (!empty($_GET['read'])) {
          $did = $_GET['read'];
          $year = 2;
          YearSemTables($con, $did, $year);
        }
        //fetch------------------>
        echo   "</table>";
        //YEAR----------------------------2222>
        //YEAR----------------------------3333>
        echo   "<table class='fetchtable'>";
        echo    "<tr>
                    <th colspan='2' class='tradi-blue1-bg'>Year 3</th>
                  </tr>";
        //fetch------------------>
        if (!empty($_GET['read'])) {
          $did = $_GET['read'];
          $year = 3;
          YearSemTables($con, $did, $year);
        }
        //fetch------------------>
        echo   "</table>";
        //YEAR----------------------------3333>
        //YEAR----------------------------4444>
        echo   "<table class='fetchtable'>";
        echo    "<tr>
                    <th colspan='2' class='tradi-blue1-bg'>Year 4</th>
                  </tr>";
        //fetch------------------>
        if (!empty($_GET['read'])) {
          $did = $_GET['read'];
          $year = 4;
          YearSemTables($con, $did, $year);
        }
        //fetch------------------>
        echo   "</table>";
        //YEAR----------------------------4444>
        echo  "</div>"; //TABLRCONTAINER---->SUBJECTS
        //SUBJECTS MODULE TABLE AREA STARS------------------->
        ?>
      </div><!--FORMCONTAINER-->
    </form>
    <!--------------------------------------------------------------------------/COURSES----------------------------------------------------------------------->

    <form action="#std-panel" method="post" class="my-3">
      <div class="formContainer section2">
        <!--------------------------------------------------------------------------STUDENTS----------------------------------------------------------------------->
        <h2 id="std-panel">Student Details Panel</h2>
        <label for="stdID" class="lname">Student ID</label>
        <input type="text" name="stdID" id="stdID" />
        <button
          type="submit"
          name="submit-A"
          class="btn btn-dark submit-A read align-selfs-center" data-section="section2">
          Read
        </button>
        <!--Preview Card-STD-->
        <?php
        $stdID = $_POST['stdID'] ?? "";
        $diR = "../";
        stdCard($con, $stdID, $diR);
        ?>
      </div>
      <!--------------------------------------------------------------------------/STUDENTS----------------------------------------------------------------------->
    </form>

    <form action="#lc-panel" method="post" class="my-3">
      <!--------------------------------------------------------------------------STAFFS----------------------------------------------------------------------->
      <div class="formContainer section3">
        <h2 id="lc-panel">Staffs Details Panel</h2>
        <label for="stfID">Staff ID</label>
        <input type="text" name="stfID" id="stfID" />
        <button
          type="submit"
          name="submit-B"
          class="btn btn-dark submit-B read readButton"
          data-section="section3">
          Read
        </button>
        <!--Preview Card-STD-->
        <?php
        $staffID = $_POST['stfID'] ?? "";
        $diR = "../";
        stafCard($staffID, $con, $diR);
        ?>
      </div>
      <!--------------------------------------------------------------------------/STAFFS----------------------------------------------------------------------->
    </form>
    <form action="#search-panel" method="post" class="my-3">
      <!--------------------------------------------------------------------------SEARCH----------------------------------------------------------------------->
      <div class="formContainer find section4">
        <h2 id="search-panel">Find people</h2>
        <label for="search" class="fw-bolder">Search: </label>
        <input type="search" name="search" id="search" class="search read">
        <button
          type="submit"
          name="submit-C"
          class="btn btn-dark submit-C read btn readButton"
          data-section="section4">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <!--search result-->
        <div class="search-resultcontainer mt-4">
          <?php
          if (isset($_POST['search'])) {
            $searchedText = $_POST['search'] ?? "";
            //Stundets----------------------------------------------------------------->
            $selectQuery = "SELECT studets.stdID,studets.std_fname,studets.std_lname,studets.faculty_id,studets.department_id,studets.aYear,studets.nic,studets.gender,studets.profile_pic_path,department.department_id,department.department_name,faculty.faculty_id,faculty.facultyName
            FROM studets
            INNER JOIN faculty ON studets.faculty_id=faculty.faculty_id
            INNER JOIN department ON studets.department_id=department.department_id 
            WHERE studets.std_fname LIKE '%$searchedText%'
            OR studets.std_lname LIKE '%$searchedText%'
            OR studets.aYear LIKE '%$searchedText%'
            OR department.department_name LIKE '%$searchedText%'
            OR faculty.facultyName LIKE '%$searchedText%'";
            $result = mysqli_query($con, $selectQuery);
            $count = mysqli_num_rows($result);
            //Stundets----------------------------------------------------------------->
            //STAFFS------------------------------------------------------------------->
            $selectQuery1 = "SELECT staffs.staffID,staffs.staff_fname,staffs.staff_lname,staffs.gender,staffs.profile_pic,staffs.role,staffs.sub_role,staffs.nic,role.status_ID,role.Academic_role,role.NON_Academic_role
          FROM staffs
          INNER JOIN role ON staffs.sub_role=role.status_ID 
          WHERE staffs.staff_fname LIKE '%$searchedText%'
          OR staffs.staff_lname LIKE '%$searchedText%'
          OR staffs.gender LIKE '%$searchedText%'
          OR staffs.role LIKE '%$searchedText%'
          OR role.Academic_role LIKE '%$searchedText%'
          OR role.NON_Academic_role LIKE '%$searchedText%'";
            $result1 = mysqli_query($con, $selectQuery1);
            $count1 = mysqli_num_rows($result1);


            //STAFFS------------------------------------------------------------------->
            if (!empty($count) || !empty($count1)) {
              while ($rowSTFF = mysqli_fetch_assoc($result1)) {
                $FULLNAME = strtoupper($rowSTFF['staff_fname'] ?? "") . " " . strtoupper($rowSTFF['staff_lname']  ?? "");
                $STAFFID = $rowSTFF['staffID'] ?? "";
                $STAFFGENDER = strtoupper($rowSTFF['gender'] ?? "");
                $ROLE = $rowSTFF['role'] ?? "";
                $STATUS_CODE = $rowSTFF[`sub_role`] ?? "";
                $PROFILEPIC = $rowSTFF['profile_pic'] ?? "";
                $NIC = $rowSTFF['nic'] ?? "";
                $INT = nicToRandom($NIC);
                if ($STAFFGENDER === "MALE") {
                  $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
                } else if ($STAFFGENDER === "FEMALE") {
                  $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
                } else {
                  $ONLINEPROFILE = "../static images/sampleImage.png";
                }
                $PROFILEPICPATH = !empty($PROFILEPIC) ? "../Dynamic images/staffs/{$PROFILEPIC}" : "{$ONLINEPROFILE}";
                $SUB_ROLE = "";
                if ($ROLE === "Academic") {
                  $SUB_ROLE = $rowSTFF['Academic_role'] ?? "";
                } else if ($ROLE === "NON-Academic") {
                  $SUB_ROLE = $rowSTFF['NON_Academic_role'] ?? "";
                }
                echo "
              <div class='card SEARCHCARD p-3 tradi-blue1-bg'>
                <div class='d-flex tradi-blue2 fw-medium justify-content-center'>{$STAFFID}</div>
                <div class='img d-flex justify-content-center'>
                  <img width='200px' src='$PROFILEPICPATH' alt='profile pic' class = 'rounded'>
                </div>
                <h5 class='text-center fw-bolder tradi-yellow1'>{$FULLNAME}</h5>
                <p class='text-center tradi-blue2 fw-bold'>STAFF</p>
                <p class='text-center tradi-blue2-border tradi-yellow1 rounded fw-light fw-bolder'>{$STAFFGENDER}</p>
                <p class='text-center tradi-blue2-border tradi-yellow2 rounded fw-light'>{$ROLE} Staff</p>
                <p class='text-center tradi-blue2-border tradi-yellow2 rounded fw-light'>{$SUB_ROLE}</p>
              </div>
              ";
              }
              while ($rowSTD = mysqli_fetch_assoc($result)) {
                $FULLNAME = strtoupper($rowSTD['std_fname'] ?? "") . " " . strtoupper($rowSTD['std_lname']  ?? "");
                $STDID = $rowSTD['stdID'] ?? "";
                $STDYEAR = $rowSTD['aYear'] ?? "";
                $FAC = $rowSTD['facultyName'] ?? "";
                $DEP = $rowSTD['department_name'] ?? "";
                $PROFILEPIC = $rowSTD['profile_pic_path'] ?? "";
                $NIC = $rowSTD['nic'] ?? "";
                $GENDER = strtoupper($rowSTD['gender'] ?? "");
                $INT = nicToRandom($NIC);
                if ($GENDER === "MALE") {
                  $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
                } else if ($GENDER === "FEMALE") {
                  $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
                } else {
                  $ONLINEPROFILE = "../static images/sampleImage.png";
                }
                $PROFILEPICPATH = !empty($PROFILEPIC) ? "../Dynamic images/students/{$PROFILEPIC}" : "{$ONLINEPROFILE}";
                echo "
              <div class='card SEARCHCARD p-3 tradi-blue1-bg'>
                <div class='d-flex tradi-blue2 fw-medium justify-content-center'>{$STDID}</div>
                <div class='img d-flex justify-content-center'>
                  <img width='200px' src='$PROFILEPICPATH' alt='profile pic' class='rounded tradi-blue2-border'>
                </div>
                <h5 class='text-center fw-bolder tradi-yellow1'>{$FULLNAME}</h5>
                <p class='text-center tradi-blue2 fw-bold'>STUDENT</p>
                <p class='text-center tradi-blue2-border tradi-yellow1 rounded fw-light fw-bolder'>{$STDYEAR}</p>
                <p class='text-center tradi-blue2-border tradi-yellow2 rounded fw-light' style='font-size:0.9rem'>{$FAC}</p>
                <p class='text-center tradi-blue2-border tradi-yellow2 rounded fw-light' style='font-size:0.9rem'>{$DEP}</p>
              </div>
              ";
              }
            } else {
              echo "<h2 class='text-center'>No Search Result</h2>";
            }
          }
          ?>
        </div>
      </div>
      <!--------------------------------------------------------------------------/SEARCH----------------------------------------------------------------------->
    </form>
  </div>
  <script src="../JavaScript/function.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>