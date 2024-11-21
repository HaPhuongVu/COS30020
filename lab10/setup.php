<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Lab10</title>
    <style>
        div {
            margin-top: 5px;
        }

        fieldset {
            margin: auto;
            width: 30%;
        }

        legend {
            text-transform: uppercase;
        }

        form {
            margin: auto;
            text-align: center;
        }

        p {
            text-align: center;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <fieldset>
            <legend>Enter your db info</legend>
            <div>
                <label for="username">Username</label>
                <input id="username" name="username" type="text">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="text" name="password" id="password">
            </div>
            <div>
                <label for="dbname">Database Name</label>
                <input type="text" name="dbname" id="dbname">
            </div>
            <div>
                <button type="submit">Set Up</button>
                <button type="reset">Reset</button>
            </div>
        </fieldset>
    </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $host = "localhost";
    $host = "feenix-mariadb.swin.edu.au";

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['dbname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['dbname'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dbname = $_POST['dbname'];

        //establish connection
        $conn = mysqli_connect($host, $username, $password, $dbname);
        if ($conn->connect_errno) {
            die("connection failed: " . $conn->connect_error);
        } else {
            $sql1 = "CREATE TABLE IF NOT EXISTS `hitcounter` ( `id` SMALLINT NOT NULL PRIMARY KEY, `hits`
            SMALLINT NOT NULL ) ";
            $sql2 = "INSERT INTO hitcounter VALUES (1,0)";
            $result = $conn->query($sql1) or die("<p>Unable to execute the query.</p>"
                . "<p>Error code " . $conn->errno
                . ": " . $conn->error . "</p>");

            $result = $conn->query($sql2) or die("<p>Unable to execute the query.</p>"
                . "<p>Error code " . $conn->errno
                . ": " . $conn->error . "</p>");
            echo "<p>Database successfully created!</p>";
        }

        //create if file not exists
        umask(0007);
        $dir = "../../data";
        if (!file_exists($dir)) {
            mkdir($dir, 02770);
        }
        //write data to file
        $filename = "../../data/mykeys.txt";
        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "<p>Unable to open file</p>";
        } else {
            $data = "$host\n$username\n$password\n$dbname";
            fwrite($handle, $data);
            fclose($handle);
            echo "<p>Successfully write data to file</p>";
        }
        $conn->close();
    } else {
        echo "<p>Please fill in all the form</p>";
    }
}


?>