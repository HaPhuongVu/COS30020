<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Monster%20App</title>
</head>

<body>
    <h1>Web Programming - Lab10</h1>
    <?php
    require_once("monsterclass.php"); // include the monster class
    $monster1 = new Monster(1, 'Red'); // creates a red monster with 1 eye
    $monster2 = new Monster(3, 'Blue'); // creates a blue monster with 3 eyes
    echo "<p>" . $monster1->describe() . "</p>"; // describe the first monster
    echo "<p>" . $monster2->describe() . "</p>"; // describe the second monster
    ?>
</body>

</html>