<?php
session_start();
#Server
include('../Includes/connection.php');
header('Content-Type: application/json');
$yearSem = $_GET['YEAR_AND_SEM'] ?? "";
$year = explode(".", $yearSem)[0] ?? "";
$Sem  = explode(".", $yearSem)[1] ?? "";
$stdId = $_SESSION['STDID'];
$search = $_GET['SEARCH'] ?? "";

$selectQuery = "SELECT fe.subject_id , sb.subject_name , fe.marks
                FROM finalexam fe
                INNER JOIN subject sb ON fe.subject_id = sb.subject_id
                WHERE sb.Year = '$year' AND sb.semester = '$Sem' AND fe.stdID = '$stdId' AND sb.subject_name LIKE '%$search%'";
$result = mysqli_query($con, $selectQuery);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
// function stdDashboard_Home_subject($con) {}


#_________________________________________________FunctionCall__________________
if (isset($_GET['YEAR_AND_SEM'], $_GET['SEARCH'])) {
    // stdDashboard_Home_subject($con);

}
