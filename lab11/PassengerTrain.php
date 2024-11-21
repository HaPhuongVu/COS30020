<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Web application development">
	<meta name="keywords" content="PHP">
	<meta name="author" content="Vu Ha Phuong">
	<title>Passenger Train</title>
</head>

<body>
	<h1>Passenger Train</h1>
	<hr>
	<?php
	if (isset($_GET['distance']) && isset($_GET['stops'])) {
		if (is_numeric($_GET['distance']) & is_numeric($_GET['stops'])) {
			$Distance = $_GET['distance'];
			$Stops = $_GET['stops'];

			if ($_GET['weather'] == "good")
				$DurationTotalMinutes = ($Distance / 50) * 60;
			else
				$DurationTotalMinutes = ($Distance / 40) * 60;
			$DurationTotalMinutes += $Stops * 5;
			$DurationHours = $DurationTotalMinutes / 60;
			$DurationHours = (int) $DurationHours;
			$DurationMinutes = $DurationTotalMinutes - ($DurationHours * 60);
			echo "<p>Based on the information you entered, your trip will take $DurationHours hours and $DurationMinutes minutes.</p>";
		} else {
			echo "<p>You must enter numeric values for distance and number of stops.</p>";
		}
	} else
		echo "<p>Enter the distance and number of stops and specify if the weather is good or bad.</p>";
	?>
	<form action="" method="get">
		<p><input type="text" name="distance" value="<?php echo isset($_GET['distance']) ? $_GET['distance'] : 0 ?>"> Distance (in miles)</p>
		<p>
			<input type="text" name="stops" value="<?php echo isset($_GET['stops']) ? $_GET['stops'] : 0 ?>"> Number of Stops
		</p>
		<p>
			<input type="radio" name="weather" value="good" <?php if (empty($_GET['weather']) || $_GET['weather'] == "good") echo 'checked=\"checked\"' ?>> Weather is Good
			<input type="radio" name="weather" value="bad" <?php if (!empty($_GET['weather']) && $_GET['weather'] == "bad") echo 'checked=\"checked\"' ?>> Weather is Bad
		</p>
		<button type="submit">Calc Travel Time</button>
	</form>
	<hr>
</body>

</html>