<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>
    <br>    
    <br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>

<?php 
// Set the page title
$page_title = 'Input Teams';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require('connect.inc'); //Connect to DB

    $errors = array(); //Initialize an Error

    //Check for ID
    if(empty($_POST['match_id'])) {
        $errors[] = 'You did not input an ID';
    } else {
        $id = mysqli_real_escape_string($conn, trim($_POST['match_id']));
    }
    
    //Check for Venue
    if(empty($_POST['venue_id'])) {
        $errors[] = 'You did not input a Venue';
    } else {
        $venue_name = mysqli_real_escape_string($conn, trim($_POST['venue_id']));
    }

    

    if(empty($errors)) { //If everything is OK
        //Input the team into the db

        //Make the Query
        $q = "INSERT INTO match_time (match_id, venue_id) 
              VALUES ('$id', '$venue_name')";
        $r = @mysqli_query($conn, $q); //Run the Query

        if ($r) { // If it ran ok
            //Print a success message
            echo '<h1>Thank You</h1>
                  <p>The match is now registered</p><p><br /></p>';
        } else { //If did not run ok
            //Public Message
            echo '<h1> System Error</h1>
                  <p class="error"> The match was not inputted due to a system error.</p>';

            //Debugging Message
            echo '<p>' . mysqli_error($conn) . '<br /><br />Query: ' . $q . '</p>';
        } //End of if ($r)

        mysqli_close($conn); //Close the DB connection
        exit(); //Quit the script
    } else { // Report the errors
        echo '<h1>Error!</h1>
              <p class="error"> The following errors occurred:<br />';
        foreach ($errors as $msg) { //Print each error
            echo "- $msg<br />\n";    
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    } //End of if (empty($errors))
} // End of the main submit conditional
?>
<form action="match_insert.php" method="post">
    <div class="container">
        <h2 class="text-center">Input a Match place</h2>
        
        <div class="form-group">
            <label for="match_id">Match ID</label>
            <input type="number" class="form-control" id="match_id" name="match_id" size="10" placeholder="Team ID..." value="<?php if (isset($_POST['match_id'])) echo htmlspecialchars($_POST['match_id']); ?>" min="0" title="Only numbers are allowed" />
        </div>
        
        <div class="form-group">
            <label for="venue_id">Venue</label>
            <input type="text" class="form-control" id="venue_id" name="venue_id" size="10" placeholder="Team Name..." value="<?php if (isset($_POST['venue_id'])) echo htmlspecialchars($_POST['venue_id']); ?>" pattern="[A-Za-z\s]+" title="Only letters are allowed" />
        </div>

        <button type="submit" class="btn btn-dark">Insert</button>
    </div>
</form>
