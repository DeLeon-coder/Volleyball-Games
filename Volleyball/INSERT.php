<?php 
include_once('connect.inc');

// Set the page title
$page_title = 'Input Teams';

// Check if the form is submitted
if(isset($_POST["submit"])) {
    // Retrieve form inputs
    $team_id = $_POST['team_id'];
    $team_name = $_POST['team_name'];
    $venue_id = $_POST['venue_id'];

    // Connect to the database
    require ('connect.inc'); // Adjust the path as necessary

    // Check if connection was successful
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Make the query
    $q = "INSERT INTO Team_Table (team_id, team_name, venue_id) VALUES ('$team_id', '$team_name', '$venue_id')";

    // Run the query and check for success
    if(mysqli_query($conn, $q)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a team</title>
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
    <h2>Input teams</h2>
    <form action="insert.php" method="post">
        <label for="team_id">Team Number:</label><br>
        <input type="text" id="team_id" name="team_id"><br><br>
        <label for="team_name">Team Name:</label><br>
        <input type="text" id="team_name" name="team_name"><br><br>
        <label for="venue_id">Venue:</label><br>
        <input type="text" id="venue_id" name="venue_id"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
