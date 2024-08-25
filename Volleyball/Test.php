<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert into Tables</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Insert Data</h2>
        
        <!-- Form with table selection -->
        <form action="Test.php" method="post">
            <!-- Table selection dropdown -->
            <div class="form-group">
                <label for="table">Select Table:</label>
                <select class="form-control" id="table" name="table">
                    <option value="quarter_points_table">Quarter Table</option>
                    <option value="semi_points_table">Semi Table</option>
                    <option value="final_points_table">Final Table</option>
                    <!-- Add more tables as needed -->
                </select>
            </div>

            <!-- Inputs for table data (you can modify according to your database schema) -->
            <div class="form-group">
                <label for="match_id">Match ID:</label>
                <input type="text" class="form-control" id="match_id" name="match_id" placeholder="Enter Match ID">
            </div>

            <div class="form-group">
                <label for="team_id">Team ID:</label>
                <input type="text" class="form-control" id="team_id" name="team_id" placeholder="Enter Team ID">
            </div>

            <div class="form-group">
                <label for="set_1_points">Set 1 :</label>
                <input type="text" class="form-control" id="set_1_points" name="set_1_points" placeholder="Enter Set 1 pts">
            </div>
            
            <div class="form-group">
                <label for="set_2_points">Set 2 :</label>
                <input type="text" class="form-control" id="set_2_points" name="set_2_points" placeholder="Enter Set 2 pts">
            </div>

            <div class="form-group">
                <label for="set_3_points">Set 3 :</label>
                <input type="text" class="form-control" id="set_3_points" name="set_3_points" placeholder="Enter Set 3 pts">
            </div>

            <button type="submit" class="btn btn-dark">Insert Data</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
require('connect.inc'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected table from the form
    $table = $_POST['table'];

    // Get the column values from the form inputs
    $column1 = mysqli_real_escape_string($conn, trim($_POST['match_id']));
    $column2 = mysqli_real_escape_string($conn, trim($_POST['team_id']));
    $column3 = mysqli_real_escape_string($conn, trim($_POST['set_1_points']));
    $column4 = mysqli_real_escape_string($conn, trim($_POST['set_2_points']));
    $column5 = mysqli_real_escape_string($conn, trim($_POST['set_3_points']));

    // Prepare the query based on the selected table
    if ($table == 'quarter_points_table') {
        $query = "INSERT INTO quarter_points_table (match_id, team_id, set_1_points, set_2_points, set_3_points) VALUES ('$column1', '$column2', '$column3', '$column4', '$column5' )";
    } elseif ($table == 'semi_points_table') {
        $query = "INSERT INTO semi_points_table (match_id, team_id, set_1_points, set_2_points, set_3_points) VALUES ('$column1', '$column2', '$column3', '$column4', '$column5' )";
    } elseif ($table == 'match_table') {
        $query = "INSERT INTO match_table (match_id, team_id, venue_id) VALUES ('$column1', '$column2', '$column3')";
    } else {
        echo "Invalid table selection.";
        exit();
    }

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully into $table.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
