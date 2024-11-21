<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignment 1">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link rel="stylesheet" href="style/style.css">
    <title>Search%20Job%20Form</title>
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
                    <a class="nav-link" href="postjobform.php">Post Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" aria-current="page" href="searchjobform.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
        </nav>
        <!-- search job form  -->
        <h1>Job Vacancy Posting System</h1>
        <form action="searchjobprocess.php" method="get">
            <fieldset>
                <legend>Search Job by</legend>
                <!-- common search  -->
                <div class="row">
                    <div>
                        <label for="keyword">Search</label>
                        <input type="text" id="keyword" name="keyword">
                    </div>
                </div>
                <!-- search by ID  -->
                <div class="row">
                    <div>
                        <label for="jobID">Job ID</label>
                        <input type="text" id="jobID" name="jobID">
                    </div>
                </div>
                <!-- search by title  -->
                <div class="row">
                    <div>
                        <label for="jobTitle">Job Title </label>
                        <input type="text" id="jobTitle" name="jobTitle">
                    </div>
                </div>
                <!-- search by position -->
                <div class="row">
                    <span>Job Position
                        <input type="checkbox" id="fTime" name="jobPosition[]" value="Full Time">
                        <label for="fTime">Full Time</label>
                        <input type="checkbox" id="pTime" name="jobPosition[]" value="Part Time">
                        <label for="pTime">Part Time</label>
                    </span>
                </div>
                <!-- search by contract  -->
                <div class="row">
                    <span>Job Contract
                        <input type="checkbox" id="onGoing" name="jobContract[]" value="On-going">
                        <label for="onGoing">On-going</label>
                        <input type="checkbox" id="fTerm" name="jobContract[]" value="Fixed Term">
                        <label for="fTerm">Fixed Term</label>
                    </span>
                </div>
                <!-- search by application  -->
                <div class="row">
                    <span>Job Application
                        <input type="checkbox" id="post" name="jobApplication[]" value="Post">
                        <label for="post">Post</label>
                        <input type="checkbox" id="email" name="jobApplication[]" value="Email">
                        <label for="email">Email</label>
                    </span>
                </div>
                <!-- search by location  -->
                <div class="row">
                    <span>Job Location
                        <input type="checkbox" id="onSite" name="jobLocation[]" value="On-site">
                        <label for="onSite">On-site</label>
                        <input type="checkbox" id="remote" name="jobLocation[]" value="Remote">
                        <label for="remote">Remote</label>
                    </span>
                </div>
                <!-- submit and reset form button  -->
                <div class="button">
                    <button type="submit">Search</button>
                    <button type="reset">Reset</button>
                </div>
            </fieldset>
        </form>
        <!-- return to home page button -->
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