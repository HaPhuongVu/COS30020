<?php
session_start();
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
    <div class="container">
        <h1>Guessing Game</h1>
        <p>Enter a number between 1 and 100, then press the Guess button</p>
        <form method="post" action="">
            <input type="text" id="guessNum" name="guessNum">
            <button type="submit">Guess</button>
        </form>
        <?php
        // Check if the random number and guess count are set in the session
        if (!isset($_SESSION["randNum"])) {
            $_SESSION["randNum"] = rand(1, 100); // Generate the random number
            $_SESSION["guessCount"] = 0; // Initialize the guess counter
        }

        $randNum = $_SESSION["randNum"];
        $guessNum = isset($_POST["guessNum"]) ? $_POST["guessNum"] : ""; // Retrieve the guess from the form

        // Validating the guessed number
        if ($guessNum) {
            if (!empty($guessNum) && is_numeric($guessNum) && $guessNum >= 1 && $guessNum <= 100) {
                $_SESSION["guessCount"]++;
                if ($guessNum < $randNum) {
                    echo "<p>Guess higher</p>";
                } else if ($guessNum > $randNum) {
                    echo "<p>Guess lower</p>";
                } else {
                    echo "<p>Congratulations! You guessed the hidden numer.</p>";
                }
            } else {
                echo "<p>You must enter a number between 1 and 100</p>";
            }
        } else {
            echo "<p>Start guessing</p>";
        }
        ?>
        <p>Number of guesses: <?php echo $_SESSION["guessCount"] ?></p>
        <p><a href="giveup.php">Give Up</a></p>
        <p><a href="startover.php">Start Over</a></p>
    </div>
</body>

</html>