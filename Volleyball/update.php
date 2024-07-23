<?php
$page_title='Update page';
include_once('connect.in');
//Check for form submission:
if($SERVER['REQUEST_METHOD']=='POST'){
    $errors = arrary(); //Initialize  an error array
    if(empty($_POST['team_id'])){
        $errors[] = 'You did not input a team ID';
    } else{
        $tid= mysqli_real_escape_string
        ($conn,trim($_POST['team_id']));
    }
    if(empty($_POST['team_name'])){
        $errors[] = 'You did not enter the current team name';
    } else{
        $tn = mysqli_real_escape_string
        ($conn,trim($_POST['team_name']));
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

        $q = "SELECT team_name  FROM Team_Table WHERE(team_id='$tid'team_name=SHA1('$tn'))";
        $r = @mysqli_query($conn,$q);
        $num = @mysqli_num_rows($r);
        if ($num == 1){ //Match was made.

            // Get the team_id
            $row = mysqli_fetch_array($r, MYSQLI_NUM);

            // Make the update query
            $q = "UPDATE Team_Table SET team_name=SHA1('$ntn') WHERE team_id=$row[0]";
            $r = @mysqli_num_rows($r);

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
<h1>Change a team name</h1>
<form action="update.php" method="post">
    <p>Team ID: <input type="text" name="team_id" size="10" value="<?php