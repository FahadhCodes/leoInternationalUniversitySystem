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
#_____________________lectureDashboard__________________________________________________

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
if (!empty($data["payloadid"]) && $data["payloadid"] == "00001") {
    $STFID = $_SESSION['STFID'] ?? "";
    $selectedSubjects = $data['selectedSubjects'] ?? '';
    $dueDate          = $data['dueDate'] ?? null;
    $title            = $data['title'] ?? '';
    $message          = $data['messageBox'] ?? '';

    $insertQuery = "INSERT INTO `lectureannouncement`( `staffID`, `subject_ids`, `title`, `message`, `due_at`) VALUES ('$STFID','$selectedSubjects','$title','$message','$dueDate')";
    mysqli_query($con, $insertQuery);
    echo json_encode([
        "type" => "successes",
        "message" => "Message received successfully",
    ]);
} else if (!empty($data["payloadid"]) && $data["payloadid"] == "00002") {
    $STFID = $_SESSION['STFID'] ?? "";
    $setting_userName = $data['setting_userName'] ?? '';

    $updateQuery = "UPDATE `staffsaccount` SET `userName`='$setting_userName' WHERE `staffID`='$STFID'";
    mysqli_query($con, $updateQuery);
    echo json_encode([
        "type" => "successes",
        "message" => "Username changed successfully",
    ]);
} else if (!empty($data["payloadid"]) && $data["payloadid"] == "00003") {
    $STFID = $_SESSION['STFID'] ?? "";
    $setting_current_pswrd = $data['setting_current_pswrd'] ?? '';
    $setting_confirm_pswrd = $data['setting_confirm_pswrd'] ?? '';
    $selectQuery = "SELECT `pswrd` FROM `staffsaccount` WHERE `staffID` = '$STFID'";
    $row = mysqli_fetch_assoc(mysqli_query($con, $selectQuery));
    if (password_verify($setting_current_pswrd, $row['pswrd'])) {
        $hash = password_hash($setting_confirm_pswrd, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE `staffsaccount` SET `pswrd`='$hash' WHERE `staffID`='$STFID'";
        echo json_encode([
            "type" => "successes",
            "message" => "Password changed successfully",
        ]);
    } else {
        echo json_encode([
            "type" => "dangers",
            "message" => "Your Current password does not matched with previous password if you wanna reset cont",
        ]);
    }
} else if (!empty($data["payloadid"]) && $data["payloadid"] == "00004") {
    $response_data = [];
    $setting_faculty_ids = $data["setting_faculty_ids"] ?? '';
    if (!empty($setting_faculty_ids)) {
        $selectQuery = "SELECT `faculty_id`, `facultyName` FROM `faculty` WHERE `faculty_id` LIKE '%$setting_faculty_ids%'";
        $result = mysqli_query($con, $selectQuery);
        while ($row = mysqli_fetch_assoc($result)) {
            $response_data[] = $row;
        }
        echo json_encode($response_data);
    }
}
#_____________________lectureDashboard__________________________________________________


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
