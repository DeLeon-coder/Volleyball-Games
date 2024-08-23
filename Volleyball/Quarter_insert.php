<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a team</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Home.php">Volleyball</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class= "navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="Home.php">Home<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="teams.php">Teams</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Update
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="Quarter_update.php">Quarter Games</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Insert
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="team_insert.php">Team</a>
                        <a class="dropdown-item" href="Quarter_insert.php">Quarter Games</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Delete
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
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
    if(empty($_POST['team_id'])) {
        $errors[] = 'You did not input an ID';
    } else {
        $id = mysqli_real_escape_string($conn, trim($_POST['team_id']));
    }
    
    //Check for match_id
    if(empty($_POST['match_id'])) {
        $errors[] = 'You did not input a match ID';
    } else {
        $match_id = mysqli_real_escape_string($conn, trim($_POST['match_id']));
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

    if(empty($errors)) { //If everything is OK
        //Input the team into the db

        //Make the Query
        $q = "INSERT INTO quarter_point_table (match_id, team_id, set_1_points, set_2_points, set_3_points) 
              VALUES ('$match_id', '$id', '$set1', '$set2', '$set3')";
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
<form action="Quarter_insert.php" method="post">
    <div class="container">
        <h2 class="text-center">Insert a Team</h2>
        <div class="form-group">
            <label for="match_id">Match ID</label>
            <input type="text" class="form-control" id="match_id" name="match_id" size="10" placeholder="Match ID..." value="<?php if (isset($_POST['match_id'])) echo htmlspecialchars($_POST['match_id']); ?>" />
        </div>
        
        <div class="form-group">
            <label for="team_id">Team ID</label>
            <input type="text" class="form-control" id="team_id" name="team_id" size="10" placeholder="Team ID..." value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" />
        </div>
        
        <div class="form-group">
            <label for="set_1_points">Set 1 Points</label>
            <input type="text" class="form-control" id="set_1_points" name="set_1_points" size="10" placeholder="Set 1 Points..." value="<?php if (isset($_POST['set_1_points'])) echo htmlspecialchars($_POST['set_1_points']); ?>" />
        </div>

        <div class="form-group">
            <label for="set_2_points">Set 2 Points</label>
            <input type="text" class="form-control" id="set_2_points" name="set_2_points" size="10" placeholder="Set 2 Points..." value="<?php if (isset($_POST['set_2_points'])) echo htmlspecialchars($_POST['set_2_points']); ?>" />
        </div>

        <div class="form-group">
            <label for="set_3_points">Set 3 Points</label>
            <input type="text" class="form-control" id="set_3_points" name="set_3_points" size="10" placeholder="Set 3 Points..." value="<?php if (isset($_POST['set_3_points'])) echo htmlspecialchars($_POST['set_3_points']); ?>" />
        </div>

        <button type="submit" class="btn btn-dark">Insert</button>
    </div>
</form>
