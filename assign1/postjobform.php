<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignment 1">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link rel="stylesheet" href="style/style.css">
    <title>Post%20Job%20Form</title>
</head>

<body>
    <div class="container">
        <!-- navbar  -->
        <nav>
            <ul class="nav-bar">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="postjobform.php">Post Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="searchjobform.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
        </nav>
        <!-- post job form  -->
        <h1>Job Vacancy Posting System</h1>
        <form action="postjobprocess.php" method="post">
            <fieldset>
                <legend>Post Job Form</legend>
                <!-- enter position ID and title field  -->
                <div class="row">
                    <div>
                        <label for="posID">Position ID</label>
                        <input type="text" id="posID" name="posID">
                    </div>
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title">
                    </div>
                </div>
                <!-- enter job description  -->
                <div class="row">
                    <label for="desc">Description</label>
                    <textarea id="desc" name="desc" rows="4" cols="75"></textarea>
                </div>
                <!-- enter closing date  -->
                <div class="row">
                    <div>
                        <label for="date">Closing Date</label>
                        <input type="text" id="date" name="date" value="<?php echo date('d/m/y') ?>"> <!-- date value set to current day  -->
                    </div>
                </div>
                <!-- choose job position. radio input type  -->
                <div class="row">
                    <span>Position
                        <input type="radio" id="fTime" name="position" value="Full Time">
                        <label for="fTime">Full Time</label>
                        <input type="radio" id="pTime" name="position" value="Part Time">
                        <label for="pTime">Part Time</label>
                    </span>
                </div>
                <!-- choose contract option. radio input type  -->
                <div class="row">
                    <span>Contract
                        <input type="radio" id="onGoing" name="contract" value="On-going">
                        <label for="onGoing">On-going</label>
                        <input type="radio" id="fTerm" name="contract" value="Fixed Term">
                        <label for="fTerm">Fixed Term</label>
                    </span>
                </div>
                <!-- choose location option. radio input type  -->
                <div class="row">
                    <span>Location
                        <input type="radio" id="onSite" name="location" value="On-site">
                        <label for="onSite">On-site</label>
                        <input type="radio" id="remote" name="location" value="Remote">
                        <label for="remote">Remote</label>
                    </span>
                </div>
                <!-- choose application method. checkbox input type  -->
                <div class="row">
                    <span>Accept Application by
                        <input type="checkbox" id="post" name="applications[]" value="Post">
                        <label for="post">Post</label>
                        <input type="checkbox" id="email" name="applications[]" value="Email">
                        <label for="email">Email</label>
                    </span>
                </div>
                <!-- submit and reset button  -->
                <div class="button">
                    <button type="submit">Post</button>
                    <button type="reset">Reset</button>
                </div>
            </fieldset>
        </form>
        <!-- return to home page button  -->
        <div class="return-button">
            <a class="return-link" href="index.php">Return to Home Page</a>
        </div>
        <!-- footer  -->
        <footer>
            <p>&copy; This work belongs to Vu Ha Phuong</p>
        </footer>
    </div>
</body>

</html>