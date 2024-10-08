<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>
    <br>    
    <?php 
    // Set the page title
    $page_title = 'Input Teams';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require('connect.inc'); //Connect to DB

        $errors = array(); //Initialize an Error

        //Check for ID
        if(empty($_POST['team_id'])) {
            $errors[] = 'You did not input an ID';
        } else {
            $id = mysqli_real_escape_string($conn, trim($_POST['team_id']));
        }
        
        //Check for team name
        if(empty($_POST['team_name'])) {
            $errors[] = 'You did not input a Team Name';
        } else {
            $team_name = mysqli_real_escape_string($conn, trim($_POST['team_name']));
        }

        //Check for venue Id
        if(empty($_POST['wins'])) {
            $errors[] = 'You did not input a venue';
        } else {
            $v_id = mysqli_real_escape_string($conn, trim($_POST['wins']));
        }
        

        if(empty($errors)) { //If everything is OK
            //Input the team into the db

            //Make the Query
            $q = "INSERT INTO team_table (team_name, team_id, wins) 
                VALUES ('$team_name', '$id', '$v_id')";
            $r = @mysqli_query($conn, $q); //Run the Query

            if ($r) { // If it ran ok
                //Print a success message
                echo '<h1>Thank You</h1>
                    <p>The team is now registered</p><p><br /></p>';
            } else { //If did not run ok
                //Public Message
                echo '<h1> System Error</h1>
                    <p class="error"> The team was not inputted due to a system error.</p>';

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
    <form action="team_insert.php" method="post">
        <div class="container">
            <h2 class="text-center">Input a Team</h2>
            
            <div class="form-group">
                <label for="team_id">Team ID</label>
                <input type="number" class="form-control" id="team_id" name="team_id" size="10" placeholder="Team ID..." value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" />
            </div>
            
            <div class="form-group">
                <label for="team_name">Team Name</label>
                <input type="text" class="form-control" id="team_name" name="team_name" size="10" placeholder="Team Name..." value="<?php if (isset($_POST['team_name'])) echo htmlspecialchars($_POST['team_name']); ?>" />
            </div>

            <div class="form-group">
                <label for="">Wins</label>
                <input type="number" class="form-control" id="wins" name="wins" size="10" placeholder="Wins..." value="<?php if (isset($_POST['venue_id'])) echo htmlspecialchars($_POST['wins']); ?>" />
            </div>

            <button type="submit" class="btn btn-dark">Insert</button>
        </div>
    </form>

    <br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>

