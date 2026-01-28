<?php
include('connection.php');
#faculty list
function facultySelectOptions($con)
{
  $selectQuery = "SELECT * FROM `faculty`";
  $runQuery = mysqli_query($con, $selectQuery);
  while ($row = mysqli_fetch_assoc($runQuery)) {
    echo "<option value=" . $row['faculty_id'] . ">" . $row['facultyName'] . "</option>";
  }
}
function departmentSelectOptions($con)
{
  $selectQuery = "SELECT * FROM `department`";
  $runQuery = mysqli_query($con, $selectQuery);
  while ($row1 = mysqli_fetch_assoc($runQuery)) {
    echo "<option value=" . $row1['department_id'] . ">" . $row1['department_name'] . "</option>";
  }
}
function subjectID($department, $year, $sem)
{
  $filtering = explode(" ", str_replace("AND", "", strtoupper($department)));
  $output = "";
  foreach ($filtering as $x) {
    $output .= substr($x, 0, 1);
  }
  $random = random_int(round(M_PI * 100), round(M_PI * 200));
  $subjectID = $output . $year . $sem . $random;
  return $subjectID;
}

function stdID($dep, $faculty, $aYEAR)
{
  if ($dep && $faculty && $aYEAR) {
    $year = explode("/", $aYEAR);
    $key = ord($faculty[strlen($faculty) - 1]) . ord($dep[2]); //!

    $offset  = (int)$year[0][0] + (int)$year[0][1];
    $sprimKey = (int)$key - $offset * 500; //!!!!!!!!!!

    $stdID = $year[0] . $dep . random_int($sprimKey, $sprimKey + 1015);
    return $stdID;
  } else {
    return;
  }
}

function stfID($fname, $lname, $gender, $role, $sub_role)
{
  if ($role === "Academic") {
    $status_code1 = "A";
  } else {
    $status_code1 = "NA";
  }
  $f = !empty($fname) ? $fname[0] : "X";
  $l = !empty($lname) ? $lname[0] : "X";
  $g = !empty($gender) ? $gender[0] : "X";
  return strtoupper($f . $l . $g . "_" . $status_code1 . "_" . $sub_role . random_int(1000, 6000));
}

function staffImageFileRenamer($ID, $firstName, $lastName, $extention, $oldImageFileName)
{
  $newFileName = $firstName . $lastName . $ID . "." . $extention;
  $oldPath = "../Dynamic images/staffs/$oldImageFileName";
  $newPath = "../Dynamic images/staffs/$newFileName";
  if (file_exists($oldPath)) {
    rename($oldPath, $newPath);
  } else {
    echo "<script>alert('Old profile picture does not exist')</script>";
  }
}

function YearSemTables($con, $did, $year)
{
  echo "
        <tr>
          <th colspan='2' class='tradi-yellow1-bg tradi-blue1'>Semester 1</th>
        </tr>
        <tr>
            <th>Subject ID</th>
            <th>Subjects</th>
        </tr>
        ";
  $selectQuery1 = "SELECT * FROM `subject` WHERE `department_id`='$did' AND `Year`='$year' AND `semester`='1'";
  $result1 = mysqli_query($con, $selectQuery1);
  while ($row = mysqli_fetch_assoc($result1)) {
    echo "
          <tr>
            <td>{$row['subject_id']}</td>
            <td>{$row['subject_name']}</td>
          </tr>
          ";
  }
  echo "
          <tr>
            <th colspan='2' class='tradi-yellow1-bg tradi-blue1'>Semester 2</th>
          </tr>
          <tr>
            <th>Subject ID</th>
            <th>Subjects</th>
          </tr>
        ";
  $selectQuery1 = "SELECT * FROM `subject` WHERE `department_id`='$did' AND `Year`='$year' AND `semester`='2'";
  $result1 = mysqli_query($con, $selectQuery1);
  while ($row = mysqli_fetch_assoc($result1)) {
    echo "
          <tr>
            <td>{$row['subject_id']}</td>
            <td>{$row['subject_name']}</td>
          </tr>
          ";
  }
}
$directory = "../"; #(../ OR / OR nothing)
function stdCard($con, $stdID, $directory)
{
  $selectQuery = "SELECT `stdID`, `std_fname`, `std_lname`, `std_dob`, `nic`, `email`, `gender`, `faculty_id`, `department_id`, `aYear`, `profile_pic_path` FROM `studets` WHERE `stdID`='$stdID'";
  $result = mysqli_query($con, $selectQuery);
  $rowSTD = mysqli_fetch_assoc($result);
  //details
  $FID = $rowSTD['faculty_id'] ?? "";
  $DEPID = $rowSTD['department_id'] ?? "";
  $STDID = $rowSTD['stdID'] ?? "";
  $DOB = $rowSTD['std_dob'] ?? "";
  $NIC = $rowSTD['nic'] ?? "";
  $AYEAR = $rowSTD['aYear'] ?? "";
  $GENDER = strtoupper($rowSTD['gender'] ?? "");
  $EMAIL = $rowSTD['email'] ?? "";
  $PROFILEPIC = $rowSTD['profile_pic_path'] ?? "";
  $INT = nicToRandom($NIC);
  if ($GENDER === "MALE") {
    $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
  } else if ($GENDER === "FEMALE") {
    $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
  } else {
    $ONLINEPROFILE = "{$directory}static images/sampleImage.png";
  }
  $PROFILEPICPATH = !empty($PROFILEPIC) ? "{$directory}Dynamic images/students/{$PROFILEPIC}" : "{$ONLINEPROFILE}";
  //details
  $selectQuery1 = "SELECT `faculty_id`, `facultyName` FROM `faculty` WHERE `faculty_id`='{$FID}'";
  $result1 = mysqli_query($con, $selectQuery1);
  $rowFAC = mysqli_fetch_assoc($result1);
  $selectQuery2 = "SELECT `date`, `department_id`, `department_name`, `faculty_id` FROM `department` WHERE `department_id`='{$DEPID}'";
  $result2 = mysqli_query($con, $selectQuery2);
  $rowDEP = mysqli_fetch_assoc($result2);
  //edits
  $FACULTY = strtoupper($rowFAC['facultyName'] ?? "");
  $DEPARTMENT = strtoupper($rowDEP['department_name'] ?? "");
  $NAME = strtoupper($rowSTD['std_fname'] ?? "") . " " . strtoupper($rowSTD['std_lname'] ?? "");
  echo "
      <div class='preview_card tradi-blue1-bg' style='overflow: hidden'>
        <div
          class='container-fluid preview-card-cont-1 row p-0 m-0 bg-white'
          style='border-bottom: 10px solid #b48f2e'>
          <div
            class='col-3 text-align-center d-flex justify-content-center'>
            <img
              src='{$directory}static images/LOGO1.png'
              alt='LOGO' class='previewCardIMG std'/>
          </div>
          <div
            class='col-9 d-flex justify-content-center align-items-center fw-bolder tradi-blue1 previewCardTitle std'>
            LEO INTERNATIONAL UNIVERSITY
          </div>
        </div>
        <div class='container-fluid preview-card-cont-2 row my-3 p-0 m-0'>
          <div
            class='col-12 text-center fw-semibold tradi-blue2 p-0 precrdFAC'>
            {$FACULTY}
          </div>
          <div
            class='col-12 text-center pb-5 fw-semibold tradi-yellow1 precrddep'>
            DEPARTMENT OF {$DEPARTMENT}
          </div>
          <div class='col-lg-4 col-12 text-center pb-4'>
            <img
              src='{$PROFILEPICPATH}'
              alt='student'
              width='200px'
              style='border-radius: 10px; border: 3px solid #122044' />
          </div>
          <div class='col-lg-8 col-12 row'>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Name</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$NAME}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Reg.NO</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$STDID}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Date of Birth</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$DOB}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>NIC</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$NIC}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Academic Year</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$AYEAR}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Gender</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$GENDER}</span>
            <span class='PrcardText col-lg-4 col-3 tradi-yellow1 fw-medium'>Email</span>
            <span class='PrcardText col-lg-1 col-2 tradi-blue2'>:</span>
            <span class='PrcardText col-lg-7 col-7 tradi-yellow2 fw-light'>{$EMAIL}</span>
          </div>
        </div>
      </div>
      ";
}
$directory = "../"; #(../ OR / OR nothing)
function stafCard($staffID, $con, $directory)
{
  $selectQuery = "SELECT `staffID`, `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role` FROM `staffs` WHERE `staffID`='$staffID'";
  $row = mysqli_fetch_assoc(mysqli_query($con, $selectQuery));
  //details
  $ROLE = $row['role'] ?? "";
  $STATUS_CODE = $row['sub_role'] ?? "";
  $FULLNAME = strtoupper($row['staff_fname'] ?? "") . " " . strtoupper($row['staff_lname']  ?? "");
  $DOB = $row['dob'] ?? "";
  $NIC = $row['nic'] ?? "";
  $MAIL = $row['mail'] ?? "";
  $GENDER = strtoupper($row['gender'] ?? "");
  //details
  //profile_PIC
  $PROFILEPIC = $row['profile_pic'] ?? "";
  $INT = nicToRandom($NIC);
  if ($GENDER === "MALE") {
    $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
  } else if ($GENDER === "FEMALE") {
    $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
  } else {
    $ONLINEPROFILE = "{$directory}static images/sampleImage.png";
  }
  $PROFILEPICPATH = !empty($PROFILEPIC) ? "{$directory}Dynamic images/staffs/{$PROFILEPIC}" : "{$ONLINEPROFILE}";
  //profile_PIC
  $selectQuery1 = "SELECT `status_ID`, `Academic_role`, `NON_Academic_role` FROM `role` WHERE `status_ID`='$STATUS_CODE'";
  $row1 = mysqli_fetch_assoc(mysqli_query($con, $selectQuery1));
  $SUB_ROLE = "";
  if ($ROLE === "Academic") {
    $SUB_ROLE = $row1['Academic_role'] ?? "";
  } else if ($ROLE === "NON-Academic") {
    $SUB_ROLE = $row1['NON_Academic_role'] ?? "";
  }
  echo "
      <div
        class='preview_card read tradi-blue1-bg'
        style='overflow: hidden'>
        <div
          class='container-fluid preview-card-cont-1 row p-0 m-0 bg-white'
          style='border-bottom: 10px solid #b48f2e'>
          <div
            class='col-3 text-align-center d-flex justify-content-center'>
            <img
              src='{$directory}static images/LOGO1.png'
              width='150px'
              alt='LOGO' 
              class='previewCardIMG stf'/>
          </div>
          <div
            class='col-9 d-flex justify-content-center align-items-center fw-bolder tradi-blue1 previewCardTitle stf'>
            LEO INTERNATIONAL UNIVERSITY
          </div>
        </div>
        <div class='container-fluid preview-card-cont-2 row my-3 p-0 m-0'>
          <div
            class='col-12 text-center fw-semibold tradi-blue2 p-0'
            style='font-size: 1.4em'>
            {$ROLE}-staff
          </div>
          <div
            class='col-12 text-center pb-5 fw-semibold tradi-yellow1'
            style='font-size: 0.9em'>
            {$SUB_ROLE}
          </div>
          <div class='col-lg-4 col-12 text-center pb-1'>
            <img
              class = 'rounded'
              src='{$PROFILEPICPATH}'
              alt='student'
              width='200px'
              style='border-radius: 10px; border: 3px solid #122044' />
          </div>
          <div class='col-lg-8 col-12 row'>
            <span class='col-4 tradi-yellow1 fw-medium'>Name</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$FULLNAME}</span>
            <span class='col-4 tradi-yellow1 fw-medium'>Staff ID</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$staffID}</span>
            <span class='col-4 tradi-yellow1 fw-medium'>Date of Birth</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$DOB}</span>
            <span class='col-4 tradi-yellow1 fw-medium'>NIC</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$NIC}</span>
            <span class='col-4 tradi-yellow1 fw-medium'>Gender</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$GENDER}</span>
            <span class='col-4 tradi-yellow1 fw-medium'>Email</span>
            <span class='col-1 tradi-blue2'>:</span>
            <span class='col-7 tradi-yellow2 fw-light'>{$MAIL}</span>
          </div>
        </div>
      </div>
      ";
}
//this is for random unique profile
function nicToRandom($nic)
{
  return (int)substr($nic, -2) % 79;
}
//Loging------------------------------->
function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
function tag($tag)
{
  switch ($tag) {
    case "BR":
      return "Best Researchers";
      break;
    case "TI":
      return "Top Innovator";
      break;
    case "AE":
      return "Academic Excellence";
      break;
    case "FS":
      return "Future Scientist";
      break;
    case "RS":
      return "Rising Scholar";
      break;
  }
}

function studentoftheYear($con)
{
  $selectQuery = "SELECT studentaccount.stdID, studentaccount.tag, studets.std_fname, 
        studets.std_lname, studets.nic, studets.gender, studets.profile_pic_path, 
        faculty.facultyName, department.department_name
        FROM studentaccount
        INNER JOIN studets 
            ON studentaccount.stdID = studets.stdID
        INNER JOIN faculty 
            ON studets.faculty_id = faculty.faculty_id
        INNER JOIN department 
            ON studets.department_id = department.department_id
            WHERE studentaccount.tag != ''";
  $result = mysqli_query($con, $selectQuery);
  while ($row = mysqli_fetch_assoc($result)) {
    $tag = tag($row['tag']);
    $GENDER = strtoupper($row['gender'] ?? "");
    $directory = "";
    //details
    //profile_PIC
    $PROFILEPIC = $row['profile_pic_path'] ?? "";
    $INT = nicToRandom($row['nic']);
    if ($GENDER === "MALE") {
      $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
    } else if ($GENDER === "FEMALE") {
      $ONLINEPROFILE = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
    } else {
      $ONLINEPROFILE = "{$directory}static images/sampleImage.png";
    }
    $PROFILEPICPATH = !empty($PROFILEPIC) ? "{$directory}Dynamic images/students/{$PROFILEPIC}" : "{$ONLINEPROFILE}";
    echo "
            <div class='card ourStd border-0'>
            <img src='{$PROFILEPICPATH}' class='card-img-top ourStd' alt='...'>
            <div class='card-body'>
              <div class='card-text text-center ourStd'>
                <h4 class='name text-uppercase fw-bolder'>{$row['std_fname']}</h4>
                <h4 class='name text-uppercase fw-bolder'>{$row['std_lname']}</h4>
                <h5 class='text-uppercase'>{$tag}</h5>
                <h6 class='ourStdFac rounded-pill'>{$row['facultyName']}</h6>
                <h6 class='ourStdDep rounded-pill'>Department of {$row['department_name']}</h6>
              </div>
            </div>
          </div>
          ";
  }
}

function noticeBoard($con)
{
  $selectQuery = "SELECT notice.title, notice.content, notice.faculty, notice.departments, faculty.facultyName
                        FROM notice
                        LEFT JOIN faculty 
                        ON notice.faculty=faculty.faculty_id";
  $result = mysqli_query($con, $selectQuery);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    echo "
            <div id='nots' class='carousel slide' data-bs-ride='carousel' data-bs-interval='2000'>
              <div class='carousel-indicators'>
            ";

    for ($i = 0; $i < $count; $i++) {
      $activeClass = ($i == 0) ? "class='active' aria-current='true'" : "";
      echo "<button type='button' data-bs-target='#nots' data-bs-slide-to='{$i}' {$activeClass} aria-label='Slide " . ($i + 1) . "'></button>";
    }

    echo "
              </div>
              <div class='carousel-inner notice'>
            ";

    $isFirst = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $activeClass = $isFirst ? "active" : "";
      $isFirst = false;

      echo "
                <div class='carousel-item notice {$activeClass}'>
                    <div class='noticeContent text-light'>
                        <div class='noticeLogo row justify-content-center'>
                            <img src='static images/LOGO1.png' class='col-3'>
                        </div>
                        <div class='cont'>
                            <h3 class='fw-bold text-center text-uppercase'>" . htmlspecialchars($row['title'] ?? "") . "</h3>
                            <div class='text-center'>" . htmlspecialchars($row['content'] ?? "") . "</div>
                            <h5 class='text-center tradi-blue2'>" . htmlspecialchars($row['facultyName'] ?? "") . "</h5>
                            <h6 class='text-center tradi-yellow2'>" . htmlspecialchars($row['departments'] ?? "") . "</h6>
                        </div>
                    </div>
                </div>
                ";
    }

    echo "
              </div>
              <button class='carousel-control-prev' type='button' data-bs-target='#nots' data-bs-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Previous</span>
              </button>
              <button class='carousel-control-next' type='button' data-bs-target='#nots' data-bs-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Next</span>
              </button>
            </div>
            <div class='buttonCont'>
              <button class='btn generalButton'>View All</button>
            </div>
            ";
  } else {
    echo "<p class='text-center text-muted'>No notices available.</p>";
  }
}

function events($con)
{
  $selectQuery = "SELECT `eventID`, `eventTitle`, `eventLocation`, `eventDate`, `bgmImage` FROM `eventtable`";
  $result = mysqli_query($con, $selectQuery);
  $count = mysqli_num_rows($result);
  if ($count > 0) {
    echo "
      <div id='evn' class='carousel slide' data-bs-ride='carousel' data-bs-interval='2000'>
        <div class='carousel-indicators'>
      ";
    for ($i = 0; $i < $count; $i++) {
      $attribute = ($i == 0) ? "class='active' aria-current='true'" : "";
      echo "<button type='button' data-bs-target='#evn' data-bs-slide-to='{$i}' {$attribute} aria-label='Slide " . ($i + 1) . "'></button>";
    }
    echo "
        </div>
        <div class='carousel-inner event'>
        ";
    $IsFirst = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $activeness = $IsFirst ? "active" : "";
      $IsFirst = false;
      echo "
          <div class='carousel-item event {$activeness}'>
            <div style='background-image: url(\"Dynamic images/events/" . $row['bgmImage'] . "\");' class='eventContent text-light'>
              <div class='cont'>
                <h3 class='fw-bold'>" . $row['eventTitle'] . "</h3>
                <div class='location'>
                  <i class='tradi-blue2 fa-solid fa-location-dot'></i>
                  <span>" . $row['eventLocation'] . "</span>
                </div>
                <div class='date'>
                  <i class='tradi-blue2 fa-solid fa-calendar-days'></i>
                  <span>" . $row['eventDate'] . "</span>
                </div>
              </div>
            </div>
          </div>
          ";
    }
    echo "
        </div>
        <button class='carousel-control-prev' type='button' data-bs-target='#evn' data-bs-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#evn' data-bs-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Next</span>
        </button>
      </div>
       <div class='buttonCont'>
          <button class='btn generalButton event'>View All</button>
        </div>
      ";
  } else {
    echo "<p class='text-center text-muted'>No events available.</p>";
  }
}

function notify($message, $type)
{
  echo "
  <div class='Notify'>
    <div class='toastContainer'>
  ";
  if (in_array($type, ["warning"])) {
    echo "
      <div class='order-2 Toast warnings'>
        <div class='headerToast warning d-flex justify-content-between'>
          <div class='message' style='color:#BA8E23;'>
            <i class='fa-solid fa-triangle-exclamation'></i>
            <span>Warning</span>
          </div>
          <button type='button' class='btn text-warning closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          " . $message["warning"] . "
        </div>
      </div>";
  }
  if (in_array($type, ["info"])) {
    echo "
      <div class='order-3 Toast infos'>
        <div class='headerToast info d-flex justify-content-between'>
          <div class='message' style='color:#ADD8E6;'>
            <i class='fa-solid fa-circle-info'></i>
            <span>Info</span>
          </div>
          <button type='button' class='btn text-info closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          " . $message["info"] . "
        </div>
      </div>";
  }
  if (in_array($type, ["danger"])) {
    echo "
      <div class='order-4 Toast dangers'>
        <div class='headerToast danger d-flex justify-content-between'>
          <div class='message' style='color:#FF474C;'>
            <i class='fa-solid fa-circle-xmark'></i>
            <span>Oops!!!</span>
          </div>
          <button type='button' class='btn text-danger closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          " . $message["danger"] . "
        </div>
      </div>";
  }
  if (in_array($type, ["success"])) {
    echo "
      <div class='order-5 Toast successes'>
        <div class='headerToast success d-flex justify-content-between'>
          <div class='message' style='color:#90EE90;'>
            <i class='fa-solid fa-square-check'></i>
            <span>Success</span>
          </div>
          <button type='button' class='btn text-success closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          " . $message["success"] . "
        </div>
      </div>";
  }
  echo "
    </div>
  </div>
  ";
}
