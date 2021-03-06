
<!doctype html>

<html>
	<head>
		<title>Verjaardagskalender</title>
        <link href="main.css" rel="stylesheet" type="text/css">
	</head>

	<body>
        <?php

    $servername = "localhost";
    $username = "admin";
    $dbname = "calendar";
    $password = "levi";

    $conn = new mysqli($servername, $username);


    $conn->select_db($dbname) or die('Could not select database');

    $sql = 'SELECT * FROM birthdays';
    $records = $conn->query($sql);
    $months = array();
    while($verjaardag=$records->fetch_assoc()) {
        if (!isset($months[$verjaardag['month']])) $months[$verjaardag['month']] = array();
        if (!isset($months[$verjaardag['month']][$verjaardag['day']]))
            $months[$verjaardag['month']][$verjaardag['day']] = array();
        $months[$verjaardag['month']][$verjaardag['day']][] = $verjaardag;
    }
    ksort($months);

    $months_in_year = array(
        1=>'januari',
        2=>'Februari',
        3=>'Maart',
        4=>'april',
        5=>'mei',
        6=>'juni',
        7=>'juli',
        8=>'augustus',
        9=>'september',
        10=>'oktober',
        11=>'november',
        12=>'december'
    );


    foreach ($months as $month=>$days){
        print '<h1>'.$months_in_year[$month].'</h1>';
        ksort($days);
        foreach ($days as $day=>$birthdays) {
            print "<h2>";
            print($day);
            print "</h2>";
            foreach ($birthdays as $birthday) {
                print "<p> <a href=\"edit.php?id=".$birthday['id']."\">";
                print($birthday['person']);
                print " (".($birthday['year']). ")";
                print "<a href=\"delete.php?id=".$birthday['id']."\">x</a> </p>";
            };
        };
    };

    ?>
        <br clear="all">
        <h2>
            Verjaardag toevoegen
        </h2>
        <form action="framework-php/create.php" method="get">
            Naam:    <input type="text" name="person"><br>
            Dag:          <input type="text" name="day"><br>
            Maand:               <input type="text" name="month"><br>
            Jaar:                        <input type="text" name="year"><br>
            <input name="submit" type="submit"> </input>
        </form>

	</body>
</html>