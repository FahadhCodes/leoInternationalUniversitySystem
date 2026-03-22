<?php

use LDAP\Result;

require "Includes/function.php";
require "Includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <form action="" method="post">
    <button type="submit" name="hello">Hello</button>
    <button type="submit" name="hello1">Hello</button>
  </form>
  <form action="" method="post">
    <button type="button" name="hello">Hello</button>
    <button type="button" name="hello1">Hello</button>
  </form>
  <?php
  echo "
  <table>
      <tr>
          <td>DID</td>
          <td>DepName</td>
          <td>FID</td>
          <td>FName</td>
      </tr>
  ";
  $faculties = array('AG', 'GE', 'TC');
  foreach ($faculties as $fac) {
    $query = "CALL facAndDep('$fac')";
    $Result = mysqli_query($con, $query);

    $departments = array('ASE', 'ASA', 'GSG', 'TET', 'TBT');

    while ($row = mysqli_fetch_assoc($Result)) {
      // Filter while fetching
      if (in_array($row['department_id'], $departments)) {
        echo "
          <tr>
              <td>" . htmlspecialchars($row['department_id']) . "</td>
              <td>" . htmlspecialchars($row['department_name']) . "</td>
              <td>" . htmlspecialchars($row['faculty_id']) . "</td>
              <td>" . htmlspecialchars($row['facultyName']) . "</td>
          </tr>
          ";
      }
    }

    mysqli_free_result($Result);
    // Consume next result sets
    while (mysqli_next_result($con)) {
      if ($result = mysqli_store_result($con)) {
        mysqli_free_result($result);
      }
    }
  }
  echo "</table>";
  // $query = "CALL facAndDep('AP')";
  // $Result = mysqli_query($con, $query);

  // print_r($Result);
  // var_dump($Result);

  // echo "<br>";
  // $depID = [];
  // $i = 0;
  // while ($row = mysqli_fetch_assoc($Result)) {
  //   $depID[$i] = $row['department_id'];
  //   $i += 1;
  // }
  // echo $depID[2];
  ?>
  <script src="JavaScript/function.js"></script>
</body>

</html>