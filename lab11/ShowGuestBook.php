<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content="Web application development">
	<meta name="keywords" content="PHP">
	<meta name="author" content="Vu Ha Phuong">
	<title>Guest Book</title>
</head>

<body>
	<?php
	// Establish a connection to the database
	$DBConnect = @mysqli_connect("localhost", "dongosselin", "rosebud")
		or die("<p>Unable to connect to the database server.</p>"
			. "<p>Error code " . mysqli_connect_errno()
			. ": " . mysqli_connect_error() . "</p>");

	// Select the database
	$DBName = "guestbook";
	if (!@mysqli_select_db($DBConnect, $DBName)) {
		die("<p>Unable to select the database.</p>");
	}

	// Define the table and query string
	$TableName = "visitors";
	$SQLstring = "SELECT * FROM $TableName"; // Corrected SQL query
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);

	// Check if there are any results from the query
	if (mysqli_num_rows($QueryResult) == 0) {
		die("<p>There are no entries in the guest book!</p>");
	} else {
		echo "<p>The following visitors have signed our guest book:</p>";
		echo "<table width='100%' border='1'>";
		echo "<tr><th>First Name</th><th>Last Name</th></tr>";

		// Fetch the rows and display them in a table
		while ($Row = mysqli_fetch_assoc($QueryResult)) {
			echo "<tr><td>{$Row['first_name']}</td>";
			echo "<td>{$Row['last_name']}</td></tr>";
		}

		echo "</table>";
	}

	// Free the result set and close the database connection
	mysqli_free_result($QueryResult);
	mysqli_close($DBConnect);
	?>
</body>

</html>