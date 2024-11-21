<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <title>Book Form</title>
    <style>
        input {
            margin-top: 5px;
        }

        fieldset {
            width: 50%;
        }
    </style>
</head>

<body>
    <h1>Lab05 Task 2 - Guestbook</h1>
    <hr>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend>Enter your details to sign our guest book</legend>
            <label for="fName">First Name</label>
            <input type="text" id="fName" name="fName"><br>
            <label for="lName">Last Name</label>
            <input type="text" id="lName" name="lName"><br>
            <button type="submit">Submit</button>
        </fieldset>
    </form>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>

</html>