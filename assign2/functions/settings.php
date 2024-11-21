

<?php

//table used
$table1 = 'friends';
$table2 = 'myfriends';

//regex pattern for input validate
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$profilePattern = "/^[a-zA-Z]+$/";
$pwdPattern = "/^[a-zA-Z0-9]+$/";

//function to connect to db
function getDBConnection()
{
    $host = "feenix-mariadb.swin.edu.au";
    $user = "s104177306";
    $password = "121204";
    $db = "s104177306_db";

    $conn = mysqli_connect($host, $user, $password, $db);
    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//function to sanitize user inputs
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

//validate all inputs
function validateInput($input, $pattern, $field)
{
    if (empty($input)) {
        return "$field cannot be empty";
    } else if (!preg_match($pattern, $input)) {
        return "$field format is incorrect";
    } else {
        return true;
    }
}

?>