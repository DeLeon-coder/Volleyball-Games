<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something</title>
    <link rel="stylesheet" href="home.css" type="text/css">
</head>


<body>
    
    <h1> Volleyball Roster </h1>
    <nav class=navbar>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="update.php">Update</a></li>
            <li><a href="INSERT.php">Insert</a></li>
        </ul>
    </nav>    
    <br>
</body>
</html>

<?php
$page_title='Update page';


//Check for form submission:
if($_SERVER['REQUEST_METHOD']=='POST'){
    include_once('connect.inc');// connect to db

    $errors = array(); //Initialize  an error array


    //Validate Team ID
    if(empty($_POST['team_id'])){
        $errors[] = 'You did not input a team ID';
    } else{
        $tid= mysqli_real_escape_string ($conn,trim($_POST['team_id']));
    }

    //Validate Team Name
    if(empty($_POST['team_name'])){
        $errors[] = 'You did not enter the current team name';
    } else{
        $tn = mysqli_real_escape_string ($conn,trim($_POST['team_name']));
    }

    if(empty($errors)){ // If everything's OK.
        //Check that if they have placed the correct current team name

        $q = "SELECT team_id  FROM team_table WHERE (team_id='$tid' AND team_name='$tn')";
        $r = @mysqli_query($conn,$q);
        if (!$r) {
            echo '<p>Query Error: ' . mysqli_error($conn) . '</p>';
        }
        $num = @mysqli_num_rows($r);
        if ($num == 1){ //Match was made.

            // Get the team_id
            $row = mysqli_fetch_array($r,MYSQLI_NUM);

            // Make the update query
            $q = "DELETE team_table WHERE (team_name='$tn' AND team_id='$tid')";
            $r = @mysqli_query($conn, $q);

            if(mysqli_affected_rows($conn) == 1){ //If it ran OK.
                //Print a Msg
                echo'<h2>Ok</h2>
                <p>Team has been deleted</p><p><br /></p>';
            } else{ //If did not run OK.
                //Public Msg
                echo'<h2> Error</h2>
                <p class="error">This Team could not be deleted due to a system error</p>';
                //Debbugging msg
                echo'<p>' . mysqli_error($conn) . '<br /><br />Query:'. $q . '</p>';
            }
            mysqli_close($conn); //Close the db connection
            exit();
        } else {//invalid team_id or team_name
            echo '<p>Invalid team ID or team name.</p>';
        }
    } else{ //Report the errors
        echo '<h1> Error!</h2>
        <p class="error"> The following error(s) occured:<br />';
        foreach($errors as $msg) { //Print each error
            echo "- $msg<br />\n"; 
        }
        echo '</p><p>Please Try again.</p><p><br /></p>';

    }// End of If (empty($errors)) IF.
    mysqli_close($conn); //Close the db connection
}// End of main Sumbit Conditional
?>
<h2>Change a Team Name</h2>
<form action="delete_team.php" method="post">
    <p>Team ID: <input type="text" name="team_id" size="10" value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" /></p>
    <p>Current Team Name: <input type="text" name="team_name" size="40" maxlength="60" value="<?php if (isset($_POST['team_name'])) echo htmlspecialchars($_POST['team_name']); ?>" /></p>
    <p><input type="submit" name="submit" value="Delete" /></p>
</form>


