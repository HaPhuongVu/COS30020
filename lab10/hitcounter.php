<?php
class HitCounter
{
    private $dbConnect;

    function __construct($host, $username, $password, $dbname)
    {
        $this->dbConnect = mysqli_connect($host, $username, $password, $dbname);
        if ($this->dbConnect->connect_errno) {
            die("Connection failed: " . $this->dbConnect->connect_error);
        }

        // Check if table exists (using DESCRIBE)
        $sql = "DESCRIBE hitcounter;";
        if (!$this->dbConnect->query($sql)) {
            die("<p>Table 'hitcounter' does not exist.</p>"
                . "<p>Error code " . $this->dbConnect->errno
                . ": " . $this->dbConnect->error . "</p>");
        }
    }

    function getHits()
    {
        $sql = "SELECT hits FROM hitcounter;";
        $result = $this->dbConnect->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['hits'];
        } else {
            return "Unable to execute the query: " . $this->dbConnect->error;
        }
    }

    function setHits($hits)
    {
        // Using prepared statement to avoid SQL injection
        $sql = "UPDATE hitcounter SET hits = $hits;";
        $this->dbConnect->query($sql) or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");
    }

    function closeConnection()
    {
        $this->dbConnect->close();
    }

    function startOver()
    {
        $sql = "UPDATE hitcounter SET hits = 0";
        $this->dbConnect->query($sql) or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");
    }
}
