<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php'); ?>
    <br>
    <?php 
    // Set the page title
    $page_title = 'Update Teams';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require('connect.inc'); //Connect to DB

        $errors = array(); // Initialize an Error array

        // Check for Team ID
        if(empty($_POST['team_id'])) {
            $errors[] = 'You did not input a Team ID';
        } else {
            $id = mysqli_real_escape_string($conn, trim($_POST['team_id']));
        }
        
        // Check for team name
        if(empty($_POST['team_name'])) {
            $errors[] = 'You did not input a Team Name';
        } else {
            $team_name = mysqli_real_escape_string($conn, trim($_POST['team_name']));
        }

        // Check for venue Id
        if(empty($_POST['venue_id'])) {
            $errors[] = 'You did not input a venue';
        } else {
            $v_id = mysqli_real_escape_string($conn, trim($_POST['venue_id']));
        }

        if(empty($errors)) { // If no errors, update the team in the database

            // Make the Query to update the team record
            $q = "UPDATE team_table SET team_name='$team_name', venue_id='$v_id' WHERE team_id='$id'";
            $r = @mysqli_query($conn, $q); // Run the Query

            if ($r) { // If the query was successful
                // Print a success message
                echo '<h1>Thank You</h1>
                    <p>The team details have been successfully updated.</p><p><br /></p>';
            } else { // If there was an error
                // Public Message
                echo '<h1>System Error</h1>
                    <p class="error"> The team details could not be updated due to a system error.</p>';

                // Debugging Message
                echo '<p>' . mysqli_error($conn) . '<br /><br />Query: ' . $q . '</p>';
            }

            mysqli_close($conn); // Close the database connection
            exit(); // Quit the script
        } else { // Report the errors
            echo '<h1>Error!</h1>
                <p class="error"> The following errors occurred:<br />';
            foreach ($errors as $msg) { // Print each error
                echo "- $msg<br />\n";    
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        }
    } 
    ?>

    <!-- Update Form -->
    <form action="team_update.php" method="post">
        <div class="container">
            <h2 class="text-center">Update a Team</h2>
            
            <div class="form-group">
                <label for="team_id">Team ID</label>
                <input type="number" class="form-control" id="team_id" name="team_id" size="10" placeholder="Team ID..." value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" />
            </div>
            
            <div class="form-group">
                <label for="team_name">Team Name</label>
                <input type="text" class="form-control" id="team_name" name="team_name" size="10" placeholder="Team Name..." value="<?php if (isset($_POST['team_name'])) echo htmlspecialchars($_POST['team_name']); ?>" />
            </div>

            <div class="form-group">
                <label for="venue_id">Venue ID</label>
                <input type="number" class="form-control" id="venue_id" name="venue_id" size="10" placeholder="Venue ID..." value="<?php if (isset($_POST['venue_id'])) echo htmlspecialchars($_POST['venue_id']); ?>" />
            </div>

            <button type="submit" class="btn btn-dark">Update</button>
        </div>
    </form>
    <br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>

