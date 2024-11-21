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
    <title>Add%20Friends</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link active" href="friendadd.php" aria-current="page">Add Friends</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="friendlist.php">Friend List</a></li>
                <li class="nav-item"><a class="nav-link" href="editprofile.php">Edit Your Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </nav>
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

        //handle add friend action
        if (isset($_POST['addfriend'])) {
            $friend_id2 = $_POST['friend_id2']; //get friend_id2 from the form action

            // Insert new friend to myfriends table
            $sql = "INSERT INTO $table2 (friend_id1, friend_id2) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $friend_id1, $friend_id2);
            $stmt->execute();

            // Update number of friends in friends table
            $numOfFriends++;
            $sql = "UPDATE $table1 SET num_of_friends = ? WHERE friend_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $numOfFriends, $friend_id1);
            $stmt->execute();

            // Redirect to the same page to refresh the friends list
            header("location:friendadd.php?page=" . $_GET['page']);
            exit();
        }

        // Pagination setup
        $friends_per_page = 10; // Define how many friends to display per page

        // Fetch the total number of friends that the user hasn't added
        $sql = "SELECT COUNT(f.friend_id) AS total_friends
        FROM $table1 f
        WHERE f.friend_id != ?
          AND f.friend_id NOT IN (
            SELECT mf.friend_id1
            FROM $table2 mf
            WHERE mf.friend_id2 = ?)
          AND f.friend_id NOT IN (
            SELECT mf.friend_id2
            FROM $table2 mf
            WHERE mf.friend_id1 = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $friend_id1, $friend_id1, $friend_id1);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //get the total friends
        $total_friends = $row['total_friends'];

        // Calculate total pages
        $totalPages = ceil($total_friends / $friends_per_page);
        $currentPage = isset($_GET['page']) ? max(1, min($_GET['page'], $totalPages)) : 1; // Determine current page
        $page_first_result = ($currentPage - 1) * $friends_per_page;

        // Fetch friends for the current page
        $sql = "SELECT f.friend_id, f.profile_name
                FROM $table1 f
                WHERE f.friend_id != ?
                AND f.friend_id NOT IN (
                    SELECT mf.friend_id2
                    FROM $table2 mf
                    WHERE mf.friend_id1 = ?)
                LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $friend_id1, $friend_id1, $page_first_result, $friends_per_page);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <h1>My Friend System</h1>
        <h2><?php echo "<span class='inline-text'>" . $profile_name . "</span>" ?>&apos;s Add Friends Page</h2>
        <h2>Total number of friends is <?php echo "<span class='inline-text'>" . $numOfFriends . "</span>" ?></h2>

        <!-- Display table of friends -->
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Friends</th><th>Mutual Friends</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                // Get mutual friends query
                $sql2 = "SELECT COUNT(*) AS num_mutual_friends
                FROM $table2 mf1
                INNER JOIN $table2 mf2 ON mf1.friend_id2 = mf2.friend_id2
                WHERE mf1.friend_id1 = ? AND mf2.friend_id1 = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("ii", $friend_id1, $row['friend_id']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();

                echo "<tr>";
                echo "<td>" . $row['profile_name'] . "</td>";
                echo "<td>" . $row2['num_mutual_friends'] . "</td>"; // Display mutual friends
                echo "<td>
                        <form method='post' action=''>
                            <input type='hidden' name='friend_id2' value='" . $row["friend_id"] . "'>
                            <button type='submit' name='addfriend' class='action button-content'>Add as Friend</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error-messages'>No more friends to add.</p>";
        }
        //close connection and prepared statment
        $stmt->close();
        $conn->close();
        ?>

        <!-- Pagination Links -->
        <div class="pagination">
            <?php
            if ($totalPages > 1) {
                for ($page_num = 1; $page_num <= $totalPages; $page_num++) {
                    if ($page_num == $currentPage) {
                        echo "<a class='active' href='friendadd.php?page=" . $page_num . "'>" . $page_num . "</a>";
                    } else {
                        echo "<a href='friendadd.php?page=" . $page_num . "'>" . $page_num . "</a>";
                    }
                }
            }
            ?>
        </div>
        <div class="return-link">
            <a href="friendlist.php">Friends List</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</body>

</html>