<?php
$page_title='Update page';


//Check for form submission:
if($_SERVER['REQUEST_METHOD']=='POST'){
    require ('connect.inc');// connect to db

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

    //Check for new password and match
    //against the confirmed password:
    if(!empty($_POST['new_tn1'])){
        if($_POST['new_tn1']!=$_POST['new_tn2']){
            $errors[]="Your new name does not match your confirmed name.";
        } else{
            $ntn = mysqli_real_escape_string($conn, trim($_POST['new_tn1']));      
        }
    }else{
        $errors[] = 'You forgot to enter your new name.';
    }
    if(empty($errors)){ // If everything's OK.
        //Check that if they have placed the correct current team name

        $q = "SELECT team_id  FROM Team_Table WHERE team_id='$tid' AND team_name=SHA1('$tn')";
        $r = @mysqli_query($conn,$q);
        /*if (!$r) {
            echo '<p>Query Error: ' . mysqli_error($conn) . '</p>';
        }*/
        $num = @mysqli_num_rows($r);
        if ($num == 1){ //Match was made.

            // Get the team_id
            $row = mysqli_fetch_array($r, MYSQLI_NUM);

            // Make the update query
            $q = "UPDATE team_table SET team_name=SHA1('$ntn') WHERE team_id='$tid'";
            $r = @mysqli_num_rows($conn,$q);

            if(mysqli_affected_rows($conn)==1){ //If it ran OK.
                //Print a Msg
                echo'<h2> Thank You</h2>
                <p>The current team has been updated</p><p><br /></p>';
            } else{ //If did not run OK.
                //Public Msg
                echo'<h2> Error</h2>
                <p class="error">Your new team name cannot be changed due to a system error.</p>';
                //Debbugging msg
                echo'<p>' . mysqli_error($conn) . '<br /><br />Query:'. $q . '</p>';
            }
            mysqli_close($conn); //Close the db connection
            exit();
        } else {//invalid team_id or team_name
            echo'<h2> Error!</h2>
            <p class="error"> The team ID and current team name do not match those on the file.</p>';
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
<h1>Change a Team Name</h1>
<form action="update.php" method="post">
    <p>Team ID: <input type="text" name="team_id" size="10" value="<?php if (isset($_POST['team_id'])) echo htmlspecialchars($_POST['team_id']); ?>" /></p>
    <p>Current Team Name: <input type="text" name="team_name" size="40" maxlength="60" value="<?php if (isset($_POST['team_name'])) echo htmlspecialchars($_POST['team_name']); ?>" /></p>
    <p>New Name: <input type="text" name="new_tn1" size="40" maxlength="60" value="<?php if (isset($_POST['new_tn1'])) echo htmlspecialchars($_POST['new_tn1']); ?>" /></p>
    <p>Confirm New Name: <input type="text" name="new_tn2" size="40" maxlength="60" value="<?php if (isset($_POST['new_tn2'])) echo htmlspecialchars($_POST['new_tn2']); ?>" /></p>
    <p><input type="submit" name="submit" value="Change Team Name" /></p>
</form>