<?php
session_start();
require '../Includes/connection.php';
include('../Includes/function.php');
if (!empty($_SESSION['message'])) {
  notify($message = [$_SESSION['type'] => $_SESSION['message']], $_SESSION['type']);
  session_unset();
}
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
    <form action="" method="post" class="my-3 STUDENTS">
      <div class="formContainer">
        <!--------------------------------------------------------------------------STUDENTS----------------------------------------------------------------------->
        <h2 id="std-panel">Student Tag Editing Panel</h2>
        <!--Name-->
        <label for="stdID STUDENTS">Student ID</label>
        <input class="mustFILL STUDENTS" type="text" name="stdID" id="stdID" />
        <label for="tag">Tag</label>
        <select name="tag" id="tag" class="mustFILL STUDENTS">
          <option value="0" selected hidden>Select Tag</option>
          <option value="BR">Best Researcher</option>
          <option value="TI">Top Innovator</option>
          <option value="AE">Academic Excellence</option>
          <option value="FS">Future Scientist</option>
          <option value="RS">Rising Scholar</option>
        </select>
        <button type="submit" name="submit-A" class="btn btn-dark submit-A submitButton" data-section="STUDENTS">
          Update
        </button>
      </div>
      <?php
      $stdID = $tag = "";
      if (isset($_POST['submit-A'])) {
        $stdID = $_POST['stdID'];
        if ($tag = $_POST['tag']) {
          $updateQuery = "UPDATE `studentaccount` SET `tag`='$tag' WHERE `stdID`='$stdID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Student tag Updated")], "success");
        }
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 NOTICE">
      <div class="formContainer notice">
        <h2 id="std-panel">Post Notices</h2>
        <!--Name-->
        <label for="title">Notice Title</label>
        <input class="mustFILL NOTICE" type="text" name="title" id="title" />
        <label for="dep">Related Departments</label>
        <input class="NOTICE" type="text" name="dep" id="dep" placeholder="Enter Department Code Ex:PST" />
        <label for="facultySelection1">Faculty</label>
        <select
          name="facultySelection1"
          id="facultySelection1"
          onchange="inputbarEnabler()"
          class="NOTICE">
          <option value="0" selected hidden>Select a Faculty</option>
          <?php
          facultySelectOptions($con);
          ?>
        </select>
        <label for="content" class="content">Notice content</label>
        <textarea name="content" id="content" class="textAreaDesign" cols="30" rows="5"></textarea>

        <button type="submit" name="submit-B" class="btn btn-dark submit-B submitButton" data-section="NOTICE">
          Post
        </button>
      </div>
      <?php
      $ID = $title = $dep = $facultySelection1 = $content = "";
      $selectQuery = "SELECT `notice_id`, `title`, `content`, `faculty`, `departments` FROM `notice`";
      $result = mysqli_query($con, $selectQuery);
      $count = mysqli_num_rows($result);
      if (empty($count)) {
        $ID = 1;
      } else {
        $ID = $count + 1;
      }
      if (isset($_POST['submit-B'])) {
        $title = $_POST['title'];
        $dep = $_POST['dep'];
        $facultySelection1 = $_POST['facultySelection1'];
        $content  = $_POST['content'];

        if (!empty($title) && !empty($content)) {
          $inserQuery = "INSERT INTO `notice`(`notice_id`, `title`, `content`, `faculty`, `departments`) VALUES ('$ID','$title','$content','$facultySelection1','$dep')";
          mysqli_query($con, $inserQuery);
          notify($message = ["success" => strtoupper("Notice Published!")], "success");
        }
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 NOTICE_U">
      <div class="formContainer notice">
        <h2 id="std-panel">Update Notices</h2>
        <!--Name-->
        <label for="ID">Notice ID</label>
        <input class="subForm primaryKey NOTICE_U" type="text" name="ID" id="ID" placeholder="enter the slide number EX: 1,2, etc..." />
        <label for="title">Notice Title</label>
        <input class="subForm NOTICE_U" type="text" name="title" id="title" />
        <label for="dep">Related Departments</label>
        <input class="subForm NOTICE_U" type="text" name="dep" id="dep" placeholder="Enter Department Code Ex:PST" />
        <label for="facultySelection2">Faculty</label>
        <select
          name="facultySelection2"
          id="facultySelection2"
          onchange="inputbarEnabler()"
          class="subForm NOTICE_U">
          <option value="0" selected hidden>Select a Faculty</option>
          <?php
          facultySelectOptions($con);
          ?>
        </select>
        <label for="content" class="content">Notice content</label>
        <textarea name="content" id="content" class="textAreaDesign" cols="30" rows="5"></textarea>

        <button type="submit" name="submit-C" class="btn btn-dark landingPage submit-C submitButton_U" data-section="NOTICE_U">
          Update
        </button>
      </div>
      <?php
      $ID = $title = $dep = $facultySelection2 = $content = "";
      if (isset($_POST['submit-C'])) {
        $ID = $_POST['ID'];
        if ($title = $_POST['title']) {
          $updateQuery = "UPDATE `notice` SET `title`='$title' WHERE `notice_id`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Notice Title Updated")], "success");
        }
        if ($content  = $_POST['content']) {
          $updateQuery = "UPDATE `notice` SET `content`='$content' WHERE `notice_id`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Notice Content Updated")], "success");
        }
        if ($facultySelection2 = $_POST['facultySelection2']) {
          $updateQuery = "UPDATE `notice` SET `faculty`='$facultySelection2' WHERE `notice_id`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Notice Realated Faculty Updated")], "success");
        }
        if ($dep = $_POST['dep']) {
          $updateQuery = "UPDATE `notice` SET `departments`='$dep' WHERE `notice_id`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Notice Realated Department Updated")], "success");
        }
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 NOTICE_D">
      <div class="formContainer notice">
        <h2 id="std-panel">Delete Notices</h2>
        <!--Name-->
        <label for="ID">Notice ID</label>
        <input class="mustFILL NOTICE_D" type="text" name="ID" id="ID" />

        <button type="submit" name="submit-D" class="btn btn-dark landingPage submit-D submitButton" data-section="NOTICE_D">
          Delete
        </button>
      </div>
      <?php
      $ID = $title = $dep = $facultySelection2 = $content = "";
      if (isset($_POST['submit-D'])) {
        $ID = $_POST['ID'];
        $deleteQuery = "DELETE FROM `notice` WHERE `notice_id`='$ID'";
        mysqli_query($con, $deleteQuery);
        notify($message = ["success" => strtoupper("Notice Deleted!")], "success");
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 EVENT" enctype="multipart/form-data">
      <div class="formContainer notice">
        <h2 id="std-panel">Post Event</h2>
        <!--Name-->
        <label for="title">Event Title</label>
        <input class="mustFILL EVENT" type="text" name="title" id="title" />
        <label for="loca">Event Location</label>
        <input class="mustFILL EVENT" type="text" name="loca" id="loca" />
        <label for="date">Event Location</label>
        <input class="mustFILL EVENT" type="date" name="date" id="date" />
        <label for="bgmi">Background Image</label>
        <input class="mustFILL EVENT" type="file" name="bgmi" id="bgmi" />
        <button type="submit" name="submit-E" class="btn btn-dark submit-B submitButton" data-section="EVENT">
          Post
        </button>
      </div>
      <?php
      $ID = $title = $loca = $date = $bgmi = "";
      $selectQuery = "SELECT `eventID`, `eventTitle`, `eventLocation`, `eventDate`, `bgmImage` FROM `eventtable` WHERE 1";
      $result = mysqli_query($con, $selectQuery);
      $count = mysqli_num_rows($result);
      if (empty($count)) {
        $ID = 1;
      } else {
        $ID = $count + 1;
      }
      if (isset($_POST['submit-E'])) {
        $title = $_POST['title'] ?? "";
        $loca = $_POST['loca'] ?? "";
        $date = $_POST['date'] ?? "";
        $fileName = $_FILES['bgmi']['name'];
        $tempPath = $_FILES['bgmi']['tmp_name'];
        $imgArr = explode(".", $fileName);
        $ext = $imgArr[sizeof($imgArr) - 1];
        $rename = $ID . "." . $ext;
        $filePath = "../Dynamic images/events/$rename";

        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
          $inserQuery = "INSERT INTO `eventtable`(`eventID`, `eventTitle`, `eventLocation`, `eventDate`, `bgmImage`) VALUES ('$ID','$title','$loca','$date','$rename')";
          mysqli_query($con, $inserQuery);
          move_uploaded_file($tempPath, $filePath);
          notify($message = ["success" => strtoupper("EVENT UPLOADED")], "success");
        } else {
          notify($message = ["success" => strtoupper("PLEASE UPLOAD AN VALID IMAGE FILE")], "success");
        }
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 EVENT1" enctype="multipart/form-data">
      <div class="formContainer notice">
        <h2 id="std-panel">Update Event</h2>
        <!--Name-->
        <label for="ID">Event ID</label>
        <input class="subForm primaryKey EVENT1" type="number" name="ID" id="ID" />
        <label for="title">Event Title</label>
        <input class="subForm EVENT1" type="text" name="title" id="title" />
        <label for="loca">Event Location</label>
        <input class="subForm EVENT1" type="text" name="loca" id="loca" />
        <label for="date">Event Location</label>
        <input class="subForm EVENT1" type="date" name="date" id="date" />
        <label for="bgmi">Background Image</label>
        <input class="subForm EVENT1" type="file" name="bgmi" id="bgmi" />
        <button type="submit" name="submit-F" class="btn btn-dark submitButton submit-F landingpage" data-section="EVENT1">
          Update
        </button>
      </div>
      <?php
      if (isset($_POST['submit-F'])) {
        $ID = $_POST['ID'];
        if ($title = $_POST['title']) {
          $updateQuery = "UPDATE `eventtable` SET `eventTitle`='$title' WHERE `eventID`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Title Updated")], "success");
        }
        if ($loca = $_POST['loca']) {
          $updateQuery = "UPDATE `eventtable` SET `eventLocation`='$loca' WHERE `eventID`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Location Updated")], "success");
        }
        if ($date = $_POST['date']) {
          $updateQuery = "UPDATE `eventtable` SET `eventDate`='$date' WHERE `eventID`='$ID'";
          mysqli_query($con, $updateQuery);
          notify($message = ["success" => strtoupper("Date Updated")], "success");
        }
        if ($fileName = $_FILES['bgmi']['name']) {
          $tempPath = $_FILES['bgmi']['tmp_name'];
          $imgArr = explode(".", $fileName);
          $ext = $imgArr[sizeof($imgArr) - 1];
          $rename = $ID . "." . $ext;
          $filePath = "../Dynamic images/events/$rename";
          if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            $updateQuery = "UPDATE `eventtable` SET `bgmImage`='$rename' WHERE `eventID`='$ID'";
            mysqli_query($con, $updateQuery);
            move_uploaded_file($tempPath, $filePath);
            notify($message = ["success" => "EVENT BACKROUND IMAGE UPDAED"], "success");
          } else {
            notify($message = ["success" => "PLEASE UPLOAD AN VALID IMAGE FILE"], "success");
          }
        }
      }
      ?>
    </form>
    <form action="" method="post" class="my-3 EVENT2" enctype="multipart/form-data">
      <div class="formContainer notice">
        <h2 id="std-panel">Delete Event</h2>
        <!--Name-->
        <label for="ID">Event ID</label>
        <input class="subForm primaryKey EVENT2" type="number" name="ID" id="ID" />
        <button type="submit" name="submit-G" class="btn btn-dark submitButton submit-G landingpage" data-section="EVENT2">
          Delete
        </button>
      </div>
      <?php
      if (isset($_POST['submit-G'])) {
        $ID = $_POST['ID'];
        $selectQuery = "SELECT `eventTitle`, `eventLocation`, `eventDate`, `bgmImage` FROM `eventtable` WHERE `eventID`='$ID'";
        $result = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($result);
        $filename = $row['bgmImage'] ?? "";
        $deleteQuery = "DELETE FROM `eventtable` WHERE `eventID`='$ID'";
        mysqli_query($con, $deleteQuery);
        unlink("../Dynamic images/events/{$filename}");
        notify($message = ["success" => "EVENT DELETED"], "success");
      }
      ?>
    </form>
  </div>
  <script src="../JavaScript/function.js"></script>
  <script>
    updateFormValidation();
  </script>
</body>

</html>