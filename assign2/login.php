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
    <title>Log%20In</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Login</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>My Friend System</h1>
            <h1>Log In Page</h1>
            <!-- log in form using post method -->
            <!-- leave action emtpy to submit to the same link  -->
            <form method="POST" action="">
                <fieldset>
                    <legend>Log In</legend>
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-input">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd">
                    </div>
                    <div class="button-group">
                        <button type="submit" class="button-content">Login</button>
                        <!-- button reset not reset the post value so redirect to the same page to reset the form  -->
                        <a href="login.php" class="reset-button button-content">Clear</a>
                    </div>
                </fieldset>
            </form>
            <div class="return-link">
                <a href="index.php">Back to Home</a>
            </div>
            <?php
            require_once("functions/settings.php");

            //connect to db
            $conn = getDBConnection();
            //arrray to store all error messages
            $errors = [];

            //validate function and reuturn error message
            function errors($input, $field)
            {
                if (empty($input)) {
                    return "$field cannot empty";
                }
                return true;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //get form data
                $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : ""; //sanitize input function in setting.php
                $password = isset($_POST['pwd']) ? sanitizeInput($_POST['pwd']) : "";

                //validate email and password, and collect errors
                $validateEmail = errors($email, "Email");
                $validatePwd = errors($password, "Password");
                if ($validateEmail !== true) {
                    $errors[] = $validateEmail;
                }

                if ($validatePwd !== true) {
                    $errors[] = $validatePwd;
                }

                //if no errors, check if email and password correct
                if (empty($errors)) {
                    //get friend_email and password fromm db
                    $sql = "SELECT friend_email, password FROM $table1 where friend_email = ?";

                    //execute the query
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result(); //get result from the query

                    //if email correct, validate password
                    if ($result->num_rows > 0) {
                        //fetch the result as an associative array
                        $data = $result->fetch_assoc();
                        $dbPassword = $data['password']; //get the password data in the db
                        //check if user enter correct password
                        if ($password == $dbPassword) {
                            //if email and password matched, set login session and assign email variable
                            $_SESSION['isLoggedIn'] = true;
                            $_SESSION['email'] = $email;
                            header("location: friendlist.php"); //direct to friend list page
                            exit();
                        } else {
                            //incorrect password message
                            echo "<p class='error-messages'>Password is incorrect</p>";
                        }
                    } else {
                        //incorrect email message
                        echo "<p class='error-messages'>Incorrect email</p>";
                    }
                    $stmt->close(); //close the prepared statement
                } else {
                    //display all errors
                    echo "<div class='error-messages'>";
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                    echo "</div>";
                }
                $conn->close(); //close the connection
            }
            ?>
        </div>
    </div>
</body>

</html>