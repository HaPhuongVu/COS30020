<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignment 1">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link rel="stylesheet" href="style/style.css">
    <title>Home%20Page</title>
</head>

<body>
    <div class="container">
        <!-- navbar  -->
        <nav>
            <ul class="nav-bar">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="postjobform.php">Post Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="searchjobform.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
        </nav>
        <!-- my information content  -->
        <h1>Job Vacancy Posting System</h1>
        <div class="content-box">
            <div class="content">
                <h2>My Profile</h2>
                <p>
                    Name: Vu Ha Phuong
                    <img src="images/avatar.jpg" alt="avatar" class="float-right" width="200" height="200">
                </p>
                <p>Student ID: 104177306</p>
                <p>Email: 104177306@student.swin.edu.au</p>
                <p class="italic-style">I declare that this assignment is my individual work. I have not worked
                    collaboratively, nor have I copied from any other student's work or from any other source.</p>
                <a href="postjobform.php" class="row">Post a job vacancy</a>
                <a href="searchjobform.php">Search for a job vacancy</a>
                <a href="about.php" class="float-right">About this assignment</a>
            </div>
        </div>
        <footer>
            <p>&copy; This work belongs to Vu Ha Phuong</p>
        </footer>
    </div>
</body>

</html>