<?php
session_start();
include('../Includes/connection.php');
include('../Includes/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous" />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../style.css" />
    <style>
        body {
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 9fr;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            padding: 20px;
        }

        /* Main content */
        .main-content {
            display: grid;
            gap: 10px;
            grid-template-columns: 1fr 1fr;
        }

        /* Sections */
        section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px #00000050;
            margin-bottom: 20px;
        }

        section.chartLec {
            grid-column: span 2;
        }

        section h3 {
            margin-bottom: 15px;
            color: #1e3a8a;
        }

        canvas {
            width: 100%;
            height: 100px;
        }

        .button1 {
            grid-column-start: 4;
        }

        .formContainer {
            gap: 2px;
        }

        .formContainer.form1 {
            display: grid;
            height: 100%;
            align-content: center;
            row-gap: 30px;
            grid-template-columns: 1fr;
        }

        .formContainer.form1>select,
        .formContainer.form1>input {
            grid-column: span 4;
        }

        .formContainer.form1>button {
            grid-row-start: 4;
            grid-column-start: 4;
            width: fit-content;
            height: fit-content;
            justify-self: center;
            padding: 10px;
        }

        .multiFormsCont {
            grid-column: span 3;
            display: grid;
            gap: 5px;
            padding: 10px;
            grid-template-columns: 1fr 1fr;
            width: fit-content;
        }

        .formContainer.form3 {
            grid-template-columns: 1fr 1fr;
        }

        .formContainer.form3>button {
            grid-row-start: 3;
            grid-column-start: 3;
            padding: 10px;
            justify-self: end;
            height: fit-content;
            width: fit-content;
        }

        .formContainer.form2.speci1 {
            grid-column: span 2;
        }

        .formContainer.form2>button {
            padding: 10px;
            grid-row-start: 5;
            width: fit-content;
            justify-self: end;
            grid-column: span 4;
        }

        .formContainer.form2>textarea {
            grid-column: span 4;
        }

        .inputBarDesign.form2 {
            grid-column: span 4;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php
        $STFID = $_SESSION['STFID'] ?? "";
        $selectQuery = "SELECT `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role` FROM `staffs` WHERE `staffID`='$STFID'";
        $result = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($result);
        $fname = $row['staff_fname'] ?? "";
        $lname = $row['staff_lname'] ?? "";
        $name = $fname . " " . $lname;
        #__________________________________________________________________
        $gender = strtoupper($_SESSION['GENDER'] ?? "");
        $INT = nicToRandom($_SESSION['NIC'] ?? "");
        if ($gender === "MALE") {
            $_SESSION['ONLINEPROFILE'] = "https://xsgames.co/randomusers/assets/avatars/male/{$INT}.jpg";
        } else if ($gender === "FEMALE") {
            $_SESSION['ONLINEPROFILE'] = "https://xsgames.co/randomusers/assets/avatars/female/{$INT}.jpg";
        } else {
            $_SESSION['ONLINEPROFILE'] = "static images/sampleImage.png";
        }

        $profilepic = $_SESSION['PROFILEPIC'] ?? "";
        $onlineprofilepic = $_SESSION['ONLINEPROFILE'] ?? "";
        if (!empty($_SESSION['STDID']) && empty($_SESSION['STFID'])) {
            $PROFILEPICPATH = !empty($profilepic) ? "../Dynamic images/students/{$profilepic}" : "$onlineprofilepic";
        } else if (empty($_SESSION['STDID']) && !empty($_SESSION['STFID'])) {
            $PROFILEPICPATH = !empty($profilepic) ? "../Dynamic images/staffs/{$profilepic}" : "$onlineprofilepic";
        } else {
            $PROFILEPICPATH = !empty($profilepic) ? "../static images/sampleImage.png" : "$onlineprofilepic";
        }
        #__________________________________________________________________

        ?>
        <div class="logoDashboard p-3 d-flex align-items-center">
            <a href="../index.php">
                <img src="../static images/LOGO1.png" width="125px">
            </a>
            <div class="path">
                <a href="student_dashboard.php" class="themLink fs-4">Home</a>
            </div>
        </div>
        <div class="Container d-flex align-items-center">
            <div class="notificationLOGO m-3">
                <i class="fa-solid fa-bell tradi-blue1 fs-2"></i>
            </div>
            <div class="profileCard m-3">
                <?php
                echo "
                        <img src='{$PROFILEPICPATH}' width='45px' class='profilePicture'>
                        ";
                ?>
            </div>
            <div class="profile_text">
                <?php
                echo "
                        <p class='p-0 m-0 me-3 tradi-blue1 fw-bolder'>{$name}</p>
                        <p class='p-0 m-0 me-3 tradi-blue1 fw-light'>{$STFID}</p>
                        ";
                ?>
            </div>
        </div>
    </div>
    <aside class="sidebar">
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-chart-line"></i>
            </a>
            <div class="textBOX tradi-yellow2">Dashboard</div>
        </div>
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-upload"></i>
            </a>
            <div class="textBOX tradi-yellow2">Uploads</div>
        </div>
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-file-pen"></i>
            </a>
            <div class="textBOX tradi-yellow2">Manage Results</div>
        </div>
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-tasks"></i>
            </a>
            <div class="textBOX tradi-yellow2">Assign Tasks</div>
        </div>
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-envelope"></i>
            </a>
            <div class="textBOX tradi-yellow2">Messages</div>
        </div>
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                <i class="fa-solid fa-gear"></i>
            </a>
            <div class="textBOX tradi-yellow2">Settings</div>
        </div>
    </aside>
    <div class="main-content">
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
        <section>
            <form class="formContainer form1">
                <h3>Upload Lecture Materials</h3>
                <select>
                    <option>Select Subject</option>
                    <option>Web Programming</option>
                    <option>Database Systems</option>
                </select>
                <input class="inputBarDesign" type="file">
                <button class="generalButton button1">Upload</button>
            </form>
        </section>
        <section class="multiFormsCont">
            <form class="formContainer form3">
                <h3>Submit Student Results</h3>
                <select>
                    <option>Select Subject</option>
                    <option>Java Programming</option>
                </select>
                <input class="inputBarDesign" type="text" placeholder="Student ID">
                <input class="inputBarDesign" type="text" placeholder="results">
                <button class="generalButton">Submit</button>
            </form>
            <form class="formContainer form2">
                <h3>Assign Tasks</h3>
                <select>
                    <option>Select Assignment Type</option>
                    <option>Group Wise</option>
                    <option>Department Wise</option>
                    <option>Gender Wise</option>
                </select>
                <textarea placeholder="Enter task details" class="inputBarDesign message-box"></textarea>
                <button class="generalButton">Assign</button>
            </form>
            <form class="formContainer form2 speci1">
                <h3>Send Message</h3>
                <input class="inputBarDesign form2" type="text" placeholder="Enter Student ID">
                <textarea class="inputBarDesign message-box" placeholder="Type your message here"></textarea>
                <button class="generalButton">Send</button>
            </form>
        </section>
    </div>
    <script src="../JavaScript/function.js"></script>
    <script>
        const ctx = document.getElementById('activityChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, ' #b0d8ff');
        gradient.addColorStop(1, '#80b4e721');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                datasets: [{
                    label: 'Lecturer Activity (Uploads & Tasks)',
                    data: [2, 4, 3, 6, 5],
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#1e3a8a',
                    tension: 0.4,
                    pointBackgroundColor: '#1e3a8a'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Activity Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Weeks'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>