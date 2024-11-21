<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="description" content="Web application development">
<meta name="keywords" content="PHP">
<meta name="author" content="Vu Ha Phuong">
<title>Car Display - Lab08</title>
</head>

<body>
    <h1>Web Programming - Lab08</h1>
    <?php
    require_once("settings.php");
    $con = mysqli_connect($host, $user, $pswd, $dbnm);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }


    ?>
</body>

</html>