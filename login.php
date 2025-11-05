<?php
require('Includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <form action="" class="logContainer formContainer" method="post">
        <h1 class="text-center text-uppercase fw-bolder">Account Creating form</h1>
        <img src="static images/LOGO1.png">
        <label for="admin">Admission Number</label>
        <input class="logingBar" id="admin" name="admissionNumer" type="text">
        <label for="pswd">Password</label>
        <input class="logingBar" id="pswd" name="passwrd" type="password">
        <label for="cnfrmPassword">Confirm Password</label>
        <input class="logingBar" id="cnfrmPassword" name="cnfrmpasswrd" type="password">
        <button name="submitButton" type="submit" class="btn generalButton submitButtonLOG">Create an Account</button>
    </form>
    <?php
    function getIPAddress()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    if (isset($_POST['submitButton'])) {
        $ip = getIPAddress();
        $admissionNumber = $_POST['admissionNumer'] ?? '';
        $uname = $_POST['uname'] ?? '';
        $password = $_POST['passwrd'] ?? '';
        $confrmpassword = $_POST['cnfrmpasswrd'] ?? '';
        $selectQuery = "SELECT `stdID`,`std_fname`,`std_lname` FROM `studets` WHERE stdID='$admissionNumber'";
        $result = mysqli_query($con, $selectQuery);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $FNAME = $row['std_fname'] ?? '';
        $LNAME = $row['std_lname'] ?? '';
        $UNAME = $FNAME[0] . "." . $LNAME;
        $_SESSION['UNAME'] = $UNAME;
        $valid = 1;
        if ($count = 0) {
            $valid = 0;
        }
        $stdId = $row['stdID'] ?? '';

        if ($password != $confrmpassword) {
            echo "<script>alert('The entered Password is not Matching')</script>";
        } else if (empty($admissionNumber) && empty($uname) && empty($password) && empty($confrmpassword)) {
            return;
        } else {
            if ($valid) {
                $insertQuery = "INSERT INTO `studentaccount`(`IP`, `Createddate`, `stdID`,`userName`, `pswrd`, `confirm_pswrd`) VALUES ('$ip',NOW(),'$admissionNumber','$UNAME','$password','$confrmpassword')";
                mysqli_query($con, $insertQuery);
            } else {
                echo "<script>alert('Entered Addmission Number is INVALID!!!')</script>";
            }
        }
    }
    ?>
</body>

</html>