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
    <title>Friends%20List</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link" href="friendadd.php">Add Friends</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link active" href="friendlist.php" aria-current="page">Friend List</a></li>
                <li class="nav-item"><a class="nav-link" href="editprofile.php">Edit Your Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <?php
            require_once("functions/settings.php");
            // Connect to the database
            $conn = getDBConnection();

            // Get the current user's details (friend_id, profile_name, number of friends)
            $sql = "SELECT friend_id, profile_name, num_of_friends FROM $table1 WHERE friend_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc(); //fetch the result as an associative array

            // Store friend_id, profile name, and number of friends
            $friend_id1 = $data['friend_id'];
            $profile_name = $data['profile_name'];
            $numOfFriends = $data['num_of_friends'];

            // Fetch the current user's friends
            $sql = "SELECT f.friend_id, f.profile_name
                FROM $table2 AS mf
                JOIN $table1 AS f ON mf.friend_id2 = f.friend_id
                WHERE mf.friend_id1 = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $friend_id1);
            $stmt->execute();
            $result = $stmt->get_result();

            //handle unfriend action
            if (isset($_POST['unfriend'])) {
                $friend_id2 = $_POST['friend_id2']; //get friend_id2 from the form action
                // Delete the record from myfriends table
                $sql = "DELETE FROM $table2 WHERE friend_id1 = ? AND friend_id2 = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $friend_id1, $friend_id2);
                $stmt->execute();

                // Update the number of friends
                $numOfFriends--;
                $sql = "UPDATE $table1 SET num_of_friends = ? WHERE friend_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $numOfFriends, $friend_id1);
                $stmt->execute();

                // Redirect to the same page to refresh the friend list
                header("location: friendlist.php");
                exit();
            }

            ?>
            <h1>My Friend System</h1>
            <!-- display profile name and num of friends to screen  -->
            <h2><?php echo "<span class='inline-text'>" . $profile_name . "</span>" ?>&apos;s Friend List Page</h2>
            <h2>Total number of friends is <?php echo "<span class='inline-text'>" . $numOfFriends . "</span>" ?></h2>

            <!-- Display table of friends -->
            <?php
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Your Friends</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['profile_name'] . "</td>";
                    echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='friend_id2' value='" . $row["friend_id"] . "'>
                        <button type='submit' name='unfriend' class='action button-content'>Unfriend</button>
                    </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='error-messages'>You have no friends added.</p>";
            }
            // Close the prepared statement and connection
            $stmt->close();
            $conn->close();
            ?>
            <div class="return-link">
                <a href="friendadd.php">Add Friends</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
</body>

</html>