<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Vu Ha Phuong">
    <link href="style/style.css" rel="stylesheet">
    <title>Home%20Page</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul class="nav-bar">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home Page</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>My Friend System</h1>
            <h1>Assignment Home Page</h1>
            <div class="home">
                <p>Name: Vu Ha Phuong</p>
                <p>Student ID: 104177306</p>
                <p>Email: 104177306@student.swin.edu.au</p>
                <p>I declare that this assignment is my individual work. I have not worked
                    collaboratively, nor have I copied from any other student&apos;s work or from any other source.</p>
                <?php
                require_once("functions/settings.php");
                //connect to database
                $conn = getDBConnection();

                //query to create all tables
                //sql to create friends table
                $sql1 = "CREATE TABLE IF NOT EXISTS $table1 (
                friend_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                friend_email VARCHAR(50) NOT NULL,
                password VARCHAR(20) NOT NULL,
                profile_name VARCHAR(30) NOT NULL,
                date_started DATE NOT NULL,
                num_of_friends INT UNSIGNED
                )";
                if ($conn->query($sql1)) {
                    echo "<div class='result-query'>";
                    echo "<p>Table $table1 successfully created and populated</p>";
                } else {
                    echo "Error creating table: " . $conn->error;
                }

                //sql to create myfriends table
                $sql2 = "CREATE TABLE IF NOT EXISTS $table2 (
                friend_id1 INT NOT NULL,
                friend_id2 INT NOT NULL
                )";
                if ($conn->query($sql2)) {
                    echo "<p>Table $table2 successfully created and populated</p>";
                } else {
                    echo "Error creating table: " . $conn->error;
                }

                //query to insert data
                //check if there is data in friends table
                $query = "SELECT * FROM $table1";
                $result = $conn->query($query);
                if ($result) {
                    if ($result->num_rows > 0) {
                        echo "<p>Data have already been inserted into $table1</p>";
                    } else {
                        //sql to insert sample data to friends table (30 Sample data)
                        $sql3 = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES
                            ('john123@gmail.com', 'password123', 'FriendlyUser', '2022-01-15', 5),
                            ('amie2004@gmail.com', 'pass456', 'CoolGuy', '2021-06-25', 3),
                            ('elena9811@gmail.com', 'mypassword789', 'ChillPerson', '2020-11-05', 3),
                            ('spatta122@gmail.com', 'secret123', 'NiceLady', '2022-02-20', 3),
                            ('trangntt4@gmail.com', 'password007', 'Demon', '2019-08-14', 3),
                            ('orange1212@gmail.com', 'pass999', 'BestHacker', '2018-03-30', 3),
                            ('astre1412@gmail.com', 'mypass333', 'LittleMaster', '2020-10-10', 3),
                            ('deft2310@gmail.com', '123secure', 'TimeTraveler', '2021-12-12', 3),
                            ('faker1305@gmail.com', 'passxyz', 'Goat', '2023-05-05', 3),
                            ('chovyJihoon2002@gmail.com', 'letmein789', 'BestMidLaner', '2017-09-17', 3),
                            ('james.bond007@gmail.com', 'agent007', 'SpyMaster', '2022-03-10', 3),
                            ('lucas1234@gmail.com', 'strongpass12', 'FastRunner', '2020-04-21', 3),
                            ('sakura.blossom@gmail.com', 'flower789', 'CherryBlossom', '2019-09-09', 3),
                            ('robinhood@gmail.com', 'arrow123', 'JusticeSeeker', '2018-12-31', 3),
                            ('eagleeye@gmail.com', 'visionary321', 'SharpShooter', '2021-07-07', 3),
                            ('harry.wizard@gmail.com', 'alohomora', 'ChosenOne', '2020-01-01', 3),
                            ('tony.stark@starkindustries.com', 'iamironman', 'IronMan', '2017-05-05', 3),
                            ('captain.america@gmail.com', 'freedom123', 'Cap', '2019-11-11', 3),
                            ('natasha.romanoff@gmail.com', 'blackwidow2020', 'BlackWidow', '2021-08-08', 3),
                            ('clint.barton@gmail.com', 'hawkeye456', 'HawkEye', '2018-06-15', 3),
                            ('bruce.banner@gmail.com', 'hulkSmash!', 'Hulk', '2019-03-22', 3),
                            ('thor.odinson@gmail.com', 'stormbreaker', 'GodOfThunder', '2021-02-01', 3),
                            ('wanda.maximoff@gmail.com', 'scarletwitch', 'Witch', '2023-01-15', 3),
                            ('vision.ai@gmail.com', 'synthezoid123', 'Vision', '2020-08-08', 3),
                            ('stephen.strange@gmail.com', 'mysticarts', 'DrStrange', '2021-09-29', 3),
                            ('peter.parker@gmail.com', 'spideySense', 'SpiderMan', '2018-12-17', 2),
                            ('tchalla.wakanda@gmail.com', 'wakandaforever', 'BlackPanther', '2022-04-04', 1),
                            ('carol.danvers@gmail.com', 'flerken123', 'CaptainMarvel', '2019-07-07', 0),
                            ('gamora.zen@gmail.com', 'greenwarrior', 'Gamora', '2021-06-12', 0),
                            ('rocket.raccoon@gmail.com', 'trashpanda456', 'Rocket', '2019-05-15', 0);";
                        if ($conn->query($sql3)) {
                            echo "<p>Data successfully inserted into $table1</p>";
                        } else {
                            echo "<p>Error inserting data into $table1: " . $conn->error . "</p>";
                        }
                    }
                } else {
                    echo "<p>Error checking data in $table1: " . $conn->error . "</p>";
                }

                //check if there is data in myfriends table
                $query2 = "SELECT * FROM myfriends";
                $result2 = $conn->query($query2);
                if ($result2) {
                    if ($result2->num_rows > 0) {
                        echo "<p>Data have already been inserted into $table2</p>";
                    } else {
                        //insert sample data to myfriends table
                        $sql4 = "INSERT INTO myfriends VALUES (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (2, 5),
                                                            (2, 6), (2, 7), (3, 6), (3, 7), (3, 8), (4, 7),
                                                            (4, 8), (4, 9), (5, 8), (5, 9), (5, 10), (6, 9),
                                                            (6, 10), (6, 11), (7, 10), (7, 11), (7, 12), (8, 11), (8, 12), (8, 13),
                                                            (9, 12), (9, 13), (9, 14), (10, 13), (10, 14), (10, 15),
                                                            (11, 14), (11, 15), (11, 16), (12, 15), (12, 16), (12, 17),
                                                            (13, 16), (13, 17), (13, 18), (14, 17), (14, 18), (14, 19),
                                                            (15, 18), (15, 19), (15, 20), (16, 19), (16, 20), (16, 21),
                                                            (17, 20), (17, 21), (17, 22), (18, 21), (18, 22), (18, 23),
                                                            (19, 22), (19, 23), (19, 24), (20, 23), (20, 24), (20, 25),
                                                            (21, 24), (21, 25), (21, 26), (22, 25), (22, 26), (22, 27),
                                                            (23, 26), (23, 27), (23, 28), (24, 27), (24, 28), (24, 29),
                                                            (25, 28), (25, 29), (25, 30), (26, 29), (26, 30), (27, 30)
                        ;";
                        if ($conn->query($sql4)) {
                            echo "<p>Data successfully inserted into $table2</p>";
                            echo "</div>";
                        } else {
                            echo "<p>Error inserting data into $table2: " . $conn->error . "</p>";
                        }
                    }
                } else {
                    echo "<p>Error checking data in $table2: " . $conn->error . "</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div class="return-link">
            <a href="signup.php">Sign-Up</a>
            <a href="login.php">Log-In</a>
            <a href="about.php">About</a>
        </div>
    </div>
</body>

</html>