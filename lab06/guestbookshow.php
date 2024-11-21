<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Guest Book List</title>
    <style>
        table,
        tr,
        td {
            border: 1px solid black;
        }

        thead {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Lab06 Task2 - GuestBook</h1>
    <h1>Sign Guestbook</h1>
    <hr>
    <?php
    $filename = "data/guestbook.txt";
    $guestList = file($filename);
    if (empty($guestList)) {
        echo "<p>Guest List is emtpy</p>";
    } else {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<td>Number</td>";
        echo "<td>Name</td>";
        echo "<td>E-mail</td>";
        echo "</tr>";
        echo "</thead>";
        for ($i = 0; $i < count($guestList); $i++) {
            $guest = explode(",", $guestList[$i]);
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . ($i + 1) . "</td>";
            echo "<td> $guest[0] </td>";
            echo "<td> $guest[1] </td>";
            echo "</tr>";
            echo "</tbody>";
        }
        echo "</table>";
        echo "<hr>";
        echo "<a href='guestbookform.php'>Add Another Visitor</a><br>";
    }
    ?>
</body>

</html>