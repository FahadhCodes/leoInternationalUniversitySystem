<?php
session_start();
include('Includes/connection.php');
header('Content-Type: application/json');

#________Exam Result Table Respons________________________________________________________________________________________________
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

$examResultTable = [];

while ($row = mysqli_fetch_assoc($result)) {
    $examResultTable[] = $row;
}
#________Exam Result Table Respons________________________________________________________________________________________________
#________FacDep___________________________________________________________________________________________________________________
$fid = $_GET['faculty_id'] ?? "";
$depid = $_GET['department_id'] ?? "";
$stfID = $_SESSION['STFID'] ?? "";

// $selectQuery1 = "SELECT `faculty_id`, `facultyName` FROM `faculty`";
// $result1 = mysqli_query($con, $selectQuery1);

$selectQuery1 = "SELECT faculty.faculty_id, faculty.facultyName, department.department_id, department.department_name 
                 FROM `faculty` 
                 INNER JOIN department ON faculty.faculty_id=department.faculty_id
                 WHERE faculty.faculty_id = '$fid'";
$result1 = mysqli_query($con, $selectQuery1);

$data = [];
while ($row = mysqli_fetch_assoc($result1)) {
    $data[] = $row;
}
#________FacDep___________________________________________________________________________________________________________________



#_________________________________________________FunctionCall____________________________________________________________________
if (isset($_GET['YEAR_AND_SEM'], $_GET['SEARCH'])) {
    // stdDashboard_Home_subject($con);
    echo json_encode($examResultTable);
} else if (isset($_GET['faculty_id'])) {
    echo json_encode($data);
}
#_________________________________________________FunctionCall____________________________________________________________________
