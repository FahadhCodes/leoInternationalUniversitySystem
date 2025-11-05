<?php
include('../Includes/connection.php');
$year = $_GET['year'] ?? "";
$search = $_GET['search'] ?? "";

$selectQuery = "SELECT `subject_id`, `department_id`, `Year`, `semester`, `subject_name` FROM `subject` WHERE `Year`='$year' AND `subject_name` LIKE '%$search%'";
$result = mysqli_query($con, $selectQuery);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
