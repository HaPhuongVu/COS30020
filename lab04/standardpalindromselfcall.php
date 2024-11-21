<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Ha Phuong" />
    <title>Standard Palindrome Self Call</title>
</head>

<body>
    <h1>Web Programming Form - Lab 4</h1>
    <?php
    if (isset($_POST["pStr"])) { // check if form data exists
        $pStr = $_POST["pStr"];
        $newStr = str_replace(['.', ',', '!', '?', "'", ' '], '', $pStr);

        if (strcmp(strtolower($newStr), strtolower(strrev($newStr))) == 0) {
            echo "<p>The text you enter '$pStr' is a perfect palindrome</p>";
        } else {
            echo "<p>The text you enter '$pStr' is not a perfect palindrome</p>";
        }
    } else {
        echo "<p>You have not enter any string</p>";
    }
    ?>
    <form action="" method="post">
        <label for="pStr">Enter your string: </label>
        <input type="text" id="pStr" name="pStr">
        <button type="submit">Submit</button>
    </form>
</body>

</html>