<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leap Year test</title>
</head>

<body>
    <h1>Lab03 Task 2 - Leap Year</h1>
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