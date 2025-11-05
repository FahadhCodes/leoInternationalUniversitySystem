<?php
session_start();
if (isset($_POST['AdminSub'])) {
    $userName = $_POST['adminUsername'] ?? "";
    $password = htmlspecialchars(trim($_POST['adminPassword']));
    $arr = file('../adminCredential.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($userName == $arr[0] && password_verify($password, htmlspecialchars(trim($arr[1])))) {
        $_SESSION['type'] = "success";
        $_SESSION['message'] = "Login Success!!!";
        header("Location: AdminPanal.php?landingPage");
        exit;
    } else if ($userName != $arr[0] || !password_verify($password, htmlspecialchars(trim($arr[1])))) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = strtoupper("Entered Password or username is incorrect");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Portal</title>
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
    <style>
        body {
            height: 100vh;
            width: 100vw;
            display: grid;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(135deg, #9795f0 0%, #fbc8d4 25%, #9795f0 75%);
            background-position: -120vw 0vh;
            background-size: 400%;
            transition: all 0.5s ease;
        }

        .Container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            box-shadow: #8b8b8b9d 5px 5px 25px;
            border-radius: 10px;
            overflow: hidden;
        }

        .formContainer {
            grid-auto-flow: row;
            grid-template-columns: 1fr;
            align-content: center;
            border-radius: 0px;
            gap: 0px;
            border: none;
        }

        .headingContainer {
            text-align: center;
            grid-column: span 2;
        }

        #adminUsername:hover body {
            background-position: 0vw 0vh;
        }

        .cover {
            position: relative;
        }

        :root {
            --value: 100%;
        }

        .cover::before {
            content: '';
            position: absolute;
            width: var(--value);
            height: 100%;
            left: calc(50% - var(--value)/2);
            top: 15%;
            border-bottom: 2px solid #ffffff4d;
        }

        label {
            grid-column: span 2;
        }

        .inputBarDesign {
            width: 30vw;
        }

        button.SubMint {
            grid-column: span 2;
            width: 20vw;
            padding-block: 10px;
            justify-self: center;
        }

        .sideStyles {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .sideStyles::after {
            content: '';
            position: absolute;
            border-right: 2px solid #ffffff4d;
            width: 100%;
            height: 90%;
        }

        .passwordbarcont>input {
            height: 30px !important;
        }

        .toastCont {
            position: absolute;
        }

        #dev {
            z-index: 11;
        }

        #dev>img {
            height: 0px;
            transition: all 0.5s ease;
        }
    </style>
</head>

<body>
    <div class="toastCont">

    </div>
    <div class="Container">
        <div class="headingContainer">
            <h1 class="headType1 cover">Welcome Admin!</h1>
        </div>
        <div class="sideStyles p-3">
            <img src="../static images/LOGO1.png" alt="LOGO" width="200px">
            <a href="mailto:fahad.work2948@gmail.com" id="dev">
                <img src="../static images/devDetail/LOGO BRAND_BLACK.png">
            </a>
        </div>
        <form method="post" class="formContainer">
            <label for="adminUsername" class="generalLabel my-2">Username:</label>
            <input type="text" name="adminUsername" id="adminUsername" class="inputBarDesign mb-5">
            <label for="adminPassword" class="generalLabel my-2">Password:</label>
            <div class="passwordbarcont align-items-center mb-5">
                <input class="inputBarDesign h-100" id="adminPassword" name="adminPassword" type="password">
                <button type="button" class="btn generalButton h-100 passwordButton" onmousedown="passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
                    <i class="passwordEye fa-solid fa-eye-slash"></i>
                </button>
            </div>
            <button class="SubMint" name="AdminSub" type="submit">Login</button>
        </form>
    </div>
    <script src="../JavaScript/function.js"></script>
    <script>
        const input1 = document.getElementById("adminUsername");
        const input2 = document.getElementById("adminPassword");
        const body = document.querySelector("body");

        input1.addEventListener("focusin", function() {
            body.style.backgroundPosition = "-70vw 0vh";
        })
        input2.addEventListener("focusin", function() {
            body.style.backgroundPosition = "-30vw 0vh";
        })
        input1.addEventListener("focusout", function() {
            body.style.backgroundPosition = "-120vw 0vh";
        })
        input2.addEventListener("focusout", function() {
            body.style.backgroundPosition = "-120vw 0vh";
        })
    </script>
    <?php if ($_SESSION['type'] ?? "" === "danger") : ?>
        <script>
            autoToast("dangers", strtoupper("Admin acredentials are incorrect contact the Developer"));
            setTimeout(() => {
                document.querySelector("#dev>img").style.height = "60px";
            }, 50);
        </script>
        <?php session_unset() ?>
    <?php endif; ?>
</body>

</html>