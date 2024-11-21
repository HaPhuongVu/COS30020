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
            margin-bottom: 10px;
        }

        fieldset {
            width: 50%;
            margin-bottom: 5px;
        }

        legend {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Lab06 Task 2 - Guestbook</h1>
    <hr>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend>Enter your details to sign our guest book</legend>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name"><br>
            <label for="email">E-mail: </label>
            <input type="text" id="email" name="email"><br>
            <button type="submit">Submit</button>
            <button type="button">Reset Form</button>
        </fieldset>
    </form>

    <a href="guestbookshow.php">Show Guest Book</a>
</body>

</html>