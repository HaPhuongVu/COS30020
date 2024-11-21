<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function factorial($n)
    {
        $result = 1;
        $factor = $n;
        while ($factor > 1) {
            $result = $factor * $result;
            $factor--;
        }
        return $result;
    }
    ?>
</body>

</html>