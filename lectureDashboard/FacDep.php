<?php
include('../Includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
    <style>
        .checkBoxContent {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <legend>Faculty</legend>
            <div class="checkBoxContent">
                <?php
                $selectQuery = "SELECT `faculty_id`, `facultyName` FROM `faculty`";
                $result = mysqli_query($con, $selectQuery);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='checkBox'>
                        <input type='checkbox' name=" . $row['faculty_id'] . " id=" . $row['faculty_id'] . "   class='CheckBoX' value=" . $row['faculty_id'] . ">
                        <label for=" . $row['faculty_id'] . ">" . $row['facultyName'] . "</label>
                    </div>
                ";
                }
                ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Department</legend>
            <div class="checkBoxContent dep">
            </div>
        </fieldset>
    </form>
    <script src="../JavaScript/function.js">

    </script>
</body>

</html>