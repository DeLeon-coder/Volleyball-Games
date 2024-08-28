<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete a Team</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <?php include('nav.php'); ?>
    <br>
    <br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>

<?php 
// Set the page title
$page_title = 'Delete Teams';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require('connect.inc'); // Connect to the database

    $errors = array(); // Initialize an Error array

    // Check for Team ID
    if(empty($_POST['team_id'])) {
        $errors[] = 'You did not input a Team ID';
    } else {
        $id = mysqli_real_escape_string($conn, trim($_POST['team_id']));
    }

    if(empty($errors)) { // If no errors, delete the team from the database

        // Make the Query to delete the team
        $q = "DELETE FROM team_table WHERE team_id='$id' LIMIT 1";
        $r = @mysqli_query($conn, $q); // Run the Query

        if ($r && mysqli_affected_rows($conn) == 1) { // If the query was successful and a row was deleted
            // Print a success message
            echo '<h1>Success</h1>
                  <p>The team has been successfully deleted.</p><p><br /></p>';
        } else { // If there was an error or no rows were affected
            // Public Message
            echo '<h1>System Error</h1>
                  <p class="error"> The team could not be deleted due to a system error or invalid Team ID.</p>';

            // Debugging Message
            echo '<p>' . mysqli_error($conn) . '<br /><br />Query: ' . $q . '</p>';
        }

        mysqli_close($conn); // Close the database connection
        exit(); // Quit the script
    } else { // Report the errors
        echo '<h1>Error!</h1>
              <p class="error">The following error occurred:<br />';
        foreach ($errors as $msg) { // Print each error
            echo "- $msg<br />\n";    
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    }
} 
?>

<!-- Delete Form -->
<form action="team_delete.php" method="post">
    <div class="container">
        <h2 class="text-center">Delete a Team</h2>
        
        <div class="form-group">
            <label for="team_id">Team ID</label>
            <input type="number" class="form-control" id="team_id" name="team_id" size="10" placeholder="Team ID..." value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" />
        </div>

        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
