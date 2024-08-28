<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>
    <div class="container">
        <h2 class="text-center">Insert Data</h2>
        
        <!-- Form with table selection -->
        <form action="insert.php" method="post">
            <!-- Table selection dropdown -->
            <div class="form-group">
                <label for="table">Select Table:</label>
                <select class="form-control" id="table" name="table">
                    <option value="quarter_points_table">Quarter Table</option>
                    <option value="semi_points_table">Semi Table</option>
                    <option value="final_points_table">Final Table</option>
                </select>
            </div>

            <!-- Inputs for table data -->
            <div class="form-group">
                <label for="match_time_match_id">Match ID:</label>
                <input type="number" class="form-control" id="match_time_match_id" name="match_time_match_id" placeholder="Enter Match ID">
            </div>

            <div class="form-group">
                <label for="team_table_team_id">Team ID:</label>
                <input type="number" class="form-control" id="team_table_team_id" name="team_table_team_id" placeholder="Enter Team ID">
            </div>

            <div class="form-group">
                <label for="set_1_points">Set 1:</label>
                <input type="number" class="form-control" id="set_1_points" name="set_1_points" placeholder="Enter Set 1 points">
            </div>
            
            <div class="form-group">
                <label for="set_2_points">Set 2:</label>
                <input type="number" class="form-control" id="set_2_points" name="set_2_points" placeholder="Enter Set 2 points">
            </div>

            <div class="form-group">
                <label for="set_3_points">Set 3:</label>
                <input type="number" class="form-control" id="set_3_points" name="set_3_points" placeholder="Enter Set 3 points">
            </div>

            <button type="submit" class="btn btn-dark">Insert Data</button>
        </form>
        

        <?php
        // Include your database connection file
        require('connect.inc'); 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array(); //Initialize an Error

            //Check for ID
            if(empty($_POST['team_table_team_id'])) {
                $errors[] = 'You did not input an ID';
            } else {
                $id = mysqli_real_escape_string($conn, trim($_POST['team_table_team_id']));
            }
            
            //Check for match_id
            if(empty($_POST['match_time_match_id'])) {
                $errors[] = 'You did not input a match ID';
            } else {
                $match_id = mysqli_real_escape_string($conn, trim($_POST['match_time_match_id']));
            }

            //Check for set 1 points
            if(empty($_POST['set_1_points'])) {
                $errors[] = 'You did not input set 1 points';
            } else {
                $set1 = mysqli_real_escape_string($conn, trim($_POST['set_1_points']));
            }
            
            //Check for set 2 points
            if(empty($_POST['set_2_points'])) {
                $errors[] = 'You did not input set 2 points';
            } else {
                $set2 = mysqli_real_escape_string($conn, trim($_POST['set_2_points']));
            }

            //Check for set 3 points
            if(empty($_POST['set_3_points'])) {
                $errors[] = 'You did not input set 3 points';
            } else {
                $set3 = mysqli_real_escape_string($conn, trim($_POST['set_3_points']));
            }

            if(empty($errors)){
                // Get the selected table from the form
                $table = $_POST['table'];

                // Get and sanitize input values
                $match_id = mysqli_real_escape_string($conn, trim($_POST['match_time_match_id']));
                $team_id = mysqli_real_escape_string($conn, trim($_POST['team_table_team_id']));
                $set_1_points = mysqli_real_escape_string($conn, trim($_POST['set_1_points']));
                $set_2_points = mysqli_real_escape_string($conn, trim($_POST['set_2_points']));
                $set_3_points = mysqli_real_escape_string($conn, trim($_POST['set_3_points']));

                // Prepare the query based on the selected table
                if ($table == 'quarter_points_table') {
                    $query = "INSERT INTO quarter_points_table (match_time_match_id, team_table_team_id, set_1_points, set_2_points, set_3_points) VALUES ('$match_id', '$team_id', '$set_1_points', '$set_2_points', '$set_3_points')";
                } elseif ($table == 'semi_points_table') {
                    $query = "INSERT INTO semi_points_table (match_time_match_id, team_table_team_id, set_1_points, set_2_points, set_3_points) VALUES ('$match_id', '$team_id', '$set_1_points', '$set_2_points', '$set_3_points')";
                } elseif ($table == 'final_points_table') {
                    $query = "INSERT INTO final_points_table (match_time_match_id, team_table_team_id, set_1_points, set_2_points, set_3_points) VALUES ('$match_id', '$team_id', '$set_1_points', '$set_2_points', '$set_3_points')";
                } else {
                    echo "<p class='text-danger'>Invalid table selection.</p>";
                    exit();
                }

                // Execute the query and handle errors
                if (mysqli_query($conn, $query)) {
                    echo "<p class='text-success'>Data inserted successfully into $table.</p>";
                } else {
                    echo "<p class='text-danger'>Error: " . mysqli_error($conn) . "</p>";
                    echo "<p class='text'> Error: U have not inputed a team_id or match_id into their respective tables</p>";
                }

                // Close the database connection
                mysqli_close($conn);
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
