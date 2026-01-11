<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'Includes/connection.php';
include('Includes/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LEO INTERNATION UNIVERSITY</title>
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
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      display: flex;
      flex-direction: column;
      padding: 0;
      width: 100vw;
      overflow-x: hidden;
      overflow-y: scroll;
      background-color: #f7f9fb;
    }

    body::-webkit-scrollbar {
      width: 5px;
      /* or any width you want */
    }

    body::-webkit-scrollbar-track {
      background: #122044;

    }

    body::-webkit-scrollbar-thumb {
      background: #80b3e7;
      border-radius: 6px;
    }
  </style>
</head>

<body>
  <?php
  global $type;
  global $Message;
  ?>
  <!------------------------------------------------------Logging/Signin Portal------------------------------------------------------>
  <!-- signIN -->
  <div class="modal fade" id="account" aria-hidden="true" aria-labelledby="accountLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content blurStyleModelBackground">
        <h1 class="text-center text-uppercase fw-bolder">Account Creating form</h1>
        <div class="btn-group mx-4 mt-3">
          <button class="btn generalButton studentReg">Student</button>
          <button class="btn generalButton staffReg">Staffs</button>
        </div>
        <!------------------------------- Students SignIN--------------------------------------->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="logContainer formContainer students" method="post">
          <img src="static images/LOGO1.png">
          <label for="stdIDreg">Admission Number</label>
          <input class="signInBar mustFILL" id="stdIDreg" name="admissionNumer" type="text">
          <label for="pswd">Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="signInBar mustFILL inputBarDesign h-100" id="pswd" name="passwrd" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <label for="cnfrmPassword">Confirm Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="signInBar mustFILL inputBarDesign h-100" id="cnfrmPassword" name="cnfrmpasswrd" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <button name="submitButtonACC" type="submit" class="btn generalButton submitButton" data-section="signInBar">Create an Account</button>
        </form>
        <?php
        if (isset($_POST['submitButtonACC'])) {
          $ip = getIPAddress();
          $admissionNumber = trim($_POST['admissionNumer'] ?? '');
          $password = htmlspecialchars(trim($_POST['passwrd'] ?? ''));
          $confrmpassword = htmlspecialchars(trim($_POST['cnfrmpasswrd'] ?? ''));
          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

          $selectQuery = "SELECT `stdID`, `std_fname`, `std_lname`, `std_dob`, `nic`, `email`, `gender`, `faculty_id`, `department_id`, `aYear`, `profile_pic_path` FROM `studets` WHERE `stdID`='$admissionNumber'";
          $result = mysqli_query($con, $selectQuery);
          $count = mysqli_num_rows($result);
          $row = mysqli_fetch_assoc($result);
          $stdID = $row['stdID'] ?? "";

          $selectQuery1 = "SELECT * FROM `studentaccount` WHERE `stdID`='$admissionNumber'";
          $result1 = mysqli_query($con, $selectQuery1);
          $count1 = mysqli_num_rows($result1);

          $FNAME = str_split($row['std_fname'] ?? "");
          $intial = $FNAME[0] ?? "";
          $LNAME = $row['std_lname'] ?? "";
          $UNAME = $intial . "." . $LNAME;


          if ($password != $confrmpassword) {
            // echo "<script>alert('The entered Password is not Matching')</script>";
            $type = "info";
            $Message = "THE ENTERED PASSWORD IS NOT MATCHING";
          } else if (empty($admissionNumber) || empty($password) || empty($confrmpassword)) {
            $type = "danger";
            $Message = "PLEASE FILL ALL THE REQUIRED FIELDS";
          } else if (empty($count)) {
            $type = "warning";
            $Message = "ENTERED ADMISSION NUMBER IS INVALID!!!";
          } else if ($count1 > 0) {
            $type = "warning";
            $Message = "ADMISSION NUMBER ALREADY USED!!!";
          } else {

            $_SESSION['UNAME'] = $UNAME ?? '';
            $_SESSION['STDID'] = $row['stdID'] ?? '';
            $_SESSION['GENDER'] = $row['gender'] ?? '';
            $_SESSION['NIC'] = $row['nic'] ?? '';
            $_SESSION['PROFILEPIC'] = $row['profile_pic_path'] ?? '';

            $insertQuery = "INSERT INTO `studentaccount`(`IP`, `Createddate`, `stdID`,`userName`, `pswrd`) VALUES ('$ip',NOW(),'$admissionNumber','$UNAME','$hashedPassword')";
            mysqli_query($con, $insertQuery);
            $type = "success";
            $Message = "ACCOUNT CREATED SUCCESS FULLY!!!";
          }
        }
        ?>
        <!------------------------------- /Students SignIN--------------------------------------->
        <!------------------------------- Staffs SignIN--------------------------------------->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="logContainer formContainer staffs" method="post">
          <img src="static images/LOGO1.png">
          <label for="staffIdReg">Staff ID</label>
          <input class="signInBarL mustFILL" id="staffIdReg" name="staffIDL" type="text">
          <label for="pswd_stf">Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="signInBarL mustFILL inputBarDesign h-100" id="pswd_stf" name="passwrdL" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <label for="cnfrmPassword_stf">Confirm Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="signInBarL mustFILL inputBarDesign h-100" id="cnfrmPassword_stf" name="cnfrmpasswrdL" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <button name="submitButtonACCL" type="submit" class="btn generalButton submitButton" data-section="signInBarL">Create an Account</button>
        </form>
        <?php
        if (isset($_POST['submitButtonACCL'])) {
          $ip = getIPAddress();
          $staffID = trim($_POST['staffIDL'] ?? '');
          $password = htmlspecialchars(trim($_POST['passwrdL'] ?? ''));
          $confrmpassword = htmlspecialchars(trim($_POST['cnfrmpasswrdL'] ?? ''));
          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

          $selectQuery = "SELECT `staffID`, `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role` FROM `staffs` WHERE `staffID`='$staffID'";
          $result = mysqli_query($con, $selectQuery);
          $count = mysqli_num_rows($result);
          $row = mysqli_fetch_assoc($result);
          $stdID = $row['staffID'] ?? "";

          $selectQuery1 = "SELECT `IP`, `Createddate`, `staffID`, `userName`, `pswrd` FROM `staffsaccount` WHERE `staffID`='$staffID'";
          $result1 = mysqli_query($con, $selectQuery1);
          $count1 = mysqli_num_rows($result1);

          $FNAME = str_split($row['staff_fname'] ?? "");
          $intial = $FNAME[0] ?? "";
          $LNAME = $row['staff_lname'] ?? "";
          $UNAME = $intial . "." . $LNAME;


          if ($password != $confrmpassword) {
            // echo "<script>alert('The entered Password is not Matching')</script>";
            $type = "info";
            $Message = "THE ENTERED PASSWORD IS NOT MATCHING";
          } else if (empty($staffID) || empty($password) || empty($confrmpassword)) {
            $type = "danger";
            $Message = "PLEASE FILL ALL THE REQUIRED FIELDS";
          } else if (empty($count)) {
            $type = "warning";
            $Message = "ENTERED ADMISSION NUMBER IS INVALID!!!";
          } else if ($count1 > 0) {
            $type = "warning";
            $Message = "ADMISSION NUMBER ALREADY USED!!!";
          } else {

            $_SESSION['UNAME'] = $UNAME ?? '';
            $_SESSION['STFID'] = $row['staffID'] ?? '';
            $_SESSION['GENDER'] = $row['gender'] ?? '';
            $_SESSION['NIC'] = $row['nic'] ?? '';
            $_SESSION['PROFILEPIC'] = $row['profile_pic'] ?? '';

            $insertQuery = "INSERT INTO `staffsaccount`(`IP`, `Createddate`, `staffID`, `userName`, `pswrd`) VALUES ('$ip',NOW(),'$staffID','$UNAME','$hashedPassword')";
            mysqli_query($con, $insertQuery);
            $type = "success";
            $Message = "ACCOUNT CREATED SUCCESS FULLY!!!";
          }
        }
        ?>
        <!------------------------------- /Staffs --------------------------------------->
        <button class="btn generalButton" data-bs-target="#account2" data-bs-toggle="modal">Already have an account?</button>
      </div>
    </div>
  </div>
  <!-- LogIN -->
  <div class="modal fade" id="account2" aria-hidden="true" aria-labelledby="accountLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content blurStyleModelBackground">
        <h1 class="text-center text-uppercase fw-bolder">LogIn form</h1>
        <div class="btn-group mx-4 mt-3">
          <button class="btn generalButton studentReg">Student</button>
          <button class="btn generalButton staffReg">Staffs</button>
        </div>
        <!------------------------------- Students LogIN--------------------------------------->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="logContainer formContainer students" method="post">
          <img src="static images/LOGO1.png">
          <label for="stdID1">Admission Number</label>
          <input class="loginBar mustFILL" id="stdID1" name="admissionNumer1" type="text">
          <label for="pswd1">Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="loginBar mustFILL inputBarDesign h-100" id="pswd1" name="passwrd1" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <button name="submitButtonLOG" type="submit" class="btn generalButton submitButton" data-section="loginBar">LogIn</button>
        </form>
        <?php
        if (isset($_POST['submitButtonLOG'])) {
          session_unset();
          $stdID = $_POST['admissionNumer1'] ?? "";
          $password = htmlspecialchars(trim($_POST['passwrd1'] ?? ""));
          $selectQuery = "SELECT studentaccount.stdID, studentaccount.userName,studentaccount.pswrd, studets.std_fname,studets.std_lname,studets.std_dob,studets.nic,studets.email,studets.aYear,studets.gender FROM studentaccount INNER JOIN studets WHERE studentaccount.stdID = studets.stdID AND studentaccount.stdID='$stdID'";
          $result = mysqli_query($con, $selectQuery);
          $row = mysqli_fetch_assoc($result);
          if (mysqli_num_rows($result) > 0) {
            if (password_verify($password, $row['pswrd'])) {

              $FNAME = str_split($row['std_fname'] ?? "");
              $intial = $FNAME[0] ?? "";
              $LNAME = $row['std_lname'] ?? "";
              $UNAME = $intial . "." . $LNAME;

              $_SESSION['UNAME'] = $UNAME ?? "";
              $_SESSION['STDID'] = $row['stdID'] ?? "";
              $_SESSION['GENDER'] = $row['gender'] ?? "";
              $_SESSION['NIC'] = $row['nic'] ?? "";
              $_SESSION['PROFILEPIC'] = $row['profile_pic_path'] ?? "";
              $type = "success";
              $Message = strtoupper("Logged in Succesfully!");
            } else {
              $type = "danger";
              $Message = strtoupper("Entered Password is incorrect!");
            }
          } else {
            $type = "info";
            $Message = strtoupper("You do not have any account!");
          }
        }
        ?>
        <!------------------------------- /Students LogIN--------------------------------------->
        <!------------------------------- Staffs LogIN--------------------------------------->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="logContainer formContainer staffs" method="post">
          <img src="static images/LOGO1.png">
          <label for="stfId1">Staff ID</label>
          <input class="loginBar1 mustFILL" id="stfId1" name="staffIdL" type="text">
          <label for="pswd1_L">Password</label>
          <div class="passwordbarcont align-items-center">
            <input class="loginBar1 mustFILL inputBarDesign h-100" id="pswd1_L" name="passwrd1L" type="password">
            <button type="button" class="btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
              <i class="passwordEye fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <button name="submitButtonLOGL" type="submit" class="btn generalButton submitButton" data-section="loginBar1">LogIn</button>
        </form>
        <?php
        if (isset($_POST['submitButtonLOGL'])) {
          session_unset();
          $stffID = $_POST['staffIdL'] ?? "";
          $password = htmlspecialchars(trim($_POST['passwrd1L'] ?? ""));
          $selectQuery = "SELECT staffsaccount.staffID, staffsaccount.userName,staffsaccount.pswrd, staffs.staff_fname,staffs.staff_lname,staffs.dob,staffs.nic,staffs.mail,staffs.profile_pic,staffs.role,staffs.sub_role,staffs.gender FROM staffsaccount INNER JOIN staffs WHERE staffsaccount.staffID = staffs.staffID AND staffsaccount.staffID='$stffID'";
          $result1 = mysqli_query($con, $selectQuery);
          $row = mysqli_fetch_assoc($result1);
          if (mysqli_num_rows($result1) > 0) {
            if (password_verify($password, $row['pswrd'])) {

              $FNAME = str_split($row['staff_fname'] ?? "");
              $intial = $FNAME[0] ?? "";
              $LNAME = $row['staff_lname'] ?? "";
              $UNAME = $intial . "." . $LNAME;

              $_SESSION['UNAME'] = $UNAME ?? "";
              $_SESSION['STFID'] = $row['staffID'] ?? "";
              $_SESSION['GENDER'] = $row['gender'] ?? "";
              $_SESSION['NIC'] = $row['nic'] ?? "";
              $_SESSION['PROFILEPIC'] = $row['profile_pic'] ?? "";
              $type = "success";
              $Message = strtoupper("Logged in Succesfully!");
            } else {
              $type = "danger";
              $Message = strtoupper("Entered Password is incorrect!");
            }
          } else {
            $type = "info";
            $Message = strtoupper("You do not have any account!");
          }
        }
        ?>
        <!------------------------------- /Staffs --------------------------------------->
        <button class="btn generalButton" data-bs-target="#account" data-bs-toggle="modal">Don't you have an Account?</button>
      </div>
    </div>
  </div>
  <?php
  if (!empty($type) && !empty($Message)) {
    notify($message = ["$type" => "$Message"], "$type");
  }
  ?>
  <!------------------------------------------------------Logging/Signin Portal------------------------------------------------------>

  <!------------------------------------------------------Account Details------------------------------------------------------>
  <!-- Modal -->
  <div class="modal fade" id="accountDetails" tabindex="-1" aria-labelledby="accountDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content blurStyleModelBackground">
        <div class="container">
          <div class="modal-body">
            <?php
            if (!empty($_SESSION['STDID']) && empty($_SESSION['STFID'])) {
              stdCard($con, $_SESSION['STDID'] ?? "", "");
            } else if (empty($_SESSION['STDID']) && !empty($_SESSION['STFID'])) {
              stafCard($_SESSION['STFID'] ?? "", $con, "");
            }
            ?>
          </div>
          <div class="modal-footer">
            <form action="index.php" method="post">
              <button type="submit" class="btn generalButton" name="logout">Logout</button>
              <?php
              if (!empty($_SESSION['STDID']) && empty($_SESSION['STFID'])) {
                echo "<a href='stdDashboard/student.php?dashboard' class='btn generalButton'>Dashboard</a>";
              } else if (empty($_SESSION['STDID']) && !empty($_SESSION['STFID'])) {
                echo "<a href='lectureDashboard/home.php' class='btn generalButton'>Dashboard</a>";
              }
              ?>
            </form>
            <?php
            if (isset($_POST['logout'])) {
              session_unset();
            }
            ?>
            <!-- <a href="index.php?logout" class="btn btn-primary navLink">logout</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!------------------------------------------------------Account Details------------------------------------------------------>

  <!------------------------------------------------------HEADER SECTION START------------------------------------------------------>

  <!-- <section id="Header" class="border border-1"> -->
  <div class="naV naV1">
    <a href="#" class="navItem nav1 navLink">Alumini</a>
    <a href="#" class="navItem nav1 navLink">Exams</a>
    <a href="#" class="navItem nav1 navLink">Online payments</a>
    <div class="navItem nav1 socialMedia smallsrcOnly">
      <a href="#" class="fa-brands navLink fa-facebook"></a>
      <a href="#" class="fa-brands navLink fa-square-x-twitter"></a>
      <a href="#" class="fa-brands navLink fa-instagram"></a>
      <a href="#" class="fa-brands navLink fa-youtube"></a>
      <a href="#" class="fa-brands navLink fa-linkedin"></a>
    </div>
    <a href="#" class="navItem nav1 navLink" title="Online Learning System">OLS</a>
    <a href="#" class="navItem nav1 navLink">Downloads</a>
    <a href="#" class="navItem nav1 navLink">Contact Us</a>
    <div class="navItem nav1 smallsrcOnly d-flex gap-lg-3 gap-1" style="padding-right: 0.7vw !important;">
      <a href='admin/' class='navItem nav1 navLink smallsrcOnly d-flex align-content-center rounded'>ADMIN</a>
      <?php
      $UNAME = $_SESSION['UNAME'] ?? "";
      $gender = strtoupper($_SESSION['GENDER'] ?? "");
      $INT = nicToRandom($_SESSION['NIC'] ?? "");
      if ($gender === "MALE") {
        $_SESSION['ONLINEPROFILE'] = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
      } else if ($gender === "FEMALE") {
        $_SESSION['ONLINEPROFILE'] = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
      } else {
        $_SESSION['ONLINEPROFILE'] = "static images/sampleImage.png";
      }

      $profilepic = $_SESSION['PROFILEPIC'] ?? "";
      $onlineprofilepic = $_SESSION['ONLINEPROFILE'] ?? "";
      if (!empty($_SESSION['STDID']) && empty($_SESSION['STFID'])) {
        $PROFILEPICPATH = !empty($profilepic) ? "Dynamic images/students/{$profilepic}" : "$onlineprofilepic";
      } else if (empty($_SESSION['STDID']) && !empty($_SESSION['STFID'])) {
        $PROFILEPICPATH = !empty($profilepic) ? "Dynamic images/staffs/{$profilepic}" : "$onlineprofilepic";
      } else {
        $PROFILEPICPATH = !empty($profilepic) ? "static images/sampleImage.png" : "$onlineprofilepic";
      }
      if (!empty($_SESSION['STDID']) || !empty($_SESSION['STFID'])) {
        echo "<a href='index.php?logout' class='navItem nav1 navLink smallsrcOnly d-flex align-content-center rounded' data-bs-toggle='modal' data-bs-target='#accountDetails'>{$UNAME}</a>";
      }
      echo "<img src='{$PROFILEPICPATH}' width='50em' data-bs-target='#account' data-bs-toggle='modal' class='d-inline'/>";
      ?>
    </div>
  </div>
  <div class="naV naV2 sticky-top">
    <!-- offcanvas_SMALLSCREENONLY -->
    <button class="btn notbigScreen offCanvasButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-bars"></i></button>

    <div class="offcanvas offcanvas-start notbigScreen" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-body">
        <div class="d-flex justify-content-end py-3">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="accordion accordion-flush" id="navAccordion">
          <!-- ABOUT SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-about" aria-expanded="false" aria-controls="flush-about">
                ABOUT
              </button>
            </h2>
            <div id="flush-about" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- UNIVERSITY -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">UNIVERSITY</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">About Us</a></li>
                      <li><a href="#" class="navItemLink">Vision & Mission</a></li>
                      <li><a href="#" class="navItemLink">History</a></li>
                      <li><a href="#" class="navItemLink">Rankings & Reputation</a></li>
                      <li><a href="#" class="navItemLink">Privacy policy</a></li>
                      <li><a href="#" class="navItemLink">Visual Identity</a></li>
                    </ul>
                  </li>

                  <!-- PEOPLE -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">PEOPLE</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Chancellor</a></li>
                      <li><a href="#" class="navItemLink">Vice Chancellor</a></li>
                      <li><a href="#" class="navItemLink">Deans of the Faculties</a></li>
                      <li><a href="#" class="navItemLink">Registrar</a></li>
                      <li><a href="#" class="navItemLink">Acting Librarian</a></li>
                      <li><a href="#" class="navItemLink">Bursar</a></li>
                      <li><a href="#" class="navItemLink">Academic Personnel</a></li>
                    </ul>
                  </li>

                  <!-- GOVERNANCE -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">GOVERNANCE</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Council</a></li>
                      <li><a href="#" class="navItemLink">Senate</a></li>
                      <li><a href="#" class="navItemLink">IT Committee</a></li>
                    </ul>
                  </li>

                  <!-- HONOURS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">HONOURS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Emeritus Professors</a></li>
                      <li><a href="#" class="navItemLink">Honorary Degrees</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- ACADEMIC SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-academic" aria-expanded="false" aria-controls="flush-academic">
                ACADEMIC
              </button>
            </h2>
            <div id="flush-academic" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- FACULTIES -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">FACULTIES</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href='https://www.sab.ac.lk/agri/' class='navItemLink'>Faculty of Agricultural Sciences</a></li>
                      <li><a href='https://www.sab.ac.lk/app/' class='navItemLink'>Faculty of Applied Science</a></li>
                      <li><a href='https://www.sab.ac.lk/computing/' class='navItemLink'>Faculty of Computing</a></li>
                      <li><a href='https://www.sab.ac.lk/geo/' class='navItemLink'>Faculty of Geomatics</a></li>
                      <li><a href='https://www.sab.ac.lk/med/' class='navItemLink'>Faculty of Medicine</a></li>
                      <li><a href='https://www.sab.ac.lk/mgmt/' class='navItemLink'>Faculty of Management Studies</a></li>
                      <li><a href='https://www.sab.ac.lk/fssl/' class='navItemLink'>Faculty of Social Sciences and Languages</a></li>
                      <li><a href='https://www.sab.ac.lk/tech/' class='navItemLink'>Faculty of Technology</a></li>
                    </ul>
                  </li>

                  <!-- CENTRES -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">CENTRES</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Centre for Contemporary Indian Studies (CCIS)</a></li>
                      <li><a href="#" class="navItemLink">Center for Environmental Initiatives (CEI)</a></li>
                      <li><a href="#" class="navItemLink">Centre for Environmental Law and Policy (CELP)</a></li>
                      <li><a href="#" class="navItemLink">Center for Excellence in Disability Research, Education and practice (CEDREP)</a></li>
                      <li><a href="#" class="navItemLink">Centre for Open & Distance Learning (CODL)</a></li>
                      <li><a href="#" class="navItemLink">Centre for the Study of Human Rights (CSHR)</a></li>
                      <li><a href="#" class="navItemLink">Center for Quality Assurance (CQA)</a></li>
                      <li><a href="#" class="navItemLink">Center of Research and Development (CRD)</a></li>
                      <li><a href="#" class="navItemLink">Confucius Institute</a></li>
                      <li><a href="#" class="navItemLink">Human Resource Development Centre (HRDC)</a></li>
                      <li><a href="#" class="navItemLink">National Education Research & Evaluation Centre (NEREC)</a></li>
                      <li><a href="#" class="navItemLink">Social Policy Analysis and Research Centre (SPARC)</a></li>
                    </ul>
                  </li>

                  <!-- UNITS & PROJECTS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">UNITS & PROJECTS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Accelerating Higher Education Expansion and Development (AHEAD)</a></li>
                      <li><a href="#" class="navItemLink">Blended Learning Project</a></li>
                      <li><a href="#" class="navItemLink">Career Guidance Unit (CGU)</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- COURSES SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-courses" aria-expanded="false" aria-controls="flush-courses">
                COURSES
              </button>
            </h2>
            <div id="flush-courses" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- UPCOMING -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">UPCOMING</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Certificate</a></li>
                      <li><a href="#" class="navItemLink">Diploma</a></li>
                      <li><a href="#" class="navItemLink">Undergraduate</a></li>
                      <li><a href="#" class="navItemLink">Postgraduate</a></li>
                    </ul>
                  </li>

                  <!-- EXTERNAL -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">EXTERNAL</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Certificate Courses</a></li>
                      <li><a href="#" class="navItemLink">Diploma Courses</a></li>
                      <li><a href="#" class="navItemLink">Undergraduate</a></li>
                      <li><a href="#" class="navItemLink">Postgraduate Programmes</a></li>
                    </ul>
                  </li>

                  <!-- INTERNAL -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">INTERNAL</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Undergraduate Programmes</a></li>
                    </ul>
                  </li>

                  <!-- ONLINE & DISTANCE -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">ONLINE & DISTANCE</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Online Courses</a></li>
                      <li><a href="#" class="navItemLink">Distance Learning</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- ADMINISTRATION SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-administration" aria-expanded="false" aria-controls="flush-administration">
                ADMINISTRATION
              </button>
            </h2>
            <div id="flush-administration" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- DIVISIONS & BRANCHES -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">DIVISIONS & BRANCHES</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Academic Establishment</a></li>
                      <li><a href="#" class="navItemLink">Academic & Publications</a></li>
                      <li><a href="#" class="navItemLink">Examinations</a></li>
                      <li><a href="#" class="navItemLink">General Administration</a></li>
                      <li><a href="#" class="navItemLink">Legal & Documentation</a></li>
                      <li><a href="#" class="navItemLink">Non Academic Establishment</a></li>
                      <li><a href="#" class="navItemLink">Student & Staff Affairs</a></li>
                    </ul>
                  </li>

                  <!-- FINANCE -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">FINANCE</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Financial Documents for Staff</a></li>
                      <li><a href="#" class="navItemLink">Program Budget</a></li>
                      <li><a href="#" class="navItemLink">Procurements</a></li>
                    </ul>
                  </li>

                  <!-- STAFF AFFAIRS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">STAFF AFFAIRS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Early Childhood Development Centre (ECDC)</a></li>
                      <li><a href="#" class="navItemLink">Health Centre</a></li>
                      <li><a href="#" class="navItemLink">Sevaka Anyonyadhara Sangamaya (SAS)</a></li>
                    </ul>
                  </li>

                  <!-- DOWNLOADS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">DOWNLOADS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Staff</a></li>
                      <li><a href="#" class="navItemLink">By-Laws</a></li>
                      <li><a href="#" class="navItemLink">Medical Welfare Scheme</a></li>
                      <li><a href="#" class="navItemLink">Vehicle Passes</a></li>
                    </ul>
                  </li>

                  <!-- DEPARTMENTS, OFFICES & CENTRES -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">DEPARTMENTS, OFFICES & CENTRES</span>
                    <ul class="list-unstyled ps-3 pt-3">
                      <li><a href="#" class="navItemLink">Center for Environmental Initiatives (CEI)</a></li>
                      <li><a href="#" class="navItemLink">Centre for Gender Equity/Equality (CGEE)</a></li>
                      <li><a href="#" class="navItemLink">Center for Quality Assurance (CQA)</a></li>
                      <li><a href="#" class="navItemLink">Department of Physical Education</a></li>
                      <li><a href="#" class="navItemLink">Early Childhood Development Centre (ECDC)</a></li>
                      <li><a href="#" class="navItemLink">Human Resource Development Centre (HRDC)</a></li>
                      <li><a href="#" class="navItemLink">Student Counselling Office</a></li>
                      <li><a href="#" class="navItemLink">Network Operations Centre (NOC)</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- STAFFS SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-staffs" aria-expanded="false" aria-controls="flush-staffs">
                STAFFS
              </button>
            </h2>
            <div id="flush-staffs" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- ACADEMIC STAFFS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">ACADEMIC STAFFS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Demonstrator</a></li>
                      <li><a href="#" class="navItemLink">Assistant Lecturer</a></li>
                      <li><a href="#" class="navItemLink">Lecturer</a></li>
                      <li><a href="#" class="navItemLink">Senior Lecturer</a></li>
                      <li><a href="#" class="navItemLink">HOD</a></li>
                      <li><a href="#" class="navItemLink">Dean</a></li>
                    </ul>
                  </li>

                  <!-- NON-ACADEMIC STAFFS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">NON-ACADEMIC STAFFS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Librarian</a></li>
                      <li><a href="#" class="navItemLink">Bursar</a></li>
                      <li><a href="#" class="navItemLink">Deputy Vice Chancellor</a></li>
                      <li><a href="#" class="navItemLink">Assistant Registrar</a></li>
                      <li><a href="#" class="navItemLink">Senior Registrar</a></li>
                      <li><a href="#" class="navItemLink">Vice Chancellor(VC)</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- STUDENTS SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-students" aria-expanded="false" aria-controls="flush-students">
                STUDENTS
              </button>
            </h2>
            <div id="flush-students" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <!-- STUDYING -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">STUDYING</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Admissions</a></li>
                      <li><a href="#" class="navItemLink">Convocation</a></li>
                      <li><a href="#" class="navItemLink">Exam Rules and Regulations</a></li>
                      <li><a href="#" class="navItemLink">Student Awards & Prizes</a></li>
                    </ul>
                  </li>

                  <!-- RECREATION -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">RECREATION</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Achievements</a></li>
                      <li><a href="#" class="navItemLink">Arts & Culture</a></li>
                      <li><a href="#" class="navItemLink">Blog</a></li>
                      <li><a href="#" class="navItemLink">Gavel Club</a></li>
                      <li><a href="#" class="navItemLink">Leo Club</a></li>
                      <li><a href="#" class="navItemLink">Social</a></li>
                      <li><a href="#" class="navItemLink">Societies</a></li>
                      <li><a href="#" class="navItemLink">Sports</a></li>
                    </ul>
                  </li>

                  <!-- WELFARE -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">WELFARE</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">Health Centre</a></li>
                      <li><a href="#" class="navItemLink">Hostels</a></li>
                      <li><a href="#" class="navItemLink">Student Affairs</a></li>
                      <li><a href="#" class="navItemLink">Student Counselor Office</a></li>
                    </ul>
                  </li>

                  <!-- SCHOLARSHIPS -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">SCHOLARSHIPS</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">International Students</a></li>
                      <li><a href="#" class="navItemLink">Current Students</a></li>
                    </ul>
                  </li>

                  <!-- INFORMATION -->
                  <li class="list-group-item border-0">
                    <span class="drpTitles text-start d-block">INFORMATION</span>
                    <ul class="list-unstyled ps-3">
                      <li><a href="#" class="navItemLink">By-Laws, Guidelines & Policies</a></li>
                      <li><a href="#" class="navItemLink">Educational and Leisure Trips</a></li>
                      <li><a href="#" class="navItemLink">Email Policy</a></li>
                      <li><a href="#" class="navItemLink">Emergency Contacts for Students</a></li>
                      <li><a href="#" class="navItemLink">Examination Results</a></li>
                      <li><a href="#" class="navItemLink">Marshal Office</a></li>
                      <li><a href="#" class="navItemLink">Physical Education</a></li>
                      <li><a href="#" class="navItemLink">Ragging and Violence</a></li>
                      <li><a href="#" class="navItemLink">Social Media Guidelines</a></li>
                      <li><a href="#" class="navItemLink">Student Information System(SIS)</a></li>
                      <li><a href="#" class="navItemLink">Transcripts</a></li>
                      <li><a href="#" class="navItemLink">Job Portal</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- OTHERS SECTION -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-others" aria-expanded="false" aria-controls="flush-others">
                OTHERS
              </button>
            </h2>
            <div id="flush-others" class="accordion-collapse collapse" data-bs-parent="#navAccordion">
              <div class="accordion-body p-0">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">Alumni</a>
                  </li>
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">Exams</a>
                  </li>
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">Online payments</a>
                  </li>
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">OLS</a>
                  </li>
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">Downloads</a>
                  </li>
                  <li class="list-group-item border-0">
                    <a href="#" class="navItemLink d-block">Contact Us</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- offcanvas_SMALLSCREENONLY END-->
    <div class="UniLOGO py-1 pe-3 d-flex align-items-center">
      <img src="static images/LOGO1.png" alt="" width="90px" />
      <h3 class="fw-bolder">LEO INTERNATION UNIVERSITY</h3>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">ABOUT</span>
      <div class="dropDown position-absolute d-flex">
        <!-- UNIVERSITY -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">UNIVERSITY</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">About Us</a></li>
            <li><a href="#" class="navItemLink">Vision & Mission</a></li>
            <li><a href="#" class="navItemLink">History</a></li>
            <li>
              <a href="#" class="navItemLink">Rankings & Reputation</a>
            </li>
            <li><a href="#" class="navItemLink">Privacy policy</a></li>
            <li><a href="#" class="navItemLink">Visual Identity</a></li>
          </ul>
        </div>

        <!-- PEOPLE -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">PEOPLE</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Chancellor</a></li>
            <li><a href="#" class="navItemLink">Vice Chancellor</a></li>
            <li>
              <a href="#" class="navItemLink">Deans of the Faculties</a>
            </li>
            <li><a href="#" class="navItemLink">Registrar</a></li>
            <li><a href="#" class="navItemLink">Acting Librarian</a></li>
            <li><a href="#" class="navItemLink">Bursar</a></li>
            <li><a href="#" class="navItemLink">Academic Personnel</a></li>
          </ul>
        </div>

        <!-- GOVERNANCE -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">GOVERNANCE</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Council</a></li>
            <li><a href="#" class="navItemLink">Senate</a></li>
            <li><a href="#" class="navItemLink">IT Committee</a></li>
          </ul>
        </div>
        <!-- HONOURS -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">HONOURS</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Emeritus Professors</a></li>
            <li><a href="#" class="navItemLink">Honorary Degrees</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">ACADEMIC</span>
      <div class="dropDown position-absolute d-flex">
        <!-- FACULTIES -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">FACULTIES</h4>
          <ul class="drpLists fw-normal">
            <li><a href='https://www.sab.ac.lk/agri/' class='navItemLink'>Faculty of Agricultural Sciences</a></li>
            <li><a href='https://www.sab.ac.lk/app/' target="_blank" class='navItemLink'>Faculty of Applied Science</a></li>
            <li><a href='https://www.sab.ac.lk/computing/' target="_blank" class='navItemLink'>Faculty of Computing</a></li>
            <li><a href='https://www.sab.ac.lk/geo/' target="_blank" class='navItemLink'>Faculty of Geomatics</a></li>
            <li><a href='https://www.sab.ac.lk/med/' target="_blank" class='navItemLink'>Faculty of Medicine</a></li>
            <li><a href='https://www.sab.ac.lk/mgmt/' target="_blank" class='navItemLink'>Faculty of Management Studies</a></li>
            <li><a href='https://www.sab.ac.lk/fssl/' target="_blank" class='navItemLink'>Faculty of Social Sciences and Languages</a></li>
            <li><a href='https://www.sab.ac.lk/tech/' target="_blank" class='navItemLink'>Faculty of Technology</a></li>
          </ul>
        </div>

        <!-- CENTRES -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">CENTRES</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Centre for Contemporary Indian Studies (CCIS)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Center for Environmental Initiatives (CEI)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Centre for Environmental Law and Policy (CELP)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Center for Excellence in Disability Research, Education and
                practice (CEDREP)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Centre for Open & Distance Learning (CODL)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Centre for the Study of Human Rights (CSHR)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Center for Quality Assurance (CQA)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Center of Research and Development (CRD)</a>
            </li>
            <li><a href="#" class="navItemLink">Confucius Institute</a></li>
            <li>
              <a href="#" class="navItemLink">Human Resource Development Centre (HRDC)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">National Education Research & Evaluation Centre (NEREC)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Social Policy Analysis and Research Centre (SPARC)</a>
            </li>
          </ul>
        </div>

        <!-- UNITS & PROJECTS -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">UNITS & PROJECTS</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Accelerating Higher Education Expansion and Development
                (AHEAD)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Blended Learning Project</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Career Guidance Unit (CGU)</a>
            </li>
          </ul>
        </div>


      </div>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">COURSES</span>
      <div class="dropDown position-absolute d-flex">
        <!-- UPCOMING -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">UPCOMING</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Certificate</a></li>
            <li><a href="#" class="navItemLink">Diploma</a></li>
            <li><a href="#" class="navItemLink">Undergraduate</a></li>
            <li><a href="#" class="navItemLink">Postgraduate</a></li>
          </ul>
        </div>

        <!-- EXTERNAL -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">EXTERNAL</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Certificate Courses</a></li>
            <li><a href="#" class="navItemLink">Diploma Courses</a></li>
            <li><a href="#" class="navItemLink">Undergraduate</a></li>
            <li>
              <a href="#" class="navItemLink">Postgraduate Programmes</a>
            </li>
          </ul>
        </div>

        <!-- INTERNAL -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">INTERNAL</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Undergraduate Programmes</a>
            </li>
          </ul>
        </div>

        <!-- ONLINE & DISTANCE -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">ONLINE & DISTANCE</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Online Courses</a></li>
            <li><a href="#" class="navItemLink">Distance Learning</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">ADMINITRATION</span>
      <div class="dropDown position-absolute d-flex">
        <!-- DIVISIONS & BRANCHES -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">DIVISIONS & BRANCHES</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Academic Establishment</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Academic & Publications</a>
            </li>
            <li><a href="#" class="navItemLink">Examinations</a></li>
            <li>
              <a href="#" class="navItemLink">General Administration</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Legal & Documentation</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Non Academic Establishment</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Student & Staff Affairs</a>
            </li>
          </ul>
        </div>

        <!-- FINANCE -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">FINANCE</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Financial Documents for Staff</a>
            </li>
            <li><a href="#" class="navItemLink">Program Budget</a></li>
            <li><a href="#" class="navItemLink">Procurements</a></li>
          </ul>
        </div>

        <!-- STAFF AFFAIRS -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">STAFF AFFAIRS</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Early Childhood Development Centre (ECDC)</a>
            </li>
            <li><a href="#" class="navItemLink">Health Centre</a></li>
            <li>
              <a href="#" class="navItemLink">Sevaka Anyonyadhara Sangamaya (SAS)</a>
            </li>
          </ul>
        </div>

        <!-- DOWNLOADS -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">DOWNLOADS</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Staff</a></li>
            <li><a href="#" class="navItemLink">By-Laws</a></li>
            <li>
              <a href="#" class="navItemLink">Medical Welfare Scheme</a>
            </li>
            <li><a href="#" class="navItemLink">Vehicle Passes</a></li>
          </ul>
        </div>

        <!-- DEPARTMENTS, OFFICES & CENTRES -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">
            DEPARTMENTS, OFFICES & CENTRES
          </h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">Center for Environmental Initiatives (CEI)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Centre for Gender Equity/Equality (CGEE)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Center for Quality Assurance (CQA)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Department of Physical Education</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Early Childhood Development Centre (ECDC)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Human Resource Development Centre (HRDC)</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Student Counselling Office</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Network Operations Centre (NOC)</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">STAFFS</span>
      <div class="dropDown position-absolute d-flex">
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">ACADEMIC STAFFS</h4>
          <ul class="drpLists fw-normal">
            <li><a href='#' class='navItemLink'>Demonstrator</a></li>
            <li><a href='#' class='navItemLink'>Assistant Lecturer</a></li>
            <li><a href='#' class='navItemLink'>Lecturer</a></li>
            <li><a href='#' class='navItemLink'>Senior Lecturer</a></li>
            <li><a href='#' class='navItemLink'>HOD</a></li>
            <li><a href='#' class='navItemLink'>Dean</a></li>
          </ul>
        </div>
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">NON-ACADEMIC STAFFS</h4>
          <ul class="drpLists fw-normal">
            <li><a href='#' class='navItemLink'>Librarian</a></li>
            <li><a href='#' class='navItemLink'>Bursar</a></li>
            <li><a href='#' class='navItemLink'>Deputy Vice Chancellor</a></li>
            <li><a href='#' class='navItemLink'>Assistant Registrar</a></li>
            <li><a href='#' class='navItemLink'>Senior Registrar</a></li>
            <li><a href='#' class='navItemLink'>Vice Chancellor(VC)</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="navItem fw-bold nav2">
      <span class="drpMain">STUDENTS</span>
      <div class="dropDown position-absolute d-flex">
        <!-- STUDYING -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">STUDYING</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Admissions</a></li>
            <li><a href="#" class="navItemLink">Convocation</a></li>
            <li>
              <a href="#" class="navItemLink">Exam Rules and Regulations</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Student Awards & Prizes</a>
            </li>
          </ul>
        </div>

        <!-- RECREATION -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">RECREATION</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Achievements</a></li>
            <li><a href="#" class="navItemLink">Arts & Culture</a></li>
            <li><a href="#" class="navItemLink">Blog</a></li>
            <li><a href="#" class="navItemLink">Gavel Club</a></li>
            <li><a href="#" class="navItemLink">Leo Club</a></li>
            <li><a href="#" class="navItemLink">Social</a></li>
            <li><a href="#" class="navItemLink">Societies</a></li>
            <li><a href="#" class="navItemLink">Sports</a></li>
          </ul>
        </div>

        <!-- WELFARE -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">WELFARE</h4>
          <ul class="drpLists fw-normal">
            <li><a href="#" class="navItemLink">Health Centre</a></li>
            <li><a href="#" class="navItemLink">Hostels</a></li>
            <li><a href="#" class="navItemLink">Student Affairs</a></li>
            <li>
              <a href="#" class="navItemLink">Student Counselor Office</a>
            </li>
          </ul>
        </div>

        <!-- SCHOLARSHIPS -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">SCHOLARSHIPS</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">International Students</a>
            </li>
            <li><a href="#" class="navItemLink">Current Students</a></li>
          </ul>
        </div>

        <!-- INFORMATION -->
        <div class="drpItems">
          <h4 class="drpTitles text-start ps-4">INFORMATION</h4>
          <ul class="drpLists fw-normal">
            <li>
              <a href="#" class="navItemLink">By-Laws, Guidelines & Policies</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Educational and Leisure Trips</a>
            </li>
            <li><a href="#" class="navItemLink">Email Policy</a></li>
            <li>
              <a href="#" class="navItemLink">Emergency Contacts for Students</a>
            </li>
            <li><a href="#" class="navItemLink">Examination Results</a></li>
            <li><a href="#" class="navItemLink">Marshal Office</a></li>
            <li><a href="#" class="navItemLink">Physical Education</a></li>
            <li>
              <a href="#" class="navItemLink">Ragging and Violence</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Social Media Guidelines</a>
            </li>
            <li>
              <a href="#" class="navItemLink">Student Information System(SIS)</a>
            </li>
            <li><a href="#" class="navItemLink">Transcripts</a></li>
            <li><a href="#" class="navItemLink">Job Portal</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="carouselContainer position-relative">
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="0" class="active carouselButton" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="1" aria-label="Slide 2" class="carouselButton"></button>
        <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="2" aria-label="Slide 3" class="carouselButton"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="carouselImage IMG1"></div>
          <div class="carousel-caption slide1">
            <div class="LOGOcontainer1">
              <img src="static images/LOGO1.png" class="img1" style="width: 12.49vw;">
            </div>
            <h1 class="fw-bolder CCHead1">Learn Today, Lead Tomorrow.</h1>
            <p class="captionbody1 fw-medium">
              Equipping future leaders with the education and vision to shape a better future.
            </p>
          </div>
        </div>
        <div class="carousel-item position-relative">
          <div class="carouselImage IMG2"></div>
          <div class="carousel-caption slide2">
            <h1 class="fw-bolder CCHead2"> Experience Learning Beyond the Classroom</h1>
            <p class="captionbody2 fw-medium">
              Blending academic knowledge with real-world experiences for a complete education.
            </p>
            <div class="img2"></div>
            <div class="CCHead2cover"></div>
            <div class="captionbody2cover"></div>
            <div class="IMG2cover"></div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="carouselImage IMG3"></div>
          <div class="carousel-caption slide3 d-none d-md-block">
            <div class="LOGOcontainner">
              <img src="static images/LOGO1.png" class="img3" style="width: 12.49vw;">
            </div>
            <div class="line"></div>
            <div class="fw-bolder CCHead3 ps-3 overflow-hidden">
              <div class="titleCap">Unlock</div>
              <div class="titleCap">Your</div>
              <div class="titleCap">Potential,</div>
              <div class="titleCap">Transform</div>
              <div class="titleCap">the</div>
              <div class="titleCap">World</div>
              <p class="captionbody3 fw-medium lh-base">
                We believe every student holds the power to make a difference. Through innovative learning, real-world experiences, and personal guidance, we help you grow the skills, confidence, and vision to achieve your goals and create meaningful change in the world.
              </p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- </section> -->
  <!------------------------------------------------------HEADER SECTION END------------------------------------------------------>
  <!------------------------------------------------------ANNOUNCEMENT SECTION START------------------------------------------------------>
  <section id="announcement">
    <div class="MainTitle">
      <div class="backline"></div>
      <h1 class="text-center MainTitleText fw-bolder py-3">ANNOUNCEMENT</h1>
    </div>
    <div class="maincontainer">
      <div class="events">
        <h3 class="text-center fw-bolder">EVENTS</h3>
        <?php
        events($con);
        ?>
      </div>
      <div class="notices">
        <h3 class="text-center fw-bolder">NOTICES</h3>
        <?php
        noticeBoard($con);
        ?>
      </div>

    </div>
  </section>
  <!------------------------------------------------------ANNOUNCEMENT SECTION START------------------------------------------------------>
  <section id="lifeInLeo">
    <div class="MainTitle">
      <div class="backline"></div>
      <h1 class="text-center MainTitleText fw-bolder py-3">LIFE IN LEO</h1>
    </div>
    <div class="backdropTitle"></div>
    <div class="maincont">
      <div class="card LifeCard" style="background-image: url('static images/uniLife/beautyOfLeo.jpg');">
        <div class="card-body life position-relative p-0">
          <h5 class="card-title position-absolute">Beauty of LEO</h5>
          <div class="linkWrapper">
            <a href="#" class="cardLink">Read more</a>
          </div>
        </div>
      </div>
      <div class="card LifeCard" style="background-image: url('static images/uniLife/industrialCollaboration.jpeg');">
        <div class="card-body life position-relative p-0">
          <h5 class="card-title position-absolute">Industrial Collaboration</h5>
          <div class="linkWrapper">
            <a href="#" class="cardLink">Read more</a>
          </div>
        </div>
      </div>
      <div class="card LifeCard" style="background-image: url('static images/uniLife/Sports.png');">
        <div class="card-body life position-relative p-0">
          <h5 class="card-title position-absolute">Sports</h5>
          <div class="linkWrapper">
            <a href="#" class="cardLink">Read more</a>
          </div>
        </div>
      </div>
      <div class="card LifeCard" style="background-image: url('static images/uniLife/CulturalDiversity.jpg');">
        <div class="card-body life position-relative p-0">
          <h5 class="card-title position-absolute">Cultural Diversity</h5>
          <div class="linkWrapper">
            <a href="#" class="cardLink">Read more</a>
          </div>
        </div>
      </div>
      <div class="card LifeCard" style="background-image: url('static images/uniLife/AlumniSuccessStories.jpg');">
        <div class="card-body life position-relative p-0">
          <h5 class="card-title position-absolute">Alumni Success Stories</h5>
          <div class="linkWrapper">
            <a href="#" class="cardLink">Read more</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="faculties">
    <div class="MainTitle">
      <div class="backline"></div>
      <h1 class="text-center MainTitleText fw-bolder py-3">OUR FACULTIES</h1>
    </div>
    <div class="backdropTitle"></div>
    <div class="flex-container">
      <div class="facBox">
        <i class="fa-solid fa-tractor"></i>
        <span>Agriculture Science</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-flask"></i>
        <span>Applied Science</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-location-dot"></i>
        <span>Geomatrics</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-chart-line"></i>
        <span>Management</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-stethoscope"></i>
        <span>Medicine</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-language"></i>
        <span>Social Sciences and Languages</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-tower-cell"></i>
        <span>Technology</span>
      </div>
      <div class="facBox">
        <i class="fa-solid fa-square-binary"></i>
        <span>Computing</span>
      </div>
    </div>
  </section>
  <section id="ourStd">
    <div class="MainTitle">
      <div class="backline"></div>
      <h1 class="text-center MainTitleText fw-bolder py-3 text-uppercase">STUDENTS OF THE YEAR-2025</h1>
    </div>
    <div class="d-flex fitContainer">
      <div class="maincontainerStd1 d-flex py-5">
        <?php
        studentoftheYear($con);
        ?>
      </div>
      <div class="maincontainerStd2 d-flex py-5">
        <?php
        studentoftheYear($con);
        ?>
      </div>
    </div>
  </section>
  <section id="footer">
    <div class="footer1">
      <div class="addressContainer">
        <img src="static images/LOGO1.png">
        <div class="address">
          <h4 class="fw-bolder">ADDRESS</h4>
          <div class="d-block tradi-blue2">Kahatagasdigiliya,</div>
          <div class="d-block tradi-blue2">Anuradhapura,</div>
          <div class="d-block tradi-blue2">Sri Lanka.</div>
        </div>
      </div>
      <div class="footerColumn">
        <div class="footerContent">
          <h3 class="text-center">LOCATION</h3>
          <iframe class="px-3 pb-3" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3946.7723361162966!2d80.68353407477078!3d8.42400529816613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOMKwMjUnMjYuNCJOIDgwwrA0MScxMC4wIkU!5e0!3m2!1sen!2slk!4v1755294024066!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="footerContent">
          <h3 class="text-center">UNIVERSITY</h3>
          <ul class="footerList">
            <li><a class="footerLink" href="#">About Us</a></li>
            <li><a class="footerLink" href="#">History</a></li>
            <li><a class="footerLink" href="#">Chancellor</a></li>
            <li><a class="footerLink" href="#">Vice Chancellor</a></li>
            <li><a class="footerLink" href="#">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footerContent">
          <h3 class="text-center">ACADEMIC</h3>
          <ul class="footerList">
            <li><a class="footerLink" href="#">Faculty</a></li>
            <li><a class="footerLink" href="#">Library</a></li>
            <li><a class="footerLink" href="#">Online Learning</a></li>
            <li><a class="footerLink" href="#">Department</a></li>
            <li><a class="footerLink" href="#">Center & Unit</a></li>
          </ul>
        </div>
        <div class="footerContent">
          <h3 class="text-center">UNIVERSITY LIFE</h3>
          <ul class="footerList">
            <li><a class="footerLink" href="#">Achievements</a></li>
            <li><a class="footerLink" href="#">Arts & Culture</a></li>
            <li><a class="footerLink" href="#">Social</a></li>
            <li><a class="footerLink" href="#">Sports</a></li>
            <li><a class="footerLink" href="#">Students’ Blog</a></li>
          </ul>
        </div>
        <div class="footerContent">
          <h3 class="text-center">COURSES</h3>
          <ul class="footerList">
            <li><a class="footerLink" href="#">Postgraduate</a></li>
            <li><a class="footerLink" href="#">Undergraduate</a></li>
            <li><a class="footerLink" href="#">Certificate</a></li>
            <li><a class="footerLink" href="#">Online</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer2">
      <div class="F2footerContent">
        <span class="fw-bold text-center d-block">&copy; 2025 LEO INTERNATIONAL UNIVERSITY
        </span>
        <span class="d-block">
          ALL RIGHT RESERVED
        </span>
      </div>
      <div class="F2footerContent">
        <a href="#" class="F2socialMedia themLink"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" class="F2socialMedia themLink"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="F2socialMedia themLink"><i class="fa-brands fa-square-x-twitter"></i></a>
        <a href="#" class="F2socialMedia themLink"><i class="fa-brands fa-linkedin"></i></a>
        <a href="#" class="F2socialMedia themLink"><i class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </section>
  <script src="JavaScript/function.js"></script>
</body>

</html>