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
        $dir = "data/";
        //$dir = "../../data/jobs/";
        //Check if directory exists
        if (!file_exists($dir)) {
            mkdir($dir, 02770, true); //create if directory not exist
        }
        $filename = $dir . 'positions.txt';

        //reduce number of calling button and footer by put it in a function
        function displayButtonAndFooter()
        {
            echo "<div class='button-group'>";
            echo "<div class='return-button'>";
            echo "<a class='return-link' href='index.php'>Return to Home Page</a>";
            echo "</div>";
            echo "<div class='return-button'>";
            echo "<a class='return-link' href='searchjobform.php'>Back to Search Page</a>";
            echo "</div>";
            echo "<footer>";
            echo "<p>&copy; This work belongs to Vu Ha Phuong</p>";
            echo "</footer>";
            echo "</div>";
            echo "</div>";
        }

        //get data from file
        function readDataFromFile($filename)
        {
            $data = []; //create array to store data from the file
            //check if file exist and allow to read
            if (file_exists($filename)) {
                $jobData = file($filename);
                if (empty($jobData)) {
                    echo "<p>No related data was found</p>";
                } else {
                    //get data from file and store it in an array with corresponding value
                    foreach ($jobData as $line) {
                        $fields = explode("\t", $line);
                        $applicationMethods = explode(",", trim($fields[7]));
                        $data[] = [
                            'posID' => $fields[0],
                            'title' => $fields[1],
                            'desc' => $fields[2],
                            'date' => $fields[3],
                            'position' => $fields[4],
                            'location' => $fields[6],
                            'contract' => $fields[5],
                            'application' => $applicationMethods
                        ];
                    }
                }
            } else {
                return false;
            }
            return $data;
        }

        // sort date in ascending order. Start from the closest date.
        function sortByDate($job1, $job2)
        {
            // Convert dd/mm/yyyy to DateTime for comparison
            $date1 = DateTime::createFromFormat('d/m/Y', $job1['date']);
            $date2 = DateTime::createFromFormat('d/m/Y', $job2['date']);

            if ($date1 < $date2) { //date1 < date2, date1 stand before date 2
                return -1;
            } else if ($date1 > $date2) { //date1 > date2, so date1 stand behind
                return 1;
            } else {
                return 0; //same date
            }
        }

        //function to sort job by title (A-Z)
        function sortByTitle($job1, $job2)
        {
            return strcmp($job1['title'], $job2['title']);
        }

        //sort by ID. Smallest to Largest
        function sortByID($job1, $job2)
        {
            $firstID = substr($job1['posID'], 2);
            $secondID = substr($job2['posID'], 2);
            if ($firstID < $secondID) {
                return -1;
            } else {
                return 1;
            }
        }

        //highligth search word
        function hightlightSearchWord($text, $keyword)
        {

            $keyword = preg_quote($keyword, '/'); //Escapes special characters in the keyword
            $keywordArray = explode(' ', $keyword); // Split keywords by space and create a pattern to match any of them
            $pattern = implode('|', $keywordArray); //Joins the keywords into a single regex pattern where each keyword is separated by |

            // Use preg_replace to wrap matched keywords with a <span> tag
            // The 'iu' tag ensure that the matching is case-sensitive
            // $1 refer to the matched text before, which is '/(' . $pattern . ')/iu'
            $highlightedText = preg_replace('/(' . $pattern . ')/iu', '<span class="highlighted-word">$1</span>', $text);

            return $highlightedText;
        }

        //search job based on different fields
        function searchMatchesJob($data, $keyword, $posID, $title, $position, $contract, $location, $application)
        {
            $matches = [];

            foreach ($data as $job) {
                $match = true;

                if (!empty($keyword)) {
                    $keywordWords = explode(" ", $keyword); // Split the keyword into words
                    $match = false;
                    foreach ($keywordWords as $word) {
                        if (
                            (stripos($job['title'], $word) !== false) ||
                            (stripos($job['desc'], $word) !== false) ||
                            (stripos($job['posID'], $word) !== false) ||
                            (stripos($job['position'], $word) !== false) ||
                            (stripos($job['location'], $word) !== false) ||
                            (stripos($job['contract'], $word) !== false) ||
                            (stripos(implode(",", $job['application']), $word)) !== false
                        ) {
                            $match = true; // Match if any word appears in the title or description
                        }
                    }
                }

                if (!empty($title) && stripos($job['title'], $title) === false) {
                    $match = false; //check if title not in the array/not match with any character
                }
                if (!empty($posID) && stripos($job['posID'], $posID) === false) {
                    $match = false; //search by positionID, user can just enter in the number, no need for ID
                }
                if (!empty($position) && !in_array($job['position'], $position)) {
                    $match = false; //check if no postion match
                }
                if (!empty($contract) && !in_array($job['contract'], $contract)) {
                    $match = false; //check if no contract match
                }
                if (!empty($location) && !in_array($job['location'], $location)) {
                    $match = false; //check if no location match
                }
                if (!empty($application) && !array_intersect($application, $job['application'])) {
                    $match = false; //check if no application match
                }
                if ($match) {
                    $matches[] = $job; //if there are matches job, add to array
                }
            }
            return $matches; //return array
        }

        //display jobs in table form
        function displayJobs($data, $keyword)
        {
            if (empty($data)) { //if file has no data, so there is no posted jobs
                echo "<p class='error-message'>There is no jobs has been posted</p>";
            } else {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Job Title</th>";
                echo "<th style='text-align:center;'>Job Description</th>";
                echo "<th>Closing Date</th>";
                echo "<th>Location</th>";
                echo "<th>Position</th>";
                echo "<th>Contract</th>";
                echo "<th>Application by</th>";
                echo "</tr>";
                echo "</thead>";
                foreach ($data as $job) { //loop through the file
                    echo "<tbody>";
                    echo "<tr>";
                    // hightlighted search keyword
                    $highlightedTitle = !empty($keyword) ? hightlightSearchWord($job['title'], $keyword) : $job['title'];
                    $highlightedDesc = !empty($keyword) ? hightlightSearchWord($job['desc'], $keyword) : $job['desc'];
                    $highlightedLocation = !empty($keyword) ? hightlightSearchWord($job['location'], $keyword) : $job['location'];
                    $highlightedPosID = !empty($keyword) ? hightlightSearchWord($job['posID'], $keyword) : $job['posID'];
                    $highlightedPosition = !empty($keyword) ? hightlightSearchWord($job['position'], $keyword) : $job['position'];
                    $highlightedContract = !empty($keyword) ? hightlightSearchWord($job['contract'], $keyword) : $job['contract'];
                    $highlightedApplication = !empty($keyword) ? hightlightSearchWord(implode(",", $job['application']), $keyword) : implode(",", $job['application']);

                    //display it on table
                    echo "<td>" . $highlightedPosID . "</td>";
                    echo "<td>" . $highlightedTitle . "</td>";
                    echo "<td>" . $highlightedDesc . "</td>";
                    echo "<td>" . $job['date'] . "</td>";
                    echo "<td>" . $highlightedLocation . "</td>";
                    echo "<td>" . $highlightedPosition . "</td>";
                    echo "<td>" . $highlightedContract . "</td>";
                    echo "<td>" . $highlightedApplication . "</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";
                displayButtonAndFooter();
            }
        }

        //only display job has not been closed(inclusive today)
        function filterJobsByDate($data)
        {
            $today = new DateTime();
            $today->setTime(0, 0, 0); //set time of the day to 0 to remove time component
            $filterData = array(); //create array to store the filtered job data
            foreach ($data as $job) {
                $jobDate = DateTime::createFromFormat("d/m/y", $job['date']);
                $jobDate->setTime(0, 0, 0);
                //Compare job date with today date
                //If job date is today or future's date, add to the array
                if ($jobDate >= $today) {
                    $filterData[] = $job;
                }
            }
            if ($filterData) {
                return $filterData;
            } else {
                return false;
            }
        }

        //check if method is "get"
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            //get data from form. If data exists, get result. If not, return empty string/empty array
            $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
            $posID = isset($_GET["jobID"]) ? trim($_GET["jobID"]) : '';
            $title = isset($_GET["jobTitle"]) ? trim($_GET["jobTitle"]) : '';
            $location = isset($_GET["jobLocation"]) ? $_GET["jobLocation"] : [];
            $position = isset($_GET["jobPosition"]) ? $_GET["jobPosition"] : [];
            $contract = isset($_GET["jobContract"]) ? $_GET["jobContract"] : [];
            $application = isset($_GET["jobApplication"]) ? $_GET["jobApplication"] : [];

            //read file data. Filter jobs by date, only display jobs hasn't closed.
            $fileData = readDataFromFile($filename);
            if (!$fileData) { //check if file exists
                //error message when file cannot open
                echo "<p class='error-message'>File not exists.</p>";
                displayButtonAndFooter();
            } else {
                $fileData = filterJobsByDate($fileData); //filter data from file, only display up-to-date jobs
                if ($fileData) {
                    if (empty($keyword) && empty($posID) && empty($title) && empty($position) && empty($location) && empty($contract) && empty($application)) { //no data found
                        echo "<h2>All Jobs List</h2>";
                        //form to select sort options for all job lists
                        //multiple option to sort
                        echo "<form action='' method='get' class='row'>";
                        echo "<select name='sortOption' id='sort' onchange='this.form.submit()'>";
                        echo "<option value=''>Sort Option</option>";
                        echo "<option value='sortTitle'>Sort by Job Title A-Z</option>";
                        echo "<option value='sortDate'>Sort by closest Closing Date</option>";
                        echo "<option value='sortID'>Sort by ID(from smallest to largest)</option>";
                        echo "</select>";
                        echo "</form>";
                        $sortOption = isset($_GET["sortOption"]) ? $_GET["sortOption"] : '';
                        if ($sortOption == 'sortTitle') {
                            usort($fileData, "sortByTitle"); //sprt by title
                        } else if ($sortOption == 'sortID') {
                            usort($fileData, "sortByID"); //sort by ID
                        } else {
                            usort($fileData, "sortByDate"); //sort by date
                        }
                        displayJobs($fileData, $keyword); //display jobs on screen
                    } else {
                        $matchingJobs = searchMatchesJob($fileData, $keyword, $posID, $title, $position, $contract, $location, $application);
                        if ($matchingJobs) {
                            usort($matchingJobs, "sortByDate"); //sort jobs by date
                            echo "<h2>Job Match</h2>";
                            displayJobs($matchingJobs, $keyword); //display jobs
                        } else {
                            echo "<p class='error-message'>No Job match found.</p>";
                            displayButtonAndFooter();
                        }
                    }
                } else {
                    echo "<p class='error-message'>No up-to-date jobs has been posted.</p>";
                    displayButtonAndFooter();
                }
            }
        }
        ?>
    </div>
</body>

</html>