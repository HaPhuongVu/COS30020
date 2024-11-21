<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Shop Form</title>
</head>

<body>
    <h1>Web Programming Form - Lab 5</h1>
    <form action="shoppingsave.php" method="post">
        <label for="iName">Enter item name: </label>
        <input type="text" id="iName" name="iName">
        <label for="iQuantity">Enter item quantity: </label>
        <input type="number" id="iQuantity" name="iQuantity">
        <button type="submit">Submit</button>
    </form>
</body>

</html>