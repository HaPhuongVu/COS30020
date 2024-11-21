<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Web application development">
	<meta name="keywords" content="PHP">
	<meta name="author" content="Vu Ha Phuong">
	<link rel="stylesheet" href="php_styles.css" type="text/css">
	<title>Hit Counter</title>
</head>

<body>
	<?php
	$CounterFile = "hitcount.txt";
	if (file_exists($CounterFile)) {
		$Hits = file_get_contents($CounterFile);
		++$Hits;
	} else {
		$Hits = 1;
	}
	echo "<h1>There have been $Hits hits to this page!</h1>";
	if (file_put_contents($CounterFile, $Hits)) {
		echo "<p>The counter file has been updated.</p>";
	}


	?>
</body>

</html>