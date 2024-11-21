<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab03 Task 2 - Leap Year</h1>
    <form action="leapyear_selfcall.php" method="get">
        <label for="lyear">Year: </label>
        <input type="text" id="lyear" name="lyear">
        <button type="submit">Check for leap year</button>
    </form>
    <?php
    function is_leapyear($year)
    {
        if ($year % 4 == 0) {
            return true;
        }
        return false;
    }

    function leapyear()
    {
        if (isset($_GET["lyear"]) && is_numeric($_GET["lyear"])) {
            $lyear = $_GET["lyear"];
            if ($lyear > 0) {
                if (is_leapyear($lyear)) {
                    echo "<p>The year you enter $lyear is a leap year</p>";
                } else {
                    echo "<p>This is not leap year</p>";
                }
            } else {
                echo "<p>This is not a valid year</p>";
            }
        } else {
            echo "<p>Please enter a number</p>";
        }
    }

    leapyear();
    ?>
</body>

</html>