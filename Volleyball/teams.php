<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Something</title>
    <link rel="stylesheet" href="home.css" type="text/css">
</head>


<body>
    
    <h1> Volleyball Roster </h1>
    <nav class=navbar>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="teams.php">Teams</a></li>
        </ul>
    </nav>    
    <br>
</body>
</html>

<?php
include_once('connect.inc');

// Make sure $data_result is initialized
$data_result = array();

// Query to select all from Team_Table
$query = "SELECT * FROM Team_Table";
$result = $conn->query($query);

if ($result) {
    // Fetch all results into $data_result
    while ($row = $result->fetch_assoc()) {
        $data_result[] = $row;
    }

    // Check if there are results to display
    if (!empty($data_result)) {
        foreach ($data_result as $row) {
            echo 'Team Number: ' . $row['team_id'] . '<br>';
            echo 'Team Name: ' . $row['team_name'] . '<br>';
            echo 'Venue: ' . $row['venue_id'] . '<br>';
            echo '<hr>'; // Add a horizontal rule for better readability
        }
    } else {
        echo 'No teams found.';
    }
} else {
    echo 'Query failed: ' . $conn->error;
}

?>