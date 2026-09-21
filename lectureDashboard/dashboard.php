<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="task-cards">
        <div class="card_DASH assignment">
            <h3 class="headType1">Uploaded</h3>
            <div class="numberBarLec tradi-blue2">12</div>
        </div>
        <div class="card_DASH submission">
            <h3 class="headType1">Results Submitted</h3>
            <div class="numberBarLec tradi-blue2">4</div>
        </div>
        <div class="card_DASH message">
            <h3 class="headType1">Messages Sent</h3>
            <div class="numberBarLec tradi-blue2">45</div>
        </div>
        <div class="card_DASH task">
            <h3 class="headType1">Tasks Assigned</h3>
            <div class="numberBarLec tradi-blue2">8</div>
        </div>
    </div>
    <section class="chartLec">
        <h3 class="text-center fw-bolder">Lecturer Activity Overview</h3>
        <canvas id="activityChart"></canvas>
    </section>
    <section class="p-3">
        <h3 class="text-center fw-bolder">Teaching affiliations</h3>
        <!-- PHP -->
        <?php
        $selectQuery  = "SELECT `faculty_ids`, `department_ids` FROM `staffsaccount` WHERE `staffID` = '{$STFID}'";
        $result = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($result);
        $str1 = $row['faculty_ids'] ?? "";
        $str2 = $row['department_ids'] ?? "";
        if (!empty($str1) && !empty($str2)) {
            //specific Lecturer modules
            $selectedFaculties = explode('|', $str1);
            $selectedDepartments = explode("|", $str2);
            //specific Lecturer modules

            //LOGIC
            $uniData = [];
            $facultyArr = [];
            foreach ($selectedFaculties as $faculty) {
                $uni = "SELECT faculty.faculty_id, faculty.facultyName, 
                                    GROUP_CONCAT(department.department_id SEPARATOR '|') AS department_ids,
                                    GROUP_CONCAT(department.department_name SEPARATOR '|') AS department_names
                            FROM department 
                            INNER JOIN faculty ON department.faculty_id = faculty.faculty_id 
                            WHERE faculty.faculty_id = '{$faculty}'
                            GROUP BY faculty_id";
                $result = mysqli_query($con, $uni);
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<h3>{$row['facultyName']}</h3>";

                    $facultyArr[$faculty] = $row['facultyName'];

                    $allDepId = explode('|', $row['department_ids']);
                    $allDepName = explode('|', $row['department_names']);
                    $index = 0;
                    for ($i = 0; $i < count($allDepId); $i++) {
                        if (in_array($allDepId[$i], $selectedDepartments)) {
                            // echo "{$allDepId[$i]}       {$allDepName[$i]}<br>";
                            $uniData[$faculty]['did'][$index] = $allDepId[$i];
                            $uniData[$faculty]['dname'][$index] = $allDepName[$i];
                            $index++;
                        }
                    }
                }
            }
            echo "<div class='accordion' id='dashboard_stf_acc'>";
            foreach ($selectedFaculties as $faculty) {
                $facArr = $facultyArr[$faculty] ?? "";
                echo "
                    <div class='accordion-item'>
                        <h2 class='accordion-header'>
                            <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#{$faculty}' aria-expanded='false' aria-controls='{$faculty}'>
                                {$facArr}
                        </h2>
                        <div id='{$faculty}' class='accordion-collapse collapse' data-bs-parent='#dashboard_stf_acc'>
                            <div class='accordion-body p-0 '>
                                <ul class='btn-group p-0'>";
                for ($index = 0; $index < count($uniData[$faculty]['did']); $index++) {
                    echo "<a href='home.php?{$uniData[$faculty]['did'][$index]}' class = 'badge tradi-yellow1 tradi-yellow1-border p-1 m-1 fw-medium'>";
                    echo $uniData[$faculty]['dname'][$index];
                    echo '</a>';
                }
                echo "</ul>
                            </div>
                        </div>
                    </div>";
            }
            echo "</div>";
        } else {
            echo "<i class='text-secondary text-center' style='align-self-center'>Add your affiliations in Setting</i>";
        }

        //LOGIC
        //debug Purpose
        // print_r($uniData);
        // echo "<br>";
        // print_r($facultyArr);
        //debug Purpose
        ?>
        <style>
            .test {
                height: max-content;
            }
        </style>
    </section>
    <section class="multiFormsCont">
        <!-- An Annoncement to a Faculty -->
        <h3 class="span4 text-center fw-bolder">Annoncement</h3>
        <h5 class="span4 fs-6 text-center"><i>pick the class you wanna send message</i></h5>
        <form class="formContainer" method="post">
            <div class="subjectChackBoxes span4 align-items-center  p-1">
                <?php
                $data = subjectInformations($con, pickedSubjectbyLecturer($con, "$STFID"));
                foreach ($data as $i => $value) {
                    $subjectInfo = json_decode(json_encode($value));
                    echo "
                        <input class='selSub' type='checkbox' name='$subjectInfo->subject_name' id='$subjectInfo->subject_id' value='$subjectInfo->subject_id'>
                        <label class='tradi-blue1 fw-medium depCheckBox' for='$subjectInfo->subject_id'>$subjectInfo->subject_name</label>
                        <span class='badge text-light tradi-blue1-bg'>$subjectInfo->department_id</span>";
                }
                ?>
            </div>
            <?php
            if (!empty($str1) && !empty($str2)) {
                echo "
                    <label for='dueDate' class='span1'>Due Date : </label>
                    <input class='inputBarDesign form2 span3' type='date' placeholder='Due Date' id='dueDate'>
                    <input class='inputBarDesign title form2' type='text' placeholder='Title'>
                    <textarea class='inputBarDesign message-box span4' placeholder='Type your message here'></textarea>
                    <button type='button' class='generalButton column4'>Send</button>
                    ";
            } else {
                echo "<i class='span4 text-secondary text-center'>Add your affiliations in Setting</i>";
            }
            ?>
        </form>
    </section>
</body>

</html>