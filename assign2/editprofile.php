<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['isLoggedIn']) || !isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link href="style/style.css" rel="stylesheet">
    <title>Edit%20Profile</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link" href="friendadd.php">Add Friends</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="friendlist.php" aria-current="page">Friend List</a></li>
                <li class="nav-item"><a class="nav-link active" href="editprofile.php">Edit Your Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <?php
            require_once("functions/settings.php");
            //connect to db
            $conn = getDBConnection();
            //array to store errors msg and a success variable
            $errors = [];
            $success = false;
            //Get the current user's infomation (friend_id, email, profile name, password)
            $sql = "SELECT friend_id, friend_email, password, profile_name FROM $table1 where friend_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            //get the data
            $friendID = $data['friend_id'];
            $email = $data['friend_email'];
            $profileName = $data['profile_name'];
            $password = $data['password'];

            //get the data from the form
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $newEmail = isset($_POST['email']) ? sanitizeInput($_POST['email']) : $email;
                $newProfileName = isset($_POST['profileName']) ? sanitizeInput($_POST['profileName']) : $profileName;
                $newPassword = isset($_POST['password']) ? sanitizeInput($_POST['password']) : $password;

                //validate input
                $emailValidation = validateInput($newEmail, $emailPattern, "Email");
                $profileNameValidation = validateInput($newProfileName, $profilePattern, "Profile Name");
                $passwordValidation = validateInput($newPassword, $pwdPattern, "Password");

                //collect errors
                if ($emailValidation !== true) {
                    $errors[] = $emailValidation;
                }

                if ($profileNameValidation !== true) {
                    $errors[] = $profileNameValidation;
                }

                if ($passwordValidation !== true) {
                    $errors[] = $passwordValidation;
                }

                if (empty($errors)) {
                    //update for new information
                    $sql = "UPDATE $table1 SET friend_email = ?, profile_name = ?, password = ? WHERE friend_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssi", $newEmail, $newProfileName, $newPassword, $friendID);
                    if ($stmt->execute() == TRUE) {
                        //fetch new data again
                        $sql2 = "SELECT friend_email, profile_name, password FROM $table1 WHERE friend_id = ?;";
                        $stmt = $conn->prepare($sql2);
                        $stmt->bind_param("i", $friendID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        // Assign new information to the screen
                        $email = $row['friend_email'];
                        $password = $row['password'];
                        $profileName = $row['profile_name'];
                        // Update session email to the new email
                        $_SESSION['email'] = $email;
                        $success = true;
                    } else {
                        $errors[] = "Failed to update information";
                    }
                }
            }
            //close connect and prepared statement
            $stmt->close();
            $conn->close();
            ?>
            <!-- display edit form  -->
            <h1>My Friend System</h1>
            <h2><?php echo "<span class='inline-text'>" . $profileName . "</span>" ?> &apos;s Information</h2>
            <form method="post" action="">
                <fieldset>
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-input">
                        <label for="profileName">Profile Name</label>
                        <input type="text" name="profileName" id="profileName" value="<?php echo $profileName; ?>">
                    </div>
                    <div class="form-input">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" value="<?php echo $password; ?>">
                    </div>
                    <div class="button-group">
                        <button type="submit" name="edit" class="button-content">Update</button>
                    </div>
                </fieldset>
            </form>
            <?php
            if (!empty($errors)) {
                // Display all errors
                echo "<div class='error-messages'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            }

            //display success message if profile successfully updated
            if ($success) {
                echo "<p class='error-messages'>Profile updated success</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>