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
    <h1>Lab05 Task2 - Sign Guestbook</h1>
    <?php
    umask(0007);
    $dir = "data/lab05";
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }

    if (isset($_POST["fName"]) && isset($_POST["lName"])  && !empty($_POST["fName"]) && !empty($_POST["lName"])) {
        $fName = $_POST["fName"]; // obtain the form item data
        $lName = $_POST["lName"]; // obtain the form quantity data
        $filename = "data/guestbook.txt";
        $handle = fopen($filename, "a"); // open the file in append mode
        $data = "$fName $lName\n";
        if (is_writable($filename)) {
            fwrite($handle, $data);
            echo "<p style='color: green'>Thank you for signing the Guestbook!</p>";
            echo "<a href='guestbookshow.php'>Show Guest Book</a>";
        } else {
            echo "<p>Cannot add your name to the Guest book</p>";
        }
        fclose($handle); // close the text file
    } else { // no input
        echo "<p style='color: red'>You must enter your first and last name!<br>
                 Use the Browser's 'Go Back' button to return to the Guestbook form</p>";
        echo "<a href='guestbookform.php'><button type='button'>Go Back</button></a>";
    }
    ?>
</body>

</html>