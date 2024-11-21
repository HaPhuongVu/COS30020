<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link href="style/style.css" rel="stylesheet">
    <title>About%20Page</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <!-- check if user is logged in or not  -->
                <?php if (isset($_SESSION['isLoggedIn'])): ?>
                    <!-- Navbar for logged-in users -->
                    <li class="nav-item"><a class="nav-link" href="friendadd.php">Add Friends</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="friendlist.php">Friend List</a></li>
                    <li class="nav-item"><a class="nav-link" href="editprofile.php">Edit Your Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- Navbar for not logged-in users  -->
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="content">
            <!-- answer for all the questions  -->
            <h1 class="title">About Page</h1>
            <div class="about">
                <div class="task">
                    <p class="question">What tasks you have not attempted or not completed?</p>
                    <ul>
                        <li>I have attempted every tasks</li>
                    </ul>
                </div>
                <div class="task">
                    <p class="question">What special features have you done, or attempted, in creating the site that we should know about?</p>
                    <ul>
                        <li>I implemented a new function that allow current user to modify their information inclue email, profile name, password</li>
                    </ul>
                </div>
                <div class="task">
                    <p class="question">Which parts did you have trouble with?</p>
                    <ul>
                        <li>The mutual count is a bit challenge for me. But in the end, I managed to do it.</li>
                    </ul>
                </div>
                <div class="task">
                    <p class="question">What would you like to do better next time?</p>
                    <ul>
                        <li>For the next time, I would love to implement some more advanced fuctions.
                            <p>1. View another user's profile: The current user are allowed to view other user's profile by clicking on their name</p>
                            <p>2. Each user will have their own image on the home page.</p>
                        </li>
                    </ul>
                </div>
                <div class="task">
                    <p class="question">What additional features did you add to the assignment? (if any)</p>
                    <ul>
                        <li>I have created a new page for users to edit their information include email, profile name and password</li>
                    </ul>
                </div>
                <div class="task">
                    <p class="question">Discussion</p>
                    <ul>
                        <li>Discussion point 1<br>
                            <img src="images/discussion_1.png" alt="discussion_point_1" class="discussion">
                        </li>
                        <li>Discussion point 2<br>
                            <img src="images/discussion_2.png" alt="discussion_point_2" class="discussion">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="return-link">
                <a href="friendlist.php">Friend List</a>
                <a href="friendadd.php">Add Friends</a>
                <a href="index.php">Home Page</a>
            </div>
        </div>
    </div>
</body>

</html>