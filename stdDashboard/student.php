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
</head>

<body>
    <div class="dashboard-container">
        <!-- header -->
        <div class="header">
            <?php
            $SID = $_SESSION['STDID'];
            $selectQuery = "SELECT `std_fname`, `std_lname`, `std_dob`, `nic`, `email`, `gender`, `faculty_id`, `department_id`, `aYear`, `profile_pic_path` FROM `studets` WHERE `stdID` = '$SID'";
            $result = mysqli_query($con, $selectQuery);
            $row = mysqli_fetch_assoc($result);
            $fname = $row['std_fname'] ?? "";
            $lname = $row['std_lname'] ?? "";
            $name = $fname . " " . $lname;
            #__________________________________________________________________
            $UNAME = $_SESSION['UNAME'] ?? "";
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
                        <p class='p-0 m-0 me-3 tradi-blue1 fw-light'>{$SID}</p>
                        ";
                    ?>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="student_dashboard.php" title="Home">
                    <i class="fa-solid fa-house"></i>
                </a>
                <div class="textBOX tradi-yellow2">Home</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="My subjects">
                    <i class="fa-solid fa-book"></i>
                </a>
                <div class="textBOX tradi-yellow2">Subject</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Timetable">
                    <i class="fa-solid fa-table"></i>
                </a>
                <div class="textBOX tradi-yellow2">Timetable</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Results">
                    <i class="fa-solid fa-sheet-plastic"></i>
                </a>
                <div class="textBOX tradi-yellow2">Results</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Projects">
                    <i class="fa-solid fa-clipboard-list"></i>
                </a>
                <div class="textBOX tradi-yellow2">Projects</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Resources">
                    <i class="fa-solid fa-box-open"></i>
                </a>
                <div class="textBOX tradi-yellow2">Resources</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Settings">
                    <i class="fa-solid fa-gear"></i>
                </a>
                <div class="textBOX tradi-yellow2">Setting</div>
            </div>
            <div class="sideBarContet text-center">
                <a class="dashBoardLink" href="#" title="Logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
                <div class="textBOX tradi-yellow2">Logout</div>
            </div>

        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <?php
            if (isset($_GET['dashboard'])) {
                include('home.php');
            }
            ?>
        </main>
    </div>
    <script src="../JavaScript/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('gpaChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 100, 400);
        gradient.addColorStop(0, ' #b0d8ff');
        gradient.addColorStop(1, '#80b4e721');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1.1', '1.2', '2.1', '2.2', '3.1', '3.2', '4.1', '4.2'],
                datasets: [{
                    label: 'GPA',
                    data: [3.2, 3.5, 3.8, 3.6, 3.2, 3.5, 3.8, 3.6],
                    borderColor: '#122044',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4
                    }
                }
            }
        });
    </script>
</body>

</html>