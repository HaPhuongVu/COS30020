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
    <title>Sign%20Up</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="signup.php">Sign Up</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </nav>
        <!-- display sign up form  -->
        <div class="content">
            <h1>My Friend System</h1>
            <h1>Registration Page</h1>
            <!-- sign up form using post method -->
            <form method="post" action="">
                <fieldset>
                    <legend>Sign Up</legend>
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"> <!--set input value for email and profile name, when submit the value will not clear-->
                    </div>
                    <div class="form-input">
                        <label for="profileName">Profile Name</label>
                        <input type="text" name="profileName" id="profileName" value="<?php echo isset($_POST['profileName']) ? htmlspecialchars($_POST['profileName']) : ''; ?>">
                    </div>
                    <div class="form-input">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd">
                    </div>
                    <div class="form-input">
                        <label for="confirmPwd">Confirm Password</label>
                        <input type="password" name="confirmPwd" id="confirmPwd">
                    </div>
                    <div class="button-group">
                        <button type="submit" class="button-content">Register</button>
                        <!-- button reset not reset the post value so redirect to the same page to reset the form -->
                        <a href="signup.php" class="reset-button button-content">Clear</a>
                    </div>
                </fieldset>
            </form>

            <?php
            require_once("functions/settings.php");

            // Array to store error messages
            $errors = [];
            //connect to db
            $conn = getDBConnection();


            // Check if email is unique
            function isEmailUnique($email, $conn, $table1)
            {
                $sql = "SELECT friend_email FROM $table1 WHERE friend_email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    return "This email has already been registered.";
                }
                return true;
            }

            // Validate confirm password
            function validateConfirmPwd($pwd, $confirmPwd)
            {
                if ($confirmPwd !== $pwd) {
                    return "Confirmed Password does not match the Password.";
                }
                return true;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get form data
                $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : ""; //sanitize input function from settings.php
                $profileName = isset($_POST['profileName']) ? sanitizeInput($_POST['profileName']) : "";
                $pwd = isset($_POST['pwd']) ? sanitizeInput($_POST['pwd']) : "";
                $confirmPwd = isset($_POST['confirmPwd']) ? sanitizeInput($_POST['confirmPwd']) : "";

                // Validate inputs and collect errors
                //Validate inputs function in settings.php
                $emailValidation = validateInput($email, $emailPattern, "Email");
                if ($emailValidation !== true) {
                    $errors[] = $emailValidation;
                }

                $profileNameValidation = validateInput($profileName, $profilePattern, "Profile Name");
                if ($profileNameValidation !== true) {
                    $errors[] = $profileNameValidation;
                }

                $pwdValidation = validateInput($pwd, $pwdPattern, "Password");
                if ($pwdValidation !== true) {
                    $errors[] = $pwdValidation;
                }

                $confirmPwdValidation = validateConfirmPwd($pwd, $confirmPwd);
                if ($confirmPwdValidation !== true) {
                    $errors[] = $confirmPwdValidation;
                }

                // Check if email is unique
                if ($emailValidation === true) {
                    $uniqueEmailValidation = isEmailUnique($email, $conn, $table1);
                    if ($uniqueEmailValidation !== true) {
                        $errors[] = $uniqueEmailValidation;
                    }
                }

                // If no errors, insert data into table
                if (empty($errors)) {
                    $sql = "INSERT INTO $table1 VALUES (null, ? , ? , ?, CURDATE(), 0)";
                    //execute the query
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $email, $pwd, $profileName);
                    $result = $stmt->execute();
                    //if query success, set login session and assign email variable
                    if ($result) {
                        $_SESSION['isLoggedIn'] = true;
                        $_SESSION['email'] = $email;
                        header("location: friendadd.php"); //direct the add friends page
                        exit();
                    } else {
                        echo "<p class='error-messages'>Could not insert data into the table.</p>";
                    }
                    //close the prepared statement
                    $stmt->close();
                } else {
                    // Display all errors
                    echo "<div class='error-messages'>";
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                    echo "</div>";
                }
                //close connection
                $conn->close();
            }
            ?>
            <div class="return-link">
                <a href="index.php">Back to Home</a>
            </div>
        </div>
    </div>
</body>

</html>