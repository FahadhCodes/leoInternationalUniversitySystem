<?php
session_start();
include('Includes/connection.php');
header('Content-Type: application/json');

#________Exam Result Table Respons________________________________________________________________________________________________
$yearSem = $_GET['YEAR_AND_SEM'] ?? "";
$year = explode(".", $yearSem)[0] ?? "";
$Sem  = explode(".", $yearSem)[1] ?? "";
$stdId = $_SESSION['STDID'] ?? "";
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

$selectQuery1 = "SELECT faculty.faculty_id, faculty.facultyName, department.department_id, department.department_name 
                 FROM `faculty` 
                 INNER JOIN department ON faculty.faculty_id=department.faculty_id
                 WHERE faculty.faculty_id = '$fid'";
$result1 = mysqli_query($con, $selectQuery1);

$data = [];
while ($row = mysqli_fetch_assoc($result1)) {
    $data[] = $row;
}

#_____________________subjects responses__________________________________________________
$department_ids = $_GET['dids'] ?? "";
$year = $_GET['year'] ?? "";
$semester = $_GET['sem'] ?? "";
$subjectsRes = [];

$department_ids_arr = explode("|", $department_ids);
foreach ($department_ids_arr as $dep) {
    $subjects = mysqli_query($con, "SELECT * FROM `subject` WHERE `department_id` = '{$dep}' AND `Year` = '{$year}' AND `semester` = '{$semester}'");
    while ($row = mysqli_fetch_assoc($subjects)) {
        $subjectsRes[] = $row;
    }
}
#_____________________subjects responses__________________________________________________


#________FacDep___________________________________________________________________________________________________________________
#________FacDepDB_________________________________________________________________________________________________________________
$fids = $_GET['fac'] ?? "";
$deps = $_GET['dep'] ?? "";
$subs = $_GET['sub'] ?? "";
$sftId = $_GET['stfId'] ?? "";
#________FacDepDB_________________________________________________________________________________________________________________

#_________________________________________________FunctionCall____________________________________________________________________
if (isset($_GET['YEAR_AND_SEM'], $_GET['SEARCH'])) {
    // stdDashboard_Home_subject($con);
    echo json_encode($examResultTable);
} else if (isset($_GET['faculty_id'])) {
    echo json_encode($data);
} else if (!empty($fids) && !empty($deps) && !empty($sftId)) {
    $autoToast = [];
    $row = mysqli_fetch_assoc(mysqli_query($con, "SELECT `staffID` FROM `staffsaccount` WHERE `staffID` = '{$sftId}'"));
    if (!empty($row['staffID'])) {
        $update = "UPDATE `staffsaccount` SET `faculty_ids`='$fids',`department_ids`='$deps',`subjects`='$subs' WHERE `staffID`='$sftId'";
        mysqli_query($con, $update);
        $autoToast["type"] = "successes";
        $autoToast["message"] = "Teaching affiliations updated";
    } else {
        $autoToast["type"] = "warnings";
        $autoToast["message"] = "That staff did not have an account yet or invalid Staff id";
    }
    echo json_encode($autoToast);
} else if (!empty($department_ids) || !empty($year) || !empty($semester)) {
    echo json_encode($subjectsRes);
} 
#_________________________________________________FunctionCall____________________________________________________________________
