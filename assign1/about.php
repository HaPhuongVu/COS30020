<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignment 1">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link rel="stylesheet" href="style/style.css">
    <style>
        .content-box {
            margin-bottom: 50px;
        }
    </style>
    <title>About%20Page</title>
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
                    <a class="nav-link" href="searchjobform.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="about.php">About</a>
                </li>
            </ul>
        </nav>
        <h1>About this assignment</h1>
        <!-- requirement 1  -->
        <div class="content-box">
            <div class="content">
                <h3>Req 1.</h3>
                <div>
                    <ul>
                        <li>The PHP version installed in Mercury is <?php echo 'PHP version: ' . phpversion(); ?></li>
                        <li>I have attempted all the tasks and finished all the requirements</li>
                        <li>
                            <p>In Search Process Page, I have implemented more sort functions for all jobs.
                                Users are allow to sort all jobs by title, ID and date. This function only work when no search criteria selected and the entire jobs display.</p>
                            <p>I also implement a search by ID number. User just need to enter the number to search for job, no need to enter ID.</p>
                            <p>The search keyword can be highlighted when using the common search part.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- requirement 2  -->
        <div class="content-box">
            <div class="content">
                <h3>Req 2.</h3>
                <ul>
                    <li>
                        Discussion point 1.<br>
                        <img src="./images/Disscusion1.png" alt="discussion_point_1" class="image">
                    </li>
                    <li>
                        Discussion point 2.<br>
                        <img src="./images/Disscusion2.png" alt="discussion_point_2" class="image">
                    </li>
                    <li>
                        Discussion point 3.<br>
                        <img src="./images/Disscusion3.png" alt="discussion_point_3" class="image">
                    </li>
                    <li>
                        Discussion point 4.<br>
                        <img src="./images/Disscusion4.png" alt="discussion_point_4" class="image">
                    </li>
                    <li>
                        Discussion point 5.<br>
                        <img src="./images/Disscusion5.png" alt="discussion_point_5" class="image">
                    </li>
                </ul>
            </div>
        </div>
        <!-- requirement 3  -->
        <div class="content-box">
            <div class="content">
                <h3>Req 3.
                    <a href='index.php'>Return to Home Page</a>
                </h3>
            </div>
        </div>
        <!-- footer  -->
        <footer>
            <p>&copy; This work belongs to Vu Ha Phuong</p>
        </footer>
    </div>
</body>

</html>