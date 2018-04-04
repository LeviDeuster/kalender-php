<?php

$servername = "localhost";
$username = "admin";
$dbname = "calendar";
$password = "levi";

$conn = new mysqli($servername, $username);


$conn->select_db($dbname) or die('Could not select database');

$sql ="DELETE FROM birthdays WHERE id=".$_GET['id'];

if ($conn->query($sql) === TRUE){
    echo "Succesfully deleted birthday";
}
?>
<html>
        <a href="http://localhost:63342/php%20dordt/kalender-php-master/index.php">Back</a>
    </html>