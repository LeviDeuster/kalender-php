<?php
$servername = "localhost";
$username = "admin";
$dbname = "calendar";
$password = "levi";


$conn = new mysqli($servername, $username);


$conn->select_db($dbname) or die('Could not select database');

$sql="SELECT * FROM birthdays WHERE id=".(int)$_GET['id'];
$res=$conn->query($sql);

$row = $res->fetch_assoc();
?>
<html>
<form action="edit.php" method="get">
    <input type="hidden" name="id" value="<?php echo $row['id']?>">
    Naam:    <input type="text" name="person" value="<?php echo $row['person']?>"><br>
    Dag:          <input type="text" name="day" value="<?php echo $row['day']?>"><br>
    Maand:               <input type="text" name="month" value="<?php echo $row['month']?>"><br>
    Jaar:                        <input type="text" name="year" value="<?php echo $row['year']?>"><br>
    <input name="submit" type="submit"> </input>
</form>
</html>
<?php

if (array_key_exists('submit', $_GET)){
    $person = $_GET['person'];
        $year = $_GET['year'];
        $month = $_GET['month'];
        $day = $_GET['day'];
    $sql = "UPDATE birthdays SET person = '$person', year = $year, month = $month, day = $day WHERE id=".$_GET['id'];
}

if ($conn->query($sql) === TRUE){
    echo "Succesfully edited birthday";
}
?>
<html>
        <a href="http://localhost:63342/php%20dordt/kalender-php-master/index.php">Back</a>
    </html>