<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>
    <div class="container">
        <h2 class="text-center">Delete Points</h2>

        <?php
        // Include your database connection file
        require('connect.inc'); 

        // Fetch available team IDs
        $team_ids = array();

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

        <!-- Form with table and team selection -->
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

            <button type="submit" class="btn btn-dark">Delete Points</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get and sanitize input values
            $table = mysqli_real_escape_string($conn, $_POST['table']);
            $team_id = mysqli_real_escape_string($conn, trim($_POST['team_table_team_id']));

            // Ensure Team ID is provided
            if (empty($team_id)) {
                echo "<p class='text-danger'>Please select a Team ID.</p>";
                exit();
            }

            // Prepare the query to delete the row where team_id matches
            $query = "DELETE FROM $table WHERE team_table_team_id = '$team_id'";

            // Execute the query and handle errors
            if (mysqli_query($conn, $query)) {
                echo "<p class='text-success'>Row deleted successfully from $table for Team ID: $team_id.</p>";
            } else {
                echo "<p class='text-danger'>Error: " . mysqli_error($conn) . "</p>";
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
