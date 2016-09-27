<?php
/* mysql database connection*/
$con = mysqli_connect("localhost","root","mysql","opdata");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
?>