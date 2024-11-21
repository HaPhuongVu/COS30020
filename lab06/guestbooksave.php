<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Guest Book List</title>
</head>

<body>
    <h1>Lab06 Task2 - Guestbook</h1>
    <h1>Sign Guestbook</h1>
    <hr>
    <?php
    umask(0007);
    $dir = "data/lab06";
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }

    if (isset($_POST["name"]) && isset($_POST["email"])  && !empty($_POST["name"]) && !empty($_POST["email"])) {
        $name = $_POST["name"]; // obtain the form item data
        $email = $_POST["email"]; // obtain the form quantity data
        $emailExp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}+$/";
        if (preg_match($emailExp, $email)) {
            echo "<p>Email address is valid.</p>";
            $filename = "data/guestbook.txt";
            $alldata = array();
            if (is_readable($filename)) {
                $guestdata = array();
                $handle = fopen($filename, "r");
                while (!feof($handle)) {
                    $onedata = fgets($handle);
                    if ($onedata != "") {
                        $data = explode(" ", $onedata);
                        $alldata[] = $data;
                        $guestdata[] = $data[0];
                    }
                }
                fclose($handle);
                $newdata = !(in_array($name, $guestdata));
            } else {
                $newdata = true;
            }
            if ($newdata) {
                $handle = fopen($filename, "a");
                $data = $name . "," . $email . "\n";
                fputs($handle, $data);
                fclose($handle);
                $alldata[] = array($name, $email);
                echo "<p style='color: green'>Thank you for signing our guest book!</p>";
                echo "<p>Name: $name</p>";
                echo "<p>E-mail: $email</p><br><hr>";
                echo "<a href='guestbookshow.php'>View Guest Book</a>";
            } else {
                echo "<p>You have already signed the guest book</p>";
            }
        } else {
            echo "<p>Email address is not valid.</p>";
            echo "<a href='guestbookform.php'><button type='button'>Go Back</button></a>";
        }
    } else { // no input
        echo "<p style='color: red'>You must enter your name and email address!</p><br><hr>";
        echo "<a href='guestbookform.php'>Add Another Visitor</a><br>";
        echo "<a href='guestbookshow.php'>View Guest Book</a>";
    }
    ?>
</body>

</html>