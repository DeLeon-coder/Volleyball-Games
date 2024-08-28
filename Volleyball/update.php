<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>
    <div class="container">
        <h2 class="text-center">Update Points</h2>

        <?php
        // Include your database connection file
        require('connect.inc'); 

        // Fetch available match IDs and team IDs
        $match_ids = array();
        $team_ids = array();

        // Fetch match IDs from the match_time_table (or relevant table)
        $match_query = "SELECT match_id FROM match_time"; // Adjust table name if needed
        $match_result = mysqli_query($conn, $match_query);
        if ($match_result) {
            while ($row = mysqli_fetch_assoc($match_result)) {
                $match_ids[] = $row['match_id'];
            }
        } else {
            echo "<p class='text-danger'>Error fetching match IDs: " . mysqli_error($conn) . "</p>";
        }

        // Fetch team IDs from the team_table (or relevant table)
        $team_query = "SELECT team_id FROM team_table"; // Adjust table name if needed
        $team_result = mysqli_query($conn, $team_query);
        if ($team_result) {
            while ($row = mysqli_fetch_assoc($team_result)) {
                $team_ids[] = $row['team_id'];
            }
        } else {
            echo "<p class='text-danger'>Error fetching team IDs: " . mysqli_error($conn) . "</p>";
        }
        ?>

        <!-- Form with table selection -->
        <form action="" method="post">
            <!-- Table selection dropdown -->
            <div class="form-group">
                <label for="table">Select Table:</label>
                <select class="form-control" id="table" name="table">
                    <option value="quarter_points_table">Quarter Table</option>
                    <option value="semi_points_table">Semi Table</option>
                    <option value="final_points_table">Final Table</option>
                </select>
            </div>

            <!-- Match ID Dropdown -->
            <div class="form-group">
                <label for="match_time_match_id">Select Match ID:</label>
                <select class="form-control" id="match_time_match_id" name="match_time_match_id" required>
                    <option value="" disabled selected>Select Match ID</option>
                    <?php
                    foreach ($match_ids as $match_id) {
                        echo "<option value='$match_id'>$match_id</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Team ID Dropdown -->
            <div class="form-group">
                <label for="team_table_team_id">Select Team ID:</label>
                <select class="form-control" id="team_table_team_id" name="team_table_team_id" required>
                    <option value="" disabled selected>Select Team ID</option>
                    <?php
                    foreach ($team_ids as $team_id) {
                        echo "<option value='$team_id'>$team_id</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Inputs for points -->
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

            <button type="submit" class="btn btn-dark">Update Points</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array(); // Initialize error array

            // Get and sanitize input values
            $table = mysqli_real_escape_string($conn, $_POST['table']);
            $match_id = mysqli_real_escape_string($conn, trim($_POST['match_time_match_id']));
            $team_id = mysqli_real_escape_string($conn, trim($_POST['team_table_team_id']));
            $set_1_points = mysqli_real_escape_string($conn, trim($_POST['set_1_points']));
            $set_2_points = mysqli_real_escape_string($conn, trim($_POST['set_2_points']));
            $set_3_points = mysqli_real_escape_string($conn, trim($_POST['set_3_points']));

            // Ensure both Match ID and Team ID are provided
            if (empty($match_id) || empty($team_id)) {
                echo "<p class='text-danger'>Please provide both Match ID and Team ID.</p>";
                exit();
            }

            // Prepare the query to update points only where match_id and team_id match
            $updates = array();

            if (!empty($set_1_points)) {
                $updates[] = "set_1_points = '$set_1_points'";
            }

            if (!empty($set_2_points)) {
                $updates[] = "set_2_points = '$set_2_points'";
            }

            if (!empty($set_3_points)) {
                $updates[] = "set_3_points = '$set_3_points'";
            }

            if (count($updates) > 0) {
                // Join all update fields with commas
                $update_query = implode(", ", $updates);

                // Build the full update query
                $query = "UPDATE $table SET $update_query WHERE match_time_match_id = '$match_id' AND team_table_team_id = '$team_id'";

                // Execute the query and handle errors
                if (mysqli_query($conn, $query)) {
                    echo "<p class='text-success'>Points updated successfully in $table for Match ID: $match_id and Team ID: $team_id.</p>";
                } else {
                    echo "<p class='text-danger'>Error: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p class='text-danger'>No points were provided for update.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
