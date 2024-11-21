<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number test</title>
</head>

<body>
    <h1>Lab03 Task 3 - Prime Number</h1>
    <?php
    function is_prime($num)
    {
        for ($count = 1; $count < $num; $count++) {
            $result = $num % $count;
            if ($count !== 1 && $count !== $num && $result == 0) {
                return false;
            }
        }
        return true;
    }

    function check_prime_number()
    {
        if (isset($_GET["pnum"]) && is_numeric($_GET["pnum"])) {
            $pnum = $_GET["pnum"];
            if (1 <= $pnum && $pnum <= 999) {
                if (is_prime($pnum)) {
                    echo "<p>Number $pnum is a prime number</p>";
                } else {
                    echo "<p>THis is not a prime number</p>";
                }
            } else {
                echo "<p>Please enter number between 1 and 999</p>";
            }
        } else {
            echo "<p>Please enter a number</p>";
        }
    }

    check_prime_number();
    ?>
</body>

</html>