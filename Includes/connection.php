<?php
$con = mysqli_connect("localhost", "root", "", "leoUni_db");
if (!$con) {
    die("Failed to Conect: " . mysqli_connect_error());
}
