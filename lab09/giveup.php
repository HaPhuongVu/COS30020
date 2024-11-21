<?php
session_start(); // start the session

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Guessing Game</title>
</head>

<body>
    <h1>Guessing Game</h1>
    <?php
    $randNum = $_SESSION["randNum"];
    if (isset($randNum)) {
        echo "<p>The hidden number is " . $randNum . "</p>";
    } else {
        echo "<p>The number not generated</p>";
    }
    ?>
    <p><a href="startover.php">Start Over</a></p>
</body>

</html>