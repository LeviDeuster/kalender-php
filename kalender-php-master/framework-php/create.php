<?php
    $servername = "localhost";
    $username = "admin";
    $dbname = "calendar";
    //$password = "levi";

    $conn = new mysqli($servername, $username);

    $sql = mysqli_select_db($conn, $dbname) or die('Could not select database');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $person = ($_GET["person"]);
        $day = ($_GET["day"]);
        $month = ($_GET["month"]);
        $year = ($_GET["year"]);
    }

    $sql = "CREATE TABLE birthdays (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    person VARCHAR(30) NOT NULL,
    day TINYINT(2),
    month TINYINT(2),
    year YEAR(),
    )";

    $sql ="INSERT INTO birthdays (person, day, month, year)
    VALUES ('$person', '$day', '$month', '$year')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql ="SELECT (person, day, month, year) FROM birthdays";

$result = $conn->query($sql);
echo $result;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo " " . $row['person'] . " " . $row['day'] . " " . $row['month'] . " " . $row['year'] . "<br>";
    }
}


$conn->close();
