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
    <h1>Lab05 Task2 - GuestBook List</h1>
    <?php
    $filename = "data/guestbook.txt";
    $guestList = file_get_contents($filename);
    if (empty($guestList)) {
        echo "<p>Guest List is empty</p>";
    } else {
        echo "<pre>$guestList</pre>";
    }
    echo "<a href='guestbookform.php'><button type='button'>Go Back</button></a>";
    ?>
</body>

</html>