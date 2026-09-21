<?php
session_start();
include('../Includes/connection.php');
global $con;
global $STFID;
$STFID = $_SESSION['STFID'] ?? "";
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
            grid-template-rows: 1fr 20fr;
            height: 100vh;
            overflow: hidden;
        }

        /* Main content */

        .subContainer {
            overflow: visible;
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
            border: none;
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
            gap: 5px;
            padding: 10px;
            grid-template-columns: 1fr 1fr;
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

        .accordion-item {
            overflow: visible;
            border-width: 1px 0px 1px 0px;
            border-top: 1px solid var(--color1);
            border-bottom: 1px solid var(--color1);
        }

        .accordion-button {
            background-color: var(--color7) !important;
            color: var(--color1);
            font-weight: 800;
            font-size: 0.7em;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--color1) !important;
            color: var(--colorD);
        }

        .badge {
            font-size: 0.8em;
            transition: all 0.3s;
        }

        .badge:hover {
            color: var(--color1);
            border-color: var(--color1);
        }
    </style>
</head>

<body>
    <div class="header">
        <?php
        // $STFID = $_SESSION['STFID'] ?? "";
        $selectQuery = "SELECT `userName`, `pswrd`, `faculty_ids`, `department_ids`, `subjects` FROM `staffsaccount` WHERE `staffID` = '$STFID'";
        $result = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($result);
        $name = $row["userName"] ?? '';
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
        if (!empty($_SESSION['STDID']) && empty($STFID)) {
            $PROFILEPICPATH = !empty($profilepic) ? "../Dynamic images/students/{$profilepic}" : "$onlineprofilepic";
        } else if (empty($_SESSION['STDID']) && !empty($STFID)) {
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
                        <span class='badge tradi-blue1-bg text-light py-1 px-2' style='font-size: 0.72rem;'><i class='fa-solid fa-id-badge me-1'></i>{$STFID}</span>
                        ";
                ?>
            </div>
        </div>
    </div>
    <aside class="sidebar">
        <div class="sideBarContet text-center">
            <a class="dashBoardLink" href="home.php?dashboard" title="Home">
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
            <a class="dashBoardLink" href="home.php?setting" title="Setting">
                <i class="fa-solid fa-gear"></i>
            </a>
            <div class="textBOX tradi-yellow2">Settings</div>
        </div>
    </aside>
    <div class="main-content">
        <?php
        if (isset($_GET['dashboard'])) {
            include('dashboard.php');
        } else if (isset($_GET['setting'])) {
            include('setting.php');
        }
        ?>
    </div>
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
    <script src="../JavaScript/function.js"></script>
</body>

</html>