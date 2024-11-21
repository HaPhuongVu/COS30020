<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Lab10</title>
</head>

<body>
    <h1>Hit Counter</h1>
    <?php
    require_once("hitcounter.php");
    umask(0007);
    $directory = "../../data";
    if (!file_exists($directory)) {
        echo "<p>'$directory' does not exist.</p>";
    }
    $filename = "../../data/mykeys.txt";
    $handle = fopen($filename, "r");
    if (!$handle) {
        echo "<p>Unable to open the file</p>";
    } else {
        $host = trim(fgets($handle));
        $username = trim(fgets($handle));
        $password = trim(fgets($handle));
        $dbname = trim(fgets($handle));
        fclose($handle);

        $counter = new HitCounter($host, $username, $password, $dbname);
        $counter->startOver();
        $counter->closeConnection();
        header("Location: countvisits.php");
    }
    ?>
    <a href="startover.php">Start Over</a>
</body>

</html>