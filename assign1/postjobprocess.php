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
                    <a class="nav-link" href=" postjobform.php">Post Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="searchjobform.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
        </nav>
        <h1>Job Vacancy Posting System</h1>
        <?php
        umask(0007);
        //$dir = "../../data/jobs/";
        $dir = "data/";

        //Check if directory exists
        if (!file_exists($dir)) {
            mkdir($dir, 02770, true);
        }
        $filename = $dir . "positions.txt";

        // validate position ID
        function validatePosId($posID)
        {
            $posIDPattern = "/^ID\d+$/";
            if (empty($posID)) {
                echo "<p class='error-message'>Position ID cannot empty</p>";
                return false;
            } else if (strlen($posID) != 5) {
                echo "<p class='error-message'>Position ID need exactly 5 characters</p>";
            } else if (!preg_match($posIDPattern, $posID)) {
                echo "<p class='error-message'>Position ID need to start with 'ID' and contain numbers</p>";
            } else {
                return true;
            }
        }

        //check if Position ID is unique
        function isPosIdUnique($posID, $filename)
        {
            $posIDData = [];
            if (file_exists($filename) && is_readable($filename)) {
                $handle = fopen($filename, "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                        $data = explode("\t", trim($line));
                        if (isset($data[0])) {  // Check if there is a valid position ID
                            $posIDData[] = $data[0];  // Add the position ID to the array
                        }
                    }
                    fclose($handle);
                } else {
                    echo "<p class='error-message'>Unable to open file</p>";
                    displayButtonAndFooter();
                }
            }
            return !(in_array($posID, $posIDData));
        }

        // validate title
        function validateTitle($title)
        {
            $titlePattern = "/^[a-zA-Z\s,\.!]+$/";
            if (empty($title)) { //check if title has data
                echo "<p class='error-message'>Title cannot be empty</p>";
                return false;
            } else if (strlen($title) > 11) { //check if length of title is <= 10
                echo "<p class='error-message'>Maximum characters for title is 10.</p>";
            } else if (!preg_match($titlePattern, $title)) { //check if title match with required pattern
                echo "<p class='error-message'>Title only contains alphabetic characters include spaces, comma, full-stop and exclamation point.</p>";
            } else {
                return true;
            }
        }

        // validate description
        function validateDes($des)
        {
            if (empty($des)) { //check if description is empty
                echo "<p class='error-message'>Description cannot be empty</p>";
                return false;
            } else if (strlen($des) > 250) { //check if maximum length of description is 250
                echo "<p class='error-message'>Maximum characters for description is 250.</p>";
            } else {
                return true;
            }
        }

        // validate date. Date need to be in format dd/mm/yy
        function validateDate($date)
        {
            $datePattern = "/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{2}$/"; //format dd/mm/yy in regex
            if (empty($date)) { //check if date is empty
                echo "<p class='error-message'>Date cannot be emtpy</p>";
                return false;
            } else if (!preg_match($datePattern, $date)) { //checkk if date is in format dd/mm/yy
                echo "<p class='error-message'>Date need to be in format dd/mm/yy</p>";
            } else {
                return true;
            }
        }

        //validate for location, position, contract
        function validateRadioInput($fieldInput, $fileName)
        {
            if (empty($fieldInput)) {
                echo "<p class='error-message'>Choose one $fileName option</p>";
                return false;
            } else {
                return true;
            }
        }

        //validate application method
        function validateApplicationMethod($fieldInput, $fieldName)
        {
            if (empty($fieldInput)) { //check if application method is empty
                echo "<p class='error-message'>You have to choose at least one $fieldName</p>";
                return false;
            } else {
                return true;
            }
        }

        //reduce number of repeating html code to call button and footer by put in in a function
        function displayButtonAndFooter()
        {
            echo "<div class='return-button'>";
            echo "<a class='return-link' href='index.php'>Return to Home Page</a>";
            echo "</div>";
            echo "<div class='return-button'>";
            echo "<a class='return-link' href='postjobform.php'>Back to Post Job Page</a>";
            echo "<footer>";
            echo "<p>&copy; This work belongs to Vu Ha Phuong</p>";
            echo "</footer>";
            echo "</div>";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // check if form submit method is 'post'
            //get all data from post job form. If data exists, get the result. If not, return empty string
            $posID = (isset($_POST["posID"])) ? $_POST["posID"] : '';
            $title = (isset($_POST["title"])) ? $_POST["title"] : '';
            $desc = (isset($_POST["desc"])) ? $_POST["desc"] : '';
            $date = (isset($_POST["date"])) ? $_POST["date"] : '';
            $position = (isset($_POST["position"])) ? $_POST["position"] : '';
            $contract = (isset($_POST["contract"])) ? $_POST["contract"] : '';
            $location = (isset($_POST["location"])) ? $_POST["location"] : '';
            $application = isset($_POST["applications"]) ? implode(",", $_POST["applications"]) : array();

            //validate input
            $validatePosID = validatePosId($posID);
            $validateTitle = validateTitle($title);
            $validateDes = validateDes($desc);
            $validateDate = validateDate($date);
            $validatePosition = validateRadioInput($position, "position");
            $validateLocation = validateRadioInput($location, "location");
            $validateContract = validateRadioInput($contract, "contract");
            $validateApplication = validateApplicationMethod($application, "application methods");

            //check if all inputs are validated
            if ($validatePosID && $validateTitle && $validateDes && $validateDate && $validatePosition && $validateContract && $validateLocation && $validateApplication) {
                if (isPosIdUnique($posID, $filename)) { //check if posID unique
                    $handle = fopen($filename, "a"); //open the file in append mode
                    if ($handle) { //check if file open successfully
                        $data = "$posID\t$title\t$desc\t$date\t$position\t$contract\t$location\t$application\n"; //concatenate data
                        $result = fwrite($handle, $data); //write data to the file
                        if ($result) {
                            echo "<p class='success-message'>Your submission has successfully submitted!!</p>"; //success message when data successfully written to the file
                            displayButtonAndFooter(); // display footer, back to home page and back to post job page button
                        } else {
                            echo "<p class='error-message'>Unable to write data to file</p>";
                            displayButtonAndFooter();
                        }
                    } else {
                        echo "<p class='error-message'>Unable to open file</p>"; //error message when file cannot open
                        displayButtonAndFooter();
                    }
                    fclose($handle); //close the file
                } else {
                    echo "<p class='error-message'>This position ID has been existed</p>"; // error message for duplicate position ID
                    displayButtonAndFooter();
                }
            } else {
                echo "<p class='error-message'>Please fulfil all requirements to submit the form</p>";
                displayButtonAndFooter();
            }
        }
        ?>
    </div>
</body>

</html>