<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Web application development">
	<meta name="keywords" content="PHP">
	<meta name="author" content="Vu Ha Phuong">
	<title>Leap Year</title>
</head>

<body>
	<?php
	$year = $_GET["year"];
	if ($year % 4 != 0)
		echo "The year you entered is a standard year.";
	else if ($year % 400 == 0)
		echo "The year you entered is a leap year.";
	else if ($year % 100 == 0)
		echo "The year you entered is a standard year.";
	else
		echo "The year you entered is a leap year.";
	?>
</body>

</html>