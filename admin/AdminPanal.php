<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIN PANEL</title>
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
    body {
      display: grid;
      grid-template-areas:
        "aside welcome welcome"
        "aside body body";
      height: 100vh;
      grid-template-rows: 1fr 8fr;
      grid-template-columns: 1fr 5fr;
      gap: 8px;
      padding: 8px;
      font-family: "Open Sans", sans-serif;
    }
  </style>
</head>

<body>
  <div class="mainContainer container1">
    <a href="AdminPanal.php?landingPage">
      <img src="../static images/LOGO1.png" alt="LOGO" class="LOGO1" />
    </a>
    <div class="buttonset">
      <a href="AdminPanal.php?add" class="btn d-flex align-items-center justify-content-center">ADD</a>
      <a href="AdminPanal.php?update" class="btn d-flex align-items-center justify-content-center">UPDATE</a>
      <a href="AdminPanal.php?read" class="btn d-flex align-items-center justify-content-center">READ</a>
      <a href="AdminPanal.php?delete" class="btn d-flex align-items-center justify-content-center">DELETE</a>
    </div>
  </div>
  <div
    class="mainContainer container2 d-flex align-items-center justify-content-center">
    <h1 class="mainheading">Welcome !</h1>
  </div>
  <div class="mainContainer container3">
    <div class="buttonset2 btn-group">
      <a href="#lc-panel" class="UserType btn">Staff</a>
      <a href="#std-panel" class="UserType btn">Student</a>
      <a href="#fid" class="UserType btn">Faculty</a>
      <a href="#did" class="UserType btn">Department</a>
    </div>
    <div class="subContainer">
      <?php
      if (isset($_GET['add'])) {
        include('add.php');
      } else if (isset($_GET['update'])) {
        include('update.php');
      } else if (isset($_GET['read'])) {
        include('read.php');
      } else if (isset($_GET['delete'])) {
        include('delete.php');
      } else if (isset($_GET['landingPage'])) {
        include('landningPage.php');
      }
      ?>
    </div>
  </div>
  <script src="../JavaScript/function.js"></script>
</body>

</html>